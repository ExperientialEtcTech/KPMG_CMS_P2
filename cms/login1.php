<?php
$errorMsg="Enter the OTP received in mail";
session_start();
if(!isset($_SESSION['username']))
{
    header("Location : login.php");
}

function createLockFile($filename){
    $myfile = fopen($filename, "w") or die("Unable to open file!".$filename);
    $txt = "Javed Akhtar\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}

if(isset($_POST['otp']))
{
    if($_SESSION['otp']==$_POST['otp'])
    {
        $filename = $_SESSION['raw-username'].'-fp.lock';
        createLockFile($filename);
        header("Location : select_template.php");
    } else {
        $errorMsg="Invalid OTP";
    }
} else {
    include_once('config.php');
    include_once('jwt.php');
	$otp=rand(100000,999999);
    $_SESSION['otp']=$otp;
	$postData = array("username"=>$_SESSION['raw-username'],"otp"=>$otp);
	$url = $apiBaseUrl.'login/sendOtp.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	//added by shubham J - 18/7/23
	echo $otp;
	//$response = json_decode($jsonResponse,true);
    //$filename = 'mail-fp.lock';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KPMG</title>
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
</head>

<body>
    <main>

        <div class="search" id = "searchDiv">
 
<form method="post">

                <table style="margin: auto;width: 100%; max-width: 500px; border-spacing: 0 50px;">
                    <tr>
                        <td><h2 style="color: #00338D;text-align: center;font-size: 45px;">CMS Login</h2></td>
                    </tr>
                    <tr>
                        <td style="color: red;"><?php echo $errorMsg; ?></td>
                    </tr>
<tr><td><input type="text" placeholder="OTP" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 17px;background-size: 26px;color: #707070;font-size: 20px;padding-left:70px;" name="otp" autocomplete="off"/></td></tr>
                    <tr>
                        <td  style="text-align: center;">
                            <button value="Login" name="login" id = "login"  class="searchb" style="cursor: pointer;width: 200px;border-radius: 8px; background-color: #00338D; height:60px; font-size: 28px; color: white; border: none;">Login</button>
                        </td>
                    </tr>
                </table>

</form>
        </div>
    </main>
</body>
</html>
