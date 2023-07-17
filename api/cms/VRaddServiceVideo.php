<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['ServiceId']) && isset($_POST['ContentUrl']) && isset($_POST['Name']) ){
		$details=array();
		$status=1;
		$ServiceId = $_POST['ServiceId'];
		$ContentUrl = $_POST['ContentUrl'];
		$Name = $_POST['Name'];

		$sql = "SELECT MAX(Labels) AS MaxLabel FROM VRServiceVideos WHERE ServiceId = ? AND IsActive = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$row = sqlsrv_fetch_array($stmt);
				$MaxLabel = $row['MaxLabel'];
				$NewMaxLabel = ++$MaxLabel;
				if($MaxLabel == 1){
					$NewMaxLabel = 'a';
				}
				//print_r($NewMaxLabel);
				$sqlIns = "INSERT INTO VRServiceVideos (ServiceId,ContentFilePath, Name, Labels, IsActive) VALUES (?,?,?,?,?)";
				$paramIns = array(&$ServiceId, &$ContentUrl, &$Name, &$NewMaxLabel, &$status);
				$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramIns, $options);
				if(sqlsrv_execute($stmtIns)){
					response(Array("status"=>"1","msg"=>"Successful"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Fail"));
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