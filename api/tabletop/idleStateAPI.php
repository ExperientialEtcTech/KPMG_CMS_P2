<?php
include_once('../../jwt/jwtAccess.php');
/*
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST'); 
*/
header("Content-Type:application/json");

include('../db.php');

$twitterSQL = "SELECT TwitterHandle FROM TwitterHandles WHERE Status = ?";
$kaleidoscopeSQL = "SELECT FilePath FROM IdleStateKaleidoscope WHERE Status = ?";
//$weatherSQL = "SELECT City FROM WeatherCities WHERE Status = ?";
$weatherSQL = "SELECT City,CityType FROM WeatherCities WHERE Status=? ORDER BY CityType DESC, Id ASC";
$status = 1;

$params1 = array(&$status);
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_prepare( $conn, $twitterSQL, $params1, $options);

if($stmt1){
    if(sqlsrv_execute($stmt1)){
        $twitter_handles = array();
        if(sqlsrv_num_rows($stmt1)>0){
	        while ($row = sqlsrv_fetch_array( $stmt1) ) {
	            $temp = $row['TwitterHandle'];
	            array_push($twitter_handles, $temp);
	        }
        }else{
            $twitter_handles = NULL;
        }
    }
    
}else{
    $twitter_handles = NULL;
}

$stmt2 = sqlsrv_prepare( $conn, $kaleidoscopeSQL, $params1, $options);
if($stmt2){
    if(sqlsrv_execute($stmt2)){
        $slides_path = array();
        if(sqlsrv_num_rows($stmt2)>0){
	        while ($row = sqlsrv_fetch_array($stmt2) ) {
	            $temp = $row['FilePath'];
	            array_push($slides_path, $temp);
	        }
        }else{
            $slides_path = NULL;
        }
    }
    
}else{
    $slides_path = NULL;
}

$stmt3 = sqlsrv_prepare( $conn, $weatherSQL, $params1, $options);
if($stmt3){
    if(sqlsrv_execute($stmt3)){
        $cities = array();
        if(sqlsrv_num_rows($stmt3)>0){
	        while ($row = sqlsrv_fetch_array($stmt3) ) {
	            $temp = $row['City'];
	            array_push($cities, $temp);
	        }
        }else{
            $cities = NULL;
        }
    }
    
}else{
    $cities = NULL;
}

response($twitter_handles, $slides_path, $cities);

function response($twitter_handles, $slides_path, $cities){
	$response['twitter_handles'] = $twitter_handles ;
	$response['slides_path'] = $slides_path ;
	$response['cities'] = $cities ;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>
