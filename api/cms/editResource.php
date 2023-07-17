<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['ResourceName']) && isset($_POST['ResourceType']) && isset($_POST['ResourceId']) && isset($_POST['IconUrl']) & isset($_POST['LabelUrl'])){
		$details=array();
		$status=1;
		$Id = $_POST['ResourceId'];
		$ResourceName = $_POST['ResourceName'];
		$ResourceType = $_POST['ResourceType'];		
		$IconUrl = $_POST['IconUrl'];
		$LabelUrl = $_POST['LabelUrl'];		
		
		//Assign resource
		
		//Checks if resource is already present	
		$sql = "SELECT ResourceName, ResourceType FROM MuralResourcesMaster WHERE Id = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$Id, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			
			if(sqlsrv_num_rows($stmt)>0){
					$row = sqlsrv_fetch_array($stmt);
					//Checks if resourse is already present	and its status is 0, then update it to 1
					$sqlUpdate = "UPDATE MuralResourcesMaster SET ResourceName = ?, ResourceType = ?, IconUrl = ?, LabelUrl = ?, IsActive = ? WHERE Id = ?";
					$paramUpdate = array(&$ResourceName, &$ResourceType, &$IconUrl, &$LabelUrl, &$status, &$Id);
					$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successfully Updated"));
					}else{
						die(print_r(sqlsrv_errors(), true)); 
						response(Array("status"=>"0","msg"=>"Failed to Update"));
					}
				
			}else{
					//die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"No such active ResourceId"));
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