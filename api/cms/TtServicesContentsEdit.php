<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();
//Added by shubham - 30/08
//$sql='UPDATE TtContentMaster SET Type=?, Data=? WHERE Id=? AND IsActive=1';
$sql='UPDATE TtContentMaster SET Type=?, Data=?, DisplayName = ? WHERE Id=? AND IsActive=1';

//Added by shubham - 30/08
//if(!isset($_POST['ContentId']) && !isset($_POST['Type']) && !isset($_POST['Data']))
if(!isset($_POST['ContentId']) && !isset($_POST['Type']) && !isset($_POST['Data']) && !isset($_POST['DisplayName']) )
{
	response("Invalid Params");
	exit;
}


$status = 1;
$ContentId = $_POST['ContentId'];
$Type = $_POST['Type'];
$Data = $_POST['Data'];

//Added by shubham - 30/08
$DisplayName = $_POST['DisplayName'];

//Added byshubham - 29/08
//$params = array(&$Type,&$Data,&$ContentId);
$params = array(&$Type,&$Data, &$DisplayName ,&$ContentId);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		response("Record Updated");
	}
}else{
die(print_r(sqlsrv_errors(), true)); 
	response( NULL);
}
sqlsrv_close($conn);

function response($details)
{
	
	$response['services'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>