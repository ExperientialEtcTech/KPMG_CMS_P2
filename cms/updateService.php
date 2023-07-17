<?php
    include_once('config.php');
    include_once('jwt.php');
    $postData['ServiceId']=$_POST['serviceID'];
    $postData['Type']=$_POST['contentType'];
    $postData['ContentId']=$_POST['contentId'];
    $postData['FilePath']=$_POST['FilePath'];
    if($_POST['contentType']==="Text"){
        $postData['Data']=$_POST['Data'];
    }
    else{
        $postData['Data']=$_POST['FilePath'];
		//Added by shubham - 30/08
		$postData['DisplayName']=$_POST['DisplayName'];
    }
    $url = $apiBaseUrl.'cms/TtServicesContentsEdit.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    $response = json_decode($jsonResponse,true);
    header("Location:TTServicesContent.php?ServiceId=".$_POST['serviceID']."&&Name=".$_POST['serviceName']);
?>