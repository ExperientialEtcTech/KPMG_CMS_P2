<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['ResourceId'])  && isset($_POST['HotspotId'])){
		$details=array();
		$status=1;
		
		$ResourceId = $_POST['ResourceId'];
		$HotspotId = $_POST['HotspotId'];
		//Assign resource
			
		//Checks if resourse is already present	
		$sql = "SELECT ResourceId, HotspotId, IsActive FROM MuralHotspotResources WHERE ResourceId = ? AND HotspotId = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ResourceId, &$HotspotId);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$row = sqlsrv_fetch_array($stmt);
				if($row['IsActive'] == 1){
					response(Array("status"=>"0","msg"=>"Resource is already assigned"));
				}else if($row['IsActive'] == 0){
					//Checks if resourse is already present	and its status is 0, then update it to 1
					$sqlUpdate = "UPDATE MuralHotspotResources SET IsActive = 1 WHERE IsActive = 0 AND ResourceId = ? AND HotspotId = ?";
					$paramUpdate = array(&$ResourceId, &$HotspotId);
					$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successfully assigned"));
					}else{
						die(print_r(sqlsrv_errors(), true)); 
						response(Array("status"=>"0","msg"=>"Failed to assigned"));
					}
				}
				
			}else{
				
				//Inserts new Resource 
				$sqlIns = "INSERT INTO MuralHotspotResources (ResourceId, HotspotId, IsActive) VALUES (?,?,?)";
				$paramIns = array(&$ResourceId, &$HotspotId, &$status);
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