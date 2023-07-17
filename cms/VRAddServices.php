<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

if(isset($_POST['name']))
{
    //$postData1 = array("ServiceName"=>&$_POST['name'], "ServiceOrder"=>&$_POST['order']);
	$postData1 = array("ServiceName"=>&$_POST['name']);
    $url1 = $apiBaseUrl.'cms/VRaddService.php';
	//echo ($_POST['Id']);
    $jsonResponse = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	header("location: https://kpmg.experientialetc.com/cms/VRServices.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || Add Services</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
	<link rel="stylesheet" href="./style1.css">
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
</head>
<style>
    .btn-custom {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 157px;
    height: 80px;
    color: #fff;
    background: #00338d;
    font-size: 24px;
    text-decoration: none;
    border-radius: 15px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 0px;
}
.btn-custom:hover{
  background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
}
/*Added By shubham - 16/09 */
.del-image1:hover~.tooltiptext {
        Display: block;

    }
</style>
<body>
	<!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
	<div style="margin:15px">
		<img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
		<span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
	</div>
	<!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
<form action="VRAddServices.php" method="post">
    <div class="container add-services">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow" onclick="location.href='VRServices.php';">
                Back
            </a>
            <h1>Add Services
            <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
            <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px;margin-top:0px; background-size: contain;cursor:pointer;"onclick="location.href='login.php';"></div>
            </div>
        </h1>
        </div>
        <div class="content-block">
		
            <div class="text-box-container">
                <input name="name" type = "text" class="text-box" placeholder="Service name">
				<!--Added by shubham 26/08 - Start -->
				<img class="del-image1" src="assets/Info button.png" alt="welcome-text" style = "float:left;padding-top:5%;">
				<span class="tooltiptext" style="bottom:45%;margin-left:10%">Please insert appropriate VR Service name.</span>
			<!--Added by shubham 26/08 - End -->
            </div>
			 <!--<div class="text-box-container">
                <input name="order" type = "text" class="text-box" placeholder="Service order">
            </div>-->
            <button class="btn-custom">
                Save
            </button>
        </div>
    </div>
</form>
	<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
</body>
</html>