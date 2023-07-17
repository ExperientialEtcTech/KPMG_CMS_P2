<?php



include_once('config.php');
include_once('jwt.php');

$postData['KpmgLogo']=$_POST['KPMG_logo'];
$postData['TemplateBackground']=$_POST['bg_vid'];
$postData['LoopVideo']=$_POST['loop_vid'];
$postData['HeaderText']=trim($_POST['HeaderText']);
$postData['SubheaderText1']=trim($_POST['SubheaderText1']);
$postData['SubheaderText2']=trim($_POST['SubheaderText2']);
$postData['SubheaderText3']=trim($_POST['SubheaderText3']);
$postData['SubheaderText4']=trim($_POST['SubheaderText4']);
$postData['FooterText']=trim($_POST['FooterText']);
$postData['Timer']=trim($_POST['Timer']);



$url = $apiBaseUrl.'cms/editWelcome.php';

//Timer:60


$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);


$response = json_decode($jsonResponse,true);

echo "<script>  localStorage.setItem('save', true);</script>";
  header("Location: welcome1.php");
?>