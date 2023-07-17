<?php
error_reporting(0);
include_once('config.php');
include_once('jwt.php');
    $postData = array("signoff_text"=>&$_POST['signoff_text'],"signoff_footer"=>&$_POST['signoff_footer']);
    $url = $apiBaseUrl.'cms/editSignOff.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    header("Location:SignOff.php");