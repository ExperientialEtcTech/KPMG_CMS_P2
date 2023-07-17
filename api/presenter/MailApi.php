<?php
include_once('jwt/jwtAccess.php');
include('api/db.php');
header("Content-Type:application/json");
$IP =$_SERVER['REMOTE_ADDR'];
$http_referrer = getenv( "HTTP_REFERER" );
require('phpmailer/PHPMailerAutoload.php');
	
$json=file_get_contents('php://input');
$decode_array=json_decode($json,true)['email_id'];

$response_mail=Array();
$status="Success";		

foreach ($decode_array as $email_id) {
     //print_r($email_id);
    //echo "<br><br>";
    try{
        $mail = new PHPMailer();
        $mail->IsSMTP();
	$mail->Host = "authnz.proofpoint.com";
        $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "a69c1e89-7f07-4295-b99d-e77702010ea1"; // SMTP account username example
        $mail->Password   = "Dw6=8zYhQHCv"; 
        $mail->IsHTML(true);	
        $mail->From = 'kaleidoscope@in.kpmg.com';
        $mail->FromName = 'KPMG';
        $mail->AddAddress($email_id);
		$mail->SMTPOptions=array(
			'ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false,
				'allow_self_signed'=>true
			)
		);
        //$mail->AddBCC("");
        $mail->Subject = "Feedback on Innovation Session";
        
        $message = "Dear participant,<br>";
        // $message .= "$http_referrer<br>";
        $message .= "Hope you had an enriching session with us today. We would like to hear your feedback to help improve the effectiveness of our sessions. Kindly also rate your overall experience at the innovation center.<br><br>";
$feedback_link='http://10.188.7.135/feedback/get_feedback.php?eventId=100A';
        $message .= "Please <a href='".$feedback_link."'>click here</a> to assist us in our journey to serve you better.<br><br>";
        $message .= "Thanks & regards<br>";
		$message .= "Innovation center team";
        
        $mail->Body =$message;
        
        if($mail->Send()){
            $response_mail[]=Array("mail"=>$email_id,"status"=>"Success");
            // response($decode_array, $email_id); 
            //response("Success", "Mail Sent");            
        }else{
            $response_mail[]=Array("mail"=>$email_id,"status"=>"Fail");
            $status="Fail";
            //response("Failure", $mail->ErrorInfo);
        }

//$response_mail[]=Array("mail"=>$email_id,"status"=>"Success"); // remove this line in production and uncomment acrual send mail

    }catch(phpmailerException $e){
        $response_mail[]=Array("mail"=>$email_id,"status"=>"Fail");
        $file = fopen('logger.txt','a');
        $txt = "failed to send email to admin, error is: ".$e->errorMessage()."\n";
        fwrite($file,$txt);
        fclose($file);
        $status="Fail";
    }
}
response($status,$response_mail);


function response($status, $res)
{
	
	$response['status'] = $status;
    $response['debug'] = $res;
	$json_response = json_encode($response);
	echo $json_response;
}
?>
