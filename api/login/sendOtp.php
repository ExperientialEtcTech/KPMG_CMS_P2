<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include_once('../config.php');
include('../db.php');
require('../presenter/phpmailer/PHPMailerAutoload.php');
	
$response_mail=Array();
$status="Success";
    try{
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = $smtpAuth;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port       = $smtpPort;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass; 
        $mail->IsHTML(true);	
        $mail->From = $smtpFrom;
        $mail->FromName = $smtpFromName;
        $mail->AddAddress($fpMailTo);
		//$mail->AddCC("naayeshakatkar@kpmg.com");
		$mail->AddCC("shivanikadam@kpmg.com");
        $mail->Subject = "OTP For ".$_POST['app']." Application Login";
        $mail->SMTPOptions=$SMTPOptions;
		
        $message = "Dear user,<br>";
        $message .= $_POST['otp']." is the OTP to login to ".$_POST['app']." application.<br><br>";

        $message .= "Thanks & regards<br>";
		$message .= "Innovation center team";
        
        $mail->Body =$message;
        
        if($mail->Send()){
            $response_mail[]=Array("mail"=>$email_id,"status"=>"Success");          
        }else{
            $response_mail[]=Array("mail"=>$email_id,"status"=>"Fail");
            $status="Fail";
        }


    }catch(phpmailerException $e){
        $response_mail[]=Array("mail"=>$email_id,"status"=>"Fail");
        $file = fopen('logger.txt','a');
        $txt = "failed to send email to admin, error is: ".$e->errorMessage()."\n";
        fwrite($file,$txt);
        fclose($file);
        $status="Fail";
    }

response($status,$response_mail);


function response($status, $res)
{
	
	$response['status'] = $status;
    $response['debug'] = $res;
	$json_response = json_encode($response);
	insert_log($conn,"login",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>
