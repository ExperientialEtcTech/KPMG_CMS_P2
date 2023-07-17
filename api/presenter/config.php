<?php
error_reporting(0);
header("X-Frame-Options: DENY");
header("Access-Control-Allow-Mathods: GET,POST");
header("X-XSS-Protection: 1");
header("Content-Security-Policy: script-src 'Unsafe-inline' 'self'");
//header("Content-Type: text/plain");
$baseUrl="http://10.188.7.135/";
//$baseUrl="https://kpmg.experientialetc.com/";

if(!isset($_COOKIE['kpmg-access']))
{
    $postData = array("user"=>"kpmg_presenter", "pass"=>"kpmg_presenter");
    
    $url = $baseUrl.'jwt/jwtAuthorize.php';
    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data');
    $response = json_decode($jsonResponse);

    setcookie("kpmg-access", $response->key, time() + (840), "/presenter"); // expire in 14 mins 14*60 secs
    $_COOKIE['kpmg-access']=$response->key;
}

function rest_call($method, $url, $data = false, $contentType=false, $token = false,$port=443)
{
    $curl = curl_init();
	/*
	if(curl_exec($curl) === false)
	{
		//echo 'Curl error: ' . curl_error($curl);
	}
	else
	{
		echo 'Operation completed without any errors';
	}
	*/
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
$contentTemptype=Array();
            if($contentType)
            {
$contentTemptype[]='Content-Type: '.$contentType;
            }
            if($token)
            {
$contentTemptype[]='Authorization: Bearer '.$token;
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER, $contentTemptype);

            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    curl_setopt($curl,CURLOPT_VERBOSE,true);
    curl_setopt($curl, CURLOPT_STDERR, fopen('curl.txt', 'w+'));

    curl_setopt($curl, CURLOPT_PORT, $port);
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($curl, CURLOPT_CAINFO, "ISRG_Root_X1.crt");
	//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	//curl_setopt($curl, CURLOPT_PROXY, '');
	//curl_setopt($curl, CURLOPT_SSLVERSION,3);
	//print_r(curl_getinfo($curl));
    $result = curl_exec($curl);
	$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	//echo curl_error($curl);
	switch ($httpcode) {
		case 404:
			echo "404: ". $url;
    		break;
		case 200:
			if(!$result)
			{
				echo "curl fail";
			} else {
				return $result;
			}
    		break;
		case 0:
    		break;
		default:
			{
				echo "HTTP response ".$httpcode;
				echo $result;
			}
			break;
	}
    curl_close($curl);
}
?>