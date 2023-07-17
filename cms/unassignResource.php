<?php
    include_once('config.php');
    include_once('jwt.php');
    
    $postData['HotspotResourceId']=$_GET['id'];
    
 
    
    $url = $apiBaseUrl.'cms/unassignResource.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);


    header("Location:serviceandsectors.php?id=".$_GET['hotspotId']);
?>