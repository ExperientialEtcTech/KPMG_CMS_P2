<?php	
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
if(isset($_GET['Id']) && $_GET['Id'] != "" && isset($_GET['VideoId']) && $_GET['VideoId'] != ""){
	$Id = $_GET['Id'];
	$VideoId = $_GET['VideoId'];
	$postData = array("ServiceId"=>&$Id);
	$url = $apiBaseUrl.'cms/VRshowServiceVideos.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$response = json_decode($jsonResponse,true)['videos'];
}else{
	//header("location: VRServices.php");
	
}
if(isset($_GET['VideoName']) && isset($_GET['VideoId']) && $_GET['VideoId'] != "")
{
    $VideoName = $_GET['VideoName'];
	$VideoId = $_GET['VideoId'];
    $postData2 = array("ServiceVideoId"=>&$VideoId,"VideoName"=>&$VideoName);

    $url2 = $apiBaseUrl.'cms/VReditServiceVideo.php';

    $jsonResponse2 = rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$response2 = json_decode($jsonResponse2,true)['response']['status'];
	//Added by shubham - 25/08
	//header("location: VRServiceVideos.php?Id=".$_GET['Id']."");
	$response_msg2 = json_decode($jsonResponse2,true)['response']['msg'];
	if($response2 == 1){
		header("location: VRServiceVideos.php?Id=".$_GET['Id']."");
	}elseif($response2 == 0 && $response_msg2 == 'Name is already taken'){
		?>
		<script>alert('Name is already taken');</script>
		<?php
	}
    
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
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
</head>
<style>
    .btn-custom-small:hover{
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
}
</style>
<body>
	 <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <form action="" method="get" id="form">
        <div class="container edit-services">
            <div class="title-bar">
                <a href="javascript: void(0);" class="left-arrow"
                    onclick="location.href='VRServiceVideos.php?Id=<?php echo $_GET['Id']; ?>';">
                    Back
                </a>
                <h1>Edit Services 
                    
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';"><div
                        style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';"></div></div>
                </h1>
            </div>
            <div class="content-block">
                <div class="edit-services-row">
                    <label>Service Name</label>
                    <div>
                        <input type="hidden" name="VideoId" type="text" class="text-box"
                            value="<?= $_GET['VideoId'] ?>">
						<input type="hidden" name="Id" type="text" class="text-box"
						value="<?= $_GET['Id'] ?>">
                        <input name="VideoName" type="text" class="text-box" value="<?= $_GET['name']?>">
                    </div>
                </div>
                <button class="btn-custom-small" type="submit" name="submit">
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