<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['Hotspot_id'])){
		$details=array();
		$hotspot_id = $_POST['Hotspot_id'];
		$sql = "SELECT hotres.Id, resmas.ResourceName, resmas.ResourceType FROM MuralResourcesMaster resmas JOIN MuralHotspotResources hotres ON  hotres.HotspotId = ? AND hotres.ResourceId = resmas.Id AND resmas.IsActive = hotres.IsActive AND resmas.IsActive = 1";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$hotspot_id);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				while ($row = sqlsrv_fetch_array($stmt) ) {
					$temp=array("Id"=>$row['Id'],"ResourceName"=>$row['ResourceName'],"ResourceType"=>$row['ResourceType']);
	            	array_push($details, $temp);
				}
				response($details);
			}else{
				response(Array("status"=>"0","msg"=>"No Resources Found"));
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