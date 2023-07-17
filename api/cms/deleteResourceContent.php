<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['ResourceContentId'])){
		$details=array();
		$status=1;
	
		$ResourceContentId = $_POST['ResourceContentId'];

		$sql = "SELECT * FROM MuralHotspotContent WHERE Id = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ResourceContentId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$sqlUpdate1 = "UPDATE MuralHotspotContent SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
				$paramUpdate1 = array(&$ResourceContentId, &$status);
				$stmtUpdate1 = sqlsrv_prepare( $conn, $sqlUpdate1, $paramUpdate1, $options);
				if(sqlsrv_execute($stmtUpdate1)){
					response(Array("status"=>"1","msg"=>"Successfully"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed to Delete from MuralHotspotContent"));
				}
			}else{
				response(Array("status"=>"0","msg"=>"No Resource Found"));
			}
		}else{
			die(print_r(sqlsrv_errors(), true)); 
			response(Array("status"=>"0","msg"=>"Fail"));
		}
	}else{
    	response(Array("status"=>"0","msg"=>"Invalid values"));
	}



function response($details)
{
	
	$response['response'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>