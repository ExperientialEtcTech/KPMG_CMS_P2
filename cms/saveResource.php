<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    $postData['ResourceName']=$_POST['ResourceName'];
    $postData['ResourceType']=$_POST['ResourceType'];
    $postData['LabelUrl']=$_POST['resourceLabel'];
    $postData['IconUrl']=$_POST['resourceIcon'];
    
    $url = $apiBaseUrl.'cms/addResource.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);

    header("Location:muralResources.php");
?>