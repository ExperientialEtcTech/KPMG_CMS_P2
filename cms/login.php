<?php
$errorMsg = "";
session_start();
if (isset($_SESSION['username'])) {
    session_destroy();
    session_start();
    $status = unlink('cmsadmin-fp.lock');
}

function createLockFile($filename)
{
    $myfile = fopen($filename, "w") or die("Unable to open file!" . $filename);
    $txt = "Javed Akhtar\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}

function userLogin($filename, $username, $rawUser)
{
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['raw-username'] = $rawUser;
    //createLockFile($filename);
    header("Location : login1.php");
}

if (isset($_POST['login'])) {

    if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
        $errorMsg = "The Validation code does not match!"; // Captcha verification is incorrect.		
    } else { // Captcha verification is Correct. Final Code Execute here!		
        include_once('config.php');
        include_once('jwt.php');

        $key = 'bRuD5WYw5wd0rdHR';
        $method = 'aes128';

        $username = (openssl_encrypt($_POST['username'], $method, $key));
        $password = (openssl_encrypt($_POST['password'], $method, $key));
        //echo $username."<br>".$password;

        $postData = array("username" => $username, "password" => $password);
        $url = $apiBaseUrl . 'login/login.php';
        $jsonResponse = rest_call('POST', $url, $postData, 'multipart/form-data', "Bearer " . $_COOKIE['kpmg-access']);

        $response = json_decode($jsonResponse, true);
        if ($response['Msg'] == "Success") {

            $errorMsg = "";


            $filename = $_POST['username'] . '-fp.lock';
            if (file_exists($filename)) {
                $now = new DateTime();
                $date = new DateTime();
                $date->setTimestamp(filemtime($filename));
                $since_start = $date->diff($now);

                $minutes = $since_start->days * 24 * 60;
                $minutes += $since_start->h * 60;
                $minutes += $since_start->i;
                if ($minutes > 15) {
                    userLogin($filename, $username, $_POST['username']);
                } else {
                    //Commented by shubham J to bypass allowing multiple users to login to cms - 10/7/23 - start 
                    //$errorMsg="ERROR: Another Session is active".$minutes;
                    userLogin($filename, $username, $_POST['username']);
                    //Commented by shubham J to bypass allowing multiple users to login to cms - 10/7/23 - start 
                }
            } else {
                userLogin($filename, $username, $_POST['username']);
            }
        } else {
            $errorMsg = $response['Msg'];
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

    <script type='text/javascript'>
        function refreshCaptcha() {
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        }
    </script>
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

        body {

            margin: 0px;
            font-family: 'UNIVERSFORKPMG-BOLD';
            src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
            /* Added by magdum 15-07-23 */
            /* for background image */
            background-image: url(./assets/CMS-BG.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            background-color: black;
        }
        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 470px;
            margin: auto;
			margin-top:100px;
        }
		    .code-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .code-container label {
            margin-right: 10px;
        }
		     .logo-left {
            position: absolute;
            top: 20px;
            left: 50px;
            height: 90px;
            padding: 10px;
        }

        @font-face {
            font-family: 'UNIVERSFORKPMG-BOLD';
            src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
        }

        p,
        button {
            font-family: 'UNIVERSFORKPMG-BOLD';
            src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
        }

        input {
            outline: none;
        }

        input[type='text'],
        input[type='password'] {
            outline: none;
            font-family: 'UNIVERSFORKPMG-BOLD';
            src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
			margin-bottom: 10px;
        }
		   button {
            margin-top: 20px; 
        }
    </style>
    <script src="assets/js/jquery.min.js"></script>
    <script>
        var timeoutTimer;
        var expireTime = 1000 * 60 * 15;

        function expireSession() {
            clearTimeout(timeoutTimer);
            timeoutTimer = setTimeout("IdleTimeout()", expireTime);
        }

        function IdleTimeout() {
            localStorage.setItem("logoutMessage", true);
            window.location.href = "login.php";
        }
        $(document).on('click mousemove scroll keypress', function() {
            expireSession();
        });
        expireSession();
    </script>
</head>

<body>
    <main>
		 <div class="logo-left">
            <img src="./assets/KPMG_logo2.png" alt="Left Logo" height="100%">
        </div>
		<div class="card">

        <div class="search" id="searchDiv">

            <form  method="post">

                <table   style="margin: auto;">
                    <tr>
                        <td>
                            <h2 style="color: #00338D;text-align: center;font-size: 45px;">CMS Login</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: red;"><?php echo $errorMsg; ?></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="User Name" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Account-ID.png');background-repeat:no-repeat;background-position: 20px 17px;background-size: 26px;color: #707070;font-size: 20px;padding-left:70px;" name="username" autocomplete="off" /></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Password" style="width:100%;height: 70px; border-radius: 10px; border: solid 1px #a3a3a3;background-image:url('assets/Password.png');background-repeat:no-repeat;background-position: 20px 18px;background-size: 30px;color: #707070;font-size: 20px;padding-left:70px;" name="password" autocomplete="off"></td>
                    </tr>
                    <tr>
                       <td class="code-container">
                                <label for="captcha_code">Enter code:</label>
                                <input style="height:40px;border-radius:10px;border:1px solid gray" id="captcha_code" name="captcha_code" type="text" autocomplete="off">
                                <img style="margin-left: 10px;" src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'>
                            </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <button value="Login" name="login" id="login" class="searchb" style="cursor: pointer;width: 200px;border-radius:                               8px; background-color: #00338D; height:60px; font-size: 28px; color: white; border: none;"                                                     onclick="location.href='select_template.php';">Login</button>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <a href="forgotPassword.php">Forgot Password</a>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
			 </div>
    </main>
</body>

</html>
