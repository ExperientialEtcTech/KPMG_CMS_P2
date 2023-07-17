<?php

//include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

	$sql = "SELECT * FROM VRServices WHERE IsActive = 1";
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, [], $options);	
	$services= array();
	if($stmt){
		sqlsrv_execute($stmt);
		if(sqlsrv_num_rows($stmt)>0){
			while ($row = sqlsrv_fetch_array($stmt)){
				$temp = array("Id"=>$row['Id'], "Name"=>$row['ServiceName']);
				array_push($services,$temp);
			}
		}
	}else{
		
	}
	response($services);

function response($res)
{

	$response['services'] = $res;
	$json_response = json_encode($response);
	echo $json_response;
}
