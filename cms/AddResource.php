<?php
include_once('security.php');
?>
<?php

include_once('config.php');
include_once('jwt.php');

$url = $apiBaseUrl.'cms/showAllResource.php';
$status=1;
$postData = array(&$status);

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true);
$respData = $response['resources'];

$serviceArray = array();
$sectorArray = array();
for($i=0;$i<count($respData);$i++)
{
  if($respData[$i]['ResourceType'] == 'service')
  {
    $serviceArray[]=$respData[$i];
  }
  else if($respData[$i]['ResourceType'] == 'sector')
  {
    $sectorArray[]=$respData[$i];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Resource Add</title>
     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>
    

	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->	

</head>
<!--Added by shubham  - 26/08-->
<style>
.del-image1:hover~.tooltiptext {
        Display: block;

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



<body class="body-bg">
    <script>
    $(document).ready(function() {

        // search button click
        $("#textbtn").click(function() {
            let fieldSelect = $('#changeField').val();



            var request = $.ajax({
                type: "POST",
                url: "resourceSearch.php",
                data: {
                    Tags: $("#filetag").val(),
                    fieldSelect
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
    <div class="container-lg">
        <div class="welcome-screen">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='muralResources.php';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-top:20px;margin-left:55px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    Style="margin-top:5px;">
                    <span class="welcome resource">Add Resource <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';"></span>
                </div>
            </div>
            <form action="saveResource.php" method="post" class="resource-form">
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row  type-select">
                            <div class="col-4">
							<!--Added by shubham 26/08 - Start -->
								<img class="del-image1" src="assets/Info button.png" alt="welcome-text" style="padding-right:2%">
								<span class="tooltiptext" style="bottom:60%">Please upload only 'label' image, if choosing resource type as 'Service'.</span>
							<!--Added by shubham 26/08 - End -->
                                <label> Resource Type:</label>
                            </div>
                            <div class="col-8">
                                <select name="ResourceType" class="form-select" aria-label="Default select example">
                                    <option value="" selected="true" disabled>Please select one</option>
                                    <option value="service">Service</option>
                                    <option value="sector">Sector</option>
                                </select>
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-4">
                                <label> Resource Name:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="ResourceName" class="form-control" placeholder = "Add resource name">
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-4">
							<!--Added by shubham 26/08 - Start -->
								<img class="del-image1" src="assets/Info button.png" alt="welcome-text">
								<span class="tooltiptext">Max file size is 348x102. Allowed file types are png, jpg and jpeg.</span>
							<!--Added by shubham 26/08 - End -->
                                <label> Resource Label:</label>
                            </div>
                            <div class="col-4">
                                <span id="resourceLabel" class="span-text"></span>
                                <input type="hidden" name="resourceLabel" id="resourceLabelInput">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary viewBtn select-btn" type="button" id="change" onclick="selectFile('Resource Label',
                                    'label')">Select Label</button>
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-4">
							<!--Added by shubham 26/08 - Start -->
								<img class="del-image1" src="assets/Info button.png" alt="welcome-text">
								<span class="tooltiptext" style="bottom:30%">Max file dimension is 99x99. Allowed file types are png, jpg and jpeg.</span>
							<!--Added by shubham 26/08 - End -->
                                <label> Resource Icon:</label>
                            </div>
                            <div class="col-4">
                                <span class="span-text" id="resourceIcon"></span>
                                <input type="hidden" name="resourceIcon" id="resourceIconInput">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-primary viewBtn select-btn" type="button" id="change"
                                    onclick="selectFile('Resource Icon','icon')">Select Icon</button>
                            </div>
                        </div>
                        <div class=" row type-select">
                            <div class="col-12 text-center" Style="margin-top:100px;">
                                <button type="submit" class="btn btn-primary viewBtn">Save</button>
                            </div>

                        </div>


                    </div>
                </div>
            </form>

        </div>
        <div id="changeModel" class="modal">

            <!-- Modal content -->
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">



                        <div id="videoTitle">

                        </div>


                        <span class="close" id="changePopupClose">×</span>
                    </div>
                    <div class="modal-body changePopup">
                        <div class="example" style="margin:auto;">
                            <input type="hidden" name="field" id="changeField">
                            <input type="text" name="filetag" id="filetag" placeholder="Search..">
                            <button type="submit" name="textbtn" id="textbtn"><img src="assets/search.png"
                                width="20px" /></button>
                        </div>
                        <div id="filebrowser">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="changeViewModelUpdate" class="modal">
            <div class="modal-dialog modal-xl">
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

    </div>
	<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
    <script src="footer.js"></script>
    <script>
    function selectFile(type, data) {
        document.getElementById("videoTitle").innerText = type;
        document.getElementById("changeModel").style.display = "block";
        document.getElementById("changeField").value = data;
    }

    function showDataResourceModel(data, type) {
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
    document
        .getElementById("closeChangeViewModelUpdate")
        .addEventListener("click", function() {
            document.getElementById("changeViewModelUpdate").style.display = "none";
        });


    function UpdateDataResource(data, fileName, field) {
        let filename = data.substring(data.lastIndexOf("/") + 1);
        filename = filename.length > 16 ? filename = filename.substring(0, 16) + "..." : filename = filename;

        if (field === "label") {
            document.getElementById("resourceLabelInput").value = data
            document.getElementById("resourceLabel").innerText = filename;

        } else {
            document.getElementById("resourceIconInput").value = data
            document.getElementById("resourceIcon").innerText = filename;
        }
        document.getElementById("changeModel").style.display = "none";
        document.getElementById("filebrowser").innerHTML = "";
        document.getElementById("filetag").value = ""

    }
    document.getElementById("changePopupClose").addEventListener("click", function() {
        document.getElementById("changeModel").style.display = "none";
        document.getElementById("filebrowser").innerHTML = "";
        document.getElementById("filetag").value = ""
    });
    </script>

</body>

</html>
