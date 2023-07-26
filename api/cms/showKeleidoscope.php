<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=Array();
$sql = "SELECT Id,FilePath, VideoOrder FROM IdleStateKaleidoscope WHERE Status=? ORDER BY VideoOrder";
$status = 1;

$params1 = array(&$status);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while($row = sqlsrv_fetch_array($stmt))
			{
				$temp=array("id"=>$row['Id'],"slides"=>$row['FilePath'], "VideoOrder"=>$row['VideoOrder']);
				array_push($details, $temp);
			}
			response($details);
		}else{
			response(NULL);
		}
	} else{
		die(print_r(sqlsrv_errors(), true)); 
	}
	
	
}else{
	die(print_r(sqlsrv_errors(), true)); 
	response(NULL);
}
sqlsrv_close($conn);


function response($details)
{
	
	$response['files'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>
