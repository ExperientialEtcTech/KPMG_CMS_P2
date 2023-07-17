<?php
    include_once('config.php');
    include_once('jwt.php');

    $postData['ResourceName']=$_POST['ResourceName'];
    $postData['ResourceType']=$_POST['ResourceType'];
    $postData['ResourceId']=$_POST['id'];
    $postData['IconUrl']=$_POST['icon'];
    $postData['LabelUrl']=$_POST['label'];
 
    
    $url = $apiBaseUrl.'cms/editResource.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);

    header("Location:muralResources.php");
?>