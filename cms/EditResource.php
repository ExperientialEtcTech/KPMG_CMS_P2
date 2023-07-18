<?php
include_once('security.php');

include_once('config.php');
include_once('jwt.php');



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
    <title>KPMG || Edit Resource </title>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>


	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
    <script>
    $(document).ready(function() {

        // search button click
        $("#textbtn").click(function() {
            let type = $('#fileType').val();
            var request = $.ajax({
                type: "POST",
                url: "findResource.php",
                data: {
                    Tags: $("#filetag").val(),
                    type: type
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
	/*Added by shubham - 30/08*/
    .del-image1:hover~.tooltiptext {
        Display: block;

    }
	
    button.btn.btn-primary.select-file.data {


        font-size: 18px !important;

        width: 190px !important;
    }
    


    
    .viewBtn {
    
    height: 50px;
    width: 150px;
    background-color: #00338d;
    border-radius: 10px;
    border: none;
    color: white;
    font-size: 20px;
   
    cursor: pointer
}

.viewBtn:hover {
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
</head>




<body class="body-bg edit-service">
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
                            style="cursor:pointer;margin-left:55px;margin-top:20px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    onclick="location.href='login.php';">
                    <span class="welcome resource">Edit Resource
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';">
                    </span>
                </div>
            </div>
            <form action="updateResource.php" method="post" class="resource-form">
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="row  type-select">
                            <div class="col-4">
                                <label> Resource Type:</label>
                            </div>
                            <div class="col-8">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"> <select id="hotspot"
                                    name="ResourceType" class="form-select" aria-label="Default select example">

                                    <option value="service" <?php echo $_GET['type']==='service' ? "selected":"";?>>
                                        Service</option>
                                    <option value="sector" <?php echo $_GET['type']==='sector' ? "selected":"";?>>
                                        Sector</option>
                                </select>
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-4">
                                <label> Resource Name:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" id="serviceOptions" name="ResourceName" class="form-control"
                                    value="<?php echo $_GET['resourceName'];?>">
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
                            <div class="col-3">
                                <label id="label-url">
                                    <?php
                                   
                                     if($_GET['labelUrl']!=""){
                                        $pos=strripos($_GET['labelUrl'],"/")+1;
                                            $finalStr=substr($_GET['labelUrl'],$pos);
                                        $length = strlen($finalStr);
                                        if($length >16 )
                                        {
                                            $icon = substr($finalStr,0,16)."...";
                                        }
                                        else
                                        {
                                            $icon =$finalStr;
                                        }
                                        echo $icon; 
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="col-5" style="text-align: right">
                                <?php   if($_GET['labelUrl']!=""){?>
                                <button class="btn btn-primary select-file data" type="button"
                                    onclick="viewFile('label','<?= $_GET['labelUrl'];?>')">
                                    View Current
                                </button>
                                <?php }?>
                                <button class="btn btn-primary select-file data" type="button"
                                    onclick="changeFile('label')">
                                    Select New Label
                                </button>
                                <input type="hidden" id="label" name="label" class="form-control" name="label" value="<?php echo $_GET['labelUrl'];?>">
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
                            <div class="col-3">
                                <label id="icon-url">
                                    <?php
                                   
                                     if($_GET['iconUrl']!=""){
                                        $pos=strripos($_GET['iconUrl'],"/")+1;
                                            $finalStr=substr($_GET['iconUrl'],$pos);
                                        $length = strlen($finalStr);
                                        if($length >16 )
                                        {
                                            $icon = substr($finalStr,0,16)."...";
                                        }
                                        else
                                        {
                                            $icon =$finalStr;
                                        }
                                        echo $icon; 
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="col-5" style="text-align: right">
                                <?php   if($_GET['iconUrl']!=""){?>
                                <button class="btn btn-primary select-file data" type="button"
                                    onclick="viewFile('icon','<?= $_GET['iconUrl']?>')">
                                    View Current
                                </button>
                                <?php }?>
                                <button class="btn btn-primary select-file data" type="button"
                                    onclick="changeFile('icon')">
                                    Select New Icon
                                </button>
                                <input type="hidden" id="icon" name="icon" class="form-control" name="icon" value="<?php echo $_GET['iconUrl'];?>">
                            </div>
                        </div>
                    </div>
                    <div class=" row type-select">
                        <div class="col-12 text-center">
                            <button type="submit" class="viewBtn">Save</button>
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

                        <div style="width: 800px;height:100px;margin:auto;">

                            <div id="videoTitle"
                                style="height:60px;text-align: center;color: #00338D;text-align: center;font-size: 51px;margin:0px;">
                            </div>
                            <input type="hidden" name="field" id="changeField">
                        </div>
                        <span class="close" id="changePopupClose">×</span>
                    </div>
                    <div class="modal-body changePopup">
                        <div class="example" style="margin:auto;">

                            <input type="text" name="filetag" id="filetag" placeholder="Search..">
                            <input type="hidden" name="type" id="fileType" placeholder="Search..">
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
                        <h2 id="fileName"></h2>
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
    function changeFile(type) {
        document.getElementById("videoTitle").innerText = "Select " + type;
        document.getElementById("filebrowser").innerHTML = "";
        document.getElementById("filetag").value = "";
        document.getElementById("fileType").value = type;

        let modal = document.getElementById("changeModel").style.display = "block";
    }
    document.getElementById("changePopupClose").addEventListener("click", function() {
        document.getElementById("changeModel").style.display = "none";
    });

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
    document.getElementById("closeChangeViewModelUpdate").addEventListener("click", function() {
        document.getElementById("changeViewModelUpdate").style.display = "none";
    });

    function UpdateData1(data, fileName) {
        let filename = data.substring(data.lastIndexOf("/") + 1);
        filename = filename.length > 10 ? filename = filename.substring(0, 10) + "..." : filename = filename;
        if (fileName === "icon") {
            document.getElementById(fileName).value = data
            document.getElementById("icon-url").innerText = filename
        } else {
            document.getElementById(fileName).value = data
            document.getElementById("label-url").innerText = filename

        }
        document.getElementById("changeModel").style.display = "none";

    }

    function viewFile(name, url) {
        html = "<img src='" + url + "' alt='image' class='img-fluid'>";
        console.log('name', html)
        document.getElementById("changeViewBody").innerHTML = html;
        document.getElementById("changeViewModelUpdate").style.display = "block";
        document.getElementById("fileName").innerText = name
    }
    </script>

</body>

</html>
