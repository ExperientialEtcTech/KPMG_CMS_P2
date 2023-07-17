<?php
    
    include_once('config.php');
    include_once('jwt.php');
    $postData['HotspotId']=$_POST['hotspotId'];
    $postData['ResourceId']=$_POST['serviceType'];
    
 
    
    $url = $apiBaseUrl.'cms/assignResource.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);

    header("Location:serviceandsectors.php?id=".$_POST['hotspotId']);
?>