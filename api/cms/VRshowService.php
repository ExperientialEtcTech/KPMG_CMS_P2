<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

		$details=array();
		$status=1;

		$sql = "SELECT Id, ServiceName, ServiceOrder FROM VRServices WHERE IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				while ($row = sqlsrv_fetch_array($stmt) ) {
					$temp = array("Id"=>$row['Id'],"name"=>$row['ServiceName'],"order"=>$row['ServiceOrder']);
					array_push($details, $temp);
	       		}
				response($details);
			}else{
				response(Array("status"=>"0","msg"=>"No Resource Found"));
			}
		}else{
			die(print_r(sqlsrv_errors(), true)); 
			response(Array("status"=>"0","msg"=>"Fail"));
		}




function response($details)
{
	
	$response['services'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>