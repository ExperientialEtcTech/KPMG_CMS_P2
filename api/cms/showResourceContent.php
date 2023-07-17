<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
//if(isset($_POST['ResourceId']) && isset($_POST['HotspotId'])){
		//print_r("IN");
if(isset($_POST['HotspotResourceId'])){
	
    //$ResourceId = $_POST['ResourceId'];
	//$HotspotId = $_POST['HotspotId'];
	$HotspotResourceId = $_POST['HotspotResourceId'];
	$details=array();
	$status = 1;
	
	//$sqlCheck = "SELECT Id AS HotspotResourceId  FROM MuralHotspotResources WHERE ResourceId = ? AND HotspotId = ? AND IsActive = ?";
	$sqlCheck = "SELECT Id AS HotspotResourceId FROM MuralHotspotResources WHERE Id =? AND IsActive = ?";
	//$paramsCheck = array(&$ResourceId, &$HotspotId, &$status);
	$paramsCheck = array(&$HotspotResourceId, &$status);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmtCheck = sqlsrv_prepare( $conn, $sqlCheck, $paramsCheck, $options);

		if($stmtCheck){
			if(sqlsrv_execute($stmtCheck)){
				if(sqlsrv_num_rows($stmtCheck)>0){
					$rowCheck = sqlsrv_fetch_array($stmtCheck);
					$HotspotResourceId = $rowCheck['HotspotResourceId'];
					//print_r($HotspotResourceId);
					$sql = "SELECT hotcon.Id, hotcon.FilePath, hotcon.FileType FROM  MuralHotspotContent hotcon JOIN MuralHotspotResources hotres ON hotres.Id = ? AND hotres.Id = hotcon.HotspotResourceId  AND hotcon.IsActive = hotres.IsActive AND hotres.IsActive = ?";
					$params = array(&$HotspotResourceId, &$status);
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
					if($stmt){
						if(sqlsrv_execute($stmt)){
							if(sqlsrv_num_rows($stmt)>0){
								while ($row = sqlsrv_fetch_array($stmt)) {
									$temp = array("ID"=>$row['Id'],"FilePath"=>$row['FilePath'], "FileType"=>$row['FileType']);
									//print_r();
									array_push($details, $temp);
								}
								response($details);
							}else{
								response(Array("status"=>"0","msg"=>"No content present"));
							}
						}else{
							response(Array("status"=>"0","msg"=>"Fail"));
						}
					}
				}else{
					response(Array("status"=>"0","msg"=>"No such resource for this hotspot"));
				}
			}
		}else{
			response(Array("status"=>"0","msg"=>"Fail"));
		}
}else{
	response(Array("status"=>"0","msg"=>"Invalid values"));
}


function response($details)
{
	
	$response['content'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>