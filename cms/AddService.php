<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="./style1.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />-->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Add Content</title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
    <script src="assets/js/jquery-3.6.0.js"></script>
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
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
    font size: bold;
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
    <div class="container-lg addServiceContainer">
        <div class="addKaleidoscope">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1"><br>
                    <span class="arrow-left-image"
                        onclick="location.href='TTServicesContent.php?ServiceId=<?= $_GET['id'];?>&Name=<?= $_GET['serviceName'];?>'">

                        <img src=" assets/login.png" Style="cursor: pointer;margin-top:20px;margin-left:55px;"
                            alt="login" /></span>

                </div>
                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-10 common-welcome-color welcome-screen-font"
                    style="margin-top:25px;" onclick="location.href='select_template.php';">
                    <span class="welcome">Add Content
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';">
                    </span>
                </div>

            </div>

        </div><br><br>
        <form action="saveService.php" method="post">
            <div class="row justify-content-md-center mt-4">
                <div class="col-lg-3 col-3 font-size-31">Content Type :</div>
                <div class="col-lg-7 col-7">
                    <select class=" form-select" name="contentType" aria-label="Default select example"
                        onchange="selectFile()" id="select_id">
                        <option value="Text">Text</option>
                       <!--Added by shubham 30/08-->
                        <!--<option value="Image">Image</option>-->
                        <option value="PDF">Pdf</option>
                        <option value="Video">Video</option>
                    </select>
                </div>
            </div>
			<!--Added by shubham 30/08 - START -->
			<div class="row justify-content-md-center mt-4" id="displayname-content">
                <div class=" col-lg-3 col-3 font-size-31">Display name :</div>
                <div class="col-lg-7 col-7">
                    <!-- <input type="text" class="form-control" placeholder="text" name="Data"> -->
                    <input class="form-control" placeholder="File name to be shown on thumbnail.." name="DisplayName">
                </div>
            </div>
			<!--Added by shubham 30/08 - END -->
            <div class="row justify-content-md-center mt-4" id="text-content">
                <div class=" col-lg-3 col-3 font-size-31">Enter Text :</div>
                <div class="col-lg-7 col-7">
                    <!-- <input type="text" class="form-control" placeholder="text" name="Data"> -->
                    <textarea class="form-control" placeholder="text" name="Data"></textarea>
                </div>
            </div>

            <div class="row justify-content-md-center mt-4" id="media-content">
                <div class="col-lg-3 col-3 font-size-31 " id="search-content">Search :</div>
                <div class="col-lg-7 col-7">
                    <div class="d-flex">
                        <input type="text" name="file" id="fileTag" class="form-control" placeholder="Search..">
                        <button type="button" name="search" id="searchBtn"><img src="assets/search.png"
                                width="20px" /></button>

                    </div>
					<div class="d-flex" id="selected-file">
					</div>
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

                <input type="hidden" name="FilePath" id="FilePath">
                <input type="hidden" name="FileType" id="FileType">
                <input type="hidden" name="serviceID" value="<?php echo $_GET['id']; ?>">
                <input type="hidden" name="serviceName" value="<?php echo $_GET['serviceName']; ?>">
                <button class="btn" type="submit" id="saveKaleidoscope">Save</button>

            </div>



    </div>
    <script src="footer.js"></script>
    <script>
    document
        .getElementById("closeChangeViewModelUpdate")
        .addEventListener("click", function() {
            document.getElementById("changeViewKaleidoscope").innerHTML = "";

            document.getElementById("changeViewModelUpdate").style.display = "none";
        });

    function showService(data, type) {
        console.log("data", data)
        let filename = data.substring(data.lastIndexOf("/") + 1);
        document.getElementById("modal-title").innerText = filename;
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
        console.log("html", html)
        document.getElementById("changeViewKaleidoscope").innerHTML = html;
        document.getElementById("changeViewModelUpdate").style.display = "block";
    }

    function updateService(data, type) {
		let filename=data.substring(data.lastIndexOf('/')+1)
        document.getElementById("FilePath").value = data;
        document.getElementById("FileType").value = type;
        document.getElementById("fileBrowser-service").innerHTML = "";
        let file=document.getElementById("selected-file")
		file.innerHTML=`<span>${decodeURI(filename)}</span>`
		document.getElementById("media-content-info").style.display="block";
		
    }

    function selectFile() {
        let x = document.getElementById("select_id").value;
        console.log("x", x)


          if (x == "Text") {
            document.getElementById("text-content").style.display = "flex"
            document.getElementById("media-content").style.display = "none"
			//Added by shubham - 30/08
			document.getElementById("displayname-content").style.display = "none"
        } else {
            document.getElementById("text-content").style.display = "none"
            document.getElementById("media-content").style.display = "flex"
			//Added by shubham - 30/08
			document.getElementById("displayname-content").style.display = "flex"

        }
        document.getElementById("fileBrowser-service").innerHTML = ""

    }
    </script>

</body>

</html>