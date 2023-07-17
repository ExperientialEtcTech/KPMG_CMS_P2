<?php
error_reporting(0);

include_once('security.php');

include_once('config.php');
include_once('jwt.php');

if($_POST){
    $formData=$_POST;
    $array = array();
    for ($i=0; $i <count($_POST['id']) ; $i++) { 
        $arr = array("twitter_handles" => $_POST['name'][$i],"id" => $_POST['id'][$i]);
        $array[$i]=$arr;
    }
    $array=array("handles"=>$array);
    $postData= json_encode($array);


            $url = $apiBaseUrl.'cms/editTwitterHandles.php';
   

    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

    $response = json_decode($jsonResponse,true);


  header("Location: twitter.php");
    }
    else{
          header("Location: twitter.php");
    }

?>