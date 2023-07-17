<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

$Type=$_GET['Type'];
$contentId=$_GET['contentId'];
$serviceName=$_GET['serviceName'];
$ServiceId=$_GET['ServiceId'];
$DataText="";
$DataContent = "";
$DisplayName ="";
$postData = array("ServiceId"=>&$ServiceId);
$url = $apiBaseUrl.'cms/TtServicesContentsShow.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
$response = json_decode($jsonResponse,true)['contents'];
//print_r($response);
for ($i=0; $i <count($response) ; $i++) { 
    if($contentId == $response[$i]['Id']){
		//Added by shubham - 01/09
		$Datatype = $response[$i]['Type'];
		if($Datatype === 'Text'){
			$DataText = $response[$i]['Data'];
		}else{
			$DataContent = $response[$i]['Data'];
		}
			//Added by shubham - 30/08
		$DisplayName = $response[$i]['DisplayName'];
        break;
	}
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="./style1.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Edit Service</title>
       <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
	<style>
	</style>
	<script src="assets/js/jquery-3.6.0.js"></script>
    <script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            let fieldSelect = $('#select_id').val();
            let showVideo = "false",
                showImage = "false",
                showPdf = "false"

            if (fieldSelect === "Video") {

                showVideo = "true"

            } else if (fieldSelect === "Image") {

                showImage = "true"

            } else if (fieldSelect === "PDF") {
                showPdf = "true"
            }

            let search = $("#fileTag").val();
            let request = $.ajax({
                type: "POST",
                url: "serviceSearch.php",
                data: {
                    Tags: search,
                    showVideo,
                    showImage,
                    showPdf
                },
                dataType: "html"
            });

            request.done(function(msg) {
                $('#fileBrowser-service').html(msg);
            });

            request.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });


        });
    });
    </script>

</head>
<style>
.btn {
    height: 50px;
    width: 150px;
    background-color: #00338d;
    border-radius: 10px;
    font-size: bold;
    border: none;
    color: white;
    cursor: pointer;
    margin: 0 auto;
    /*Removed by shubham - 12/08*/
    /*position: absolute;*/
    bottom: 50px;
}

.btn:hover {
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor: pointer;
    transition: 0.1s;
}
/*Added by shubham - 30/08 */
#displayname-content{
	display: none;
	}
</style>

