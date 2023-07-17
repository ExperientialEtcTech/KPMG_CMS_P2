<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=Array();

if(isset($_POST['FilePath']) && isset($_POST['FileType']) && isset($_POST['Order'])){
	
	$FilePath = $_POST['FilePath'];
	$FileType = $_POST['FileType'];
	$Order = $_POST['Order'];
	
	$sql = "SELECT MAX(VideoOrder) AS LatestOrder FROM IdleStateKaleidoscope WHERE Status=?";
	$status = 1;
	$params = array(&$status);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
	sqlsrv_execute($stmt);
	$row = sqlsrv_fetch_array($stmt);
	$LatestOrder = $row['LatestOrder'];
	
	if($Order>=$LatestOrder || $LatestOrder==0){
		$sqlIns = "INSERT INTO IdleStateKaleidoscope (FilePath, FileType, Status, VideoOrder) VALUES (?,?,?,?)";
		$status = 1;
		$LatestOrder = $LatestOrder+1;
		$paramsIns = array(&$FilePath, &$FileType, &$status,&$LatestOrder);
		$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramsIns, $options);
		if(sqlsrv_execute($stmtIns)){
			response(Array("status"=>"1","msg"=>"Success"));
		}else{
			response(Array("status"=>"0","msg"=>"Failed"));
		}
		
	}else if($Order == 1 || $Order == 0 && $LatestOrder>0){
		$sqlUpd = "UPDATE IdleStateKaleidoscope SET VideoOrder = VideoOrder + 1 ";
		$stmtUpd = sqlsrv_prepare( $conn, $sqlUpd, [], $options);
		sqlsrv_execute($stmtUpd);
		
		$sqlIns = "INSERT INTO IdleStateKaleidoscope  (FilePath, FileType, Status, VideoOrder) VALUES (?,?,?,?)";
		$status = 1;
		$Order = 1;
		$paramsIns = array(&$FilePath, &$FileType, &$status,&$Order);
		$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramsIns, $options);
		if(sqlsrv_execute($stmtIns)){
			response(Array("status"=>"1","msg"=>"Success"));
		}else{
			response(Array("status"=>"0","msg"=>"Failed"));
		}
		
	}else if($Order >= 1 && $Order < $LatestOrder){
		$sqlUpd = "UPDATE IdleStateKaleidoscope SET VideoOrder = VideoOrder + 1 WHERE VideoOrder>=?";
		$paramsUpd = array(&$Order);
		$stmtUpd = sqlsrv_prepare( $conn, $sqlUpd, $paramsUpd, $options);
		sqlsrv_execute($stmtUpd);
		
		
		$sqlIns = "INSERT INTO IdleStateKaleidoscope  (FilePath, FileType, Status, VideoOrder) VALUES (?,?,?,?)";
		$status = 1;
		$paramsIns = array(&$FilePath, &$FileType, &$status,&$Order);
		$stmtIns = sqlsrv_prepare( $conn, $sqlIns, $paramsIns, $options);
		if(sqlsrv_execute($stmtIns)){
			response(Array("status"=>"1","msg"=>"Success"));
		}else{
			response(Array("status"=>"0","msg"=>"Failed"));
		}
		
	}else{
		die(print_r(sqlsrv_errors(), true)); 
		response(Array("status"=>"0","msg"=>"Failed"));
	}

	sqlsrv_close($conn);
}else{
	response(Array("status"=>"0","msg"=>"Invalid values"));
}

function response($details)
{
	
	$response['res'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>