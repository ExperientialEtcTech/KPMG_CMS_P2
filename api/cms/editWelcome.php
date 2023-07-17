<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['KpmgLogo']) && isset($_POST['TemplateBackground']) && isset($_POST['LoopVideo']) && isset($_POST['HeaderText']) && isset($_POST['SubheaderText1']) && isset($_POST['SubheaderText2']) && isset($_POST['SubheaderText3']) && isset($_POST['SubheaderText4']) && isset($_POST['FooterText']) && isset($_POST['Timer']))
{
    // change all current active status to 0
    $sql = "UPDATE WelcomeTemplate SET Status = ?";
	
	$status=0;
	$params = array(&$status);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
    sqlsrv_execute($stmt);
    
	//$stmt = $mysqli->prepare("INSERT INTO `templates` (`KPMG_logo`,`bg_vid`,`loop_vid`,`male_avatar_icon`,`female_avatar_icon`,`header_text`,`sub_text`,`footer_text`,`status_flag`) VALUES(?,?,?,?,?,?,?,?,?)");
	
	$sql1 = "INSERT INTO WelcomeTemplate (KpmgLogo, TemplateBackground, LoopVideo, HeaderText, SubheaderText1, SubheaderText2, SubheaderText3, SubheaderText4, FooterText, Timer, Status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
	
	$status=1;
    $params1 = array(&$_POST['KpmgLogo'],&$_POST['TemplateBackground'],&$_POST['LoopVideo'],&$_POST['HeaderText'],&$_POST['SubheaderText1'],&$_POST['SubheaderText2'],&$_POST['SubheaderText3'],&$_POST['SubheaderText4'],&$_POST['FooterText'], &$_POST['Timer'], &$status);
	
	$stmt1 = sqlsrv_prepare( $conn, $sql1, $params1, $options);
	if(sqlsrv_execute($stmt1)){
		response(Array("status"=>"1","msg"=>"Success"));
	}else{
		response(Array("status"=>"0","msg"=>"Fail"));
	}
//echo $mysqli->error;

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