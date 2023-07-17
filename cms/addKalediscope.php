<?php
include_once('security.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="./style1.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Kaleidoscope</title>
    <script src="assets/js/jquery-3.6.0.js"></script>

	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
    <script>
    $(document).ready(function() {
        $("#searchBtn").click(function() {
            let search = $("#fileTag").val();
            console.log(search);

            let request = $.ajax({
                type: "POST",
                url: "kalediscopeSearch.php",
                data: {
                    Tags: search
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
<style>
/*Added by shubham - 30/08*/
.del-image1:hover~.tooltiptext {
        Display: block;
    }

.del-image1{
	float:left;
}	
	
.btn {
    height: 50px;
    width: 150px;
    background-color: #00338d;
    border-radius: 10px;
    border: none;
    color: white;
    font-size: 20px;
    top: 500px;
    cursor: pointer
}

.btn:hover {
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor: pointer;
    transition: 0.1s;
}

.content-search {}
</style>

<body class="body-bg">
		    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container-lg addKaleidoscopeContainer">
        <div class="addKaleidoscope">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='kalediscope.php';">
                        <img src="assets/login.png" Style="cursor: pointer;margin-top:20px;margin-left:35px;"
                            alt="login" /></span>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-12 common-welcome-color welcome-screen-font"
                    onclick="location.href='select_template.php';">
                    <span class="welcome">Add Kaleidoscope
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;" onclick="location.href='index.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;"
                            onclick="location.href='login.php';">

                    </span>
                </div>
            </div>

        </div>
		 
        <div class="content-search">
			<!--Added by shubham 26/08 - Start -->
				<img class="del-image1" src="assets/Info button.png" alt="welcome-text">
				<span class="tooltiptext" style="bottom:60%">Only mp4 file type is allowed.</span>
			<!--Added by shubham 26/08 - End -->
            <input type="text" name="file" id="fileTag" class="searchInput" placeholder="Search..">
            <button type="submit" name="search" id="searchBtn">
			<img src="assets/search.png" width="20px" />
			</button>
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
        <div class="save-kaleidoscope">
            <form action="saveKalediscope.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="FilePath" id="FilePath">
                <input type="hidden" name="FileType" id="FileType">
                <input type="hidden" name="Order" value="<?php echo $_GET['order'] ?>">
                <button class="btn" type="submit" id="saveKaleidoscope">Save</button>
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
    document
        .getElementById("closeChangeViewModelUpdate")
        .addEventListener("click", function() {
            console.log("aaaa");
            document.getElementById("changeViewModelUpdate").style.display = "none";
        });

    function showKaleidoscope(data, type) {
        console.log("data", data)
        let filename = data.substring(data.lastIndexOf("/") + 1);
        document.getElementById("modal-title").innerText = filename;
        let html = "";
        if (type == "image") {
            html = "<img src='" + data + "' alt='image' class='img-fluid'>";
        } else if (type == "video") {
            html =
                "<video controls id='video-src'><source src='" +
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

    function updateKaleidoscope(data, type) {
        document.getElementById("FilePath").value = data;
        document.getElementById("FileType").value = type;

    }
    </script>

</body>

</html>