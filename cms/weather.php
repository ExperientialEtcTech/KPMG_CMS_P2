<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status = 1;
$postData = array(&$status);
$url = $apiBaseUrl . 'cms/showWeather.php';

$jsonResponse = rest_call('POST', $url, $postData, 'multipart/form-data', "Bearer " . $_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse, true)['files'];


$postDataweather = array();
$urlweather = 'https://api.openweathermap.org/data/2.5/weather?q='.'mumbai'.'&mode=json&units=metric&APPID=11d13ae5034256d2b02b40b79743d41e'; // insert actual APPID

$jsonResponseweather = rest_call('POST',$urlweather, $postDataweather,'multipart/form-data');

$responseweather = json_decode($jsonResponseweather,true);
//$responseweather['cod']=200;// remove in production after openweather domain is allowed in colab

// Determine if services are up or not
$apiStatusMessage = "";
if ($responseweather['cod']!="200") {
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
    <link rel="stylesheet" href="./style1.css">
    <script type="text/javascript" language="javascript"></script>

    <!-- Added by shubham - 17/10 - Start -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/session_check.js"></script>
    <!-- Added by shubham - 17/10 - End -->

    <title>KPMG</title>
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
            width: 950px;
            height: 100px;
            margin: auto;
        }

        .row-data-left {
            float: left;
            margin-left: 60px;
        }

        .row-data-right {
            float: right;
            margin-right: 130px;
            font-size: 23px;
            color: black;
        }

        .add-button {
            right: 10px;
            bottom: 10px;
            position: fixed;
            margin-top: 50px;
        }

        .map-red {
            width: 50px;
            height: 57px;
        }

        /*Added by shubham - 16/09*/
        .del-image1:hover~.tooltiptext {
            Display: block;
        }
    </style>
</head>

<body>
    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin: 15px">
        <img src="./assets/KPMG_logo.png" style="width: 15%; vertical-align: middle">
        <span style="vertical-align: middle; font-size: 3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <!-- Commented and Added by shubham Jadhav - removed absolute position on div - 14/1 - start  -->
    <!-- <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px"> -->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;top: 50px">
        <div class="row-data">
            <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor: pointer;" onclick="location.href='table top idle state.php';"></div>
            <div style="height:50px;width:1000px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;cursor: context-menu;">
                Weather
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;" onclick="location.href='index.php';">
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:130px; background-size: contain;cursor:pointer;" onclick="location.href='login.php';"></div>
                </div>
                <p style="margin: 0 auto;color:red;font-size:40%;padding-top:3%">*Primary city cannot be deleted, it can be only changed.</p><br>
                <div>
                    <p style="margin: 0 auto; color: red; font-size: 40%; padding-top: 3%;"><?php echo $apiStatusMessage; ?></p>
                </div>
                <?php foreach ($response as $value) { ?>
                    <div class="row-data">
                        <div class="row-data-left">
                            <div class="row-data-left">
                                <?php if ($value['CityType'] !== 1) {
                                    echo '<img src="assets/Location icon.png">';
                                } else {
                                    echo '<img src="assets/Group258-01.png" class="map-red"/>';
                                } ?>
                            </div>
                            <div class="row-data-right" style="padding-left:50px;cursor: context-menu;">
                                <h3><?php echo $value['cities']; ?></h3>
                            </div>
                        </div>
                        <div class="row-data-right">
                            <a href="delweather.php?id=<?php echo $value['cities']; ?>"><img src="assets/Delete icon.png"></a>
                        </div>
                    </div>
                <?php } ?>
                <div class="add-button">
                    <a href="AddWeather.php"><img src="assets/Add Button.png"></a>
                </div>
                <div style="margin: 25px; font-size: 0.9vw; bottom: 10px; position: relative; color: black">
                    &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International. KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
