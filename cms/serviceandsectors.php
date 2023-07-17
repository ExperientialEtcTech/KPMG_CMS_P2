<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
if($_GET["id"]){
	$Hotspot_id = $_GET['id'];
	$postData = array("Hotspot_id"=>$Hotspot_id);
	$url = $apiBaseUrl.'cms/showResource.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$respData = json_decode($jsonResponse,true)['resources'];
	//print_r($respData);
    $serviceArray = array();
    $sectorArray = array();


    if(array_key_exists("status",$respData)==false){
        for($i=0;$i<count($respData);$i++)
        {
            if($respData[$i]['ResourceType'] == 'service')
            {
                $serviceArray[]=$respData[$i];
				//print_r($respData[$i]);
            }
            else if($respData[$i]['ResourceType'] == 'sector')
            {
                $sectorArray[]=$respData[$i];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Services &amp; Sectors</title>
     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>-->
    <script src="assets/js/jquery-3.6.0.js"></script>
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
</head>

<body class="body-bg">
	  <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <div class="container-lg">
        <div class="welcome-screen serviceSector">
            <div class="row justify-content-center align-items-center">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='muralHotspot.php';">
                        <img src="assets/login.png" alt="login" style="cursor:pointer;margin-left:53px;margin-top:13px;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"style="margin-top:5px;">
                    <span class="welcome signOff">Services &amp; Sectors
                    <img src="assets/Logout button.png" alt="logout" style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"onclick="location.href='login.php';">
                    
                    <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"onclick="location.href='index.php';">
                    </span>
                </div>
            </div>
            <div class="row margin-top-75">
                <div class="col-12 col-md-6 col-lg-6 serviceCol border-solid">
                    <div class="service-sector-name">Services</div>

                    <?php
                    if(!empty($serviceArray)){
                         for ($i=0; $i < count($serviceArray); $i++) { 
                            echo '<div class="row justify-content-center align-items-center">';
                            ?>
                    <div class="col-8">
                        <button type="button" class="btn btn-primary"
                            onclick="window.location='usecase.php?hotspotId=<?php echo $Hotspot_id; ?>&resourceId=<?php echo $serviceArray[$i]['Id'];?>'">
                            <?php echo $serviceArray[$i]['ResourceName'];?>
                        </button>
                    </div><?php
     
                echo '<div class="col-2 deleteIcon"><a
                        href="unassignResource.php?id='.$serviceArray[$i]['Id'].'&hotspotId='.$Hotspot_id.'"><img
                            src="assets/Delete icon.png"></a></div>
            </div>';

            }

            # code...
            }
            else{
            // echo "<div class='no-data'>Services is not Available</div>";
            }
            ?>
                </div>
                <div class=" col-12 col-md-6 col-lg-6 sectorCol">
                    <div class="service-sector-name">Sectors</div>
                    <?php
                    if(!empty($sectorArray)){
                         for ($i=0; $i < count($sectorArray) ; $i++) { 
                            echo '<div class="row justify-content-center align-items-center">';
                            ?>
                    <div class="col-8">
                        <button type="button" class="btn btn-primary"
                            onclick="window.location='usecase.php?hotspotId=<?php echo $Hotspot_id; ?>&resourceId=<?php echo $sectorArray[$i]['Id'];?>'">
                            <?php echo $sectorArray[$i]['ResourceName'];?>
                        </button>
                    </div>
                    <?php
                        echo '<div class="col-2 deleteIcon"><a href="unassignResource.php?id='.$sectorArray[$i]['Id'].'&hotspotId='.$Hotspot_id.'"><img src="assets/Delete icon.png"></a></div></div>';
                         }
                          
                          
                         }
                         else{
                            // echo "<div class='no-data'>Sector is not Available</div>";
                         }
                    ?>
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
    <div class="img1 muralAddImage">
        <a href="assignResource.php?id=<?= $Hotspot_id;?>"><img src="assets/Add Button.png" alt="Add Image"
                id="AddImage"></a>
    </div>


</body>

</html>