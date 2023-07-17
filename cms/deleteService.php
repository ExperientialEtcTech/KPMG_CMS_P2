<?php
    include_once('config.php');
    include_once('jwt.php');
    error_reporting(0)  ;
  
   $postData['ContentId']=$_GET['id'];



    $url = $apiBaseUrl.'cms/TtServicesContentDel.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);

   
    
    header("Location:TTServicesContent.php?ServiceId=".$_GET['ServiceID']."&&Name=".$_GET['serviceName']);
?>