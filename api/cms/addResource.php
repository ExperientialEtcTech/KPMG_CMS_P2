<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['ResourceName']) && isset($_POST['ResourceType']) && isset($_POST['LabelUrl']) && isset($_POST['IconUrl'])){
		$details=array();
		$status=1;
		
		$ResourceName = $_POST['ResourceName'];
		$ResourceType = $_POST['ResourceType'];
		$LabelUrl = $_POST['LabelUrl'];
		$IconUrl = $_POST['IconUrl'];
		
		//Assign resource
			
		//Checks if resourse is already present	
		$sql = "SELECT ResourceName, ResourceType, IsActive FROM MuralResourcesMaster WHERE ResourceName = ? AND ResourceType = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ResourceName, &$ResourceType, $status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$row = sqlsrv_fetch_array($stmt);
				//print_r($row['IsActive']);
				//if($row['IsActive'] == 1){
					response(Array("status"=>"0","msg"=>"Resource already exists"));
				//}
				//Commented by shubhsm - 26-08
				/*
				else if($row['IsActive'] == 0){
					//Checks if resourse is already present	and its status is 0, then update it to 1
					$sqlUpdate = "UPDATE MuralResourcesMaster SET IsActive = 1 WHERE IsActive = 0 AND ResourceName = ? AND ResourceType = ?";
					$paramUpdate = array(&$ResourceName, &$ResourceType);
					$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successfully Updated"));
					}else{
						die(print_r(sqlsrv_errors(), true)); 
						response(Array("status"=>"0","msg"=>"Failed to Update"));
					}
				}
				*/
			}else{
				
				//Inserts new Resource 
				$sqlIns = "INSERT INTO MuralResourcesMaster (ResourceName, ResourceType, LabelUrl, IconUrl, IsActive) VALUES (?,?,?,?,?)";
				$paramIns = array(&$ResourceName, &$ResourceType, &$LabelUrl, &$IconUrl, &$status);
				$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramIns, $options);
				if(sqlsrv_execute($stmtIns)){
					response(Array("status"=>"1","msg"=>"Successfully Inserted"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed to Insert"));
				}
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
	
	$response['resources'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>