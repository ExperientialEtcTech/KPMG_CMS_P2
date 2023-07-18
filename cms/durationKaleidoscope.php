<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

//$data =$_GET['kaleidoscope'];
$duration = $_POST['duration'];

//echo $duration;
//echo $apiBaseUrl;

$postData = array("duration"=>&$duration);

$url = $apiBaseUrl.'cms/durationKaleidoscope.php';



$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);


$response = json_decode($jsonResponse,true);

//print_r($response['msg']);
  header("Location:kalediscope.php");
?>
