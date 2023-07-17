<?php
//include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");

$sql = "SELECT * FROM MasterCentres WHERE Status = 1";

$status=1;
$params1 = array(&$status);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
$tempArr = array();
$temp = array();
if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while ($row = sqlsrv_fetch_array( $stmt) ) {
				$temp[$row['Id']] = $row['CentreName'];
			}
			array_push($tempArr, $temp);
			response($tempArr);
		}else{
			response(NULL);
		}
	} else {
		die(print_r(sqlsrv_errors(), true)); 
	}
}else{
	die(print_r(sqlsrv_errors(), true)); 
	response( NULL);
}

sqlsrv_close($conn);
function response($creds)
{
	$response['centers'] = $creds;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}

?>