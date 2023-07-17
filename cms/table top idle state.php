<?php
include_once('security.php');
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

    body{
     
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

    p{
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    .box-selection {
        height:200px;
        width:150px;
        background-color:#00338d;
        background-size: contain;
        display: inline-block;
        margin:20px;
        /* background-image:url('assets/Rectangle-76.png');
        background-repeat:no-repeat; */
        color: white;
        text-decoration: none;
        border-radius: 15px;
        text-align: center;
        font-size: 25px;
        vertical-align: middle;
        margin-left: 60px;
        margin-top:120px;
        cursor: pointer;
    }
 
.box-selection:hover{
    background-color: #38b2d7ba !important;
    outline: none;
    border: none;
    color: #f0fff0 !important;
   
    
}

    .vertical-center {
        margin: 0;
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .vertical-center1 {
        margin: 0;
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size:20px;
    }
  


</style>
<body>
     <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
     <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <!-- Commented and Added by shubham Jadhav - removed absolute position on div - 14/1 - start  -->
        <!-- <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px"> -->
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;top: 50px">

<form action="select_template.php" method="post">
<div style="width: 1000px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor: pointer;"onclick="location.href='TableTop.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
    Table Top Idle State
    <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"onclick="location.href='login.php';"></div>
</div>
<div style="width: 800px;height:200px;margin:auto;">
    <div class="box-selection" onclick="location.href='kalediscope.php';">
        <div class="vertical-center1">
            Kaleidoscope 
        </div>
    </div>
    <div class="box-selection" onclick="location.href='weather.php';">
        <div class="vertical-center">
            Weather
        </div>
    </div>
    <div class="box-selection" onclick="location.href='twitter.php';">
        <div class="vertical-center">
           Twitter
        </div>
    </div>
   
</div>
</div>
</div>


</form>
        </div>
    <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
    <div style="margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
        &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
</body>
</html>
