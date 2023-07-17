<?php
error_reporting(0);

if(!isset($_COOKIE['kpmg-access']))
{
    $postData = array("user"=>"kpmg_signoff", "pass"=>"kpmg_signoff");
    
    $url = 'http://10.188.7.135/jwt/jwtAuthorize.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data');

    $response = json_decode($jsonResponse);
    
    setcookie("kpmg-access", $response->key, time() + (840), "/"); // expire in 14 mins 14*60 secs
    $_COOKIE['kpmg-access']=$response->key;
}
	

$rfid_no = 'E200001C471302021690B50D';
$postData1 = array("rfid_no"=>$rfid_no);
$url1 = 'http://10.188.7.135/api/welcome/getNameApi.php';

$jsonResponse1 = rest_call('POST', $url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$rfid_no2 = 'E200001C0719012812605F28';
$postData2 = array("rfid_no"=>$rfid_no2);
$url2 = 'http://10.188.7.135/api/welcome/getNameApi.php';

$jsonResponse2 = rest_call('POST', $url2 , $postData2 ,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

print_r($jsonResponse1);

//print_r($jsonResponse2);

function rest_call($method, $url, $data = false, $contentType= false, $token = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data){
                if($contentType){
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: '.$contentType,'Authorization: '.$token
                    ));
                }
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
?>