<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/showHotspots.php';
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
$response = $jsonResponse;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Manage Hotspot</title>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
    <script src="assets/js/jquery-3.6.0.js"></script>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
</head>




<body class="body-bg">
	  <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container-lg">
        <div class="welcome-screen hotspot">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='mural1.php';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-left:60px;margin-top:23px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome hotspot"> Manage Hotspot
                        <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px;margin-top:20px;padding-right:15px;background-size: contain;cursor:pointer;"
                            onclick="location.href='index.php';">
                            <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px;margin-top:2px; background-size: contain;cursor:pointer;"
                                onclick="location.href='login.php';"></div></div>
                    </span>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class=" col-xs-5 col-sm-4 col-md-4 col-lg-4 margin-top">
                    <div class="height-500">
                        <label class="form-label" style="color: #00338D !important;">Select hotspot</label>
                        <select id="hotspot" name="hotspot" class="form-select" onchange="leaveChange()">
                            <option style="display: none">Select Hotspot</option>

                        </select>
                    </div>
                </div>


            </div>


        </div>
</div>
	<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
        <script>
        function leaveChange() {
            var select = document.getElementById("hotspot");
            var hotspot_id = select.value;

            location.href = 'serviceandsectors.php?id=' + hotspot_id;
        }
        let response = <?php  print_r($response); ?>;

        const select = document.querySelector('select');
        for (i = 0; i < response.mural_hotspot.length; i++) {

            HotspotName = response.mural_hotspot[i].hotspot_label;
            HotspotId = response.mural_hotspot[i].hotspot_id;
            select.options.add(new Option(HotspotName, HotspotId));

        }
        </script>
</body>

</html>