<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status = 1;
$postData = array(&$status);
$url = $apiBaseUrl . 'cms/showTwitter.php';

$jsonResponse = rest_call('POST', $url, $postData, 'multipart/form-data', "Bearer " . $_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse, true)['handles'];

// Determine if services are up or not
$apiStatusMessage = "";
if ($response === null) {
    $apiStatusMessage = "*services are currently down.";
} else {
    $apiStatusMessage = "*services are up and running.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" language="javascript"></script>
    <title>KPMG</title>
</head>
<style>
    body {

        margin: 0px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
        /* Added by magdum 17-07-23 */
        /* for background image */
        background-image: url(./assets/CMS-BG.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        background-color: black;
    }


    @font-face {
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    p {
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    .row-data {
        width: 1000px;
        height: 100px;
        margin: auto;
    }

    .row-data-left {
        float: left;
    }

    .row-data-right {
        float: right;
    }

    .add-button {
        right: 10px;
        bottom: 10px;
        position: fixed;
    }

    .twitter-form {
        max-width: 800px;
        margin: 20px auto 0px auto;
    }

    .twitter-form-row {
        display: flex;
        margin-bottom: 50px;
        align-items: center;
        justify-content: center;
    }

    .twitter-form-text {
        padding-right: 30px;
        position: relative;
    }

    .twitter-form-row h3 {
        margin: 0px;
        padding: 0px 0px 0px 0px;
        color: #838383;
        font-size: 24px;
        font-weight: normal;
        font-family: 'UNIVERSFORKPMG-BOLD';
    }

    .twitter-form-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .twitter-form-actions h3 {
        position: absolute;
        left: 10px;
        top: 15px;
    }

    .twitter-form-actions a {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .twitter-form-actions a img {
        width: 24px;
    }

    input[type='text'] {
        border-radius: 10px;
        border: solid 1px grey;
        padding: 10px;
        font-family: Arial;
        color: #777;
        font-size: 18px;
        font-weight: 500;
        text-align: left !important;
        width: 500px;
        min-height: 40px;

    }

    input:focus,
    input:focus-visible {
        outline: none;
    }

    .btn-custom-small {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-width: 270px;
        height: 60px;
        color: #fff;
        background: #00338d;
        font-size: 22px;
        text-decoration: none;
        border-radius: 10px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        cursor: pointer;
        border: 0px;
        padding: 0px 30px;
    }

    .btn-custom-small:hover {
        background-color: rgb(105, 199, 211);
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .justify-content-center {
        justify-content: center;
    }

    .edit-icon {
        position: absolute;
        right: 5px;
        padding: 5px;
    }
	
       main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: auto;
        }

        .copyright {
            font-size: 0.9vw;
            margin: 25px;
            max-width: 100%;
            word-wrap: break-word;
            line-height: 1.5;
        }
	
</style>

<body>
	<main>
    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src="./assets/KPMG_logo.png" style="width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <!-- Commented and Added by shubham Jadhav - removed absolute position on div - 14/1 - start  -->
    <!--<div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: abolute;top: 20px">-->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;top: 50px">

        <div class="row-data">
            <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor: pointer;" onclick="location.href='table top idle state.php';"></div>
            <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px; margin-top: 30px;">
                Twitter
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;" onclick="location.href='index.php';">
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;" onclick="location.href='login.php';"></div>
                </div>
            </div>
        </div>
        <br><br>

        <div class="twitter-form">
            <form action="twitterUpdate.php" method="post">
                <p style="    color: red;
    font-size: 20px;"><?php echo $apiStatusMessage; ?></p>
                <?php

                foreach ($response as $value) {
                ?>
                    <div class="twitter-form-row">
                        <div class="twitter-form-text">
                            <img src="assets/twitter.png" alt="twitter" class="twitter-icon">
                        </div>
                        <div class="twitter-form-actions">
                            <input type="hidden" name="id[]" value="<?php echo $value['id']; ?>">
                            <input type="text" name="name[]" value="<?php echo $value['twitter_handles']; ?>">

                            <img src="assets/Group 159.png" alt="editIcon" class="edit-icon">
                        </div>
                    </div>
                <?php
                }
                ?>


                <div class="twitter-form-row justify-content-center">
                    <button class="btn-custom-small" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
      <div class="copyright">
            &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
                KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
        </div>
    <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
    <div class="add-button"><a href="AddWeather.php"><img src="assets/Add Button.png"></a></div>
	</main>
</body>

</html>
