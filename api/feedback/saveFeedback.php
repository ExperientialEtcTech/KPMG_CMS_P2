<?php
//include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
$json=file_get_contents('php://input');


$decode_array=json_decode($json,true);


include('../db.php');
date_default_timezone_set("Asia/Kolkata");
if(isset($decode_array['eventId']))
{
    
    $length= count($decode_array['id']);
    $randomId=time().rand(0,9);

    $email=$decode_array['email'];
    $eventId=$decode_array['eventId'];
    
    $error=0;
    
    $sqlQuery="INSERT INTO FeedbackResponse (BookingId, FeedbackQuestionId, Response, SubmissionId, QuestionType) VALUES (?, ?, ?, ?, ?)";
    for ($x = 0; $x < $length; $x++) {
		
		$params1 = array(&$eventId,&$decode_array['id'][$x],&$decode_array['feedback'][$x],&$randomId,&$decode_array['type'][$x]);

		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_prepare( $conn, $sqlQuery, $params1, $options);
if(!$stmt)
{
	die(print_r(sqlsrv_errors(), true));
}
        if(!sqlsrv_execute($stmt)){
            $error=1;
			die(print_r(sqlsrv_errors(), true));
        }
    }
    
    $questionId=0;
    $type=2;

		$params2 = array(&$eventId,&$questionId,&$decode_array['rating'],&$randomId,&$type);

		$stmt1 = sqlsrv_prepare( $conn, $sqlQuery, $params2, $options);
        if(!sqlsrv_execute($stmt1)){
            $error=1;
        }

	if($error==0){
		response(Array("status"=>"1","msg"=>"Success"));
	}else{
		response(Array("status"=>"0","msg"=>"Fail"));
	}


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