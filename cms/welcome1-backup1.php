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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="./style1.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || welcome Screen</title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>

    <script>
    var showVideoVal = "true";
    var showPdfVal = "true";
    var showImageVal = "true";

    //var changeFieldName="loop_vid";

    $(document).ready(function() {
        $("#changePopupClose").click(function() {
            $("#changeModel").attr("style", "display:none");
        });
        $("#close2").click(function() {
            $("#myModal2").attr("style", "display:none");
            $("#viewModelBody").html("Loading ...");
        });

        $("span button").click(function() {
            if ($(this).val() == "changevideo") {
                showVideoVal = "true";
                showImageVal = "false";
                showPdfVal = "false";
                $('#inputtest').val("loop_vid");
                $("#filebrowser").html("");
                $("#changeModel").attr("style", "display:block");
                $("#videoTitle").html("Welcome Video");
            }
            if ($(this).val() == "changelogo") {
                showVideoVal = "false";
                showImageVal = "true";
                showPdfVal = "false";
                $('#inputtest').val("KPMG_logo");
                $("#filebrowser").html("");
                $("#changeModel").attr("style", "display:block");
                $("#videoTitle").html("Welcome Screen Logo");
            }
            if ($(this).val() == "changebg") {
                showVideoVal = "false";
                showImageVal = "true";
                showPdfVal = "false";
                $('#inputtest').val("bg_vid");
                $("#filebrowser").html("");
                $("#changeModel").attr("style", "display:block");
                $("#videoTitle").html("Welcome Screen BG");
            }
        });

        $('#filetag').keypress(function(e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                search_now();
            }
        });

        function search_now() {
            var request = $.ajax({
                type: "POST",
                url: "filesearch.php",
                data: {
                    Tags: $("#filetag").val(),
                    showvideo: showVideoVal,
                    showpdf: showPdfVal,
                    showimage: showImageVal
                    /*,
                    ...dataset, */
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

        // search button click
        $("#textbtn").click(function() {
            search_now();
        });

        /*
            sessionStorage.setItem('KPMG_logo', '<?php echo $response['KPMG_logo']; ?>');
            sessionStorage.setItem('bg_vid', '<?php echo $response['bg_vid']; ?>');
            sessionStorage.setItem('loop_vid', '<?php echo $response['loop_vid']; ?>');
        */

        window.CallParent = function(filePathlocal) {
            if ($('#inputtest').val() == "loop_vid") {
                var result = $('#loop_vid').val().split('/');
                $("#loopVidText").html(result[result.length - 1]);
                sessionStorage.setItem('loop_vid', result[result.length - 1]);
            }
            if ($('#inputtest').val() == "KPMG_logo") {
                var result = $('#KPMG_logo').val().split('/');
                $("#KPMGLogo").html(result[result.length - 1]);
                sessionStorage.setItem('KPMG_logo', result[result.length - 1]);
            }
            if ($('#inputtest').val() == "bg_vid") {
                var result = $('#bg_vid').val().split('/');
                $("#BgVidName").html(result[result.length - 1]);
                sessionStorage.setItem('bg_vid', result[result.length - 1]);
            }

            $("#changeModel").attr("style", "display:none");
        }
    });
    </script>
</head>
<style>
.btn {
    height: 42px;
    width: 110px;
    background-color: #00338d;
    border-radius: 10px;
    border: none;
    color: white;
    font-size: 20px;
    top: 120px;
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
</style>

<body class="body-bg">
    <input type="hidden" name="inputtest" id="inputtest" value="iconUrl" />
    <div class="container-lg">
        <div class="welcome-screen">
            <div class="row align-items-center">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-2">
                    <a class="arrow-left-image" href='select_template.php'>
                        <img src="assets/login.png" alt="login" class="pointer" />
                    </a>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-8 d-flex justify-content-center align-items-center common-welcome-color welcome-screen-font"
                    onclick="location.href='select_template.php';">
                    <span class="welcome">Welcome Screen</span>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-2 logout">
                    <img src="assets/Logout button.png" alt="logout"
                        style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                        onclick="location.href='login.php';">

                    <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                        onclick="location.href='index.php';">
                </div>
            </div>
            <form action="UpdateWelcomeScreen.php" method="post">
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class=" table-responsive">
                            <!-- table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>
                                            <input id="loop_vid" name="loop_vid" type="hidden"
                                                value="<?= $response['loop_vid']; ?>" />


                                        </td>
                                        <th>Welcome Video : </th>
                                        <td class="text" id="loopVidText" name="loopVidText">
                                            <?php $replaceUrl =str_replace("%20"," ",$response['loop_vid_name']);
                                        echo strlen($replaceUrl)>16 ?substr($replaceUrl,0,12) ."...":$replaceUrl;
                                        ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn" id="video-btn"
                                                onClick="viewData('<?php echo $response['loop_vid'];?>','Welcome Video')">
                                                View
                                            </button>

                                            <span><button class="btn" type="button" id="change1" value="changevideo"
                                                    name="changebtn">Change</button></span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="vertical-align: middle;">
                                        <td><input type="hidden" id="KPMG_logo" name="KPMG_logo"
                                                value="<?php echo ($response['KPMG_logo']); ?>"></td>
                                        <th>Welcome Screen Logo :</th>
                                        <td class="text" id="KPMGLogo" name="KPMGLogo">
                                            <?php 
                                             $replaceUrl =str_replace("%20"," ",$response['KPMG_logo_name']);
                                        echo strlen($replaceUrl)>16 ?substr($replaceUrl,0,12) ."...":$replaceUrl;
                                        ?>
                                        </td>
                                        <td> <button class="btn" type="button" id="myBtn1"
                                                onClick="viewData('<?php echo $response['KPMG_logo'];?>','Welcome Screen Logo')">View</button>
                                            <span><button class="btn" type="button" id="changeLogo1" value="changelogo"
                                                    name="changebtn">Change</button></span>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td><input type="hidden" id="bg_vid" name="bg_vid"
                                                value="<?php echo ($response['bg_vid']) ?>"></td>
                                        <th>Welcome Screen BG :</th>
                                        <td class="text" id="BgVidName" name="BgVidName">
                                            <?php
                                        $replaceUrl =str_replace("%20"," ",$response['bg_vid_name']);
                                       
                                        echo strlen($replaceUrl)>16 ?substr($replaceUrl,0,12) ."...":$replaceUrl;
                                         ?>
                                        </td>
                                        <td> <button class="btn" id="myBtn2" type="button"
                                                onClick="viewData('<?php echo $response['bg_vid'];?>','Welcome Screen BG')">View</button>
                                            <span><button class="btn" type="button" id="changeBg1" value="changebg"
                                                    name="changebtn">Change</button></span>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td>
                                            <img class="del-image1" src="assets/Info button.png" alt="welcome-text">
                                            <span class="tooltiptext">Please input the keyword orgplaceholder in the
                                                welcome text instead of the visiting company name. The keyword will
                                                fetch the company name from the booking application. Similarly please
                                                use the following keywords - nameplaceholder instead of the visiting
                                                client name, timeplaceholder instead of the visiting time and
                                                timeplaceholder instead of the visiting date.</span>
                                        </td>
                                        <th colspan="2">Welcome Text<sup class="red">*</sup> :</th>
                                        <td> <textarea aria-label="With textarea"
                                                name="HeaderText"><?php echo trim($response['header_text']); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td></td>
                                        <th colspan="2" class="subText">SubHeader Text1<sup class="red">*</sup> :</th>

                                        <td> <textarea aria-label="With textarea"
                                                name="SubheaderText1"><?php echo trim($response['sub_text1']); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td></td>
                                        <th colspan="2" class="subText">SubHeader Text2<sup class="red">*</sup> :</th>

                                        <td> <textarea aria-label="With textarea"
                                                name="SubheaderText2"><?php echo trim($response['sub_text2']); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td></td>
                                        <th colspan="2" class="subText">SubHeader Text3<sup class="red">*</sup>:</th>

                                        <td> <textarea aria-label="With textarea"
                                                name="SubheaderText3"><?php echo trim($response['sub_text3']); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td></td>
                                        <th colspan="2" class="subText">SubHeader Text4 <sup class="red">*</sup>:</th>

                                        <td> <textarea aria-label="With textarea"
                                                name="SubheaderText4"><?php echo trim($response['sub_text4']); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr style="vertical-align: middle;">
                                        <td></td>
                                        <th colspan="2" class="subText">FooterText <sup class="red">*</sup>:</th>

                                        <td> <textarea aria-label="With textarea" name="FooterText"
                                                name="SubheaderText5"><?php echo trim($response['footer_text']); ?></textarea>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="submit">
                            <input id="loop_vid" name="Timer" type="hidden" value="<?php echo $response['status'] ?>" />
                            <input type="submit" class="btn btn-primary viewBtn save" value="Save" id="save-btn" />
                        </div>

                    </div>
                </div>
            </form>

        </div>


        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Welcome Video</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="modal-body">
                    <video controls>
                        <source src="<?php echo $response['loop_vid']; ?>" type="video/mp4">

                        Your browser does not support HTML video.
                    </video>

                </div>

            </div>

        </div>
        <div id="myModal1" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Welcome Screen Logo</h2>
                    <span class="close" id="close1">&times;</span>
                </div>
                <div class="modal-body">
                    <img class="modal-image" src="<?php echo $response['KPMG_logo']; ?>" alt="logo" class="logo" />
                </div>

            </div>

        </div>
        <div id="myModal2" class="modal">
            <div class="modal-dialog modal-xl">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="h2-title"></h2>
                        <span class="close" id="close2">&times;</span>
                    </div>
                    <div class="modal-body" id="viewModelBody">


                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="viewModelUpdate" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2>Welcome Screen BG</h2>
                <span class="close" id="close2">&times;</span>
            </div>
            <div class="modal-body">
                <video controls class="video">
                    <source src="<?php echo $response['bg_vid']; ?>" type="video/mp4">


                    Your browser does not support the video tag.
                </video>

            </div>

        </div>

    </div>
    <div id="myModal2" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-1 arrow-left"></div>
                <h2>Welcome Screen BG</h2>
                <span class="close" id="close2">&times;</span>
            </div>
            <div class="modal-body">
                <video height="500" controls class="video">
                    <source src="<?php echo $response['loop_vid']; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

            </div>

        </div>

    </div>
    <div id="changeModel" name="changeModel" class="modal">

        <!-- Modal content -->
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">

                    <div style="width: 800px;height:100px;margin:auto;">

                        <div id="videoTitle" name="videoTitle"
                            style="height:60px;text-align: center;color: #00338D;text-align: center;font-size: 51px;margin:0px;">
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
                    <div id="filebrowser" name="filebrowser">

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
            </div>
            <div class="modal-body">
                <video controls class="video">
                    <source src="#" type="video/mp4" id="changeVideoShow">


                    Your browser does not support the video tag.
                </video>
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



    <script src="footer.js"></script>
    <script type="text/javascript">
    let KPMG_logo = sessionStorage.getItem('KPMG_logo'),
        bg_vid = sessionStorage.getItem('bg_vid'),
        loop_vid = sessionStorage.getItem('loop_vid'),
        header_text = sessionStorage.getItem('header_text'),
        sub_text1 = sessionStorage.getItem('sub_text1'),
        sub_text2 = sessionStorage.getItem('sub_text2'),
        sub_text3 = sessionStorage.getItem('sub_text3'),
        sub_text4 = sessionStorage.getItem('sub_text4'),
        footer_text = sessionStorage.getItem('footer_text');
    if (KPMG_logo == null, loop_vid == null, bg_vid == null, header_text == null, sub_text1 == null, sub_text2 == null,
        sub_text3 == null, sub_text4 == null, footer_text == null) {
        sessionStorage.setItem('KPMG_logo', '<?php echo $response['KPMG_logo']; ?>');
        sessionStorage.setItem('bg_vid', '<?php echo $response['bg_vid']; ?>');
        sessionStorage.setItem('loop_vid', '<?php echo $response['loop_vid']; ?>');
        sessionStorage.setItem('header_text', '<?php echo $response['header_text']; ?>');
        sessionStorage.setItem('sub_text1', '<?php echo $response['sub_text1']; ?>');
        sessionStorage.setItem('sub_text2', '<?php echo $response['sub_text2']; ?>');
        sessionStorage.setItem('sub_text3', '<?php echo $response['sub_text3']; ?>');
        sessionStorage.setItem('sub_text4', '<?php echo $response['sub_text4']; ?>');
        sessionStorage.setItem('footer_text', '<?php echo $response['footer_text']; ?>');
        sessionStorage.setItem('logoURL', '<?php echo $response['KPMG_logo']; ?>');
        sessionStorage.setItem('bgURL', '<?php echo $response['bg_vid']; ?>');
        sessionStorage.setItem('videoURL', '<?php echo $response['loop_vid']; ?>');
    }

    KPMG_logo === "<?php echo $response['KPMG_logo']; ?>" ? sessionStorage.setItem('KPMG_logo',
            '<?php echo $response['KPMG_logo']; ?>') : document.getElementById("loopVidText").value = loop_vid
        .substring(loop_vid.lastIndexOf('/') + 1);
    bg_vid === " <?php echo $response['bg_vid']; ?>" ? sessionStorage.setItem('bg_vid',
        '<?php echo $response['bg_vid']; ?>') : document.getElementById("BgVidName").value = bg_vid.substring(bg_vid
        .lastIndexOf('/') + 1);
    loop_vid === " <?php echo $response['loop_vid']; ?>" ? sessionStorage.setItem('loop_vid',
        '<?php echo $response['loop_vid']; ?>') : document.getElementById("loop_vid").value = loop_vid.substring(
        loop_vid.lastIndexOf('/') + 1);
    header_text !== " <?php echo $response['header_text']; ?>" ? sessionStorage.setItem('header_text',
        '<?php echo $response['header_text']; ?>') : "";
    sub_text1 !== " <?php echo $response['sub_text1']; ?>" ? sessionStorage.setItem('sub_text1',
        '<?php echo $response['sub_text1']; ?>') : "";
    sub_text2 !== " <?php echo $response['sub_text2']; ?>" ? sessionStorage.setItem('sub_text2',
        '<?php echo $response['sub_text2']; ?>') : "";
    sub_text3 !== " <?php echo $response['sub_text3']; ?>" ? sessionStorage.setItem('sub_text3',
        '<?php echo $response['sub_text3']; ?>') : "";
    sub_text4 !== " <?php echo $response['sub_text4']; ?>" ? sessionStorage.setItem('sub_text4',
        '<?php echo $response['sub_text4']; ?>') : "";
    footer_text !== " <?php echo $response['footer_text']; ?>" ? sessionStorage.setItem('footer_text',
        '<?php echo $response['footer_text']; ?>') : "";

    let updatedVideo = sessionStorage.getItem('loop_vid')

    let loopVidText = updatedVideo.substring(updatedVideo.lastIndexOf('/') + 1).length > 15 ? updatedVideo.substring(
        updatedVideo.lastIndexOf('/') + 1).substr(0, 15) + "..." : updatedVideo.substring(updatedVideo.lastIndexOf(
        '/') + 1)
    let KPMG_logoText = updatedVideo.substring(KPMG_logo.lastIndexOf('/') + 1).length > 15 ? KPMG_logo.substring(
        KPMG_logo.lastIndexOf('/') + 1).substr(0, 15) + "..." : KPMG_logo.substring(KPMG_logo.lastIndexOf('/') + 1)
    let bgVideoText = updatedVideo.substring(bg_vid.lastIndexOf('/') + 1).length > 15 ? bg_vid.substring(bg_vid
        .lastIndexOf('/') + 1).substr(0, 15) + "..." : bg_vid.substring(bg_vid.lastIndexOf('/') + 1)

    document.getElementById("loopVidText").innerText = loopVidText;
    document.getElementById("KPMGLogo").innerText = KPMG_logoText
    document.getElementById("BgVidName").innerText = bgVideoText;

    document.getElementById("loop_vid").value = sessionStorage.getItem('videoURL');
    document.getElementById("KPMG_logo").value = sessionStorage.getItem('logoURL');
    document.getElementById("bg_vid").value = sessionStorage.getItem('bgURL');


    function isImage(url) {
        return /\.(jpg|jpeg|png|webp|avif|gif|svg)$/.test(url);
    }

    function isVideo(url) {
        return /\.(mp4|mov|m4v|webm|ogv|ogg|avi|flv|wmv|mpg|mpeg|m2v|mkv|3gp|3g2)$/.test(
            url
        );
    }

    function viewData(data, type) {
        let checkImage = isImage(data);
        let html = "";
        if (checkImage) {
            html = "<img src='" + data + "' alt='image' class='img-fluid'>";
        } else {
            let checkVideo = isVideo(data);
            if (checkVideo) {
                html = ` <video  controls class="video" id="video-container">
        <source src=${data} id="kal-slide" type="video/mp4">
        Your browser does not support the video tag.
        </video>"`;
            } else if (data.split(".").pop() === "pdf") {
                html = `<iframe   src="${data}">`;
            } else {
                html = "<span> preview is not available</span>";
            }
        }

        document.getElementById("h2-title").innerText = type;
        document.getElementById("viewModelBody").innerHTML = html;
        document.getElementById("myModal2").style.display = "block";
    }

    function showDataModel(data, type) {
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