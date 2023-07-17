<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	
//if(isset($_POST['ResourceId']) && isset($_POST['HotspotId'])){
if(isset($_POST['HotspotResourceId'])){

		//$ResourceId = $_POST['ResourceId'];
		//$HotspotId = $_POST['HotspotId'];
		$HotResourceId = $_POST['HotspotResourceId'];
		$details=array();
		$status=1;
	
		//Checks if resourse is already present	
		//$sql = "SELECT * FROM MuralHotspotResources WHERE HotspotId = ? AND ResourceId = ? AND IsActive = ?";
		$sql = "SELECT * FROM MuralHotspotResources WHERE Id = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		//$param = array(&$HotspotId, &$ResourceId, &$status);
		$param = array(&$HotResourceId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
			
				//$sqlUpdate1 = "UPDATE MuralHotspotResources SET IsActive = 0 WHERE ResourceId = ? AND IsActive = ?";
				$sqlUpdate1 = "UPDATE MuralHotspotResources SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
				//$paramUpdate1 = array(&$ResourceId, &$status);
				$paramUpdate1 = array(&$HotResourceId, &$status);
				$stmtUpdate1 = sqlsrv_prepare( $conn, $sqlUpdate1, $paramUpdate1, $options);
				if(sqlsrv_execute($stmtUpdate1)){
						//print_r("IN");
						//Update status of content rows for this resource 
						$sqlUpdate2 = "UPDATE MuralHotspotContent SET IsActive = 0 WHERE HotspotResourceId = ? AND IsActive = ?";
						$paramUpdate2 = array(&$value, &$status);
						$stmtUpdate2 = sqlsrv_prepare( $conn, $sqlUpdate2, $paramUpdate2, $options);
						if(sqlsrv_execute($stmtUpdate2)){
							//Successfully removed from MuralHotspotContent
							response(Array("status"=>"1","msg"=>"Successfully"));
						}else{
							die(print_r(sqlsrv_errors(), true)); 
							response(Array("status"=>"0","msg"=>"Failed to Delete from MuralHotspotContent"));
						}
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed to Delete from MuralHotspotResources"));
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
