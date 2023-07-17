<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

$data =$_GET['kaleidoscope'];


$postData = array("Order"=>$data);

$url = $apiBaseUrl.'cms/deleteKaleidoscope.php';



$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);


$response = json_decode($jsonResponse,true);


  header("Location:kalediscope.php");
?>