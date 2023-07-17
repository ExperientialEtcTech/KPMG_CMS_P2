<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceVideoId']) && isset($_POST['VideoName'])){
		$details=array();
		$status=1;
		$ServiceId = $_POST['ServiceId'];
		//$ServiceName = $_POST['ServiceName'];
		//$ServiceOrder = $_POST['ServiceOrder'];
		$ServiceVideoId = $_POST['ServiceVideoId'];
		$VideoName = $_POST['VideoName'];
	
		$sql = "SELECT Id FROM VRServiceVideos WHERE Name = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$VideoName, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				response(Array("status"=>"0","msg"=>"Name is already taken"));
			}else{

				$sqlUpdate = "UPDATE VRServiceVideos SET Name = ? WHERE Id = ? AND IsActive = ?";
				$paramUpdate = array(&$VideoName, &$ServiceVideoId, &$status);
				$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
				if(sqlsrv_execute($stmtUpdate)){
					response(Array("status"=>"1","msg"=>"Successful"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed"));
				}


			}
		}else{
			die(print_r(sqlsrv_errors(), true)); 
			response(Array("status"=>"0","msg"=>"Fail"));
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