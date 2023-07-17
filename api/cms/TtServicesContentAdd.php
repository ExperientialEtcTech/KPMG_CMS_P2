<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();
//Adde by shubham - 30/08
//$sql='INSERT INTO TtContentMaster ("ServiceId","Type","IsActive","Data") VALUES(?,?,?,?)';
$sql='INSERT INTO TtContentMaster ("ServiceId","Type","IsActive","Data", "DisplayName") VALUES(?,?,?,?,?)';

//Added by shubham - 30/08
//if(!isset($_POST['ServiceId']) && !isset($_POST['Type']) && !isset($_POST['Data']))
if(!isset($_POST['ServiceId']) && !isset($_POST['Type']) && !isset($_POST['Data']) && !isset($_POST['DisplayName']))
{
	response("Invalid Params");
	exit;
}

$ServiceId = $_POST['ServiceId'];
$Type=$_POST['Type'];
$IsActive="1";
$Data=$_POST['Data'];
//added by shubham - 29/08
$DisplayName=$_POST['DisplayName'];

//Added by shubham - 29/08
//$params = array(&$ServiceId,&$Type,&$IsActive,&$Data);
$params = array(&$ServiceId,&$Type,&$IsActive,&$Data, &$DisplayName);

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
	$response['contents'] = $details;
	$json_response = json_encode($response);
	echo $json_response;
}
?>