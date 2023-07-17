<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['Id']) && isset($_POST['HotspotType'])){
	
		$details=array();
		$status=1;
		$Id = $_POST['Id'];
		$HotspotType = $_POST['HotspotType'];
		
		//For Loaction Hotspots 
		if($HotspotType == 'location' || $HotspotType == 'Location'){
					
			$sql = "SELECT * FROM RelativeHotspots WHERE Id = ? AND IsActive = ?";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$param = array(&$Id, &$status);
			$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
			if(sqlsrv_execute($stmt)){
				if(sqlsrv_num_rows($stmt)>0){
					//To Update the entered changes
					$sqlUpdate = "UPDATE RelativeHotspots SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
					$paramUpdate  = array(&$Id, &$status);
					$stmtUpdate  = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successful"));
					}else{
						response(Array("status"=>"0","msg"=>"Failed"));
					}
					
				}else{
					response(Array("status"=>"0","msg"=>"No Resource Found"));
				}
			}else{
				die(print_r(sqlsrv_errors(), true)); 
				response(Array("status"=>"0","msg"=>"Fail"));
			}
			
		}elseif($HotspotType == 'content' || $HotspotType == 'Content'){
		//For Content Hotspots 
			$sql = "SELECT * FROM HotspotContent WHERE Id = ? AND IsActive = ?";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$param = array(&$Id, &$status);
			$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
			if(sqlsrv_execute($stmt)){
				if(sqlsrv_num_rows($stmt)>0){
					//To Update the entered changes
					$sqlUpdate = "UPDATE HotspotContent SET IsActive = 0 WHERE Id = ? AND IsActive = ?";
					$paramUpdate  = array( &$Id, &$status);
					$stmtUpdate  = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successful"));
					}else{
						response(Array("status"=>"0","msg"=>"Failed"));
					}
					
				}else{
					response(Array("status"=>"0","msg"=>"No Resource Found"));
				}
			}else{
				die(print_r(sqlsrv_errors(), true)); 
				response(Array("status"=>"0","msg"=>"Fail"));
			}
		}else{
			response(Array("status"=>"0","msg"=>"Invalid Hotspot type"));
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