<?php
include_once('security.php');
    $question= $_GET['question'];
    $type= $_GET['type'];
    $id= $_GET['id'];
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
    <title>KPMG || Edit FeedBack</title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
	<script src="assets/js/jquery-3.6.0.js"></script>

</head>
<style>
.viewBtn {
    margin-top: 75px;
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

.form-control {

    color: gray
}
</style>

<body class="body-bg">
		    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container-lg">
        <div class="feedback-screen">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='Feedback form.php';">
                        <img src="assets/login.png" alt="login"
                            Style="cursor:pointer;margin-left:50px;margin-top:20px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome">Edit Question
                        <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px;margin-top:20px; background-size: contain;cursor:pointer;"
                            onclick="location.href='index.php';">
                            <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:80px;margin-top:0px; background-size: contain;cursor:pointer;"
                                onclick="location.href='login.php';"> </div> </div>
                    </span>
                </div>
            </div>
            <form action="updateFeedBack.php" method="post">
                <div class="row justify-content-md-center top-50">
                    <div class="col-4">
                        <?php 
                            if($type!=1){

                                echo "<label>Generic Question :</label>";
                            }
                            else{
                                    echo "<label>Rating Question :</label>";
                            }
                        ?>
                    </div>
                    <div class="col-6 padding-5">
                        <textarea class="form-control" placeholder="Generic Question"
                            name="generic_question"><?php echo $question;?></textarea>
                        <!-- <input type=" text" class="form-control" placeholder="Generic Question" name="generic_question"
                            value="<?php echo $question;?>" id=" generic_question"> -->
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="type" value="<?php echo $type;?>">
                    </div>

                </div>

                <div class=" row type-save-btn">
                    <div class="col-12 text-center">
                        <button type="submit" class="viewBtn">Update</button>
                    </div>

                </div>
            </form>

        </div>



    </div>
<!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
</body>

</html>