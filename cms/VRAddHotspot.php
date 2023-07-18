<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

if(isset($_GET['VideoId']) && $_GET['VideoId'] != "" && isset($_GET['Id']) && $_GET['Id'] != ""){
	//gets all 360 vid's names 
	$postData2 = array("ServiceId"=>&$_GET['Id']);
    $url2 = $apiBaseUrl.'cms/VRshowServiceVideos.php';
    $jsonResponse2 = rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$response2 = $jsonResponse2;
	
}else{
	header("location: VRServices.php");
}


if(isset($_POST['Save']) && isset($_POST['PosX']) && $_POST['PosX'] != "" && isset($_POST['PosY']) && $_POST['PosY'] != "" && isset($_POST['PosZ']) && $_POST['PosZ'] != "" && isset($_POST['RotX']) && $_POST['RotX'] != "" && isset($_POST['RotY']) && $_POST['RotY'] != "" && isset($_POST['RotZ']) && $_POST['RotZ'] != "" ){
	
	$HotspotType = $_POST['HotspotType'];
	
	if($HotspotType == 'location'){
		$ContentType = "";
		$Content = "";	
		$HotspotTo = $_POST['HotspotTo'];
	}elseif($HotspotType == 'content'){
		$ContentType = $_POST['ContentType'];
        if($_POST['ContentType']!=="text"){
            $Content = $_POST['video'];
        }
        else{

            $Content = $_POST['TextContent'];
        }
		$HotspotTo = "";
	}
	


	
	$postData1 = array("ServiceId"=>$_GET['Id'], "HotspotFrom" =>$_GET['VideoId'], "HotspotTo" =>$HotspotTo, "HotspotType" =>$HotspotType, "PosX"=> $_POST['PosX'], "PosY"=> $_POST['PosY'], "PosZ"=> $_POST['PosZ'], "RotX"=> $_POST['RotX'], "RotY"=> $_POST['RotY'], "RotZ"=> $_POST['RotZ'], "Content"=>&$Content, "ContentType"=>$ContentType);

	$url1 = $apiBaseUrl.'cms/VRaddHotspot.php';
	$jsonResponse1 = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

	$response1 =  json_decode($jsonResponse1,true)['response']['status'];


	if($response1 == 1){
		header("location: VRHotspotContent.php?Id=".$_GET['Id']."&VideoId=".$_GET['VideoId']."");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./assets/css/customstyle.css">
    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {

        $("#textbtn").click(function() {
            let fieldSelect = $("#ContentType").val()
            let showVideo = "false",
                showImage = "false",
                showPdf = "false"

            if (fieldSelect === "video") {

                showVideo = "true"

            } else if (fieldSelect === "image") {

                showImage = "true"

            }

            var request = $.ajax({
                type: "POST",
                url: "vrSearch.php",
                data: {
                    Tags: $("#filetag").val(),
                    showVideo,
                    showImage,
                    showPdf
                },
                dataType: "html"
            });
            request.done(function(msg) {
                $('#filebrowser').html(msg);
            });
            request.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });

        });


    });
    </script>
    <style>
    body {
        margin: 0px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }
    </style>
