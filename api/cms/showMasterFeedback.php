<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$feedback_master=array();
	$sql="SELECT Id,FeedbackQuestion,ResponseType FROM MasterFeedback WHERE Status=? ORDER BY Id ASC";
	$status = 1;
	$params1 = array(&$status);
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
	sqlsrv_execute($stmt);

    if(sqlsrv_num_rows($stmt)>0)
    {
        while ($row = sqlsrv_fetch_array($stmt)) {
            $temp=array("ques_id"=>$row['Id'],"feedback_ques"=>$row['FeedbackQuestion'],"response_type"=>$row['ResponseType']);
            array_push($feedback_master, $temp);
        }
		
	}

	response($feedback_master);

function response($master)
{
	$response['feedback_master'] = $master;
	$json_response = json_encode($response);
	echo $json_response;
}
?>