<?php
//include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sqlParent="SELECT ParentId,Service FROM TtServicesMaster WHERE Id=? AND IsActive=1";

//Added by shubham 30/08
//$sql="SELECT Id,ServiceId,Type,Data FROM TtContentMaster WHERE ServiceId=? AND IsActive=1";
$sql="SELECT Id,ServiceId,Type,Data,DisplayName FROM TtContentMaster WHERE ServiceId=? AND IsActive=1";
$ServiceId = 0;
if(isset($_POST['ServiceId']))
{
	$ServiceId=$_POST['ServiceId'];
}
$params = array(&$ServiceId);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);


	$stmtParent = sqlsrv_prepare($conn, $sqlParent, $params, $options);
	sqlsrv_execute($stmtParent);
	$rowParent = sqlsrv_fetch_array($stmtParent);
	$parentPage=$rowParent['ParentId'];
	$parentPageName=$rowParent['Service'];


if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while($row = sqlsrv_fetch_array($stmt))
			{	
				//$Content = str_replace ("�","",$row['Data']);
				//print_r($Content);
				//print_r($row['Data']);
				//Added by shubham - 30/08
				//$temp=array("Id"=>$row['Id'],"ServiceId"=>$row['ServiceId'],"Type"=>$row['Type'],"Data"=>$row['Data']);
				$temp=array("Id"=>$row['Id'],"ServiceId"=>$row['ServiceId'],"Type"=>$row['Type'],"Data"=>$row['Data'], "DisplayName"=>$row['DisplayName']);
				
				array_push($details, $temp);
			}
			//print_r($details);
			response($details,$parentPage,$parentPageName);
		}else{
			response( NULL,$parentPage,$parentPageName);
		}
	} else {
		die(print_r(sqlsrv_errors(), true)); 
	}
	
	
}else{
die(print_r(sqlsrv_errors(), true)); 
	response( NULL);
}
sqlsrv_close($conn);



function response($details1,$parent,$parentname)
{
	$response['contents'] = $details1; 
	$response['parent'] = $parent;
	$response['parentname'] = $parentname;
	$json_response = json_encode($response,JSON_INVALID_UTF8_SUBSTITUTE);
	echo $json_response;
}
?>