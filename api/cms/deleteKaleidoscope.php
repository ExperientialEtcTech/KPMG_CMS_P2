<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');		
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['Order']))
{
    $details=array();
	$Order = $_POST['Order'];
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	$sql = "SELECT MAX(VideoOrder) AS LatestOrder FROM IdleStateKaleidoscope WHERE Status=?";
	$status = 1;
	$params = array(&$status);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
	sqlsrv_execute($stmt);
	$row = sqlsrv_fetch_array($stmt);
	$LatestOrder = $row['LatestOrder'];

	if($Order<=$LatestOrder && $LatestOrder>1 && $Order>0){
		/*
		$sqlUpd = "UPDATE IdleStateKaleidoscope SET VideoOrder = VideoOrder - 1 WHERE VideoOrder>?";
		$paramsUpd = array(&$Order);
		$stmtUpd = sqlsrv_prepare( $conn, $sqlUpd, $paramsUpd, $options);
		sqlsrv_execute($stmtUpd);
		*/
		
		$sqlIns = "UPDATE IdleStateKaleidoscope SET Status = 0 WHERE Status = 1 AND VideoOrder = ?";
		$paramsIns = array(&$Order);
		$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramsIns, $options);
		if(sqlsrv_execute($stmtIns)){
			response(Array("status"=>"1","msg"=>"Success"));
		}else{
			response(Array("status"=>"0","msg"=>"Failed"));
		}
		
	}else if($Order<=1 || $Order>$LatestOrder){ 
		response(Array("status"=>"0","msg"=>"Failed. Order out of bounds, or only item left"));
	}else{
		response(Array("status"=>"0","msg"=>"Failed"));
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