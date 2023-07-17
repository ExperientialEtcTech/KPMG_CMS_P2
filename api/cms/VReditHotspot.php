<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['Id']) && isset($_POST['HotspotType']) && isset($_POST['PosX']) && isset($_POST['PosY']) && isset($_POST['PosZ']) && isset($_POST['RotX']) && isset($_POST['RotY']) && isset($_POST['RotZ']) && isset($_POST['Content']) && isset($_POST['ContentType'])){
	
		$details=array();
		$status=1;
		$Id = $_POST['Id'];
		$HotspotType = $_POST['HotspotType'];
		
		//For Loaction Hotspots 
		if($HotspotType == 'location' || $HotspotType == 'Location'){
			$PosX = $_POST['PosX'];
			$PosY = $_POST['PosY'];
			$PosZ = $_POST['PosZ'];
			$RotX = $_POST['RotX'];
			$RotY = $_POST['RotY'];
			$RotZ = $_POST['RotZ'];
			
			
			$sql = "SELECT * FROM RelativeHotspots WHERE Id = ? AND IsActive = ?";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$param = array(&$Id, &$status);
			$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
			if(sqlsrv_execute($stmt)){
				if(sqlsrv_num_rows($stmt)>0){
					//To Update the entered changes
					$sqlUpdate = "UPDATE RelativeHotspots SET PosX = ?, PosY = ?,PosZ = ?,RotX = ?,RotY = ?,RotZ = ? WHERE Id = ? AND IsActive = ?";
					$paramUpdate  = array( &$PosX, &$PosY, &$PosZ, &$RotX, &$RotY, &$RotZ, &$Id, &$status);
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
			$Content = $_POST['Content'];
			$ContentType = $_POST['ContentType'];
			
			$PosX = $_POST['PosX'];
			$PosY = $_POST['PosY'];
			$PosZ = $_POST['PosZ'];
			$RotX = $_POST['RotX'];
			$RotY = $_POST['RotY'];
			$RotZ = $_POST['RotZ'];
			
			
			$sql = "SELECT * FROM HotspotContent WHERE Id = ? AND IsActive = ?";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$param = array(&$Id, &$status);
			$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
			if(sqlsrv_execute($stmt)){
				if(sqlsrv_num_rows($stmt)>0){
					//To Update the entered changes
					$sqlUpdate = "UPDATE HotspotContent SET Content = ?, Type = ?, PosX = ?, PosY = ?,PosZ = ?,RotX = ?,RotY = ?,RotZ = ? WHERE Id = ? AND IsActive = ?";
					$paramUpdate  = array(&$Content, &$ContentType, &$PosX, &$PosY, &$PosZ, &$RotX, &$RotY, &$RotZ, &$Id, &$status);
					$stmtUpdate  = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successful"));
					}else{
						die(print_r(sqlsrv_errors(), true)); 
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