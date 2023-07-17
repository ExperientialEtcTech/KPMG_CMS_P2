<?php
 include_once('security.php');
include_once('config.php');
include_once('jwt.php');
 include_once('security.php');

if(isset($_GET['VideoId']) && $_GET['VideoId'] != "" && isset($_GET['Id']) && $_GET['Id'] != ""){
	//echo $_GET['VideoId'];
	$HotspotId = $_GET['HotspotId'];
	$postData = array("ServiceVideoId"=>&$_GET['VideoId']);
	$url = $apiBaseUrl.'cms/VRshowHotspot.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

	if($_GET['HotspotType'] == 'location'){
		$response = json_decode($jsonResponse,true)['hotspot']["LocationHotspot"];
		//print_r($response);
		foreach($response as $arr){
			if($arr['Id'] == $HotspotId){
				//print_r($arr[hotspotTo]);
				$hotspotTo = $arr["hotspotTo"];
				$name = $arr["name"];
				$pos = $arr["position"];
				$rot = $arr["rotation"];
				
				//declaring var with no vals
				$ContentType =  "";
				$Content =  "";
			}
		}
	}elseif($_GET['HotspotType'] == 'content'){
		$response = json_decode($jsonResponse,true)['hotspot']["ContentHotspot"];
		//print_r($response);
		foreach($response as $arr){
			if($arr["Id"] == $HotspotId){
				//print_r($arr[type]);
				$ContentType = $arr["type"];
				$Content = $arr["content"];
				$pos = $arr["position"];
				$rot = $arr["rotation"];
				
				//declaring var with no vals
				$hotspotTo = "";
				$name = "";
			}
		}

	}
	
}
else{
	header("location: VRServices.php");
}



if(isset($_POST['Save']) && isset($_POST['PosX']) && $_POST['PosX'] != "" && isset($_POST['PosY']) && $_POST['PosY'] != "" && isset($_POST['PosZ']) && $_POST['PosZ'] != "" && isset($_POST['RotX']) && $_POST['RotX'] != "" && isset($_POST['RotY']) && $_POST['RotY'] != "" && isset($_POST['RotZ']) && $_POST['RotZ'] != "" ){

	if(isset($_POST['ContentType']) && $_POST['ContentType'] != ""){
		$ContentType = $_POST['ContentType'];
        if($_POST['ContentType']!=="text" && isset($_POST['video']) && $_POST['video']!== ""){
            $Content = $_POST['video'];
        }
        else if( $_POST['ContentType']=="text" && isset($_POST['TextContent']) &&  $_POST['TextContent'] !== ""){
		
            $Content = $_POST['TextContent'];
        }
	}
	
	//print_r("IN");
	$postData1 = array("Id"=>$HotspotId, "HotspotFrom" =>$_GET['VideoId'], "HotspotTo" =>$hotspotTo, "HotspotType" =>$_GET['HotspotType'], "PosX"=> $_POST['PosX'], "PosY"=> $_POST['PosY'], "PosZ"=> $_POST['PosZ'], "RotX"=> $_POST['RotX'], "RotY"=> $_POST['RotY'], "RotZ"=> $_POST['RotZ'], "Content"=>&$Content, "ContentType"=>$ContentType);
	$url1 = $apiBaseUrl.'cms/VReditHotspot.php';
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || File Upload</title>
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
    <link rel="stylesheet" href="./style1.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">-->
	<script src="assets/js/jquery-3.6.0.js"></script>
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
    cursor: pointer;
    transition: 0.1s;
    }
    </style>

