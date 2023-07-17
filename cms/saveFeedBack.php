<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    $postData['FeedbackQuestion']=$_POST['generic_question'];
    

 
    $url = $apiBaseUrl.'cms/addFeedbackApi.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);
   

    header("Location:Feedback form.php");
?>