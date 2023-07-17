<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = 'https://kpmg.experientialetc.com/api/cms/showAllResource.php';


$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true);

$respData = $response['resources'];

$srImage="assets/SR.png";
$scImage="assets/SC.png"

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
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->

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
    #myBtn1:hover{
    background-color: #38b2d7ba !important;
    outline: none;
    border: none;
    color: #f0fff0 !important;
   }
    #deleteId:hover{
    background-color: #38b2d7ba !important;
    outline: none;
    border: none;
    color: #f0fff0 !important;
   }
   .welcome{
    font-size:45px;
   }
   .view-file,
.btn-view-resource {
    width: 100% !important;
}

    
.img1.muralAddImage {
    position: fixed;
    right: 0;
    bottom: 10px;
}
</style>
</head>

<body class="body-bg">
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
                    <span class="arrow-left-image" onclick="location.href='mural1.php';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer; margin-top:25px;margin-left:60px;" /></span>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-10 common-welcome-color welcome-screen-font"
                    Style="margin-top:5px;" onclick="location.href='select_template.php';">
                    <span class="welcome">Manage Resource
                    <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px;margin-top:20px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
                        <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px;margin-top:2px;background-size: contain;cursor:pointer;"onclick="location.href='login.php';"></div></div>
                    </span>
                </div>
               
            </div>
            <form action="UpdateWelcomeScreen.php" method="post" id="muralForm">
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-10 col-lg-10"><br><br>
                        <div class=" table-responsive">
                            <!-- table -->
                            <table class="table">
                                <thead>
                                </thead>
                                <tbody>
                                    <form id="manageForm">
                                        <?php foreach($respData as $key => $value) { ?>
                                        <tr style="vertical-align: middle;">
                                            <td><?php 
                                                if($value['ResourceType']==="sector"){
                                                    echo "<img src=".$scImage." alt='serviceSector' class='iconImage'>";
                                                }
                                                else{
                                                    echo "<img src=".$srImage." alt='serviceSector' class='iconImage'>";
                                                }
                                            ?>
                                            </td>
                                            <th colspan="2" class="subText">
                                                <button type="button" class="btn btn-primary btn-view-resource"
                                                    id="myBtn1"
                                                    onclick="window.location = 'viewResource.php?type=<?php echo $value['ResourceType']; ?>&resourceName=<?php echo urlencode($value['ResourceName']); ?>&id=<?php echo $value['Id']; ?>&iconUrl=<?php echo urlencode($value['IconUrl']); ?>&labelUrl=<?php echo urlencode($value['LabelUrl']); ?>'">
                                                    <?php echo $value['ResourceName'] ?>
                                                </button>
                                            </th>

                                            <td>

                                                <button type="button" class="btn btn-primary" id="myBtn1"
                                                    onclick="window.location = 'EditResource.php?type=<?php echo $value['ResourceType']; ?>&resourceName=<?php echo urlencode($value['ResourceName']); ?>&id=<?php echo $value['Id']; ?>&iconUrl=<?php echo urlencode($value['IconUrl']); ?>&labelUrl=<?php echo urlencode($value['LabelUrl']); ?>'">
                                                    Edit
                                                </button>
                                                <button class="btn btn-primary viewBtn" type="button" id="deleteId"
                                                    onclick="window.location.href='deleteResource.php?id=<?php echo $value['Id']; ?>'">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </form>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="box-selection1">
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
        <div class="img1 muralAddImage">
            <a href="AddResource.php"><img src="assets/Add Button.png" alt="Add Image" id="AddImage"></a>
        </div>



</body>

</html>
