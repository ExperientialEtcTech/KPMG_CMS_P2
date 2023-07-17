<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

if(isset($_GET['ServiceId']))
{	
    //$postData1 = array("ServiceName"=>&$_POST['name'], "ServiceOrder"=>&$_POST['order']);
    //$url1 = $apiBaseUrl.'cms/VRaddService.php';
	//echo ($_POST['Id']);
    //$jsonResponse = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
}else{
	header("location: http://10.188.7.135/cms/VRServices.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || Add 360 videos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/customstyle.css">

    <link rel="stylesheet" href="./style1.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
    <title>KPMG || welcome Screen</title>


    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
    <script src="assets/js/jquery-3.6.0.js"></script>
	<style>
		/*Added by shubham - 30/08*/
	.del-image1:hover~.tooltiptext {
			Display: block;
		}
body {

    margin: 0px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}
	</style>
    <script>
	
    $(document).ready(function() {

        $("#textbtn").click(function() {
            var request = $.ajax({
                type: "POST",
                url: "vrSearch.php",
                data: {
                    Tags: $("#filetag").val(),
                    showVideo: true,
                    showImage: false,
                    showPdf: false
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

</head>

<body>
		    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <form action="VRaddServiceVideoSave.php" method="post">
        <div class="container add-services">
            <div class="title-bar">
                <a href="javascript: void(0);" class="left-arrow"
                    onclick="location.href='VRServiceVideos.php?Id=<?php echo $_GET['ServiceId']; ?>';">
                    Back
                </a>
                <h1>360 videos
                    <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
                        <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                            onclick="location.href='login.php';">
                        </div>
					</div>
                </h1>
            </div>
            <div class="content-block">
                <div class="text-box-container">
                    <input name="name" type="text" class="text-box" placeholder="Service video name">
						<!--Added by shubham 26/08 - Start -->
					<img class="del-image1" src="assets/Info button.png" alt="welcome-text" style = "float:left;padding-top:5%;">
					<span class="tooltiptext" style="bottom:60%;margin-left:10%">Please use a unique VR Service video name, and also make sure that the video name is same.</span>
				<!--Added by shubham 26/08 - End -->
                </div>


                <input name="video_url" id="video_url" type="hidden" class="text-box" placeholder="Service url">


                <div class="text-box-container">
                    <div id="FileUploadCont" class="row mb-5">
                        <div class="col-sm-4 d-flex align-items-center">
                            <label class="label">
							<!--Added by shubham 26/08 - Start -->
								<img class="del-image1" src="assets/Info button.png" alt="welcome-text">
								<span class="tooltiptext" style="bottom:30%;left:10%">Only mp4 file type is allowed.</span>
							<!--Added by shubham 26/08 - End -->
                                File:
                            </label>
                            <div class="filename-extension" id="filename-extension">
                                File name
                            </div>
                        </div>

                        <div class=" col-sm-8 d-flex">
                            <div class="form-control-file-container">

                                <button class="btn-custom-small" type="button" id="fileSelectBtn" value="Save">Select
                                    File</button>
                            </div>
                        </div>

                    </div>
                </div>
                <input style="display:none;" name="ServiceId" type="text" class="text-box"
                    value="<?php echo $_GET['ServiceId']; ?>" placeholder="Service url">
                <button class="btn-custom" type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>
    <div id="changeModel" class="modal">

        <!-- Modal content -->
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content w-100">
                <div class="modal-header">

                    <div id="videoTitle"
                        style="height:60px;color: #00338D;text-align: center;font-size: 51px;margin:0px auto;">
                        Choose content file

                    </div>
                    <input type="hidden" name="field" id="changeField">
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
    </div>

    <div id="changeViewModel" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">

                <span class="close" id="closeChangeViewModel">&times;</span>
            </div>
            <div class="modal-body">
                <video width="500" height="500" controls class="video" id="video-container">
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
	<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
	
    <script src="footer.js"></script>
    <script>
    function UpdateDataVR(data, type) {
        console.log(data)
        let filename = data.substring(data.lastIndexOf("/") + 1);
        document.getElementById("filename-extension").innerText = filename;

        document.getElementById('video_url').value = data
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
</body>

</html>