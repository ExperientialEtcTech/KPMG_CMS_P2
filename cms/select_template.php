<?php
 include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KPMG</title>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
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

.big-btns-row {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    max-width: 850px;
    margin: 0 auto 0px auto;
    flex-wrap: wrap;
}

.box-selection {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 130px;
    height: 170px;
    color: #fff;
    background: #00338d;
    font-size: 20px;
    text-decoration: none;
    border-radius: 15px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 15px;
    margin: 40px;

}
.box-selection:hover {
    background-color: #38b2d7ba !important;
    outline: none;
    border: none;
    color: #f0fff0 !important;
    
}




</style>

<body>
    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle"></img>
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <!-- Commented and Added by shubham Jadhav - removed absolute position on div - 14/1 - start  -->
    <!-- <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px"> -->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: relative;top: 50px">

        <form action="select_template.php" method="post">
            <div style="width: 1000px;height:100px;margin:auto;">
                <div
                    style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor: pointer;">
                </div>
                <div
                    style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
                    Select Template
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';"></div>
                </div>

            </div>
            <div class="big-btns-row">
                <div class="box-selection" onclick="location.href='welcome1.php';">
                    <!--welcome_screen.php-->
                    <div class="vertical-center">
                        Welcome Screen
                    </div>
                </div>
                <div class="box-selection" onclick="location.href='TableTop.php';">
                    <div class="vertical-center">
                        Table Top
                    </div>
                </div>
                <div class="box-selection" onclick="location.href='VRServices.php';">
                    <div class="vertical-center">
                        VR Screen
                    </div>
                </div>
                <div class="box-selection" onclick="location.href='Feedback form.php';">
                    <div class="vertical-center">
                        Event Feedback
                    </div>
                </div>
                <div class="box-selection" onclick="location.href='FileUpload.php';">
                    <div class="vertical-center">
                        File Upload
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