</head>
<style>
.btn-custom-small:hover {
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor: pointer;
    transition: 0.1s;
}
	body{
		            /* Added by magdum 18-07-23 */
            /* for background image */
            background-image: url(./assets/CMS-BG.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            background-color: black;
	}
</style>

<body>
	 <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container file-upload">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow"
                onclick="location.href='VRHotspotContent.php?Id=<?php echo $_GET['Id']; ?>&VideoId=<?php echo $_GET['VideoId']; ?>';">
                Back
            </a>
            <h1>Add Hotspot
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                    onclick="location.href='index.php';">
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';"></div></div>
            </h1>
        </div>

        <!--<form action="VRAddHotspot.php" method="post" id="form">-->
        <form action="" method="post" id="form">
            <div class="file-upload-container">
                <div class="container-fluid"><br><br>
                    <div class="row mb-5">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Hotspot Type
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select name="HotspotType" id="HotspotType" onchange="CheckHotspotType()"
                                class="form-control">
                                <option value="" disabled selected>Please select</option>
                                <option value="location">Location</option>
                                <option value="content">Content</option>
                            </select>
                        </div>
                    </div>
                    <div id="HotpostFromCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Hotpost From
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <h3 class="label"><?php echo $_GET['VideoId']; ?></h3>
                        </div>
                    </div>
                    <div id="HotspotToCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Hotpost To
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select name="HotspotTo" id="HotspotTo" class="form-control">
                                <option value="" disabled selected>Please select</option>
                            </select>
                        </div>
                    </div>
                    <div id="ContentTypeCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Content Type
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select name="ContentType" onchange="CheckContentType()" class="form-control"
                                id="ContentType">
                                <option value="" disabled selected>Please select</option>
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                    </div>
                    <div id="TextContentCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Text Content
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <input name="TextContent" class="text-box" type="text" placeholder="TextContent">
                        </div>
                    </div>
                    <div id="FileUploadCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                File:
                            </label>
                            <div class="filename-extension">
                                File name
                            </div>
                        </div>

                        <div class="col-sm-8 d-flex">
                            <div class="form-control-file-container">

                                <input class="form-control" type="hidden" name="video" id="formFile"
                                    placeholder="Select file">
                                <button class="btn-custom-small" type="button" id="fileSelectBtn" value="Save">Select
                                    File</button>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Position <br />Co-ordinates
                            </label>
                        </div>
                        <div class="col-sm-8 d-flex align-items-center">
                            <input name="PosX" class="text-box text-center" type="text" placeholder="x">
                            <input name="PosY" class="text-box text-center mx-5" type="text" placeholder="y">
                            <input name="PosZ" class="text-box text-center" type="text" placeholder="z">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Rotation <br />Co-ordinates
                            </label>
                        </div>
                        <div class="col-sm-8 d-flex align-items-center">
                            <input name="RotX" class="text-box text-center" type="text" placeholder="x">
                            <input name="RotY" class="text-box text-center mx-5" type="text" placeholder="y">
                            <input name="RotZ" class="text-box text-center" type="text" placeholder="z">
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-8 offset-sm-4">
                        <button name="Save" class="btn-custom-small">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div id="changeModel" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">

                    <div style="width: 800px;height:100px;margin:auto;">

                        <div id="videoTitle"
                            style="height:60px;text-align: center;color: #00338D;text-align: center;font-size: 51px;margin:0px;">
                            Choose content file
                        </div>

                    </div>
                    <span class="close" id="changePopupClose">×</span>
                </div>
                <div class="modal-body changePopup">
                    <div class="example" style="margin:auto;">

                        <input type="text" name="filetag" id="filetag" placeholder="Search..">
                        <button type="submit" name="textbtn" id="textbtn"><i class="fa fa-search"></i></button>
                    </div>
                    <div id="filebrowser">

                    </div>
                </div>

            </div>

        </div>
        <div id="changeViewModel" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">

                    <span class="close" id="closeChangeViewModel">&times;</span>
                </div>
                <div class="modal-body">
                    <video width="500" height="500" controls class="video">
                        <source src="#" type="video/mp4" id="changeVideoShow">


                        Your browser does not support the video tag.
                    </video>
                </div>

            </div>

        </div>
        <div id="changeViewModelUpdate" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="fileName">Welcome Video</h2>
                    <span class="close" id="closeChangeViewModelUpdate">&times;</span>
                </div>
                <div class="modal-body" id="changeViewBody">

                </div>

            </div>

        </div>

    </div>
    <script src="footer.js"></script>
		<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
</body>
<script>
//To create options in 'hotspotTo' dynamically

var Videos = JSON.parse('<?php echo $response2; ?>');
var CurrentVideoId = JSON.parse('<?php echo $_GET['VideoId']; ?>');
selectElement = document.getElementById('HotspotTo');
NumberofVideos = Videos.videos.length;
//console.log(Videos.videos);
for (var i = 0; i < NumberofVideos; i++) {
    var option = document.createElement("option");
    if (CurrentVideoId != Videos.videos[i].Id) {
        option.value = Videos.videos[i].Id;
        option.text = Videos.videos[i].name;
        selectElement.add(option);
    }
}


function CheckHotspotType() {
    var HotspotType = document.getElementById('HotspotType').value;
    var ContentType = document.getElementById('ContentTypeCont');
    var FileUpload = document.getElementById('FileUploadCont');
    var TextContent = document.getElementById('TextContentCont');
    var HotspotTo = document.getElementById('HotspotToCont');

    if (HotspotType == 'content') {
        ContentType.style.display = '';
        //FileUpload.style.display = '';
        //HotpostFrom.style.display = 'none';
        HotspotTo.style.display = 'none';
    } else if (HotspotType == 'location') {
        ContentType.style.display = 'none';
        //FileUpload.style.display = 'none';
        //HotpostFrom.style.display = '';
        HotspotTo.style.display = '';
        FileUpload.style.display = 'none';
        TextContent.style.display = 'none';
    }
}

function CheckContentType() {
    var HotspotType = document.getElementById('HotspotType').value;
    var ContentType = document.getElementById('ContentType').value;
    var FileUpload = document.getElementById('FileUploadCont');
    var TextContent = document.getElementById('TextContentCont');
    if (ContentType == 'text' && HotspotType == 'content') {
        FileUpload.style.display = 'none';
        TextContent.style.display = '';
    } else if (ContentType == 'video' || ContentType == 'image' && HotspotType == 'content') {
        FileUpload.style.display = '';
        TextContent.style.display = 'none';
    }
}

function UpdateDataVR(data, type) {
    document.getElementById('formFile').value = data
    document.getElementById('changeModel').style.display = 'none';
    document.getElementById("filebrowser").innerText = "";
}

document.getElementById('fileSelectBtn').addEventListener('click', function() {
    document.getElementById('changeModel').style.display = 'block';
})
document.getElementById('changePopupClose').addEventListener('click', function() {
    document.getElementById('changeModel').style.display = 'none';
    document.getElementById("filebrowser").innerText = "";
});
document.getElementById('closeChangeViewModelUpdate').addEventListener('click', function() {
    document.getElementById("changeViewModelUpdate").style.display = 'none';
});
</script>

</html>
