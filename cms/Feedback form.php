<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url =$apiBaseUrl."cms/showMasterFeedback.php";
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
$response = json_decode($jsonResponse,true);
$respData = $response['feedback_master'];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->

    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Manage FeedBack</title>
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
        <div class="feedback-screen-list">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='select_template.php';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-left:50px;margin-top:20px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome">Event Feedback
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';">
                    </span>
                </div>
            </div>
            <?php foreach($respData as $key => $value) { ?>

            <div class="row justify-content-md-center question-row align-items-center" style="padding-bottom:10px;">
                <div class="col-md-1 col-1">
            <?php
            if($value['response_type']==2){
                echo "<img src='assets/star (2).png' style='float:right;height:3%;width:2vw;margin-bottom:1rem'/>";
            }        
            ?>
                </div>
                <div class="col-md-8 col-6">
                    <p class="question" style="font-size:20px;"> <?php echo $value['feedback_ques'] ?></p>
                </div>
                <div class="col-md-3 col-5">
                    <a href="editFeedback.php?question=<?php echo $value['feedback_ques']?>&id=<?php echo $value['ques_id']?>&type=<?php echo $value['response_type']?>"
                        class="btn btn-primary">Edit</a>
<?php
            if($value['response_type']<2){
				?>
                    <a href="deleteFeedBack.php?id=<?php echo $value['ques_id']?>"
                        class="<?php if($value['response_type']==1){echo "pointer-event";}?>"><img
                            class="img delete-feedback" src="assets/Delete icon.png" alt="deleteIcon"></a>
			<?php
			}
			?>
                </div>

            </div>
            <?php } ?>


        </div>



    </div>
    <div class=" img1 muralAddImage" style="float:right;">
        <a href="addFeedBack.php"><img src="assets/Add Button.png" alt="Add Image" id="AddImage"></a>
    </div>

    <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
    <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:relative">
        &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
    </div>
    <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->


</body>

</html>
