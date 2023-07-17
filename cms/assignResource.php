<?php
include_once('security.php');
include_once('config.php');
?>
<?php
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url =  $apiBaseUrl.'cms/showAllResource.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true);

$respData = $response['resources'];
$serviceArray = array();
$sectorArray = array();
for($i=0;$i<count($respData);$i++)
{
    if($respData[$i]['ResourceType'] == 'service')
    {
        $serviceArray[]=$respData[$i];
    }
    else if($respData[$i]['ResourceType'] == 'sector')
    {
        $sectorArray[]=$respData[$i];
    }
}
 

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
    <title>KPMG || Resource Assign</title>
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
        <div class="assign-resource">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image"
                        onclick="location.href='serviceandsectors.php?id=<?=$_GET['id']; ?>'">
                        <img src="assets/login.png" Style="margin-top:20px;margin-left:55px;cursor:pointer;"
                            alt="login" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome">Assign Resource
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;" onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;"
                            onclick="location.href='index.php';">
                    </span>
                </div>
            </div>
            <form method="post" action="updateAssignResource.php">
                <div class="row justify-content-center margin-top-75">
                    <div class=" col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row  type-select">
                            <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label> Resource Type:</label>
                            </div>
                            <div class="col-6">
                                <input type="hidden" name="hotspotId" value="<?php echo $_GET['id']; ?>" />
                                <select name="ResourceType" class="form-select" aria-label="Default select example"
                                    id="resourceType" onchange="selectService()">

                                    <option value="Service">Service</option>
                                    <option value="Sector">Sector</option>
                                </select>
                            </div>
                        </div>
                        <div class="row type-select">
                            <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label> Resource Name:</label>
                            </div>
                            <div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <select name="serviceType" class="form-select" aria-label="Default select example"
                                    id="service-type">

                                </select>
                            </div>
                        </div>
                        <div class=" row type-select">
                            <div class="col-12 text-center" Style="margin-top:140px;">
                                <button type="submit" class="btn btn-primary viewBtn">Save</button>
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
    <script>
    let serviceArray = <?php echo json_encode($serviceArray);?>;
    let sectorArray = <?php echo json_encode($sectorArray);?>;
    let serviceOptions = document.getElementById("service-type");

    for (let i = 0; i < serviceArray.length; i++) {
        var option = document.createElement("option");
        //console.log(serviceArray[i])
        option.value = serviceArray[i].Id;
        option.text = serviceArray[i].ResourceName;
        serviceOptions.add(option);

    }

    function selectService() {
        let selectedValue = document.getElementById("resourceType").value;
        document.getElementById('service-type').innerHTML = "";
        if (selectedValue == "Sector") {
            for (let i = 0; i < sectorArray.length; i++) {
                var option = document.createElement("option");
                option.value = sectorArray[i].Id;
                option.text = sectorArray[i].ResourceName;
                serviceOptions.add(option);

            }
        } else {
            for (let i = 0; i < serviceArray.length; i++) {
                var option = document.createElement("option");
                option.value = serviceArray[i].Id;
                option.text = serviceArray[i].ResourceName;
                serviceOptions.add(option);

            }
        }


    }
    </script>
</body>

</html>