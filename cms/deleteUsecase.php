<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    $postData['ResourceContentId']=$_GET['id'];

    $url = $apiBaseUrl.'cms/deleteResourceContent.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);
 
   
    header("Location:usecase.php?hotspotId=".$_GET['hotspotId']."&resourceId=".$_GET['resourceId']);
?>