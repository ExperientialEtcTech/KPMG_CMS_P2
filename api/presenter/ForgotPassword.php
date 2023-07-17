<?php
session_start();
    include_once('/config.php');

$errorMsg="Enter the OTP received in mail";

if($_POST['sendOtp'] == null)
{
    if($_POST['otp']!=$_SESSION['otp'])
    {
        $errorMsg="Invalid OTP. Please re-enter.";
        $status="failed";
        response($status,$errorMsg,"","");
    } else {
      
        if($_POST['GeneratePassword']!= null){
            if($_POST['password']!=$_POST['confirmPassword'])
            {
                $errorMsg="Password snd Confirm Password does not match";
                $status="failed";
                 response($status,$errorMsg,"","");
            } else {
                    $key = 'bRuD5WYw5wd0rdHR';
                    $method = 'aes128';
                
                    $username=(openssl_encrypt("rfidadmin", $method, $key));  // very importtant change username
                    $password=(openssl_encrypt($_POST['password'], $method, $key));
                    //echo $username."<br>".$password;
                    
                    $postData = array("username"=>$username,"password"=>$password);
                    $url = 'http://10.188.7.135/api/login/changePass.php';
                    $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',$_COOKIE['kpmg-access']);
                    
            }
        }else{
			  $errorMsg="Otp Varified.";
             $status="success";
             response($status,$errorMsg,"","");
			
		}
       
    }


} else {
	$username=(openssl_encrypt($_POST['username'], $method, $key));
	$otp=rand(100000,999999);
$_SESSION['otp']=$otp;
////adding application name as well for custom msg and subject in otp mail - by shubham - 27/2/23
	//$postData = array("username"=>$username,"otp"=>$otp);
	$app = "RFID";
	$postData = array("username"=>$username,"otp"=>$otp, "app"=>$app);
	$url = 'http://10.188.7.135/api/login/sendOtp.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',$_COOKIE['kpmg-access']);
    //print_r($jsonResponse);
	//$response = json_decode($jsonResponse,true);
}

function response($status,$errorMsg,$userName,$UserApp){
    $response['Username'] = $userName;
	$response['UserApp'] = $UserApp;
	$response['Name'] = $status;
	$response['Msg'] = $errorMsg;
    echo json_encode($response);
}
?>
