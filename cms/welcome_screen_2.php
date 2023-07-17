<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/showWelcome.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/stylewelcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>KPMG</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script>
    $(document).ready(function() {
        // opne browser link click
        $(".btn-change").click(function(event) {
            if ($(this).attr('id') == "openBrowser") {
                $("#changeModel").css('display', 'block');
                //document.getElementById("changeModel").style.display = "block";
                //$("#browserdiv").css('visibility','visible');
                $('#inputtest').val($(this).attr('value'));
            }
        });
        // search button click
        $("#textbtn").click(function() {



            var request = $.ajax({
                type: "POST",
                url: "filesearch.php",
                data: {
                    Tags: $("#filetag").val()
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
        window.CallParent = function() {
            $("#changeModel").css('display', 'none');
        }
    });
    </script>
</head>
<style>
body {

    margin: 0px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}


@font-face {
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}

p {
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}

textarea {
    width: 260px;
    height: 70px;
    border-radius: 10px;
    border: solid 1px grey;
    background-image: url('assets/Group 159.png');
    background-size: 24px;
    background-repeat: no-repeat;
    background-position: 96%;
    padding: 10px 50px 10px 10px;
    font-family: Arial;
    color: #777;
    font-size: 14px;
    font-weight: 500;
    text-align: left !important;
}

textarea:focus,
textarea:focus-visible {
    outline: none;
}

.welcomescreen-form {
    max-width: 800px;
    margin: 20px auto 0px auto;
}

.btn-custom-small {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-width: 157px;
    height: 44px;
    color: #fff;
    background: #00338d;
    font-size: 22px;
    text-decoration: none;
    border-radius: 10px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 0px 30px;
}

.justify-content-between {
    justify-content: space-between;
}

.justify-content-center {
    justify-content: center;
}

.d-flex {
    display: flex;
}

.welcomescreen-form-row {
    display: flex;
    margin-bottom: 50px;
    align-items: center;
}

.welcomescreen-form-text {
    flex: 1 1 auto;
    padding-right: 30px;
    position: relative;
}

.welcomescreen-form-row h3 {
    margin: 0px;
    padding: 0px 0px 0px 0px;
    color: #838383;
    font-size: 18px;
    font-weight: normal;
    font-family: 'UNIVERSFORKPMG-BOLD';
}

.welcomescreen-form-row h3 strong {
    margin: 0px;
    padding: 0px 0px 0px 0px;
    color: #555;
    font-size: 22px;
    font-weight: normal;
    font-family: 'UNIVERSFORKPMG-BOLD';
}

.welcomescreen-form-row p {
    margin: 0px;
    padding: 0px 0px 0px 0;
    color: #838383;
    font-size: 22px;
    font-family: 'UNIVERSFORKPMG-BOLD';
}

.welcomescreen-form-actions {
    display: flex;
    justify-content: center;
    align-items: center;
}

.welcomescreen-form-actions button {
    margin: 0px 0px 0px 30px;
}

.sterik {
    width: 15px;
    margin-left: 5px;
}

.infor-icon {
    position: absolute;
    left: -30px;
    top: 0px;
}

.infor-icon img {
    width: 22px;
    height: 22px;
}

.sub-header-text {
    padding-left: 25%;
}
</style>

<body>
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 100px">
        <input type="hidden" name="inputtest" id="inputtest" />

        <div style="width: 800px;height:100px;margin:auto;">
            <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat ;padding-left:50px;margin-top:10px"
                onclick="location.href='select_template.php';"></div>
            <div style="height:60px;text-align: center;color: #00338D;text-align: center;font-size: 61px;margin:0px;">
                Welcome Screen</div>
        </div>

        <div class="welcomescreen-form">
            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text">
                    <h3><strong>Welcome Video:</strong> <?php echo $response['loop_vid_name']; ?>
                        <input type="text" name="welcomevid" id="welcomevid" disabled />
                    </h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <button id="myBtn" class="btn-custom-small">View</button>
                    <button id="openBrowser" value="welcomevid" class="btn-custom-small btn-change">Change</button>
                </div>
            </div>
            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text">
                    <h3><strong>Welcome Screen Logo:</strong> <?php echo $response['KPMG_logo_name']; ?>
                        <input type="text" name="welcomelogo" id="welcomelogo" disabled />
                    </h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <button id="myBtn" class="btn-custom-small">View</button>
                    <button id="openBrowser" value="welcomelogo" class="btn-custom-small btn-change">Change</button>
                </div>
            </div>
            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text">
                    <h3><strong>Welcome Screen BG:</strong> <?php echo $response['bg_vid_name']; ?>
                        <input type="text" name="welcomebg" id="welcomebg" disabled />
                    </h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <button id="myBtn2" class="btn-custom-small">View</button>
                    <button id="openBrowser" value="welcomebg" class="btn-custom-small btn-change">Change</button>
                </div>
            </div>
            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text">
                    <h3><a href="javascript: void(0);" class="infor-icon"><img src="assets/Info button.png"
                                alt="welcome-text"></a> <strong>Welcome Text:</strong> Header Text</h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <textarea>
                        <?php echo $response['header_text']; ?></textarea>

                    <img src="assets/Highlight Header Text.png" alt="" class="sterik">
                </div>
            </div>
            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text sub-header-text">
                    <h3>SubHeader Text1</h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <textarea>
                        <?php echo $response['sub_text1']; ?></textarea>
                    <img src="assets/Highlight Header Text.png" alt="" class="sterik">
                </div>
            </div>


            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text sub-header-text">
                    <h3>SubHeader Text2</h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <textarea>
                        <?php echo $response['sub_text2']; ?></textarea>
                    <img src="assets/Highlight Header Text.png" alt="" class="sterik">
                </div>
            </div>

            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text sub-header-text">
                    <h3>SubHeader Text3</h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <textarea>
                        <?php echo $response['sub_text3']; ?></textarea>
                    <img src="assets/Highlight Header Text.png" alt="" class="sterik">
                </div>
            </div>

            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text sub-header-text">
                    <h3>SubHeader Text4</h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <textarea>
                        <?php echo $response['sub_text4']; ?></textarea>
                    <img src="assets/Highlight Header Text.png" alt="" class="sterik">
                </div>
            </div>

            <div class="welcomescreen-form-row">
                <div class="welcomescreen-form-text sub-header-text">
                    <h3>Footer Text</h3>
                </div>
                <div class="welcomescreen-form-actions">
                    <textarea>
                        <?php echo $response['footer_text']; ?></textarea>
                    <img src="assets/Highlight Header Text.png" alt="" class="sterik">
                </div>
            </div>
            <div class="welcomescreen-form-row justify-content-center">
                <button class="btn-custom-small">Save</button>
            </div>
        </div>

        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close">&times;</span>
                    <h2>Welcome Video</h2>
                </div>
                <div class="modal-body">
                    <video width="500" height="500" controls class="video">
                        <source src="<?php echo $response['loop_vid']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

            </div>

        </div>
        <div id="myModal1" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close1">&times;</span>
                    <h2>Welcome Screen Logo</h2>
                </div>
                <div class="modal-body">
                    <img class="modal-image" src="<?php echo $response['KPMG_logo']; ?>" alt="logo" class="logo" />
                </div>
            </div>
        </div>
        <div id="myModal2" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close2">&times;</span>
                    <h2>Welcome Screen BG</h2>
                </div>
                <div class="modal-body">
                    <video width="500" height="500" controls class="video">
                        <source src="<?php echo $response['bg_vid']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                </div>

            </div>

        </div>
        <div id="changeModel" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="changePopupClose">&times;</span>

                    <div style="width: 800px;height:100px;margin:auto;">

                        <div
                            style="height:60px;text-align: center;color: #00338D;text-align: center;font-size: 61px;margin:0px;">
                            Welcome Screen</div>

                    </div>
                </div>
                <div class="modal-body changePopup">
                    <div class="example" style="margin:auto;">

                        <input type="text" name="filetag" id="filetag" placeholder="Search..">
                        <button type="submit" name="textbtn" id="textbtn"><i class="fa fa-search"></i></button>
                    </div>
                    <div style="text-align:left;width:93%" id="filebrowser">

                    </div>
                </div>

            </div>

        </div>
    </div>
    <div id="changeViewModel" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="closeChangeViewModel">&times;</span>
                <h2>Welcome Video</h2>
            </div>
            <div class="modal-body">
                <video width="500" height="500" controls class="video">
                    <source src="#" type="video/mp4" id="changeVideoShow">


                    Your browser does not support the video tag.
                </video>
            </div>

        </div>

    </div>
    <script src="assets/js/welcomeScript.js">
    </script>
    <script src="footer.js"></script>

</body>

</html>