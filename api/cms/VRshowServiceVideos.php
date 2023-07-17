<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceId'])){
		$details=array();
		$status=1;
		$ServiceId = $_POST['ServiceId'];
		
		$sql = "SELECT Id, Name, ContentFilePath, Labels FROM VRServiceVideos WHERE ServiceId = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceId,&$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				while ($row = sqlsrv_fetch_array($stmt) ) {
					$temp = array("Id"=>$row['Id'],"name"=>$row['Name'],"order"=>$row['Labels'], "videourl"=>$row['ContentFilePath']);
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
} else {
    response(Array("status"=>"0","msg"=>"Invalid values"));
}




function response($details)
{
	
	$response['videos'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>