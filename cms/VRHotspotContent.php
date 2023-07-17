<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
if(isset($_GET['VideoId']) && $_GET['VideoId'] != ""){
	$postData = array("ServiceVideoId"=>&$_GET['VideoId']);
	$url = $apiBaseUrl.'cms/VRshowHotspot.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$response = json_decode($jsonResponse,true)['hotspot']['LocationHotspot'];
   
	$responseUpdate = json_decode($jsonResponse,true)['hotspot']['ContentHotspot'];
}else{
	header("location: VRServices.php");
}
if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$postData2 = array("ServiceId"=>&$_GET['Id']);
	$url2 = $apiBaseUrl.'cms/VRshowServiceVideos.php';
	$jsonResponse2 = rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$response1 = json_decode($jsonResponse2,true)['videos'];
}
if(!array_key_exists("status",$response)){
for($i=0;$i<count($response);$i++){
    for($j=0;$j<count($response1);$j++){
        if($response[$i]['name']===$response1[$j]['name']){
            $response[$i]['videoUrl']=$response1[$j]['videourl'];
        }
    }
}
}
else{
    $response=[];
}
if(array_key_exists("status",$responseUpdate)){
    $responseUpdate=[];
}


if(isset($_GET['DelId']) && isset($_GET['HotspotType']))
{
	//echo  $_GET['HotspotType'];
    $postData1 = array("Id"=>&$_GET['DelId'], "HotspotType" =>&$_GET['HotspotType']);
    $url1 = $apiBaseUrl.'cms/VRdeleteHotspot.php';
    $jsonResponse1 = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$response1 = json_decode($jsonResponse1,true)['response']['status'];
	if($response1  == 1){
		header("location: VRHotspotContent.php?Id=".$_GET['Id']."&VideoId=".$_GET['VideoId']."");
	}else{
		header("location: VRServices.php");
	}
	
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || welcome Screen</title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">-->
	<script src="assets/js/jquery-3.6.0.js">
    </script>
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
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

    .question {
        color: grey;
        font-size: 25px;
        padding-left: 20%;

    }

    .test1 {
        padding-bottom: 20px;
    }

    .delete {
        float: right;
        background-repeat: no-repeat;
    }

    .imgg {
        float: right;
        padding-right: 200px;
    }

    .img1 {
        float: right;
        margin-left: 30%;
    }

    .add-button {
        right: 10px;
        bottom: 10px;
        position: fixed;
        cursor: pointer;
    }

    .services360-form {
        max-width: 800px;
        margin: 0px auto;
        padding-left: 40px;
    }

    .btn-custom-small {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-width: 157px;
        height: 50px;
        color: #fff;
        background: #00338d;
        font-size: 24px;
        text-decoration: none;
        border-radius: 10px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        cursor: pointer;
        border: 0px;
        padding: 0px 30px;
    }

    .btn-custom-small:hover {
        background-color: #38b2d7ba;
        outline: none;
        border: none;
        color: #f0fff0;
        cursor: pointer;
        transition: 0.1s;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .d-flex {
        display: flex;
    }

    .services360-form-row {
        display: flex;
        margin-bottom: 40px;
    }

    .services360-form-question {
        flex: 1 1 auto;
    }

    .services360-form-row h3 {
        margin: 0px;
        /*padding: 0px 0px 10px 0;*/

        font-size: 28px;
        font-family: 'UNIVERSFORKPMG-BOLD';
    }

    .services360-form-row p {
        margin: 0px;
        padding: 0px 0px 0px 32px;
        color: #838383;
        font-size: 18px;
        line-height: normal;
        font-family: arial;
    }

    .services360-form-actions {
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .services360-form-actions .btn-custom-small {
        margin-left: 30px;
    }
    </style>
</head>

<body>
		    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
<!-- Commented and Added by shubham Jadhav - removed absolute position on div - 14/1 - start  -->    
    <!-- <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px"> -->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;top: 50px">


        <form action="VRHotspotContent.php" method="get" id="form">
            <div style="width: 1000px;height:100px;margin:auto;">
                <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor:pointer;"
                    onclick="location.href='VRServiceVideos.php?Id=<?php echo $_GET['Id']; ?>';"></div>
                <div
                    style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
                    Hotspot Content

                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';"></div>
                    <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';"></div>
                </div>
            </div>
            <?php
            for ($i=0; $i <count($response) ; $i++) { 
            ?>
            <div class="services360-form">
                <div class="services360-form-row">
                    <input name="Id" style="display:none;" value="<?= $response[$i]['Id'];?>" />
                    <input name="Type" style="display:none;" value="location" />
                    <div class="services360-form-question">
                        <div class="btn-custom-small" role="button"
                            onclick="ShowVideoData('video','<?= $response[$i]['videoUrl'] ?>')">
                            Location Hotspot - <?=  ($i + 1) ?>
                        </div>
                    </div>
                    <div class=" services360-form-actions">
                        <a class="btn-custom-small"
                            href="VREditHotspot.php?Id=<?php echo $_GET['Id']; ?>&VideoId=<?php echo $_GET['VideoId']; ?>&HotspotType=location&HotspotId=<?= $response[$i]['Id']?>">Edit</a>

                        <a class="btn-custom-small"
                            href="VRHotspotContent.php?Id=<?php echo $_GET['Id']; ?>&VideoId=<?php echo $_GET['VideoId']; ?>&DelId=<?=$response[$i]['Id']?>&HotspotType=location">Delete</a>
                    </div>
                </div>
            </div>
            <?php }
            for ($i=0; $i <count($responseUpdate) ; $i++) { 
                ?>
            <div class="services360-form">
                <div class="services360-form-row">
                    <input name="Id" style="display:none;" value="<?= $responseUpdate[$i]['Id']; ?>">
                    <input name="Type" style="display:none;" value="content">
                    <div class=" services360-form-question">

                        <div class="btn-custom-small" role="button"
                            onclick="ShowVideoData('<?= $responseUpdate[$i]['type'] ?>','<?= $responseUpdate[$i]['content'] ?>')">
                            <h3>Content Hotspot - <?=($i + 1) ?></h3>
                        </div>
                    </div>
                    <div class="services360-form-actions">
                        <a class="btn-custom-small"
                            href="VREditHotspot.php?Id=<?php echo $_GET['Id']; ?>&VideoId=<?= $_GET['VideoId']; ?>&HotspotType=content&HotspotId=<?= $responseUpdate[$i]['Id'] ?>">Edit</a>

                        <a class="btn-custom-small"
                            href="
                        VRHotspotContent.php?Id=<?php echo $_GET['Id']; ?>&VideoId=<?php echo $_GET['VideoId']; ?>&DelId=<?= $responseUpdate[$i]['Id'] ?>&HotspotType=content">Delete</a>
                    </div>
                </div>
            </div>
            <?php
            }?>
        </form>
		<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:relative">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
        <div class="add-button" id="btnadd"><a
                href="VRAddHotspot.php?Id=<?php echo $_GET['Id']; ?>&VideoId=<?php echo $_GET['VideoId']; ?>"><img
                    src="assets/Add Button.png" alt="img"></a></div>
        <div id="changeViewModelUpdate" class="modal">
            <div class="modal-dialog modal-xl">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="fileName"></h2>
                        <span class="close" id="closeChangeViewModelUpdate">&times;</span>
                    </div>
                    <div class="modal-body" id="changeViewBody">
                    </div>
                </div>
            </div>
        </div>
		
        <script src=" ./assets/js/bootstrap.min.js">
        </script>
        <script src="footer.js"></script>
        <script>
        function ShowVideoData(type, data) {
            let filename = data.substring(data.lastIndexOf("/") + 1);
            let html = "";
            if (type == "image") {
                html = "<img src='" + data + "' alt='image' class='img-fluid'>";
            } else if (type == "video") {
                html =
                    "<video controls id='video-src'><source src='" + data + "' type='video/mp4'></video>";
                document.getElementById("fileName").innerText = filename
            } else if (type == "pdf" || type == "Pdf") {
                html = `<iframe  src="${data}">`;
                document.getElementById("fileName").innerText = filename
            } else if (type == "text" || type == "Text") {
                html = `<span>${data}</span>`;
                document.getElementById("fileName").innerText = "content"
            } else {
                html = "<span>Preview is not available</span>";
            }
            document.getElementById("changeViewBody").innerHTML = html;

            document.getElementById("changeViewModelUpdate").style.display = "block";
        }
        document.getElementById("closeChangeViewModelUpdate").addEventListener("click", function() {
            document.getElementById("changeViewModelUpdate").style.display = "none";
        });
        </script>
    </div>
</body>

</html>
