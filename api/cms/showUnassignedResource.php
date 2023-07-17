<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['HotspotId'])){
	$details=array();
	$status=1;
	$HotspotId= $_POST['HotspotId'];
	
	$sql = "SELECT * FROM MuralResourcesMaster WHERE IsActive = ?";
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$param = array(&$status);
	$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);

	if(sqlsrv_execute($stmt)){
		if(sqlsrv_num_rows($stmt)>0){
			while ($row = sqlsrv_fetch_array($stmt) ) {
				
				$ResourceId = $row['Id'];
				//Check if this resource is present in HotspotResource Table ie. if it is assigned and active
				$sqlCheck = "SELECT * FROM MuralHotspotResources WHERE ResourceId = ? AND HotspotId = ? AND IsActive = ?";
				//Checks is its status is 1 ie. if we have this resource actively assigned to any hotspot
				$paramCheck = array(&$ResourceId, &$HotspotId, &$status);
				$stmtCheck = sqlsrv_prepare( $conn, $sqlCheck, $paramCheck, $options);
				if(sqlsrv_execute($stmtCheck)){
					if(sqlsrv_num_rows($stmtCheck)>0){
						//This resourceId for hotstpot Id is already assigned 
					}else{
						$temp=array("Id"=>$row['Id'],"ResourceName"=>$row['ResourceName'],"ResourceType"=>$row['ResourceType']);
						array_push($details, $temp);
					}
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Fail"));
				}
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