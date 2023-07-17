<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
if($_GET["hotspotId"]){
	$Hotspot_id = $_GET['hotspotId'];
	$resourceId = $_GET['resourceId'];
	$postData = array("HotspotId"=>$Hotspot_id,"HotspotResourceId"=>$resourceId);
	$url = $apiBaseUrl.'cms/showResourceContent.php';
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	$respData = json_decode($jsonResponse,true)['content'];

}
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
    <title>KPMG || Usecases</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
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
        <div class="welcome-screen usecase">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image"
                        onclick="location.href='serviceandsectors.php?id=<?= $Hotspot_id;?>';">
                        <img src="assets/login.png" alt="login" style="cursor:pointer;" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font">
                    <span class="welcome signOff">Usecases
                        <img src="assets/Logout button.png" alt="logout"
                            style="margin-top:20px;float:right;padding-left:20px;cursor:pointer;"
                            onclick="location.href='login.php';">

                        <img src="assets/Group 563.png" alt="logout" style="margin-top:20px;float:right;cursor:pointer;"
                            onclick="location.href='index.php';">
                    </span>
                </div>
            </div>
            <?php 
            if(array_key_exists("status",$respData)==false){
                for ($i=0; $i <count($respData) ; $i++) { 
                    ?>
            <div class="row justify-content-md-center margin-top-10">
                <div class="col-5">
                    <button type="button" class="btn btn-primary name pointer-event">
                        <?php 
                        if($respData[$i]['FileType']!=="text"){

                            $file=$respData[$i]['FilePath'];
                            $pos =strrpos($file,"/");
                            echo urldecode(substr($file,$pos+1));
                        }
                        else{
                            echo "Text";
                        }
                        ?>
                    </button>
                </div>
                <div class="col-1"></div>
                <div class="col-4">
                    <button type="button" class="btn btn-primary"
                        onclick="showContent('<?= $respData[$i]['FilePath'];?>','<?= $respData[$i]['FileType'];?>')">
                        View</button>
                    <button type="button" class="btn btn-primary"
                        onclick="window.location='deleteUsecase.php?id=<?= $respData[$i]['ID'];?>&resourceId=<?= $_GET['resourceId'];?>&hotspotId=<?= $_GET['hotspotId'];?>'">
                        Delete</button>
                </div>
            </div>
            <?php
                    
                }
            }
            else{
                  echo ' <div class="row justify-content-md-center margin-top-10 no-content">
               
                <div class="col-12">
                    <h1 class="d-flex align-items-center justify-content-center"> No content available</h1>
                </div>
            </div>';
            }
            
            ?>
            <div id=" changeViewModelUpdate" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Welcome Video</h2>
                        <span class="close" id="closeChangeViewModelUpdate">&times;</span>
                    </div>
                    <div class="modal-body" id="changeViewBody">

                    </div>

                </div>

            </div>

        </div>
        <div id="viewUseCase" class="modal">
            <div class="modal-dialog modal-xl">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="model-text">Content</h2>
                        <span class="close" id="closeUseCaseModal">&times;</span>
                    </div>
                    <div class="modal-body" id="changeUseCaseBody">

                    </div>
                </div>
            </div>

        </div>
        <div class="img1 muralAddImage">
            <a href="addUsecase.php?id=<?=$_GET['hotspotId'];?>&resourceId=<?=$_GET['resourceId'];?>"><img
                    src="assets/Add Button.png" alt="Add Image" id="AddImage"></a>
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
    function showContent(url, type) {
        let html = "";
        if (type == "image") {
            html = "<img src='" + url + "' alt='image' class='img-fluid'>";
        } else if (type == "video") {
            html =
                "<video controls id='video-src' width='300'><source src='" +
                url +
                "' type='video/mp4'></video>";
        } else if (type == "pdf") {
            html = `<iframe   src="${url}">`;
        } else if (type == "text") {
            html = `<h3 class="modal-text"> ${url}</h3>`;
        } else {
            html = "<span>Preview is not available</span>";
        }
        document.getElementById("changeUseCaseBody").innerHTML = html;
        document.getElementById("viewUseCase").style.display = "block";
    }
    document.getElementById("closeUseCaseModal").addEventListener("click", function() {
        document.getElementById("viewUseCase").style.display = "none";
    });
    // window.addEventListener('click', function() {
    //     document.getElementById("viewUseCase").style.display = "none";
    // });
    </script>
</body>

</html>