<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceName']) && $_POST['ServiceName'] != "" ){
		$details=array();
		$status=1;
		$ServiceName= $_POST['ServiceName'];
		//$ServiceOrder= $_POST['ServiceOrder'];
	
		//$sql = "SELECT Id, ServiceName, ServiceOrder, IsActive FROM VRServices WHERE ServiceName = ?";
		$sql = "SELECT Id, ServiceName, IsActive FROM VRServices WHERE ServiceName = ?";
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceName, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$row = sqlsrv_fetch_array($stmt);
				//print_r($row['IsActive']);
				if($row['IsActive'] == 1){
					response(Array("status"=>"0","msg"=>"Resource already exists"));
				}else if($row['IsActive'] == 0){
					$sqlUpdate = "UPDATE VRServices SET IsActive = 1 WHERE ServiceName = ? AND IsActive = 0";
					$paramUpdate = array(&$ServiceName);
					$stmtUpdate = sqlsrv_prepare( $conn, $sqlUpdate, $paramUpdate, $options);
					if(sqlsrv_execute($stmtUpdate)){
						response(Array("status"=>"1","msg"=>"Successful"));
					}else{
						die(print_r(sqlsrv_errors(), true)); 
						response(Array("status"=>"0","msg"=>"Failed"));
					}
				}
			}else{
				//Inserts new Resource 
				//$sqlIns = "INSERT INTO VRServices (ServiceName, ServiceOrder, IsActive) VALUES (?,?,?)";
				$sqlIns = "INSERT INTO VRServices (ServiceName, IsActive) VALUES (?,?)";
				//$paramIns = array(&$ServiceName, &$ServiceOrder, &$status);
				$paramIns = array(&$ServiceName, &$status);
				$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramIns, $options);
				if(sqlsrv_execute($stmtIns)){
					response(Array("status"=>"1","msg"=>"Successfully Inserted"));
				}else{
					die(print_r(sqlsrv_errors(), true)); 
					response(Array("status"=>"0","msg"=>"Failed to Insert"));
				}
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
	
	$response['response'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>