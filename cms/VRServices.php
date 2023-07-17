<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

if(isset($_GET['DelId']))
{
    $postData1 = array("ServiceId"=>&$_GET['DelId']);
    $url1 = $apiBaseUrl.'cms/VRdeleteService.php';
	//echo ($_POST['Id']);
    $jsonResponse1 = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	//header("Refresh:0");
	$response1 = json_decode($jsonResponse1,true)['response']['status'];
	header("location: VRServices.php");
}


$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/VRshowService.php';
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
//$response = json_decode($jsonResponse,true)['services'][0];
//echo '<script>console.log('.$response.');</script>';

$response = $jsonResponse;

if(empty($response)) {
  echo ("No Service available.");
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

    .add-button {
        right:10px;
        bottom:10px;
        position: fixed;
    }

    .box-selection {
        height:200px;
        width:150px;
        background-size: contain;
        display: inline-block;
        margin:20px;
        background-image:url('assets/Rectangle-76.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        text-align: center;
        font-size: 25px;
        vertical-align: middle;
        margin-left: 90px;
        margin-top:50px
    }

    .vertical-center {
        margin: 0;
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .vrscreen-form {
        max-width: 700px;
        margin: 0px auto;
    }
    .btn-custom-small {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        /*min-width: 157px;*/
		min-width: 140px;
        height: 50px;
        color: #fff;
        background: #00338d;
        /*font-size: 24px;*/
		font-size: 17px;
        text-decoration: none;
        border-radius: 10px;
		margin-right:10px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        cursor: pointer;
        border: 0px;
        padding: 0px 30px;
    }
    .btn-custom-small:hover{

    background-color: #38b2d7ba !important;
    color: #f0fff0 !important;
    
}
    
    .justify-content-between {
        justify-content: space-between;
    }
    .d-flex {
        display: flex;
    }
    .vrscreen-form-row {
        display: flex;
        margin-bottom: 60px;
    }
    .vrscreen-form-text {
        flex: 1 1 auto;
        padding-right: 30px;
    }
    .vrscreen-form-row h3 {
        margin: 0px;
        padding: 0px 0px 10px 0;
        color: #838383;
        font-size: 28px;
        font-family: 'UNIVERSFORKPMG-BOLD';
    }
    .vrscreen-form-row p {
        margin: 0px;
        padding: 0px 0px 0px 0;
        color: #838383;
        font-size: 22px;
        font-family: 'UNIVERSFORKPMG-BOLD';
    }
    .vrscreen-form-actions {
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    .vrscreen-form-actions button {
        margin: 0px 30px;
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

        <form action="VRServices.php" method="get" id = "form">
            <div style="width: 1000px;height:100px;margin:auto;">
                <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor:pointer;"onclick="location.href='select_template.php';"></div>
                <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
                VR Services <div
                        style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';"><div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"onclick="location.href='login.php';"></div>
            </div></div></div>
			<!--
            <div class="vrscreen-form">
                <div class="vrscreen-form-row">
                    <div class="vrscreen-form-text">
                        <h3>Item 01</h3>
                    </div>
                    <div class="vrscreen-form-actions">
                        <button class="btn-custom-small">View</button>
                        <button class="btn-custom-small">Delete</button>
                    </div>
                </div>
            </div>
			-->
			<div class="add-button" id="btnadd"><a href="VRAddServices.php"><img src="assets/Add Button.png"></a></div>
        </form>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
    <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:relative">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
</body>
	
<script>
		
		response = JSON.parse('<?php echo $response; ?>');
		NumberOfServices = response.services.length;
		//console.log(response.services.length);
		var formElem = document.getElementById("form");
		
		if(NumberOfServices === undefined ){
			console.log(NumberOfServices);
			formElem.innerHTML  += `
			<div class="vrscreen-form">
					<div class="vrscreen-form-row">
						<div class="vrscreen-form-text">
							<h3>No Services available</h3>
						</div>
					</div>
				</div>`;
		}else{
			for(var i=0;i<response.services.length;i++){
				formElem.innerHTML  += `
				<div class="vrscreen-form">
						<div class="vrscreen-form-row">
							<div class="vrscreen-form-text">
								<h3>`+(i+1)+`. `+response.services[i].name+`</h3>
							</div>
							<div class="vrscreen-form-actions">
								<a href="VRServiceVideos.php?Id=`+response.services[i].Id+`" class="btn-custom-small">View</a>										
								<input name = "Id" style = "display:none;" value = "`+response.services[i].Id+`" />
								<!--<button class="btn-custom-small" name = "Delete">Delete</button>-->
								<a href="VRServices.php?DelId=`+response.services[i].Id+`" class="btn-custom-small">Delete</a>	
							</div>
						</div>
					</div>`;
			}
		}
	//href="EditTwitter.php?id="
</script>	
</html>
