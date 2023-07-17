<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$feedback_event=array();
	$status = 0;
	$feedbackId=$_POST['feedbackId'];
    $responseType=0;
if(!isset($feedbackId))
{
    $temp=array("status"=>"0","response"=>"Missing Parameter");
    array_push($feedback_event, $temp);
    response($feedback_event);
} else {
	$params2 = array(&$status,&$feedbackId);
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $sqlEF='UPDATE EventFeedback SET Status=? WHERE Id=?';
	$stmtEF = sqlsrv_prepare( $conn, $sqlEF, $params2, $options);

	if(sqlsrv_execute($stmtEF))
    {
        $temp=array("status"=>"1","response"=>"Question Deleted");
        array_push($feedback_event, $temp);
    } else {
        //die(print_r(sqlsrv_errors(), true));
        $temp=array("status"=>"0","response"=>"Question Delete Failed");
        array_push($feedback_event, $temp);
    }

	response($feedback_event);
}
function response($event)
{
    $response['feedback_event'] = $event;
	$json_response = json_encode($response);
	echo $json_response;
}
?>