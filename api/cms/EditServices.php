<?php
include_once('config.php');
include_once('jwt.php');



if(isset($_POST['update']))
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Edit Service</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

    <script>
    $(document).ready(function() {

        // search button click
        $("#textbtn").click(function() {
            var request = $.ajax({
                type: "POST",
                url: "resourceSearch.php",
                data: {
                    Tags: $("#filetag").val(),
                    showvideo: "false",
                    showpdf: "false",
                    showimage: "true"
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

</head>

<body>
    <div class="container-lg">
        <div class="welcome-screen service">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image"
                        onclick="location.href='TTServices.php?ParentId=<?php echo $ParentId; ?>';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-top:20px;margin-left:55px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    Style="margin-top:5px;">
                    <span class="welcome resource">Edit Service <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';"></span>
                </div>
            </div>
            <form method="post" class="resource-form"><br><br><br>
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row  type-select">
                            <div class="col-4">
                                <label> Service Name:</label>
                            </div>
                            <div class="col-8">
                                <input type="hidden" name="ParentId" value="<?php echo $ParentId; ?>">
                                <input type="text" name="service_name" class="form-control" placeholder="service Name"
                                    value="<?php echo $response[0]['Service']; ?>">
                            </div>
                        </div>
                        <div class=" row type-select">
                            <div class="col-4">
                                <label>Service Icon:</label>
                            </div>
                            <div class="col-3">
                                <label id="iconUrl"></label>
                                <input type="hidden" name="iconUrl" id="iconUrl-input">
                            </div>
                            <div class="col-5">
                                <button type="button" class="btn btn-primary custom-btn"
                                    onclick="viewIcon('<?= $response[0]['icon'] ;?>')">View
                                </button>
                                <button type="button" class="btn btn-primary custom-btn" id="selectServiceIcon">Select
                                    Icon</button>
                            </div>
                        </div>

                        <div class=" row type-select">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary viewBtn" name="update">Update</button>
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
                                Select Icon
                            </div>

                        </div>
                        <span class="close" id="changePopupClose">×</span>
                    </div>
                    <div class="modal-body changePopup">
                        <div class="example" style="margin:auto;">
                            <input type="hidden" name="field" id="changeField">
                            <input type="text" name="filetag" id="filetag" placeholder="Search..">
                            <button type="submit" name="textbtn" id="textbtn"><i class="fa fa-search"></i></button>
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

    function viewIcon(url) {
        html = "<img src='" + url + "' alt='image' class='img-fluid'>";
        document.getElementById("changeViewBody").innerHTML = html;
        document.getElementById("changeViewModelUpdate").style.display = "block";
    }
    </script>
</body>

</html>