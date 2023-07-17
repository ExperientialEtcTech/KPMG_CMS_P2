<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

$sql = "SELECT * FROM WelcomeTemplate WHERE Status = ?";
$status = 1;

$params1 = array(&$status);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			$row = sqlsrv_fetch_array($stmt);
			response($row['KpmgLogo'], $row['TemplateBackground'], $row['LoopVideo'], $row['MaleAvatarIcon'], $row['FemaleAvatarIcon'], $row['HeaderText'], $row['SubheaderText1'], $row['SubheaderText2'], $row['SubheaderText3'], $row['SubheaderText4'], $row['FooterText'], $row['Timer']);
		}else{
			response( NULL, 200, NULL, NULL,  NULL, NULL,  NULL,  NULL, NULL, NULL,NULL,"No active record Found");
		}
	}
	
	
}else{
	response( NULL, 400, NULL, NULL,  NULL, NULL, NULL,  NULL,  NULL, NULL,NULL,"Missing parameter");
}
sqlsrv_close($conn);

function response($KPMG_logo,  $bg_vid, $loop_vid, $male_avatar_icon, $female_avatar_icon, $header_text, $SubheaderText1, $SubheaderText2, $SubheaderText3, $SubheaderText4, $footer_text, $timer){
	$response['KPMG_logo'] = urldecode($KPMG_logo);
	$response['bg_vid'] = urldecode($bg_vid);
	$response['loop_vid'] = urldecode($loop_vid);
	$response['male_avatar_icon'] = $male_avatar_icon;
	$response['female_avatar_icon'] = $female_avatar_icon;
	$response['header_text'] = $header_text;
	$response['sub_text1'] = $SubheaderText1;
	$response['sub_text2'] = $SubheaderText2;
	$response['sub_text3'] = $SubheaderText3;
	$response['sub_text4'] = $SubheaderText4;
	$response['footer_text'] = $footer_text;
	$response['timer'] = $timer;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>