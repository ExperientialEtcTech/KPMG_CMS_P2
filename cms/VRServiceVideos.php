<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	//echo $_GET['Id'];
	$postData = array("ServiceId"=>&$_GET['Id']);
	$url = $apiBaseUrl.'cms/VRshowServiceVideos.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	//$response = json_decode($jsonResponse,true)['text'][0];
	$response = $jsonResponse;
}else{
	header("location: VRServices.php");
}

if(isset($_GET['View']))
{
	header("location: VRHotspotContent.php?Id=".$_POST['VideoId']."");
}

if(isset($_GET['DelId']))
{
    $postData1 = array("ServiceVideoId"=>&$_GET['DelId']);

    $url1 = $apiBaseUrl.'cms/VRdeleteServiceVideo.php';
	//echo ($_POST['Id']);
    $jsonResponse1 = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
   header('Location : VRServiceVideos.php?Id='.$_GET["Id"]);
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
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->

    <title>KPMG</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
</head>
<style>
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

.box-selection {
    height: 50px;
    min-width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    background-color: #00338d;
    border-radius: 10px;
    cursor: pointer;
}

.box-selection1 {
    height: 80px;
    float: right;
    width: 27%;
    top: 60%;
}

.box-selection-text {
    height: 40px;
    width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    background-image: url('assets/Rectangle-80.png');
    background-repeat: no-repeat;
    color: #FFFFFF;
    text-align: left;
    font-size: 25px;
    vertical-align: middle;
    width: 350px;
    background-image: none;
    color: #000000;

}

.vertical-center {
    margin: 0;
    position: relative;
    top: 47%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 17px;
    text-align: center;


}

.vertical-centers {
    margin: 0;
    position: relative;
    top: 80%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    margin-left: 50%;
    color: grey;
    font-size: 25px;
}

.add-button {
    right: 10px;
    bottom: 10px;
    position: fixed;
    cursor: pointer;
}

.video-form {
    max-width: 800px;
    margin: 20px auto 0px auto;
}

.video-form-row {
    display: flex;
    margin-bottom: 10px;
    align-items: center;
    justify-content: center;
}

.video-form-row .box-selection:first-of-type {
    min-width: 300px;
}

.btn-custom-small {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-width: 140px;
    height: 50px;
    color: #fff;
    background: #00338d;
    font-size: 17px;
    text-decoration: none;
    border-radius: 10px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 0px 30px;
}

.btn-custom-small:hover {
    color: white;
    background-color: rgb(105, 199, 211)
        /* background-color: #38b2d7ba !important;
    outline: none;
    border: none;
    color: #f0fff0 !important; */
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
    <!-- <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px"> -->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;top: 70px">

        <form action="VRServiceVideos.php" method="get" id="form">
            <div style="width: 1000px;height:100px;margin:auto;">
                <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor:pointer;"
                    onclick="location.href='VRServices.php';"></div>
                <div
                    style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
                    360 Video
                    <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
                        <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                            onclick="location.href='login.php';"></div>
                    </div>

                    <div class="add-button" id="btnadd"><a
                            href="VRAddServiceVideos.php?ServiceId=<?php echo $_GET['Id']; ?>"><img
                                src="assets/Add Button.png"></a></div>
					</div>
				</div>
        </form>
    </div>

    <div class="modal fade" id="viewVideoModal" tabindex="-1" aria-labelledby="viewVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewVideoModalLabel">360 Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video width="100%" height="500" id="video-src" controls class="video">
                        <source type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:relative">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
	
    <script src="./assets/js/bootstrap.min.js"></script>
	<script src="footer.js"></script>
</body>
<script>
response = JSON.parse('<?php echo $response; ?>');
var formElem = document.getElementById("form");
NumberOfVideos = response.videos.length;
//console.log(NumberOfServices);
if (response.videos.status == 0) {
    formElem.innerHTML += `
		<div class="video-form">
			<div class="video-form-row">
					<h3>No Videos Available</h3>
			</div>
		</div>
		`;
} else {

    VidUrls = [];
    var ModalElem = document.getElementById("video-src");

    function ShowVideo(elem) {
        var ModalElem = document.getElementById("video-src");
        ModalElem.src = VidUrls[elem.id];
        //console.log(ModalElem);
    };
    for (var i = 0; i < response.videos.length; i++) {
        VidUrls.push(response.videos[i].videourl);
        //console.log(VidUrls);
        formElem.innerHTML += `
				<div class="video-form">
					<div class="video-form-row">
						<input name = "Id" style = "display:none;" value = "` + response.videos[i].Id + `" />
						<div class="box-selection">
							<div class="vertical-center" id = "` + i + `" onclick = "ShowVideo(this)" data-bs-toggle="modal" data-bs-target="#viewVideoModal">
								` + response.videos[i].name + `
							</div>
						</div>
						<div class="box-selection">
							<a href="VRHotspotContent.php?Id=<?php echo $_GET['Id']; ?>&VideoId=` + response.videos[i].Id + `" class="btn-custom-small">Hotspot</a>
						</div>
						<div class="box-selection">
							<!--<button class="btn-custom-small">Edit</button>-->
<a href="VREditServiceVideo.php?Id=<?php echo $_GET['Id']; ?>&VideoId=` + response.videos[i].Id + `&name=` + response
            .videos[i].name + `"" class="btn-custom-small">Edit</a>
						</div>
						<div class="box-selection">
								<!--<button class="btn-custom-small" name = "Delete">Delete</button>-->
<a href="VRServiceVideos.php?Id=<?php echo $_GET['Id']; ?>&DelId=` + response.videos[i].Id + `" class="btn-custom-small">Delete</a>
						</div>
					</div>
				</div>
		`
    }
}
//<input name = "VideoId" style = "display:none;" value = "`+response.videos[i].Id+`" />
//<button class="btn-custom-small" name = "Delete"  value = "`+response.videos[i].Id+`">Delete</button>
//ShowVideo = document.getElementsByClassName("ShowVideo");
</script>

</html>
