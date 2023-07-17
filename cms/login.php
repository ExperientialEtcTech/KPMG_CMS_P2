<?php
error_reporting(0);
header("X-Frame-Options: DENY");
header("Access-Control-Allow-Mathods: GET,POST");
header("X-XSS-Protection: 1");
header("Content-Security-Policy: script-src 'Unsafe-inline' 'unsafe-eval' 'self'");
$errorMsg="";
session_start();
if(isset($_SESSION['username']))
{
session_destroy();
session_start();
$status=unlink('cmsadmin-fp.lock');
}

function createLockFile($filename){
    $myfile = fopen($filename, "w") or die("Unable to open file!".$filename);
    $txt = "Javed Akhtar\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}

function userLogin($filename,$username,$rawUser)
{
                    session_start();
                    $_SESSION['username']=$username;
                    $_SESSION['raw-username']=$rawUser;
                    header("Location : login1.php");
}

if(isset($_POST['login']))
{
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$errorMsg="The Validation code does not match!";// Captcha verification is incorrect.		
	}else{// Captcha verification is Correct. Final Code Execute here!
		include_once('config.php');
		include_once('jwt.php');

		$key = 'bRuD5WYw5wd0rdHR';
		$method = 'aes128';

		$username=(openssl_encrypt($_POST['username'], $method, $key));
		$password=(openssl_encrypt($_POST['password'], $method, $key));
		//echo $username."<br>".$password;
		
		$postData = array("username"=>$username,"password"=>$password);
		$url = 'http://10.188.7.135/api/login/login.php';
		$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

		$response = json_decode($jsonResponse,true);
		if($response['Msg']=="Success")
		{
			$errorMsg="";
            $filename = $_POST['username'].'-fp.lock';
            if (file_exists($filename)) {
                $now = new DateTime();
                $date = new DateTime();
                $date->setTimestamp(filemtime($filename));
                $since_start =$date->diff($now);
        
                $minutes = $since_start->days * 24 * 60;
                $minutes += $since_start->h * 60;
                $minutes += $since_start->i;
                if($minutes>15)
                {
					userLogin($filename,$username,$_POST['username']);
                } else {
                    $errorMsg="ERROR: Another Session is active".$minutes;
                }
            } else {
                userLogin($filename,$username,$_POST['username']);
            }
		} else {
			$errorMsg=$response['Msg'];
		}
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
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}


</script>
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
   
    <main>
<!-- Added by magdum shaikh - for logo - 117/07 - start  -->
    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle"></img>
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="search" id = "searchDiv">

        <form method="post">

                <table style="margin: auto;width: 100%; max-width: 500px; border-spacing: 0 50px;">
                    <tr>
                        <td><h2 style="color: #00338D;text-align: center;font-size: 45px;">CMS Login</h2></td>
                    </tr>
                    <tr>
                        <td style="color: red;"><?php echo $errorMsg; ?></td>
                    </tr>
<tr><td><input type="text" placeholder="User Name" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 17px;background-size: 26px;color: #707070;font-size: 20px;padding-left:70px;" name="username"/></td></tr>
<tr><td><input type="password" placeholder="Password" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Password.png');background-repeat:no-repeat;background-position: 20px 18px;background-size: 30px;color: #707070;font-size: 20px;padding-left:70px;" name="password"/></td></tr>
<tr><td>Enter code:<input id="captcha_code" name="captcha_code" type="text" autocomplete="off"><img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
</td></tr>
                    <tr>
                        <td  style="text-align: center;">
                            <button value="Login" name="login" id = "login"  class="searchb" style="cursor: pointer;width: 200px;border-radius: 8px; background-color: #00338D; height:60px; font-size: 28px; color: white; border: none;" onclick="location.href='select_template.php';">Login</button>
                        </td>
                    </tr>
                    <tr>
                        <td  style="text-align: center;">
                            <a href="forgotPassword.php">Forgot Password</a>
                        </td>
                    </tr>
                </table>

        </form>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
    <div style="margin:25px;font-size:0.9vw;bottom:10px;position:relative;">
        &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
    </main>
</body>
</html>
