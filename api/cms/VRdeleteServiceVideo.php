<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceVideoId'])){
		$details=array();
		$status=1;
		$ServiceVideoId = $_POST['ServiceVideoId'];
	
		$sql = "SELECT * FROM VRServiceVideos WHERE Id = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceVideoId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$sqlUpdate = "UPDATE VRServiceVideos SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
				$paramUpdate = array(&$ServiceVideoId, &$status);
				$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
				if(sqlsrv_execute($stmtUpdate)){
					response(Array("status"=>"1","msg"=>"Successful"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed"));
				}
			}else{
				response(Array("status"=>"0","msg"=>"Invalid Service"));
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