<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');		
date_default_timezone_set("Asia/Kolkata");

$json=file_get_contents('php://input');
$decode_array = json_decode($json,true)['handles'];

if(!empty($decode_array)){


	foreach($decode_array as $handles){
	
//if(isset($_POST['twitter_handles']) && isset($_POST['id'])){
		$details=array();
		$id=$handles['id'];
		$twitter_handles=$handles['twitter_handles'];
		//$id=$_POST['id'];
		//$twitter_handles=$_POST['twitter_handles'];
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

		//$stmt = $mysqli->prepare("UPDATE `signoff` SET `status`=0 WHERE `status`=?");
		$sql = "UPDATE TwitterHandles SET TwitterHandle = ? WHERE Id=?";
		$params = array(&$twitter_handles, &$id);
		$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
		sqlsrv_execute($stmt);

		if(sqlsrv_execute($stmt)){
			response(Array("status"=>"1","msg"=>"Success"));
			//$count+=1;
		}else{
			response(Array("status"=>"0","msg"=>"Fail"));
		}

	} 

}else {
    response(Array("status"=>"0","msg"=>"Invalid values"));
}


function response($details)
{
	
	$response['response'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>