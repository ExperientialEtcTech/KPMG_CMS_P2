<?php
include_once('security.php');
?>
<?php
    include_once('config.php');
    include_once('jwt.php');
    $id=$_GET['id'];
      $postData = array("feedbackId"=>$id);
    $url = $apiBaseUrl.'cms/delFeedbackApi.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);


    header("Location:Feedback form.php");
?>