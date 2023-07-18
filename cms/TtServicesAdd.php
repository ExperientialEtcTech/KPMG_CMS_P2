<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

$parentId=$_GET['ParentId'];
$pageName="Add Service";
if(isset($_GET['Service']))
{
    $pageName="Add Service".urldecode($_GET['Service']);
}


if(isset($_POST['addservice']))
{
    $postData1 = array("parentid"=>&$_POST['parentid'],"service"=>&$_POST['service'],"servicetype"=>&$_POST['servicetype'],"iconUrl"=>&$_POST['iconUrl']);
    $url1 = $apiBaseUrl.'cms/TtServicesAdd.php';

    $jsonResponse = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    //print_r($jsonResponse);
    ?>
<script>
//alert("Record Added");
window.location.href ="TTServices.php?ParentId=<?php echo $_GET['ParentId']; ?>&Service=<?php echo $_GET['Service']; ?>";
</script>
<?php
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG </title>
    <script src="assets/js/jquery-3.6.0.js">
    </script>

    <script>
    $(document).ready(function() {

        function search_now() {
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
        }

        
        $('#filetag').keypress(function(e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                search_now();
            }
        });

        $("#filetag").blur(function() {
            search_now();
        });

        // search button click
        $("#textbtn").click(function() {
            search_now();
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
.welcomes{
    font-size:45px;
    color:darkblue;
    margin-top:60px;
    padding-top:80px;
}
	.type-select {
    margin: 20px;
}
.custom-btn {
    width: 100% !important;
}
        </style>

</head>

<body>
    <div class="container-lg">
        <div class="welcome-screen service">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='TTServices.php?type=services';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-top:20px;margin-left:60px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    Style="margin-top:8px;">
                    <span class="welcomes">Add Service <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:10px;float:right;margin-right:40px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:10px;margin-right:40px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';"></span>
                </div>
            </div>
            <form method="post" class="resource-form"><br>
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row  type-select">
                            <div class="col-4">
                                <label> Service Name:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="service" class="form-control" placeholder="Service Name">
                            </div>
                        </div>
                        <div class=" row type-select">
                            <div class="col-4">
                                <label>Service Icon:</label>
                            </div>
                            <div class="col-4">
                                <label id="iconUrl"></label>
                                <input type="hidden" name="iconUrl" id="iconUrl-input">
                                <input type="hidden" name="parentid" value="<?= $_GET['ParentId'];?>">
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary custom-btn" id="selectServiceIcon">Select
                                    Icon</button>
                            </div>
                        </div>

                        <div class=" row type-select">
                            <div class="col-12 text-center">
                            <button type="submit" class="viewBtn" name="addservice">Save</button>
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
    </script>
</body>

</html>
