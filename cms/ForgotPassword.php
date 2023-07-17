<?php
session_start();
    include_once('config.php');
    include_once('jwt.php');
$errorMsg="Enter the OTP received in mail";
function createLockFile(){
    $myfile = fopen("mail-fp.lock", "w") or die("Unable to open file!");
    $txt = "Javed Akhtar\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
                $key = 'bRuD5WYw5wd0rdHR';
                $method = 'aes128';
if(isset($_POST['changePassword']))
{
    if($_POST['otp']!=$_SESSION['otp'])
    {
        $errorMsg="Invalid OTP Plz re-enter";
    } else {
        //$errorMsg="Check username";
        if($_POST['password']!=$_POST['confirmPassword'])
        {
            $errorMsg="Password snd Confirm Password does not match";
        } else {

            
                $username=(openssl_encrypt("cmsadmin", $method, $key));  // very importtant change username
                $password=(openssl_encrypt($_POST['password'], $method, $key));
                //echo $username."<br>".$password;
                
                $postData = array("username"=>$username,"password"=>$password);
                $url = 'http://10.188.7.135/api/login/changePass.php';
                $jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
                ?>
                <script>
                    alert("Password changed successfully. Please login with new password");
                    window.location.href = "login.php";
                    </script>
                <?php
        }
    }
} else {
	$_POST['username']="cmsadmin";
	$username=(openssl_encrypt($_POST['username'], $method, $key));
	$otp=rand(100000,999999);
$_SESSION['otp']=$otp;
	$postData = array("username"=>$username,"otp"=>$otp);
	$url = 'http://10.188.7.135/api/login/sendOtp.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    //print_r($jsonResponse);
	//$response = json_decode($jsonResponse,true);
	    $filename = 'mail-fp.lock';

    if (file_exists($filename)) {
        //echo "$filename was last modified: " . date ("F d Y H:i:s.", filemtime($filename));
        $now = new DateTime();
        $date = new DateTime();
        $date->setTimestamp(filemtime($filename));
        $since_start =$date->diff($now);

        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;
        //echo $minutes.' minutes';
        if($minutes>2)
        {
            createLockFile();
        } else {
            $errorMsg="Kindly wait for 2 mins before resending OTP";
        }
    } else {
        createLockFile();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KPMG</title>
	<script src= "assets/js/jquery.min.js"></script>
</head>
<style>

*,
*::before,
*::after {
  box-sizing: border-box;
}

@media (prefers-reduced-motion: no-preference) {
  :root {
    scroll-behavior: smooth;
  }
}

    body{
        
        margin: 0px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }


    @font-face {    
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    p, button {
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }
    input {
        outline: none;
    }
    input[type='text'], input[type='password'] {
        outline: none;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }
</style>
<body>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>
    <main>

        <div class="search" id = "searchDiv">

<form method="post">

                <table style="margin: auto;width: 100%; max-width: 500px; border-spacing: 0 50px;">
                    <tr>
                        <td><h2 style="color: #00338D;text-align: center;font-size: 45px;">Forgot Password</h2></td>
                    </tr>
                    <tr>
                        <td style="color: red;"><?php echo $errorMsg; ?></td>
                    </tr>
<!--<tr><td><input type="text" placeholder="User Name" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 17px;background-size: 26px;color: #707070;font-size: 20px;padding-left:70px;" name="username"/></td></tr>-->
<tr><td><input type="text" placeholder="OTP" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 18px;background-size: 30px;color: #707070;font-size: 20px;padding-left:70px;" name="otp"/></td></tr>
<tr><td><input type="text" placeholder="password" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 18px;background-size: 30px;color: #707070;font-size: 20px;padding-left:70px;" name="password"/></td></tr>
<tr><td><input type="password" placeholder="confirm password" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 18px;background-size: 30px;color: #707070;font-size: 20px;padding-left:70px;" name="confirmPassword"/></td></tr>

                    <tr>
                        <td  style="text-align: center;">
                            <button value="Change" name="changePassword" id = "changePassword"  class="searchb" style="cursor: pointer;width: 200px;border-radius: 8px; background-color: #00338D; height:60px; font-size: 28px; color: white; border: none;">Change</button>
                        </td>
                    </tr>
                </table>

</form>
        </div>
    </main>
</body>
</html>