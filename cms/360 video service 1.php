<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script type="text/javascript" language="javascript"></script>

    <title>KPMG</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
</head>
<style>

    body{
       
        margin: 0px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }


    @font-face {    
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    p{
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    .box-selection {
        height:80px;
        width:120px;
        background-size: contain;
        display: inline-block;
        margin:20px;
        background-image:url('assets/Rectangle-80.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        text-align: center;
        font-size: 25px;
        
        
    }

    .box-selection-text {
        height:80px;
        width:80px;
        background-size: contain;
        display: inline-block;
        
        background-image:url('assets/Rectangle-80.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        text-align: center;
        font-size: 25px;
        vertical-align: middle;
        width:350px;
        background-image:none;
        color: #000000;
        
    }

    .vertical-center {
        margin: 0;
        position: relative;
        top: 30%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size:20px;

        
    }
    .vertical-centers {
        margin: 0;
        position: relative;
        top: 60%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        margin-left:20%;
        color:grey;
        font-size:25px;
    }
    .img1{
        float:right;
        padding-right:200px;
    }
    .box-selection1 {
        height:80px;
        float: right;
        width:27%;
        top:60%;
 }
 
 .add-button {
        right:10px;
        bottom:10px;
        position: fixed;
    }
    
    .del-image {
        height:32px;
        margin-top:13%;
        
    }

    

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">

<form action="select_template.php" method="post">
<div style="width: 800px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='hotspot content.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
Service 1 - 360 Video</div>
</div>

<div style="width: 1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
            Hotspot 1
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center" data-bs-toggle="modal" data-bs-target="#viewVideoModal">
            View
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            Edit
        </div>
    </div>
    <div class="box-selection1">
        <div class="vertical-center1">
        <img class="del-image"src="assets/Delete.png">
        </div>
    </div>
</div><br>

<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
        Hotspot 2
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center" data-bs-toggle="modal" data-bs-target="#viewVideoModal">
            View
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            Edit
        </div>
    </div>
    <div class="box-selection1">
        <div class="vertical-center1">
        <img class="del-image"src="assets/Delete.png">
        </div>
    </div>
</div><br>

<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
        Hotspot 3
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center" data-bs-toggle="modal" data-bs-target="#viewVideoModal">
        view
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            Edit
        </div>
    </div>
    <div class="box-selection1">
        <div class="vertical-center1">
        <img class="del-image"src="assets/Delete.png">
        </div>
    </div>
    
</div>
<div class="add-button"><img src="assets/Add Button.png"></div>







</form>
        </div>

        <div class="modal fade" id="viewVideoModal" tabindex="-1" aria-labelledby="viewVideoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewVideoModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <video width="100%" height="500" controls class="video">
                            <source src="<?php echo $response['bg_vid']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>
