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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || File Upload</title>
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
    <link rel="stylesheet" href="assets/css/customstyle.css">
    <style>
body{
	           /* Added by magdum 17-07-23 */
            /* for background image */
            background-image: url(./assets/CMS-BG.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            background-color: black;
}
    .del-image1:hover~.tooltiptext {
        Display: block;

    }

    .filename-extension {
        position: relative;
        display: flex;
        align-items: center;
    }

    .filename-extension label {
        margin-left: 5px
    }

    span.tooltiptext {
        display: none;
        position: absolute;
        left: 0;
        top: 30px;
        max-width: 400px;
        font-size: 14px;
        font-weight: normal;
        background-color: #fff;
        color: #000;
        font-weight: 400;
        padding: 10px;
        transition: all 0.5s;
        border-radius: 10px;
        -webkit-box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 30%);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 30%);
        text-align: justify;
        font-family: "UNIVERSFORKPMG-LIGHT" !important;
        border: solid grey;
        z-index: 99;
    }
    </style>
    <script src="assets/js/jquery-3.6.0.js"></script>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
    <script>
    $(document).ready(function() {
        $("#textbtn").click(function() {
            $('#filebrowser').load('filelist.php?filePath=' + encodeURIComponent($("#filePath").val()), function() {
                //$('#inputtest'+$('#txtvalue').val()).val("testimage.jpg");
            });
        });
        $('#filebrowser').load('filelist.php?filePath=' + encodeURIComponent($("#filePath").val()), function() {});
        window.CallParent = function(filePathlocal) {
            $('#filePath').val(filePathlocal);
            $("#filebrowser").html("");
            $('#filebrowser').load('filelist.php?filePath=' + encodeURIComponent($("#filePath").val()), function() {});
        }
 
        $('#fileName').change(function() {
            var file = $('#fileName')[0].files[0].name;
            $('#custom-file-upload').text(file);
        });

        $("#delSelFile").click(function() { // delete selected file
            var values1 = {
                'filePath': document.getElementById('filePath').value,
                'fileName': document.getElementById('selectedFile').value
            };
            $.ajax({
                url: "<?php echo $apiBaseUrl; ?>cms/delFile.php",
                type: "POST",
                data: JSON.stringify(values1),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    "Authorization": "Bearer <?php echo $_COOKIE['kpmg-access']; ?>"
                },
                success: function(resp) {
					
                    //alert(resp);
                    alert(JSON.stringify(resp));
                    location.reload();
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.' + jqXHR.responseText;
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    alert(msg);
                }
            })
        });

        $("#addFolderBtn").click(function() {
            var values1 = {
                'filePath': document.getElementById('filePath').value,
                'addfoldername': document.getElementById('addfoldername').value
            };
            $.ajax({
                url: "http://10.188.7.135/api/cms/createFolder.php",
                type: "POST",
                data: JSON.stringify(values1),
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    "Authorization": "Bearer <?php echo $_COOKIE['kpmg-access']; ?>"
                },
                success: function(resp) {
                    alert(resp);
                    //alert(JSON.stringify(resp));
                    location.reload();
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.' + jqXHR.responseText;
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    alert(msg);
                }
            })
        });

        $("#formupload").on('submit', (function(e) {
            e.preventDefault();
            var tags = $('#tags').val();
            var category = $('#category').val();
            if ((tags.length == 0) || (category.length == 0)) {
                alert("Please enter Tags and categoty");
            } else {
                $("#filebrowser").html("Uploading File. Please Wait");
                $.ajax({
                    url: "<?php echo $apiBaseUrl; ?>cms/fileUpload.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        "Authorization": "Bearer <?php echo $_COOKIE['kpmg-access']; ?>"
                    },
                    success: function(resp) {
                        if(resp.status==1)
                        {
                        alert("File Uploaded");
                        } else {
                        alert(resp.msg);
                        }
                        location.reload();
                    },
                    error: function(jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.' + jqXHR.responseText;
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        alert(msg);
                    }
                })
            }
            return false;
        }));

    });
    </script>
</head>
<style>
    .btn-custom-small:hover{
        background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
    }
</style>
<body>
     <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
     <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle"></img>
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container file-upload">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow" onclick="location.href='select_template.php';">
                Back
            </a>
            <h1>Upload Files
            <img src="assets/Logout button.png" alt="logout" style="margin-top:0px;float:right;padding-left:20px;cursor:pointer;"onclick="location.href='login.php';">
                    
                    <img src="assets/Group 563.png" alt="logout" style="margin-top:px;float:right;cursor:pointer;"onclick="location.href='index.php';">
            </h1>
        </div>
        <div class="file-upload-container">
            <form id="formupload" method="post" enctype="multipart/form-data">

                <div class="full-row colrow mrgt">
                    <div class="colrow col40">
                        <label class="label">
                            Directory:
                        </label>
                    </div>
                    <div>
                        <input type="text" value="<?php echo dirname(__DIR__); ?>" name="filePath" id="filePath"
                            class="text-box text-box-min" />
                    </div>
                </div>

                <div class="file-upload-path"></div>

                <div class="file-upload-icon-container" id="filebrowser">

                </div>

                <div class="full-row colrow">
                    <div class="colrow">
                        <label class="label">
                            Selected File:
                        </label>
                    </div>
                    <div class="form-control-file-container">

                        <input class="text-box text-box-min" type="text" name="selectedFile" id="selectedFile"
                            style="width:80%" placeholder="Select a File">
                        <input class="btn-custom-small" type="button" id="delSelFile" name="delSelFile"
                            style="width:19%;min-width:10px;display:inline-block;" value="Delete">

                    </div>
                </div>

                <div class="full-row colrow">
                    <div class="colrow">
                        <label class="label">
                            Add Folder:
                        </label>
                    </div>
                    <div class="form-control-file-container">

                        <input class="text-box text-box-min" type="text" name="addfoldername" id="addfoldername"
                            style="width:80%" placeholder="Folder Name">
                        <input class="btn-custom-small" type="button" id="addFolderBtn" name="addFolderBtn"
                            style="width:19%;min-width:10px;display:inline-block;" value="Add">

                    </div>
                </div>


                <div class="full-row colrow">
                    <div class="colrow">
                        <label class="label">
                            Selected File:
                        </label>
                        <div class="filename-extension">
                            <img class="del-image1" src="assets/Info button.png" alt="welcome-text">
                            <span class="tooltiptext">Allowed File types pdf, jpg, jpeg, mp4.</span>
                            <label for="file-upload" class="custom-file-upload" id="custom-file-upload">File name
                                extension</label>
                        </div>
                    </div>
                    <div class="form-control-file-container">
                        <a class="btn-custom-small">Select file</a>
                        <input class="form-control" type="file" id="fileName" name="fileName" placeholder="Select file"
                            style="width:100%">
                    </div>
                </div>
                <div class="full-row colrow mrgt">
                    <div class="colrow col40">
                        <label class="label">
                            Tags
                        </label>
                    </div>
                    <div>
                        <input class="text-box text-box-min" type="text" name="tags" id="tags">
                    </div>
                </div>
                <div class="full-row colrow mrgt">
                    <div class="colrow col40">
                        <label class="label">
                            Category
                        </label>
                    </div>
                    <div>
                        <input class="text-box text-box-min" type="text" name="category" id="category">
                    </div>
                </div>
                <div class="upload-btn-row">
                    <button class="btn-custom-small" type="submit" id="submit">
                        Upload File
                    </button>
                </div>

            </form>
        </div>
    </div>
     <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
     <div style="margin:25px;font-size:0.9vw;bottom:10px;position:relative">
        &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
</body>

</html>
