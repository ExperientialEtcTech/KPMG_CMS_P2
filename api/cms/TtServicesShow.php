<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sqlParent="SELECT ParentId,Service FROM TtServicesMaster WHERE Id=? AND IsActive=1";

$sql="SELECT Id,Service,ParentId,icon FROM TtServicesMaster WHERE ParentId=? AND IsActive=1";
$parentId = 0;
if(isset($_POST['parentId']))
{
	$parentId=$_POST['parentId'];
}
$params = array(&$parentId);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

$parentPage=-1;
$parentPageName="Services";
if($parentId>0)
{
	$stmtParent = sqlsrv_prepare($conn, $sqlParent, $params, $options);
	sqlsrv_execute($stmtParent);
	$rowParent = sqlsrv_fetch_array($stmtParent);
	$parentPage=$rowParent['ParentId'];
	$parentPageName=$rowParent['Service'];
} else {
//return parent page as 0
}

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while($row = sqlsrv_fetch_array($stmt))
			{
				$temp=array("Id"=>$row['Id'],"Service"=>$row['Service'],"ParentId"=>$row['ParentId'],"icon"=>$row['icon']);
				array_push($details, $temp);
			}
			response($details,$parentPage,$parentPageName);
		}else{
			response( NULL,$parentPage,$parentPageName);
		}
	}
}else{
die(print_r(sqlsrv_errors(), true)); 
	response( NULL);
}

sqlsrv_close($conn);

function response($details,$parent,$parentname)
{
	
	$response['services'] = $details;
	$response['parent'] = $parent;
	$response['parentname'] = $parentname;
	$json_response = json_encode($response);
	echo $json_response;
}
?>