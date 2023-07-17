<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');		
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['signoff_text']) || isset($_POST['signoff_footer']))
{
    $details=array();
	$signoff_text=$_POST['signoff_text'];
	$signoff_footer=$_POST['signoff_footer'];
	
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

	//$stmt = $mysqli->prepare("UPDATE `signoff` SET `status`=0 WHERE `status`=?");
	$sql1 = "UPDATE SignoffTemplate SET Status=0 WHERE Status=?";
	$status=1;
	$params1 = array(&$status);
	$stmt1 = sqlsrv_prepare( $conn, $sql1, $params1, $options);
	sqlsrv_execute($stmt1);

	//$stmt = $mysqli->prepare("INSERT INTO `signoff`(`signoff_text`,`status`) VALUES (?,?)");
	$sql2 = "INSERT INTO SignoffTemplate(SignOffText,  SignOffFooter, Status) VALUES (?,?,?)";
	$status=1;
	
	$params2 = array( &$signoff_text, &$signoff_footer, &$status);
	$stmt2 = sqlsrv_prepare( $conn, $sql2, $params2, $options);
	//
	if(sqlsrv_execute($stmt2)){
		response(Array("status"=>"1","msg"=>"Success"));
	}else{
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