<?php
//include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");

if(isset($_POST['duration'])){	

	$AppName = "KalediscopeVideo"; 
	$duration = $_POST['duration'];
	
	
	$sql='INSERT INTO MasterTimeDuration (AppName, TimeDuration)
VALUES (?, ?)';


	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$params1 = array(&$AppName,&$duration);
	
	
	$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

	if($stmt){
		if(sqlsrv_execute($stmt))
		{
			if(sqlsrv_num_rows($stmt)>0){
				response("Updated");
			}else{
				response("Failed");
			}
			
		} else {
			response("Failed");
			die(print_r(sqlsrv_errors(), true)); 
		}
	}else{
		die(print_r(sqlsrv_errors(), true)); 
		response( NULL);
	}
}else{
	response("invalid params");
}
sqlsrv_close($conn);



function response($creds)
{
	$response['msg'] = $creds;
	$json_response = json_encode($response);
	//insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>
