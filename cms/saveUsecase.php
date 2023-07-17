<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    $postData['ContentUrl']=$_POST['FilePath'];
    $postData['ContentType']=$_POST['FileType'];
    $postData['HotspotResourceId']=$_POST['resourceId'];
    // $postData['resourceId']=$_POST['resourceId'];
    
    $url = $apiBaseUrl.'cms/addResourceContent.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);

    header("Location:usecase.php?hotspotId=".$_POST['hotspotid']."&resourceId=".$_POST['resourceId']);
?>