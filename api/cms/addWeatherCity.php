<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');		
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['cities']) || isset($_POST['CityType']))
{
	
    $details=array();
	$city = $_POST['cities'];
	$city_type = $_POST['CityType'];
	
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$status=1;
	
	$sqlCheck = "SELECT * FROM WeatherCities WHERE City = ?";
	$paramCheck  = array(&$city);
	$stmtCheck = sqlsrv_prepare( $conn, $sqlCheck, $paramCheck, $options);
	sqlsrv_execute($stmtCheck);
	if(sqlsrv_num_rows($stmtCheck)>0){
		//If city is already present
		$rowCheck = sqlsrv_fetch_array( $stmtCheck);
		
		if($rowCheck['Status'] == 1 AND $rowCheck['CityType'] == 0 AND $city_type == 0){
			//If city is already present
			response(Array("status"=>"0","msg"=>"City already present"));
			
		}else if($rowCheck['Status'] == 1 AND $rowCheck['CityType'] == 0 AND $city_type == 1){
			//If city is already present and Citytype is 0, then set it to 1 and the previously city's citytype as 0
			$sql = "UPDATE WeatherCities SET CityType=0 WHERE Status=? AND CityType = ?";
			$params = array(&$status, &$city_type);
			$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
			sqlsrv_execute($stmt);
			
			$sqlCheckUpdate = "UPDATE WeatherCities SET CityType=1 WHERE Status=? AND CityType = 0 AND City = ?";
			$paramsCheckUpdate  = array(&$status, &$city);
			$stmtCheckUpdate  = sqlsrv_prepare( $conn, $sqlCheckUpdate , $paramsCheckUpdate , $options);
			if(sqlsrv_execute($stmtCheckUpdate)){
				response(Array("status"=>"1","msg"=>"City has been set to Primary"));
			}
		}else if($rowCheck['Status'] == 0 AND $rowCheck['CityType'] == 0){
			$sqlCheckUpdate = "UPDATE WeatherCities SET Status=1 WHERE Status = 0 AND CityType = 0 AND City = ?";
			$paramsCheckUpdate  = array(&$city);
			$stmtCheckUpdate  = sqlsrv_prepare( $conn, $sqlCheckUpdate , $paramsCheckUpdate , $options);
			if(sqlsrv_execute($stmtCheckUpdate)){
				response(Array("status"=>"1","msg"=>"Success"));
			}
		}
		
		
	}else{
		if($city_type == 1){
			$sql = "UPDATE WeatherCities SET CityType=0 WHERE Status=?";
			$params = array(&$status);
			$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
			sqlsrv_execute($stmt);
		}

		$sql1 = "INSERT INTO WeatherCities(City,  Status, CityType) VALUES (?,?,?)";
		$params1 = array( &$city, &$status, &$city_type);
		$stmt1 = sqlsrv_prepare( $conn, $sql1, $params1, $options);
		if(sqlsrv_execute($stmt1)){
			response(Array("status"=>"1","msg"=>"Success"));
		}else{
			response(Array("status"=>"0","msg"=>"Fail"));
		}
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