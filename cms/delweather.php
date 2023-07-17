<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$city = $_GET['id'];
$array['city'] = $city;
$postData =$array;
$url = $apiBaseUrl.'cms/deleteWeatherCity.php';
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);


$response = json_decode($jsonResponse,true);
  header("Location: weather.php");
?>