<?php
include_once('../../jwt/jwtAccess.php');
//print_r($jwtTtokenDecoded['jwtAuthUser']);
header("Content-Type:application/json");
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
//added by hariom for centre name -- start
/*if(!isset($_POST['centre']))
{
	header('HTTP/1.0 403 Forbidden');
	response( "Fail","Fail","Fail","Invalid Params");
	exit;
}*/
//added by hariom for centre name -- end
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

$key = 'bRuD5WYw5wd0rdHR';
$dbkey = '123412';
$method = 'aes128';

//vB2odJGA2%2BeWFQiFOoIDKA%3D%3D<br>cghBexg7tCbyRHLub0pEOw%3D%3D //presenter
//68b0LJQsXE98fvd%2BO78%2FBw%3D%3D<br>nzTBYJ5oDsV6vhhsbHwm1A%3D%3D //cms
//VdJ3c%2Bqz3tFCDQgDUTvB2g%3D%3D<br>sDzfRjZugJfKbcSIjVx%2B8w%3D%3D //rfid
/*
$userName="rfidadmin";
$passwordIns="Confermath2022!";
$password=urlencode(openssl_encrypt ($passwordIns, $method, $dbkey));
$JWTUser="kpmg_rfid";
$Name="Presenter Admin";

$sqlInsert="INSERT INTO LoginDetails (Username,Password,JWTUser,Name) VALUES (?,?,?,?)";

$params1 = array(&$userName,&$password,&$JWTUser,&$Name);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sqlInsert, $params1, $options);
if(!$stmt){
	die(print_r(sqlsrv_errors(), true));
}
sqlsrv_execute($stmt);


echo urlencode(openssl_encrypt ($userName, $method, $key));
echo "<br>";
echo urlencode(openssl_encrypt ($passwordIns, $method, $key));
exit;

*/
//$sql = "SELECT * FROM LoginDetails WHERE Username = ? AND CentreId = ? ";
$sql = "SELECT * FROM LoginDetails WHERE Username = ?";
$username = trim((openssl_decrypt(($_POST['username']), $method, $key, false)));
$password = trim((openssl_decrypt(($_POST['password']), $method, $key, false)));
//$CentreId = $_POST['centre'];

$password=urlencode(openssl_encrypt($password, $method, $dbkey));
//$params1 = array(&$username,$CentreId);
$params1 = array(&$username);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			$row = sqlsrv_fetch_array($stmt);
			if(($row['Password']==$password)&&($row['JWTUser']==$jwtTtokenDecoded['jwtAuthUser']))
			{
				response($row['Username'], $row['JWTUser'], $row['Name'],"Success");
			} else {
				header('HTTP/1.0 403 Forbidden');
				response( "Fail","Fail","Fail","Invalid Password");
				//echo "<script type='text/javascript'>alert('Invalid Password');</script>";
			}
		}else{
			header('HTTP/1.0 403 Forbidden');
			response( "Fail","Fail","Fail","Invalid User");
			//echo "<script type='text/javascript'>alert('Invalid User');</script>";
		}
	} else {
		header('HTTP/1.0 403 Forbidden');
		response( "Fail","Fail","Fail","SQL Error");
		//echo "<script type='text/javascript'>alert('SQL Error');</script>";
	}
}else{
	header('HTTP/1.0 403 Forbidden');
	response( "Fail","Fail","Fail","SQL Error");
	//echo "<script type='text/javascript'>alert('SQL Error');</script>";
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
	//echo $response['Msg'];
}
?>