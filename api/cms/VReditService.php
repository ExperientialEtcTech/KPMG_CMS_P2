<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceId']) && isset($_POST['ServiceName']) && isset($_POST['ServiceOrder'])){
		$details=array();
		$status=1;
		$ServiceId = $_POST['ServiceId'];
		$ServiceName = $_POST['ServiceName'];
		$ServiceOrder = $_POST['ServiceOrder'];
	
		$sql = "SELECT Id, ServiceName, ServiceOrder FROM VRServices WHERE ServiceName = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceName, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				//response(Array("status"=>"0","msg"=>"Service name already taken."));
				
				$sqlCheck = "SELECT Id, ServiceName, ServiceOrder FROM VRServices WHERE Id = ? AND ServiceOrder = ? AND IsActive = ?";
				$paramCheck = array(&$ServiceId, &$ServiceOrder, &$status);
				$stmtCheck = sqlsrv_prepare( $conn, $sqlCheck, $paramCheck, $options);
				if(sqlsrv_execute($stmtCheck)){
					if(sqlsrv_num_rows($stmtCheck)>0){
						response(Array("status"=>"0","msg"=>"Service name and order are already taken."));
					}else{
						$sqlUpdate = "UPDATE VRServices SET ServiceOrder = ? WHERE Id = ? AND IsActive = ?";
						$paramUpdate = array( &$ServiceOrder, &$ServiceId, &$status);
						$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
						if(sqlsrv_execute($stmtUpdate)){
							response(Array("status"=>"1","msg"=>"Successful"));
						}else{
							die(print_r(sqlsrv_errors(), true)); 
							response(Array("status"=>"0","msg"=>"Failed"));
						}
						//response(Array("status"=>"0","msg"=>"Invalid service"));
					}
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Fail"));
				}
				
			}else{
				$sqlCheck = "SELECT Id, ServiceName, ServiceOrder FROM VRServices WHERE Id = ? AND IsActive = ?";
				$paramCheck = array(&$ServiceId, &$status);
				$stmtCheck = sqlsrv_prepare( $conn, $sqlCheck, $paramCheck, $options);
				if(sqlsrv_execute($stmtCheck)){
					if(sqlsrv_num_rows($stmtCheck)>0){
						$sqlUpdate = "UPDATE VRServices SET ServiceName = ?, ServiceOrder = ? WHERE Id = ? AND IsActive = ?";
						$paramUpdate = array(&$ServiceName, &$ServiceOrder, &$ServiceId, &$status);
						$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
						if(sqlsrv_execute($stmtUpdate)){
							response(Array("status"=>"1","msg"=>"Successful"));
						}else{
							die(print_r(sqlsrv_errors(), true)); 
							response(Array("status"=>"0","msg"=>"Failed"));
						}
					}else{
						response(Array("status"=>"0","msg"=>"Invalid service"));
					}
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Fail"));
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