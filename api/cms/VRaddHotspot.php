<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['ServiceId']) && isset($_POST['HotspotFrom']) && isset($_POST['HotspotTo']) && isset($_POST['HotspotType']) && isset($_POST['PosX']) && isset($_POST['PosY']) && isset($_POST['PosZ']) && isset($_POST['RotX']) && isset($_POST['RotY']) && isset($_POST['RotZ']) && isset($_POST['Content']) && isset($_POST['ContentType'])){
	
		$details=array();
		$status=1;
		//$Id = $_POST['Id'];
		$HotspotType = $_POST['HotspotType'];
	
		
		//For Loaction Hotspots 
		if($HotspotType == 'location' || $HotspotType == 'Location'){
			$ServiceId = $_POST['ServiceId'];
			$HotspotFrom = $_POST['HotspotFrom'];
			$HotspotTo = $_POST['HotspotTo'];
			if($HotspotFrom == 0 || $HotspotTo == 0){
				response(Array("status"=>"0","msg"=>"No such VidoeId as '0'"));
			}
			
			$PosX = $_POST['PosX'];
			$PosY = $_POST['PosY'];
			$PosZ = $_POST['PosZ'];
			$RotX = $_POST['RotX'];
			$RotY = $_POST['RotY'];
			$RotZ = $_POST['RotZ'];
			
			
			$sql = "SELECT * FROM RelativeHotspots WHERE HotspotFrom = ? AND HotspotTo = ? AND IsActive = ?";
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$param = array(&$HotspotFrom, &$HotspotTo, &$status);
			$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
			if(sqlsrv_execute($stmt)){
				if(sqlsrv_num_rows($stmt)>0){
					response(Array("status"=>"0","msg"=>"Location Hotspot exists already"));
				}else{
					//To Insert into RelativeHotspots
					$sqlUpdate = "INSERT INTO RelativeHotspots (ServiceId, HotspotFrom, HotspotTo, PosX, PosY, PosZ, RotX, RotY, RotZ, IsActive) VALUES (?,?,?,?,?,?,?,?,?,?)";
					$paramUpdate  = array(&$ServiceId, &$HotspotFrom, &$HotspotTo, &$PosX, &$PosY, &$PosZ, &$RotX, &$RotY, &$RotZ, &$status);
					$stmtUpdate  = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successful"));
					}else{
						die(print_r(sqlsrv_errors(), true)); 
						response(Array("status"=>"0","msg"=>"Failed"));
					}
				}
			}else{
				die(print_r(sqlsrv_errors(), true)); 
				response(Array("status"=>"0","msg"=>"Fail"));
			}
			
		}elseif($HotspotType == 'content' || $HotspotType == 'Content'){
		//For Content Hotspots 
			$HotspotFrom = $_POST['HotspotFrom'];
			$Content = $_POST['Content'];
			$ContentType = $_POST['ContentType'];
			
			$PosX = $_POST['PosX'];
			$PosY = $_POST['PosY'];
			$PosZ = $_POST['PosZ'];
			$RotX = $_POST['RotX'];
			$RotY = $_POST['RotY'];
			$RotZ = $_POST['RotZ'];
			
			//To Insert into RelativeHotspots
			$sqlUpdate = "INSERT INTO HotspotContent (VideoId, Content, Type, PosX, PosY, PosZ, RotX, RotY, RotZ, IsActive) VALUES (?,?,?,?,?,?,?,?,?,?)";
			$paramUpdate  = array( &$HotspotFrom, &$Content, &$ContentType, &$PosX, &$PosY, &$PosZ, &$RotX, &$RotY, &$RotZ, &$status);
			$stmtUpdate  = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
			if(sqlsrv_execute($stmtUpdate)){
				response(Array("status"=>"1","msg"=>"Successful"));
			}else{
				die(print_r(sqlsrv_errors(), true)); 
				response(Array("status"=>"0","msg"=>"Failed"));
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