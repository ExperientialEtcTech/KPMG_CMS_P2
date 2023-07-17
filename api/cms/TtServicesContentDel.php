<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sql='UPDATE TtContentMaster SET IsActive=0 WHERE Id=? AND IsActive=1';

if(!isset($_POST['ContentId']))
{
	response("Invalid Params");
	exit;
}

$status = 1;
$ContentId = $_POST['ContentId'];


$params = array(&$ContentId);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		response("Record Deleted");
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