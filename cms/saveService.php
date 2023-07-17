<?php
include_once('security.php');
    include_once('config.php');
    include_once('jwt.php');
    error_reporting(0)  ;
  
    $postData['ServiceId']=$_POST['serviceID'];
    $postData['Type']=$_POST['contentType'];
    $postData['FilePath']=$_POST['FilePath'];
	//Added by shubham -30/08
	$postData['DisplayName']=$_POST['DisplayName'];

    if($_POST['contentType']==="Text"){
        $postData['Data']=$_POST['Data'];
    }
    else{
        $postData['Data']=$_POST['FilePath'];
    }

    $url = $apiBaseUrl.'cms/TtServicesContentAdd.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);
   
    echo "<pre>";
    print_r($response);
    print_r($_POST);
    echo "</pre>";
//    exit;
    header("Location:TTServicesContent.php?ServiceId=".$_POST['serviceID']."&&Name=".$_POST['serviceName']);
?>