<?php
include_once('../../jwt/jwtAccess.php');
if(!isset($_POST['eventId']))
{
	response("Invalid Param");
	exit;
}
ini_set( 'serialize_precision', -1 );
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$feedback_master=array();
//$sql="SELECT ISNULL(round((SUM(CAST(Response as int))/COUNT(*)),2),0) as avgVal FROM FeedbackResponse WHERE QuestionType=2 AND BookingId=?";
//added by Shubham - 06/08
$sql = "SELECT ISNULL(CAST(SUM(CAST(Response as decimal(10, 2)))/COUNT(*) as decimal(10, 2)),0) as avgVal FROM FeedbackResponse WHERE QuestionType=2 AND BookingId= ?";

$eventId=$_POST['eventId'];

$params1 = array(&$eventId);

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			$row = sqlsrv_fetch_array($stmt);
			//$temp=array("avgValue"=>ROUND($row['avgVal'],0));
			//added by Shubham - 06/08
			$temp=array("avgValue"=>number_format(round($row['avgVal'], 2)));
			array_push($feedback_master, $temp);
		} else {
			$temp=array("avgValue"=>"0");
			array_push($feedback_master, $temp);
		}
	} else {
		die(print_r(sqlsrv_errors(), true));
	}
} else {
	die(print_r(sqlsrv_errors(), true));
}


response($feedback_master);

function response($master)
{
	$response['feedback_avg'] = $master;
	$json_response = json_encode($response);
	echo $json_response;
}
?>