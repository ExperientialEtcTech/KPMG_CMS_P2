<?php
echo "aaaa";
// error_reporting(0);
include_once('config.php');
include_once('jwt.php');

$postData['feedbackId']=$_POST['id'];

$postData['FeedbackQuestion']=$_POST['generic_question'];

 
    
    $url =  $apiBaseUrl."/cms/editFeedbackApi.php";
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

    $response = json_decode($jsonResponse,true);
 

    header("Location:Feedback%20form.php");
?>