<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	//if(isset($_POST['ContentUrl']) && isset($_POST['ContentType']) && isset($_POST['ResourceId']) && isset($_POST['HotspotId'])){
if(isset($_POST['ContentUrl']) && isset($_POST['ContentType']) && isset($_POST['HotspotResourceId'])){
		$details=array();
		$status=1;
			
		//$ResourceId = $_POST['ResourceId'];
		//$HotspotId = $_POST['HotspotId'];
		$HotspotResourceId = $_POST['HotspotResourceId'];
		$ContentUrl = $_POST['ContentUrl'];
		$ContentType = $_POST['ContentType'];

		
		//Assign resource
			
		//Get HotspotResourceId from MuralHotspotResource Table
		//$sqlCheck = "SELECT Id FROM MuralHotspotResources WHERE ResourceId = ? AND HotspotId = ? AND IsActive = ?";
		$sqlCheck = "SELECT Id FROM MuralHotspotResources WHERE Id = ? AND IsActive = ?";
		//$paramsCheck = array(&$ResourceId, &$HotspotId, &$status);
		$paramsCheck = array(&$HotspotResourceId, &$status);
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmtCheck = sqlsrv_prepare( $conn, $sqlCheck, $paramsCheck, $options);
		if(sqlsrv_execute($stmtCheck)){
			if(sqlsrv_num_rows($stmtCheck)>0){
				$rowCheck = sqlsrv_fetch_array($stmtCheck);
				$HotspotResourceId = $rowCheck['Id'];
				//print_r($HotspotResourceId);
				$sql = "INSERT INTO MuralHotspotContent (HotspotResourceId,FilePath, FileType, IsActive) VALUES (?,?,?,?)";
				$params = array(&$HotspotResourceId,&$ContentUrl,&$ContentType, &$status);
				$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
				if(sqlsrv_execute($stmt)){
					response(Array("status"=>"1","msg"=>"Successful"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Fail"));
				}
			}else{
				response(Array("status"=>"0","msg"=>"No such resource row"));
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

