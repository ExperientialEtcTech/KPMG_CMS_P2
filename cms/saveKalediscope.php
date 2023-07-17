<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    $postData['FilePath']=$_POST['FilePath'];
    $postData['FileType']=$_POST['FileType'];
    $postData['Order']=$_POST['Order'];
    $url = $apiBaseUrl.'cms/addKaleidoscope.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);
    header("Location:kalediscope.php");
?>