<body class="body-bg">
	<!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
     <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container addServiceContainer">
        <div class="addKaleidoscope">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-2">
                    <span class="arrow-left-image"
                        onclick="location.href='TTServicesContent.php?ServiceId=<?= $_GET['ServiceId']?>&Name=<?= $_GET['serviceName']?>'">
                        <img src="assets/login.png" Style="cursor: pointer;margin-top:60px;margin-left:50px;"
                            alt="login" /></span>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-8 common-welcome-color welcome-screen-font"
                    style="margin-top:40px;" onclick="location.href='select_template.php';">
                    <span class="welcome" Style="cursor: pointer;">Edit Service
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';">
                    </span>
                </div>

            </div>

        </div><br><br>
        <form action="updateService.php" method="post">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-3 col-12 font-size-31">Content Type :</div>
                <div class="col-lg-7 col-12">
                    <select class=" form-select" name="contentType" aria-label="Default select example"
                        onchange="selectFile()" id="select_id">
                        <option value="Text" <?= $Type=="Text"?"selected":""?>>Text</option>
						<!--Added by shubham 30/08-->
                        <!--<option value="Image" <?= $Type=="Image"?"selected":""?>>Image</option>-->
						<!--Added by shubham 01/09-->
                        <!--<option value="PDF" <?= $Type=="Pdf" ||$Type=="PDF"?"selected":""?>>Pdf</option>-->
						<option value="PDF" <?= $Type=="Pdf" ||$Type=="PDF"?"selected":""?>>Pdf</option>
                        <option value="Video" <?= $Type=="Video"?"selected":""?>>Video</option>
                    </select>
                </div>
            </div>

			<!-- Added by shubham 30/08 - START-->
			<div class="row justify-content-center mt-4" id="displayname-content">
                <div class=" col-lg-3 col-12 font-size-31" style="padding-top:20px;">Display Name :</div>
                <div class="col-lg-7 col-12">
                    <input class="form-control" placeholder = "File name to be shown on thumbnail.." onfocus = "this.placeholder = ''" 
						onblur = "this.placeholder = 'File name to be shown on thumbnail..'" value = "<?php echo $DisplayName;?>" name="DisplayName" style="height:100px;width:640px;color:gray">
                </div>
            </div>
			<!--Added by shubham 30/08 - END-->
            <div class="row justify-content-center mt-4" id="text-content">
                <div class=" col-lg-3 col-12 font-size-31" style="padding-top:20px;">Enter Text :</div>
                <div class="col-lg-7 col-12">
                    <textarea class="form-control" placeholder="" name="Data"
                        style="height:100px;width:640px;color:gray"><?php echo $DataText;?></textarea>
                </div>
            </div>

            <div class=" row justify-content-center mt-4" id="media-content">
                <div class="col-lg-3 col-12 font-size-31 " id="search-content">Search :</div>
                <div class="col-lg-7 col-12">
                    <div class="d-flex">
                        <input type="text" name="file" id="fileTag" class="form-control" placeholder="Search..">
                        <button type="button" name="search" id="searchBtn"><img src="assets/search.png"
                                width="20px" /></button>
						<!--Adde by Shubham - 26/08-->
						<!--<span><?php echo $DataContent;?></span>-->
                    </div>
					<div id="selected-file"></div>
                    <div id="fileBrowser-service">

                    </div>
                </div>
            </div>



            <div id="changeViewModelUpdate" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modal-title"></h2>
                        <span class="close" id="closeChangeViewModelUpdate">&times;</span>
                    </div>
                    <div class="modal-body" id="changeViewKaleidoscope">

                    </div>

                </div>

            </div>
            <div class="save-kaleidoscope">
				<!--Added by shubham - 01/09-->		
				<!--<input type="hidden" name="FilePath" id="FilePath">-->
                <input type="hidden" name="FilePath" id="FilePath" value="<?php echo $DataContent; ?>">
                <input type="hidden" name="FileType" id="FileType">
                <input type="hidden" name="serviceID" value="<?php echo $_GET['ServiceId']; ?>">
                <input type="hidden" name="contentId" value="<?php echo $_GET['contentId']; ?>">
                <input type="hidden" name="serviceName" value="<?php echo $_GET['serviceName']; ?>">
                <button class="btn btn-primary" type="submit" id="saveKaleidoscope">Save</button>

            </div>


	</form>
    </div>
	 <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
    <div style="margin:25px;font-size:0.9vw;bottom:-50px;position:absolute">
        <!--&copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>-->
		&copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
    <script src="footer.js"></script>
    <script>
    let x = "<?=  $Type; ?>";




    if (x == "Text") {
        document.getElementById("text-content").style.display = "flex"
        document.getElementById("media-content").style.display = "none"
    } else {
        document.getElementById("text-content").style.display = "none"
        document.getElementById("media-content").style.display = "flex"

    }
    document.getElementById("fileBrowser-service").innerHTML = ""
    document
        .getElementById("closeChangeViewModelUpdate")
        .addEventListener("click", function() {
            document.getElementById("changeViewModelUpdate").style.display = "none";
        });

    function showService(data, type) {

        let filename = data.substring(data.lastIndexOf("/") + 1);
        document.getElementById("modal-title").innerText = filename;
        let html = "";
        if (type == "image") {
            html = "<img src='" + data + "' alt='image' class='img-fluid'>";
        } else if (type == "video") {
            html =
                "<video controls id='video-src' width='300'><source src='" +
                data +
                "' type='video/mp4'></video>";
        } else if (type == "pdf") {
            html = `<iframe   src="${data}">`;
        } else if (type == "text") {
            html = `<h3 class="modal-text"> ${data}</h3>`;
        } else {
            html = "<span>Preview is not available</span>";
        }
        console.log("html", html)
        document.getElementById("changeViewKaleidoscope").innerHTML = html;
        document.getElementById("changeViewModelUpdate").style.display = "block";
    }

    function updateService(data, type) {
        document.getElementById("FilePath").value = data;
        document.getElementById("FileType").value = type;
        document.getElementById("fileBrowser-service").innerHTML = "";
		const myArray=data.split("/");
        document.getElementById("selected-file").innerText = decodeURIComponent(myArray[myArray.length-1]);

    }

    function selectFile() {
        let x = document.getElementById("select_id").value;

        console.log(x)

        if (x == "Text") {
            document.getElementById("text-content").style.display = "flex"
            document.getElementById("media-content").style.display = "none"
			//Added by shubham - 30/08
			document.getElementById("displayname-content").style.display = "none"
			console.log('none');
        } else {
            document.getElementById("text-content").style.display = "none"
            document.getElementById("media-content").style.display = "flex"
			//Added by shubham - 30/08
			document.getElementById("displayname-content").style.display = "flex"
			console.log(document.getElementById("displayname-content").style.display);

        }
        document.getElementById("fileBrowser-service").innerHTML = ""

    }
    let selectData = document.getElementById("select_id").value;
    if (selectData == "Text") {
        document.getElementById("text-content").style.display = "flex"
        document.getElementById("media-content").style.display = "none"
		//Added by shubham - 30/08
			document.getElementById("displayname-content").style.display = "none"
			console.log('none');
		
    } else {
        document.getElementById("text-content").style.display = "none"
        document.getElementById("media-content").style.display = "flex"
		//Added by shubham - 30/08
			document.getElementById("displayname-content").style.display = "flex"
			console.log(document.getElementById("displayname-content").style.display);
		
		
    }
    </script>

</body>

</html>