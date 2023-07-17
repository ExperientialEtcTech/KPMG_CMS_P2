<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sql='INSERT INTO TtServicesMaster ("Service","ParentId","IsActive","icon") VALUES(?,?,?,?)';

if(!isset($_POST['service']))
{
	response("Invalid Params");
	exit;
}

$parentId = $_POST['parentid'];
$servieName=$_POST['service'];
$IsActive="1";
$icon=$_POST['iconUrl'];
$params = array(&$servieName,&$parentId,&$IsActive,&$icon);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		response("Record Added");
	}
}else{
die(print_r(sqlsrv_errors(), true)); 
	response( NULL);
}
sqlsrv_close($conn);

function response($details)
{
	
	$response['services'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>