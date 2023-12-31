<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');



//if(isset($_POST['update']))
if(isset($_POST['service_name']) || (isset($_POST['iconUrl']) && $_POST['iconUrl'] != ""))
{
    $Id=$_GET['ServiceId'];
    $service_name=$_POST['service_name'];
    $icon=$_POST['iconUrl'];

    $postData2 = array("Id"=>&$Id,"Service"=>&$service_name,"icon"=>$icon);

    $url2 = $apiBaseUrl.'cms/TtServicesUpdate.php';
    $ParentId=$_POST['ParentId'];
   $response=  rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

     echo "<script>window.location = 'TTServices.php?ParentId=".$ParentId."'</script>";
     exit;
}

$ParentId=$_GET['ParentId'];
$serviceId=$_GET['ServiceId'];
$postData = array("ServiceId"=>&$serviceId);
$url = $apiBaseUrl.'cms/TtServiceShow.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true)['services'];






?>
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
    <title>KPMG || Edit Service</title>
       <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>

    <script>
    $(document).ready(function() {

        // search button click
        $("#textbtn").click(function() {
            let field = $('#changeField').val()
            var request = $.ajax({
                type: "POST",
                url: "resourceSearch.php",
                data: {
                    Tags: $("#filetag").val(),
                    showvideo: "false",
                    showpdf: "false",
                    showimage: "true",
                    field: field
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

        //$('#filebrowser').load('filelist.php?filePath='+$("#filePath").val(), function() {
        //});
        window.CallParent = function(filePathlocal) {
            //$('#filePath').val(filePathlocal);
            //$("#filebrowser").html("");
            //$('#filebrowser').load('filelist.php?filePath='+$("#filePath").val(), function() {
            //});
        }
    });
    </script>
    <style>
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
    .viewBtn {
        margin-top: 35px;
        height: 50px;
        width: 150px;
        background-color: #00338d;
        border-radius: 10px;
        border: none;
        color: white;
        font-size: 20px;
        top: 120px;
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

    .welcomes {
        font-size: 45px;
        color: darkblue;
        margin-top: 60px;
        padding-top: 80px;
    }
	.type-select {
    margin: 20px;
}
    </style>

</head>

<body>
     <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
     <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container-lg">
        <div class="welcome-screen service service-edit-update">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image"
                        onclick="location.href='TTServices.php?ParentId=<?php echo $ParentId; ?>';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-top:25px;margin-left:60px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    Style="margin-top:20px;font-size:45px;">
                    <span class="welcomes">Edit Service <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:8px;float:right;margin-right:40px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout"
                            style="margin-top:8px;margin-right:40px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';"></span>
                </div>
            </div>
            <form method="post" class="resource-form"><br><br><br>
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="row  type-select">
                            <div class="col-3">
                                <label> Service Name:</label>
                            </div>
                            <div class="col-9">
                                <input type="hidden" name="ParentId" value="<?php echo $ParentId; ?>">
                                <input type="text" name="service_name" class="form-control" placeholder="service Name"
                                    value="<?php echo $response[0]['Service']; ?>">
                            </div>
                        </div>
                        <div class=" row type-select">
                            <div class="col-3">
                                <label>Service Icon:</label>
                            </div>
                            <div class="col-2">
                                <label id="iconUrl">
                                    <?php
                                   
                                     if($response[0]['icon']!=""){
                                        $pos=strripos($response[0]['icon'],"/")+1;
                                            $finalStr=substr($response[0]['icon'],$pos);
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
                                <input type="hidden" name="iconUrl" id="iconUrl-input"
                                    value="<?= $response[0]['icon'] ?>">
                            </div>
                            <div class="col-7" style="text-align:right">
                                <?php if($response[0]['icon']!=""){?> <button type="button"
                                    class="btn btn-primary custom-btn"
                                    onclick="viewIcon('<?= $response[0]['icon'] ;?>')">View Current Icon
                                </button>
                                <?php }?>
                                <button type="button" class="btn btn-primary custom-btn" id="selectServiceIcon">Select
                                    Icon</button>
                            </div>
                        </div>

                        <div class=" row type-select">
                            <div class="col-12 text-center">
                                <button type="submit" class="viewBtn">Update</button>
                            </div>

                        </div>


                    </div>
                </div>
            </form>

        </div>
        <div id="changeModel" name="changeModel" class="modal">

            <!-- Modal content -->
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">

                        <div style="width: 800px;height:100px;margin:auto;">

                            <div id="videoTitle">
                                Select New Icon
                            </div>

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
    <script>
    document.getElementById("selectServiceIcon").addEventListener("click", function() {
        document.getElementById("changeModel").style.display = "block"

    })
    document.getElementById('changePopupClose').addEventListener("click", function() {
        document.getElementById("changeModel").style.display = "none"
        document.getElementById("filetag").value = ""
        document.getElementById("filebrowser").innerHtml = ""
    })

    function UpdateDataResource(url, type, data) {
        document.getElementById("changeModel").style.display = "none"
        document.getElementById("filetag").value = ""
        document.getElementById("filebrowser").innerHtml = ""
        let filename = url.substring(url.lastIndexOf("/") + 1);
        filename = filename.length > 16 ? filename = filename.substring(0, 16) + "..." : filename = filename;
        document.getElementById("iconUrl").innerText = filename;
        document.getElementById("iconUrl-input").value = url;

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
            html = `<embed src="${data}">`;
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

    function viewIcon(url) {
        html = "<img src='" + url + "' alt='image' class='img-fluid'>";
        document.getElementById("changeViewBody").innerHTML = html;
        document.getElementById("fileName").innerText = "Icon"
        document.getElementById("changeViewModelUpdate").style.display = "block";
    }
    </script>
</body>

</html>
