<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sql='UPDATE TtServicesMaster SET Service=?, icon=? WHERE Id=?';

if(!isset($_POST['Id']))
{
	response("Invalid Params");
	exit;
}

$Id = $_POST['Id'];
$Service = $_POST['Service'];
$icon = $_POST['icon'];

$params = array(&$Service,&$icon,&$Id);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		response("Record Updated");
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