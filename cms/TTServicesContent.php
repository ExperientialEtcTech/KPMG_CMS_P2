<?php
 include_once('security.php');
    $iconUrl=   $_GET['iconUrl'];
    $labelUrl=   $_GET['labelUrl'];

    $iconName= substr($iconUrl,strrpos($iconUrl,"/")+1);
    $labelName= substr($labelUrl,strrpos($labelUrl,"/")+1);
    
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || View Resource </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
    <style>
    #cml:hover {
        background-color: #38b2d7ba !important;
        outline: none;
        border: none;
        color: #f0fff0 !important;

    }
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
        <div class="welcome-screen">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='muralResources.php';">
                        <img src="assets/login.png" alt="login" style="cursor:pointer;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    onclick="location.href='login.php';">
                    <span class="welcome resource">Show Resource
                        <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px;margin-top:20px; background-size: contain;cursor:pointer;"
                            onclick="location.href='login.php';"></div>
                    </span>
                </div>
            </div>
            <form action="d.php" method="post" class="resource-form"><br><br>
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row  type-select">
                            <div class="col-4">
                                <label> Resource Type:</label>
                            </div>
                            <div class="col-8">

                                <select id="hotspot" name="ResourceType" class="form-select user-select-none"
                                    aria-label="Default select example">

                                    <option value="Service" <?php echo $_GET['type']==='service' ? "selected":"";?>>
                                        Service</option>
                                    <option value=" Sector" <?php echo $_GET['type']==='sector' ? "selected":"";?>>
                                        Sector</option>
                                </select>
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-4">
                                <label> Resource Name:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" id="serviceOptions" name="ResourceName"
                                    class="form-control user-select-none" value="<?php echo $_GET['resourceName'];?>">
                            </div>
                        </div>

                        <div class="row type-select">
                            <div class="col-4">
                                <label> Resource Icon:</label>
                            </div>
                            <div class="col-8">
                                <button class="btn btn-primary view-file" type="button" id="cml"
                                    onclick="showFile('<?= $_GET['iconUrl']; ?>','Resource Icon')">
                                    <?= $iconName; ?>
                                </button>

                            </div>
                        </div>

                        <div class="row type-select">
                            <div class="col-4">
                                <label> Resource Label:</label>
                            </div>
                            <div class="col-8">
                                <button class="btn btn-primary view-file" type="button" id="cml"
                                    onclick="showFile('<?= $_GET['labelUrl']; ?>','Resource Label')">
                                    <?= $labelName; ?>
                                </button>

                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <div id="myModal2" class="modal">
            <div class="modal-dialog modal-xl">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="h2-title"></h2>
                        <span class="close" id="close2">&times;</span>
                    </div>
                    <div class="modal-body" id="viewModelBody" style="background: #efefef;">


                    </div>

                </div>
            </div>
        </div>

    </div>
 <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
            <div style="z-index:-99;margin:25px;font-size:0.9vw;bottom:10px;position:absolute">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
            <!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
    <script src="footer.js"></script>
    <script>
    function showFile(url, type) {
        document.getElementById("h2-title").innerText = type;
        let html = "<img src='" + url + "' alt='image' class='img-fluid'>";
        document.getElementById("viewModelBody").innerHTML = html;
        document.getElementById("myModal2").style.display = "block";

    }
    document.getElementById("close2").addEventListener("click", function() {
        document.getElementById("myModal2").style.display = "none";
    });
    </script>

</body>

</html>
