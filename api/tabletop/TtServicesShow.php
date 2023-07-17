<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

/* get all services as array */
$services=array();

$sql="SELECT Id,Service,ParentId,icon FROM TtServicesMaster WHERE IsActive=?";
$isActive = 1;

$params = array(&$isActive);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while($row = sqlsrv_fetch_array($stmt))
			{
				$temp=array("Id"=>$row['Id'],"Service"=>$row['Service'],"ParentId"=>$row['ParentId'],"icon"=>$row['icon']);
				array_push($services, $temp);
			}
			//response($details);
		}else{
			//response( NULL);
		}
	}
	
	
}else{
die(print_r(sqlsrv_errors(), true)); 
	//response( NULL);
}
/* end get all services as array */

/* get all service content as array */
$details=array();


//Added by shubham 30/08
//$sql="SELECT Id,ServiceId,Type,Data FROM TtContentMaster WHERE ServiceId=? AND IsActive=1";
$sql="SELECT Id,ServiceId,Type,Data,DisplayName FROM TtContentMaster WHERE IsActive=1";
$isActive = 1;
$params = array(&$isActive);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while($row = sqlsrv_fetch_array($stmt))
			{
				//Added by shubham - 30/08
				//$temp=array("Id"=>$row['Id'],"ServiceId"=>$row['ServiceId'],"Type"=>$row['Type'],"Data"=>$row['Data']);
				$temp=array("Id"=>$row['Id'],"ServiceId"=>$row['ServiceId'],"Type"=>$row['Type'],"Data"=>$row['Data'], "DisplayName"=>$row['DisplayName']);
				
				array_push($details, $temp);
			}
			//response($details);
		}else{
			//response( NULL);
		}
	} else {
		die(print_r(sqlsrv_errors(), true)); 
	}
	
	
}else{
die(print_r(sqlsrv_errors(), true)); 
	//response( NULL);
}
/* end get all service content as array */

sqlsrv_close($conn);
//print_r($details);
$initParent=0;
if(isset($_GET['Parent']))
{
	$initParent=$_GET['Parent'];
}
$treeArray=buildTree($services,$initParent,$details);
response($treeArray);
//print_r($treeArray); 
function searchContent($inpArray,$idValue)
{
    //return Array("Count".count($inpArray));
$tempArray1=Array();
    foreach ($inpArray as $value) {
        if($value['ServiceId']==$idValue)
        {
            $tempArray1[]= $value;
            //break;
        } else {
            //return $value['ServiceId'];
        }

    }
return $tempArray1;
}

function buildTree(array &$elements, $parentId = 0,array &$contentArray) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['ParentId'] == $parentId) {
            //$tempArray=$contentArray;
            $children = buildTree($elements, $element['Id'],$contentArray);
            if ($children) {
                $element['children'] = $children;
            }
            $element['content'] = searchContent($contentArray,$element['Id']);
            $branch[] = $element;//$element['Id']
            //unset($elements[$element['Id']]);
        }
    }
    return $branch;
}

function response($details)
{
	
	//$response['services'] = $details;

	$json_response = json_encode($details,JSON_INVALID_UTF8_SUBSTITUTE);
	print_r($json_response);
	//echo  json_last_error_msg();
}
?>