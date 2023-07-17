<?php
include_once('security.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="./style1.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Add useCases</title>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
    <script src="assets/js/jquery-3.6.0.js"></script>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	<style>
	
	/*Added by shubham - 30/08*/
    .del-image1:hover~.tooltiptext {
        Display: block;

    }
	.del-image1{
		float:left;
	}
	</style>
    <script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            let search = $("#fileTag").val();
            console.log(search);

            let request = $.ajax({
                type: "POST",
                url: "kalediscopeSearch.php",
                data: {
                    Tags: search,
                    type: "usecase"
                },
                dataType: "html"
            });

            request.done(function(msg) {
                $('#fileBrowser').html(msg);
            });

            request.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });


        });
    });
    </script>
</head>

<body class="body-bg">
		    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container-lg addKaleidoscopeContainer">
        <div class="addusecase">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image"
                        onclick="location.href='usecase.php?hotspotId=<?= $_GET['id']; ?>&resourceId=<?= $_GET['resourceId']; ?>'">
                        <img src="assets/login.png" alt="login" style="padding-top:20px;cursor:pointer;"
                            onclick="location.href='usecase.php';" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome">Add Usecases
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';">
                    </span>
                </div>
            </div>

        </div>
        <div class="content-search">
		<!--Added by shubham 26/08 - Start -->
				<img class="del-image1" src="assets/Info button.png" alt="welcome-text">
				<span class="tooltiptext" style="bottom:60%">Allowed file types are pdf, mp4, png and jpeg.</span>
			<!--Added by shubham 26/08 - End -->
            <input type="text" name="file" id="fileTag" class="searchInput" placeholder="Search..">
            <button type="submit" name="search" id="searchBtn"><img src="assets/search.png" width="20px" /></button>
        </div>
        <div id="fileBrowser">

        </div>
        <div id="changeViewModelUpdate" class="modal">
            <div class="modal-dialog modal-xl">
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

        </div>
        <div class="save-usecase">
            <form action="saveUsecase.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="FilePath" id="FilePath">
                <input type="hidden" name="FileType" id="FileType">
                <input type="hidden" name="hotspotid" value=<?=$_GET['id'] ?>>
                <input type="hidden" name="resourceId" value=<?=$_GET['resourceId'] ?>>

                <button class="btn btn-primary" type="submit" id="saveKaleidoscope">Save</button>
            </form>
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
    function showKaleidoscope(data, type) {
        let html = "";
        if (type == "image") {
            html = "<img src='" + data + "' alt='image' class='img-fluid'>";
        } else if (type == "video") {
            html =
                "<video controls width='300' id='video-src'><source src='" +
                data +
                "' type='video/mp4'></video>";
        } else if (type == "pdf") {
            html = `<iframe   src="${data}">`;
        } else if (type == "text") {
            html = `<h3 class="modal-text"> ${data}</h3>`;
        } else {
            html = "<span>Preview is not available</span>";
        }
        document.getElementById("changeViewKaleidoscope").innerHTML = html;
        document.getElementById("changeViewModelUpdate").style.display = "block";
    }

    function updateKaleidoscope(data, type) {
        document.getElementById("FilePath").value = data;
        document.getElementById("FileType").value = type;

    }
    document.getElementById("closeChangeViewModelUpdate").addEventListener("click", function() {
        document.getElementById("changeViewModelUpdate").style.display = "none";
    });
    </script>

</body>

</html>