<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
error_reporting(0);
$parentId=0;
//$pageName="Services";
if(isset($_GET['ParentId']))
{
    $parentId=$_GET['ParentId'];
    //$pageName=urldecode($_GET['Service']);
}

if(isset($_GET['delId']))
{
    $delId=$_GET['delId'];
    $postData2 = array("delId"=>&$_GET['delId']);
    $url2 = $apiBaseUrl.'cms/TtServicesDel.php';

    $jsonResponse = rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
}

if(isset($_POST['addservice']))
{
    $postData1 = array("parentid"=>&$_POST['parentid'],"service"=>&$_POST['service'],"servicetype"=>&$_POST['servicetype'],"iconUrl"=>&$_POST['iconUrl']);
    $url1 = $apiBaseUrl.'cms/TtServicesAdd.php';

    $jsonResponse = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
}

$postData = array("parentId"=>&$parentId);
$url = $apiBaseUrl.'cms/TtServicesShow.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
//print_r($jsonResponse);
$response = json_decode($jsonResponse,true)['services'];
$parentpage = json_decode($jsonResponse,true)['parent'];
$parentpagename = json_decode($jsonResponse,true)['parentname'];
if($parentpage==-1)
{
    $parentpage="TableTop.php";
} else {
    $parentpage="TTServices.php?ParentId=".$parentpage;//."&Service=".$parentpagename;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/stylewelcome.css">
    <title>KPMG</title>
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
</head>
<style>
*,
*::before,
*::after {
    box-sizing: border-box;
}

@media (prefers-reduced-motion: no-preference) {
    :root {
        scroll-behavior: smooth;
    }
}

body {

    margin: 0px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
	  /* Added by magdum 17-07-23 */
            /* for background image */
            background-image: url(./assets/CMS-BG.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            background-color: black;
}


@font-face {
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}

p {
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}

.box-selection {
    height: 50px;
    min-width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    background-color: #00338d;
    border-radius: 10px;
}

.box-selection:hover {
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor: pointer;
    transition: 0.1s;
}

.box-selection3.disabled {
    height: 50px;
    min-width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    background-color: grey;
    border-radius: 10px;
}

/* .box-selection3.disabled{
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
} */

.box-selection3 {
    height: 50px;
    min-width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    background-color: #00338d;
    border-radius: 10px;
}


.box-selection-text {
    height: 80px;
    width: 80px;
    background-size: contain;
    display: inline-block;
    background-image: url('assets/Rectangle-80.png');
    background-repeat: no-repeat;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    vertical-align: middle;
    width: 500px;
    background-image: none;
    color: #000000;

}

.vertical-center {
    margin: 0;
    position: relative;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 20px;
    cursor: pointer;

}


.box-selection3.disabled {
    color: white;
    position: relative;
    -ms-transform: translateY(-50%);

    font-size: 20px;
    cursor: no-drop;
    margin-top: 25px;
    margin-left: 20px;
}

.vertical-center3 {
    color: white;
    position: relative;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 20px;
    cursor: pointer;
    margin-top: 25px;
    margin-left: 20px;
}

.vertical-centers {
    margin: 0;
    position: relative;
    top: 60%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    margin-left: 20%;
    color: grey;
    font-size: 25px;
}

.img1 {
    float: right;
    padding-right: 200px;
}

.box-selection1 {
    height: 80px;
    float: right;
    width: 27%;
    top: 60%;
}

.add-button {
    right: 10px;
    bottom: 10px;
    position: fixed;
}

.del-image {
    height: 32px;
    margin-top: 13%;

}

.text {
    margin-left: 30%;
    border: solid grey;

}


.modal-content {
    border-radius: 15px;
    border: solid 1px #ccc;
    background-color: #fff;
    -webkit-box-shadow: 0px 10px 15px 10px rgba(0, 0, 0, 0.04);
    -moz-box-shadow: 0px 10px 15px 10px rgba(0, 0, 0, 0.04);
    box-shadow: 0px 10px 15px 10px rgba(0, 0, 0, 0.04);
}

.modal-content .modal-header {
    padding: 0px;
    position: relative;
}

.modal-content .modal-header h2 {
    padding: 0px 0px 40px 0px;
    margin: 0px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    text-align: center;
    color: #00338d;
    font-size: 40px;
}

.modal-content .modal-header .close {
    position: absolute;
    top: 0px;
    right: 5px;
    padding: 0px;
    float: none;
    line-height: normal;
}

.modal-content .modal-center-content {
    margin: 0px 50px;
}

.btn-custom-small {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-width: 157px;
    height: 50px;
    color: #fff;
    background: #00338d;
    font-size: 24px;
    text-decoration: none;
    border-radius: 10px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 0px 30px;
}

.modal-content .popup-row {
    display: flex;
    margin-bottom: 30px;
}

.justify-content-center {
    justify-content: center;
}

.d-flex {
    display: flex;
}

.modal-content .popup-col {
    align-items: center;
    padding: 0px 10px;
}

.width3 {
    width: 35%;
}

.width7 {
    width: 65%;
}

.text-box {
    border: solid 1px #ccc;
    font-family: 'UNIVERSFORKPMG-BOLD';
    border-radius: 6px;
    min-height: 50px;
    padding: 15px;
    width: 100%;
    color: #00338d;
    -webkit-box-shadow: 0px 6px 10px 6px rgba(0, 0, 0, 0.04);
    -moz-box-shadow: 0px 6px 10px 6px rgba(0, 0, 0, 0.04);
    box-shadow: 0px 6px 10px 6px rgba(0, 0, 0, 0.04);
}

.text-box:focus,
.text-box:focus-visible {
    border: solid 1px #ccc;
    outline: none;
}

.form-control-file-container {
    position: relative;
}

.form-control-file-container .btn-custom-small {
    font-size: 18px;
    height: 44px;
}

.form-control-file-container .form-control[type=file] {
    position: absolute;
    top: 0px;
    left: 0px;
    opacity: 0;
    width: 160px;
    height: 44px;
}

.modal-content .popup-col label {
    color: #838383;
    font-size: 20px;
    font-family: 'UNIVERSFORKPMG-BOLD';
}

.mb-0 {
    margin-bottom: 0px !important;
}

select {
    font-size: 20px;
}

.tt-row {
    width: 800px;
    margin: auto;
    display: flex;
    justify-content: space-between;
}

.tt-row .box-selection:first-of-type {
    min-width: 400px;
}
</style>

<body>
     <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
     <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
<!-- Commented and Added by shubham Jadhav - removed absolute position on div - 14/1 - start  -->    
    <!-- <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px"> -->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;top: 50px">

        <form action="select_template.php" method="post">
            <div style="width: 1000px;height:100px;margin:auto;">
                <div style="height:50px;float: left;background-image:url('assets/login.png');cursor:pointer;background-repeat:no-repeat;padding-left:50px;"
                    onclick="location.href='<?php echo $parentpage; ?>'"></div>
                <div
                    style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">

                    <?php echo $parentpagename; ?>
                    <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
                        <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                            onclick="location.href='login.php';">
                        </div>
                    </div><br><br>
                    <?php

if(!($response))
{
?>
                    <div class="tt-row">
                        No sub-services for service '<?php echo urldecode($parentpagename); ?>'. Please add new service
                        by
                        clicking on '+' arrow.
                    </div>
                    <?php
}
$i=0;
foreach($response as $service)
{
?>

                    <div class="tt-row">
                        <div class="box-selection">
                            <?php
            $link="TTServices.php?ParentId=".$service['Id']."&Service=".urlencode($service['Service']);
            //$link="TTServicesContent.php?ParentId=".$service['Id']."&Service=".$service['Service'];
    ?>
                            <div class="vertical-center" onclick="location.href='<?php echo $link; ?>'">
                                <?php echo $service['Service']; ?>
                            </div>
                        </div>
                        <div class="box-selection">
                            <div class="vertical-center"
                                onclick="location.href='TTServicesContent.php?ServiceId=<?php echo $service['Id']; ?>&Name=<?php echo urlencode($service['Service']); ?>'">
                                Content
                            </div>
                        </div>
                        <div class="box-selection">
                            <div class="vertical-center"
                                onclick="location.href='EditServices.php?ServiceId=<?php echo $service['Id']; ?>&ParentId=<?php echo $parentId; ?>'">
                                Edit
                            </div>
                        </div>

                        <?php
                       if($i<=2 && $_GET['ParentId']==0){
                        ?>
                        <div class="box-selection3 disabled">
                            <div class="vertical-center3 disabled">
                                Delete
                            </div>
                        </div>
                    </div>
                    <?php
                     }
                        else{
                      ?>
                    <div class="box-selection3">
                        <div class="vertical-center3"
                            onclick="location.href='TTServices.php?type=services&ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($parentpagename); ?>&delId=<?php echo $service['Id']; ?>'">
                            Delete
                        </div>
                    </div>
                </div>
                <?php      
                        }
                        ?>

                <?php  $i++; } ?>

                <div class="add-button" id="btnadd"><a
                        href="TtServicesAdd.php?ParentId=<?php echo $_GET['ParentId']; ?>&Service=<?php echo $_GET['Service']; ?>"><img
                            src="assets/Add Button.png" style="cursor:pointer;"></a></div>
        </form>
    </div>

    </div>
    <div id="changeViewModel" class="modal">

        <!-- Modal content -->
        <div id="myModal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="closeChangeViewModel">&times;</span>
                    <h2>Add Service</h2>
                </div>
                <div class="modal-body">
                    <div class="modal-center-content">
                        <form method="POST">
                            <input type="hidden" name="parentid" value="<?php echo $parentId; ?>" />
                            <div class="popup-row">
                                <div class="popup-col d-flex width3">
                                    <label>Service Name</label>
                                </div>
                                <div class="popup-col width7">
                                    <input type="text" name="service" class="text-box" />
                                </div>
                            </div>
                            <!--
                        <div class="popup-row">
                            <div class="popup-col d-flex width3">
                                <label>Has Content? </label>
                            </div>
                            <div class="popup-col width7">
                                <select id="servicetype" name="servicetype" class="text-box">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
-->
                            <div class="popup-row">
                                <div class="popup-col d-flex width3">
                                    <label>Icon Url</label>
                                </div>
                                <div class="popup-col width7">
                                    <input type="text" name="iconUrl" class="text-box" />
                                    <!--
                                <div class="form-control-file-container">
                                <a href="javascript: void(0);" class="btn-custom-small">Select file</a>
                                <input class="form-control" type="file" id="formFile" placeholder="Select file" >
-->
                                </div>
                            </div>
                    <!-- </div> -->
                    <div class="popup-row mb-0 justify-content-center">
                        <input type="submit" name="addservice" class="btn-custom-small" />
                    </div>
                    </form>
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
    <!--
<script>
    const btnadd = document.getElementById("btnadd");
    const modal = document.getElementById("myModal");
    const modal1 = document.getElementById("changeViewModel");
    const span = document.getElementById("closeChangeViewModel");

    btnadd.onclick = function () {
        modal.style.display = "block";
        modal1.style.display = "block";
    };
    span.onclick = function () {
        modal.style.display = "none";
        modal1.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target.id == "myModal") {
            modal.style.display = "none";
            modal1.style.display = "none";
        }
    };
</script>
-->
</body>

</html>
