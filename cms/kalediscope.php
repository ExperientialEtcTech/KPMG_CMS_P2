<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/showKeleidoscope.php';
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true)['files'];
$lastOrder = $response[count($response)-1]['VideoOrder']+1;      



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/stylewelcome.css">
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->

    <title>KPMG || Kaleidoscope</title>
</head>
<style>
body {

    margin: 0px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
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
    height: 40px;
    width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    cursor: pointer;
    background-repeat: no-repeat;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    margin-top: 50px;
    cursor: pointer;


}

.box-selection-text {
    height: 40px;
    width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    background-image: url('assets/Rectangle-80.png');
    background-repeat: no-repeat;
    color: #FFFFFF;
    text-align: left;
    font-size: 25px;
    vertical-align: middle;
    width: 200px;
    background-image: none;
    color: #000000;
    margin-top: 50px;


}

.vertical-center {
    margin: 0;
    position: relative;
    top: 70%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);


}

.vertical-centers {
    margin: 0;
    position: relative;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    /* margin-left: %;
    color: grey; */


}

.img1 {
    float: right;
}

.add-button {
    right: 10px;
    bottom: 10px;
    position: fixed;

}

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
    /* outline: none;
    border: none; */
    color: #f0fff0;
    cursor: pointer;
    transition: 0.1s;
}

.box {
    height: 90px;
    width: 100px;
    display: inline-block;
    margin: 20px;
    position: relative;
    top: 35px;
    vertical-align: middle;
}

#KaleidoscopeModal {

    margin: 0 auto;
    display: none;

}

video {
    width: 100%;
}
</style>

<body>
    <!-- Added by shubham Jadhav - for logo - 14/1 - start  -->
    <div style="margin:15px">
        <img src = "./assets/KPMG_logo.png" style = "width:15%;vertical-align:middle">
        <span style="vertical-align:middle;font-size:3vw;">Innovation Kaleidoscope Centre</span>
    </div>
    <!-- Added by shubham Jadhav - for logo - 14/1 - end  -->
    <!-- <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px"> -->
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;top: 50px">


        <div style="width: 1000px;height:100px;margin:auto;">
            <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor: pointer;"
                onclick="location.href='table top idle state.php';"></div>
            <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
                Kaleidoscope
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                    onclick="location.href='index.php';">
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';"></div>
                </div>
                <?php
$i=1;
foreach ($response as $value) {
  ?>
                <div style="width: 1000px;margin:auto;height:100px;">
                    <div class="box-selection-text">
                        <div class="vertical-centers">
                            <?php echo "Slide ".$i; ?>
                        </div>
                    </div>

                    <div class="box">
                        <button type="button" class="btn"
                            onClick="viewImage('<?php echo $value['slides']; ?>','<?php echo $i;?>')">view</button>
                    </div>

                    <div class="box-selection">
                        <a href="deleteKalediscope.php?kaleidoscope=<?php echo $value['VideoOrder'];?>">
                            <img src="assets/Delete icon.png" alt="imf"></a>
                    </div>
                </div>
					  <?php
			 if($i >= (count($response))){
			?>
		
			 <!-- Added by shubham Jadhav - for copyright footer  - 14/1 - start  -->
           
            <div style="z-index:-99;margin:25px;text-align:left;font-size:0.9vw;bottom:10px;position:relative;color:black;">
                &copy; <span>2023 KPMG Assurance and Consulting Services LLP, an Indian Limited Liability Partnership and a member firm of the KPMG global organization of independent member firms affiliated with KPMG International Limited ("KPMG International"), an English Company limited by guarantee. All rights reserved. The KPMG name and logo are registered trademarks of KPMG International.
 KPMG Assurance and Consulting Services LLP has entered into sub-license arrangements with certain entities in India. These application(s) are also for the use of such sub-licensees in India.</span>
            </div>
			<!-- Added by shubham Jadhav - for copyright footer - 14/1 - end  -->
           <?php
			 }
			?>
                <?php
  $i++;
}
?>
				</div>
			</div>
                <div id="KaleidoscopeModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close" id="close">&times;</span>
                            <h2 id="slide-text"></h2>
                        </div>
                        <div class="modal-body" id="modal-data">

                        </div>

                    </div>

                </div>

            </div>
            <div class="add-button"><a href="addKalediscope.php?order=<?php echo $lastOrder;?>">
                    <img src="assets/Add Button.png" alt="img"></a></div>
		
		
            <script src="footer.js"></script>
            <script>
            const span = document.getElementById("close");
            const modal = document.getElementById('KaleidoscopeModal');

            function viewImage(event, i) {

                let video = document.getElementsByTagName('video');
                let url = new URL(event);
                let html =

                    ` <video controls class="video" id="video-container"><source src=${url.href} id="kal-slide" type="video/mp4">Your browser does not support the video tag.</video>"`;
                console.log(html)
                document.getElementById("modal-data").innerHTML = html;
                document.getElementById("slide-text").innerHTML = "Slide " + i;
                modal.style.display = "block";

            }
            span.onclick = function() {
                modal.style.display = "none";
                document.getElementById("modal-data").innerHTML = "";
                let video = document.getElementById("video-container")
                if (video) {
                    video.pause();
                };
            }
            window.onclick = function(event) {
				let video = document.getElementById("video-container")
                if (video) {
                    video.pause();
                };
                console.log(event.target.id);
                if (event.target.id == "myModal") {
                    modal.style.display = "none";
                }
            }
            </script>
</body>

</html>