<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');		
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['city']))
{
    $details=array();
	$city = $_POST['city'];
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	$sql = "SELECT * FROM WeatherCities WHERE City = ? AND Status = ?;";
	$status=1;
	$params = array( &$city, &$status);
	$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
	sqlsrv_execute($stmt);

	if(sqlsrv_num_rows($stmt)>0){
		$row = sqlsrv_fetch_array($stmt);
		if($row['CityType'] == 1){
			response(Array("status"=>"0","msg"=>"Selected city is primary."));
		}else{
			$sqlDel = "UPDATE WeatherCities SET Status = 0 WHERE City = ? AND Status = ?";
			$status=1;
			$paramsDel = array( &$city, &$status);
			$stmtDel = sqlsrv_prepare( $conn, $sqlDel, $paramsDel, $options);
			if(sqlsrv_execute($stmtDel)){
				response(Array("status"=>"1","msg"=>"Success"));
			} else {
				response(Array("status"=>"0","msg"=>"Fail"));
			}
		}
	}else{
		response(Array("status"=>"0","msg"=>"No such city exists"));
	}
	
} else {
    response(Array("status"=>"0","msg"=>"Invalid values"));
}



function response($details)
{
	
	$response['response'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>