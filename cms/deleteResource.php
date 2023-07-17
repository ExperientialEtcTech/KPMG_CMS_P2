<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    $postData['ResourceId']=$_GET['id'];
    
    $url = $apiBaseUrl.'cms/deleteResource.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);
   
    header("Location:muralResources.php");
?>