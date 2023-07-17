<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['ResourceId'])){
		$details=array();
		$status=1;
	
		$ResourceId = $_POST['ResourceId'];
		//Assign resource
		//print_r($ResourceId);
		//Checks if resourse is already present	
		$sql = "SELECT * FROM MuralResourcesMaster WHERE Id = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ResourceId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				//Gets the hotspotresource Id of content rrelated to this resource
				$sqlget = "SELECT Id FROM MuralHotspotResources WHERE ResourceId = ? AND IsActive = ?";
				$paramget = array(&$ResourceId, &$status);
				$stmtget = sqlsrv_prepare( $conn, $sqlget, $paramget, $options);
				if(sqlsrv_execute($stmtget)){
					if(sqlsrv_num_rows($stmtget)>0){
						$HotspotResourceId = array();
						 while ($row = sqlsrv_fetch_array($stmtget)){
							$temp = $row['Id'];
							array_push($HotspotResourceId, $temp);
						}
					}
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed to get HotspotResourceId "));
				}
				
				//print_r($HotspotResourceId);
				//Updates if resourse is already present	and its status is 1, then update it to 0
				$sqlUpdate = "UPDATE MuralResourcesMaster SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
				$paramUpdate = array(&$ResourceId, &$status);
				$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
				if(sqlsrv_execute($stmtUpdate)){
					$sqlUpdate1 = "UPDATE MuralHotspotResources SET IsActive = 0 WHERE ResourceId = ? AND IsActive = ?";
					$paramUpdate1 = array(&$ResourceId, &$status);
					$stmtUpdate1 = sqlsrv_prepare( $conn, $sqlUpdate1, $paramUpdate1, $options);
					if(sqlsrv_execute($stmtUpdate1)){
						if(!empty($HotspotResourceId)){
							$result = 0;
							foreach ($HotspotResourceId as $value){	
								//Update status of content rows for this resource 
								$sqlUpdate2 = "UPDATE MuralHotspotContent SET IsActive = 0 WHERE HotspotResourceId = ? AND IsActive = ?";
								$paramUpdate2 = array(&$value, &$status);
								$stmtUpdate2 = sqlsrv_prepare( $conn, $sqlUpdate2, $paramUpdate2, $options);
								if(sqlsrv_execute($stmtUpdate2)){
									//Successfully removed from MuralHotspotContent
								}else{
									$result = 1;
									die(print_r(sqlsrv_errors(), true)); 
									response(Array("status"=>"0","msg"=>"Failed to Delete from MuralHotspotContent"));
								}
							}
							if($result == 0){
								response(Array("status"=>"1","msg"=>"Successfully"));
							}
						}	
						
					}else{
						die(print_r(sqlsrv_errors(), true)); 
						response(Array("status"=>"0","msg"=>"Failed to Delete from MuralHotspotResources"));
					}
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed to Delete"));
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