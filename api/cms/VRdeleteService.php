<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceId'])){
		$details=array();
		$status=1;
		$ServiceId = $_POST['ServiceId'];
	
		$sql = "SELECT Id, ServiceName, ServiceOrder FROM VRServices WHERE Id = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$sqlUpdate = "UPDATE VRServices SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
				$paramUpdate = array(&$ServiceId, &$status);
				$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
				if(sqlsrv_execute($stmtUpdate)){
					//Added by Shubham  - 25/08
					$sqlVid = "UPDATE VRServiceVideos SET IsActive = 0 WHERE ServiceId = ? AND IsActive = ?";
					$paramVid = array(&$ServiceId, &$status);
					$stmtVid = sqlsrv_prepare( $conn, $sqlVid, $paramVid, $options);
					if(sqlsrv_execute($stmtVid)){
						response(Array("status"=>"1","msg"=>"Successful"));
					}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed"));
					}
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