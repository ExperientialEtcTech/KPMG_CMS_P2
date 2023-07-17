<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
//print_r($_POST);
if(!isset($_POST['username']))
{
	header('HTTP/1.0 403 Forbidden');
	response( "Fail","Fail","Fail","Invalid Params");
	exit;
}
if(!isset($_POST['password']))
{
	header('HTTP/1.0 403 Forbidden');
	response( "Fail","Fail","Fail","Invalid Params");
	exit;
}
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

$key = 'bRuD5WYw5wd0rdHR';
$dbkey = '123412';
$method = 'aes128';

$sql = "UPDATE LoginDetails SET Password=? WHERE Username = ?";
$username = trim((openssl_decrypt(($_POST['username']), $method, $key, false)));
$password = trim((openssl_decrypt(($_POST['password']), $method, $key, false)));

$password=urlencode(openssl_encrypt ($password, $method, $dbkey));

$params1 = array(&$password,&$username);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
				response($username, "", $row['Name'],"Success");
		}else{
			header('HTTP/1.0 403 Forbidden');
			response( "Fail","Fail","Fail","Invalid User");
		}
	} else {
		header('HTTP/1.0 403 Forbidden');
		response( "Fail","Fail","Fail","SQL Error");
	}
}else{
	header('HTTP/1.0 403 Forbidden');
	response( "Fail","Fail","Fail","SQL Error");
}
sqlsrv_close($conn);

function response($userName,  $UserApp, $name,$msg){
	$response['Username'] = $userName;
	$response['UserApp'] = $UserApp;
	$response['Name'] = $name;
	$response['Msg'] = $msg;
	$json_response = json_encode($response);
	insert_log($conn,"login",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>