<body>
    <script>
    $(document).ready(function() {

        $("#textbtn").click(function() {
            let fieldSelect = $("#ContentType").val();
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
            <h1>Edit Hotspot
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                    onclick="location.href='index.php';">  
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';">   </div> </div>
            </h1>
        </div>

        <!--<form action="VREditHotspot.php" method="post" id="form">-->
        <form action="" method="post" id="form">
            <div class="file-upload-container">
                <div class="container-fluid"><br>

                    <div id="HotspotToCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Hotspot To
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <h3 class="label"><?php echo $name; ?></h3>
                        </div>
                    </div>
                    <div id="ContentTypeCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Content Type
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <select name="ContentType" value="<?php echo  $ContentType; ?>" id="ContentType"
                                onchange="CheckContentType()" class="form-control">
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
                            <input name="TextContent" class="text-box" type="text" placeholder="Enter Text Content"
                                value="<?php echo  $Content; ?>">
                        </div>
                    </div>
                    <div id="FileUploadCont" class="row mb-5" style="display:none;">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                File:
                            </label>
                            <div id = "FileNameShow"class="filename-extension">
                                File name
                            </div>
                        </div>
                        <div class="col-sm-8 d-flex">
                            <div class="form-control-file-container">
                                <input class="form-control" type="hidden" name="video" id="formFile"
                                    placeholder="Select file">
                                <button class="btn-custom-small" type="button" id="fileSelectBtn">Select
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
                            <input name="PosX" class="text-box text-center" type="text"
                                placeholder="x : <?php echo $pos['x']; ?>" value="<?php echo $pos["x"]; ?>">
                            <input name="PosY" class="text-box text-center mx-5" type="text"
                                placeholder="y : <?php echo $pos['y']; ?>" value="<?php echo $pos["y"]; ?>">
                            <input name="PosZ" class="text-box text-center" type="text"
                                placeholder="z : <?php echo $pos['z']; ?>" value="<?php echo $pos["z"]; ?>">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
                                Rotation <br />Co-ordinates
                            </label>
                        </div>
                        <div class="col-sm-8 d-flex align-items-center">
                            <input name="RotX" class="text-box text-center" type="text"
                                placeholder="x : <?php echo $rot["x"]; ?>" value="<?php echo $rot["x"]; ?>">
                            <input name="RotY" class="text-box text-center mx-5" type="text"
                                placeholder="y : <?php echo $rot["y"]; ?>" value="<?php echo $rot["y"]; ?>">
                            <input name="RotZ" class="text-box text-center" type="text"
                                placeholder="z : <?php echo $rot["z"]; ?>" value="<?php echo $rot["z"]; ?>">
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-8 offset-sm-4">
                        <button name="Save" class="btn-custom-small">
							<input type="hidden" name="Id" id="Id">
							<input type="hidden" name="VideoId" id="VideoId">
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
                        <button type="submit" name="textbtn" id="textbtn"><img src="assets/search.png"
                                width="20px" /></button>
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
	<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
    <script src="footer.js"></script>
    <script>
    var HotspotType = '<?php echo $_GET['HotspotType']; ?>';
    var ContentType = document.getElementById('ContentTypeCont');
    var FileUpload = document.getElementById('FileUploadCont');
    var HotspotTo = document.getElementById('HotspotToCont');
    //console.log(HotspotType);
    if (HotspotType == 'content') {
        ContentType.style.display = '';
        FileUpload.style.display = '';
        //HotpostFrom.style.display = 'none';
        HotspotTo.style.display = 'none';
    } else if (HotspotType == 'location') {
        ContentType.style.display = 'none';
        FileUpload.style.display = 'none';
        //HotpostFrom.style.display = '';
        HotspotTo.style.display = '';
    }

    var ContentTypeAPI = '<?php echo $ContentType; ?>';
    document.getElementById('ContentType').value = ContentTypeAPI;
    CheckContentType();
    //console.log(ContentTypeAPI);


    function CheckContentType() {
        var ContentType = document.getElementById('ContentType').value;
        var FileUpload = document.getElementById('FileUploadCont');
        var TextContent = document.getElementById('TextContentCont');
        console.log(ContentType);
        if (ContentType == 'text') {
            FileUpload.style.display = 'none';
            TextContent.style.display = '';
        } else if (ContentType == 'video' || ContentType == 'image') {
            FileUpload.style.display = '';
            TextContent.style.display = 'none';
        }
    }
    document.getElementById('fileSelectBtn').addEventListener('click', function() {
        document.getElementById('changeModel').style.display = 'block';
        document.getElementById('filetag').value = '';
    })
    document.getElementById('changePopupClose').addEventListener('click', function() {
        document.getElementById('changeModel').style.display = 'none';
        document.getElementById('filetag').value = '';
    })

    function UpdateDataVR(data, type) {
        document.getElementById('formFile').value = data
        document.getElementById('changeModel').style.display = 'none';
        document.getElementById("filebrowser").innerText = "";
        document.getElementById('filetag').value = '';
		
		const arr_file = data.split('/');
		document.getElementById('FileNameShow').innerText = decodeURI(arr_file[arr_file.length - 1]);
		console.log(arr_file[arr_file.length - 1]);
    }

    function showDataModel(url, type) {
        let filename = data.substring(data.lastIndexOf("/") + 1);
        document.getElementById("fileName").innerText = filename;
        let html = "";
        if (type == "image") {
            html = "<img src='" + data + "' alt='image' class='img-fluid'>";
        } else if (type == "video") {
            html =
                "<video controls ><source src='" + data + "' type='video/mp4'></video>";
        } else if (type == "pdf") {
            html = `<iframe   src="${data}">`;
        } else {
            html = "<span>Preview is not available</span>";
        }
        document.getElementById("changeViewBody").innerHTML = html;
        document.getElementById("changeViewModelUpdate").style.display = "block";
    }
    document.getElementById('closeChangeViewModelUpdate').addEventListener('click', function() {
        document.getElementById("changeViewModelUpdate").style.display = 'none';
    });
    </script>

</body>

</html>