<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sql="SELECT SignOffText,SignOffFooter FROM SignoffTemplate WHERE Status=?";
$status = 1;

$params1 = array(&$status);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while ($row = sqlsrv_fetch_array($stmt)) {
				$temp=array("signoff_text"=>$row['SignOffText'],"signoff_footer"=>$row['SignOffFooter']);
				array_push($details, $temp);
			}
			response($details);
		}else{
			response(NULL);
		}
	}
	
	
}else{
die(print_r(sqlsrv_errors(), true)); 
	response(NULL);
}
sqlsrv_close($conn);



function response($details)
{
	
	$response['text'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>