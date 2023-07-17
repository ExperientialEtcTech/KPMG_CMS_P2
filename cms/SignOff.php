<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/showSignOff.php';
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
$response = json_decode($jsonResponse,true)['text'][0];
?>
<!DOCTYPE html>
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
    <title>KPMG || SignOff</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
</head>


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
.headtxt1 {
    position: relative;
    left: 490px;
    top: -35px;
}

.headtxt2 {
    position: relative;
    left: 490px;
    top: -85px;
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

.red {
    color: red;
}

.edit-icon {
    position: absolute;
    right: 5px;
    padding: 5px;
}

.edit-icon1 {
    position: absolute;
    right: 5px;
    padding: 5px;

}

.name {
    margin-left: 10px;

}

.name1 {
    margin-left: 10px;
    margin-top: 20px;

}

.form-control {
    border-radius: 10px;
    border: 1px solid grey;

}

.form-control1 {
    height: 110px;
    width: 500px;
    color: grey;
    border: 1px solid grey;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

.signofftext {


    padding-right: 55px
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
        <div class="welcome-screen signOff">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='TableTop.php';">
                        <img src="assets/login.png" alt="login"
                            style="cursor:pointer;margin-top:20px;margin-left:45px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome signOff">SignOff Message
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <a><img src="assets/Group 563.png" alt="logout"
                                style="margin-top:20px;float:right;cursor:pointer;"
                                onclick="location.href='index.php';">
                    </span>
                </div>
            </div><br>
            <form action="updateSignOff.php" method="post" class="resource-form">
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row  type-select">
                            <div class="col-1 col-sm-1 col-xs-1" style="padding:0">
                                <img class="del-image" src="assets/Info button.png" alt="welcome-text">
                                <span class="tooltiptext">Please input the keyword orgplaceholder in the thank you
                                    text instead of the visiting company name. The keyword will fetch the company
                                    name from the booking application.<br>
                                    e.g. Thank you orgplaceholder for a great session!"</span>
                            </div>
                            <div class="col-3 col-sm-3 col-xs-111">
                                <div class="position-relative">

                                    <label class="name">Main Text<sup class="red">*</sup></label>

                                </div>
                            </div>
                            <div class="col-8 col-sm-8 col-xs-12">


                                <div class="input-group mb-3">
                                    <input type="text" class="form-control signofftext"Style=" border-top-right-radius: 10px;
              border-bottom-right-radius: 10px;"
                                        placeholder="Recipient's username" name="signoff_text"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="<?php echo $response['signoff_text'];?>">
                                    <img src="assets/Group 159.png" alt="editIcon" class="edit-icon">

                                </div>
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-1 col-sm-1 col-xs-1">

                            </div>
                            <div class="col-3 col-sm-3 col-xs-11">
                                <label class="name1"> Footer Text<sup class="red">*</sup>:</label>
                            </div>
                            <div class="col-8 col-sm-8 col-xs-12">
                                <div class="input-group mb-3">

                                    <textarea class="form-control signofftext" Style=" border-top-right-radius: 10px;
              border-bottom-right-radius: 10px;" placeholder="Footer Text"
                                        name="signoff_footer" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2"><?php echo $response['signoff_footer'];?></textarea>
                                    <img src="assets/Group 159.png" alt="editIcon" class="edit-icon1">



                                </div>
                            </div>
                            <div class=" row type-select">
                                <div class="col-12 text-center">
                                    <button type="submit" class="viewBtn">Save Message</button>
                                </div>

                            </div>


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
