<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
/*
if ((isset($_POST['id']))){
*/
	$sql = "SELECT RfidNumber FROM MasterRfid WHERE AssignedStatus = 0";


$params1 = array(&$status);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
$tempArr = array();
if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while ($row = sqlsrv_fetch_array( $stmt) ) {
				$temp = $row['RfidNumber'];
				array_push($tempArr, $temp);
			}
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
/*
} else {
	response(NULL);
}
*/


function response($creds)
{
	$response['rfidList'] = $creds;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>