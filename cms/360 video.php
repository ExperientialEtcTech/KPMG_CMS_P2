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
        background-image: url(assets/back.png);
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
        height:50px;
        min-width:100px;
        background-size: contain;
        display: inline-block;
        margin:20px;
        color: #FFFFFF;
        text-align: center;
        font-size: 25px;
        background-color: #00338d;
        border-radius: 10px;
        cursor: pointer;
    }

    .box-selection-text {
        height:40px;
        width:100px;
        background-size: contain;
        display: inline-block;
        margin:20px;
        background-image:url('assets/Rectangle-80.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        text-align: left;
        font-size: 25px;
        vertical-align: middle;
        width:350px;
        background-image:none;
        color: #000000;
        
    }

    .vertical-center {
        margin: 0;
        position: relative;
        top: 47%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size:17px;
        text-align:center;
        
        
    }
    .vertical-centers {
        margin: 0;
        position: relative;
        top: 80%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        margin-left:50%;
        color:grey;
        font-size:25px;
    }
    .add-button {
        right:10px;
        bottom:10px;
        position: fixed;
    }
    .video-form {
        max-width: 800px;
        margin: 20px auto 0px auto;
    }
    .video-form-row {
        display: flex;
        margin-bottom: 10px;
        align-items: center;
        justify-content: center;
    }
    .video-form-row .box-selection:first-of-type {
        min-width: 300px;
    }
</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">


<div style="width: 1000px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='vrscreen.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
360 Video<div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"onclick="location.href='login.php';"></div>
</div>




<div class="video-form">
    <div class="video-form-row">
        <div class="box-selection">
            <div class="vertical-center">
                Item 01
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center">
                View
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center"  onclick="location.href='EditServices_2.php';">
                Edit
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center" onclick="location.href='TTServices.php?ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($pageName); ?>&delId=<?php echo $service['Id']; ?>'">
                Delete
            </div>
        </div>
    </div>
    <div class="video-form-row">
        <div class="box-selection">
            <div class="vertical-center">
                Item 01
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center">
                View
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center"  onclick="location.href='EditServices_2.php';">
                Edit
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center" onclick="location.href='TTServices.php?ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($pageName); ?>&delId=<?php echo $service['Id']; ?>'">
                Delete
            </div>
        </div>
    </div>
    <div class="video-form-row">
        <div class="box-selection">
            <div class="vertical-center">
                Item 01
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center">
                View
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center"  onclick="location.href='EditServices_2.php';">
                Edit
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center" onclick="location.href='TTServices.php?ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($pageName); ?>&delId=<?php echo $service['Id']; ?>'">
                Delete
            </div>
        </div>
    </div>
    <div class="video-form-row">
        <div class="box-selection">
            <div class="vertical-center">
                Item 01
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center">
                View
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center"  onclick="location.href='EditServices_2.php';">
                Edit
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center" onclick="location.href='TTServices.php?ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($pageName); ?>&delId=<?php echo $service['Id']; ?>'">
                Delete
            </div>
        </div>
    </div>
    <div class="video-form-row">
        <div class="box-selection">
            <div class="vertical-center">
                Item 01
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center">
                View
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center"  onclick="location.href='EditServices_2.php';">
                Edit
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center" onclick="location.href='TTServices.php?ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($pageName); ?>&delId=<?php echo $service['Id']; ?>'">
                Delete
            </div>
        </div>
    </div>
    <div class="video-form-row">
        <div class="box-selection">
            <div class="vertical-center">
                Item 01
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center">
                View
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center"  onclick="location.href='EditServices_2.php';">
                Edit
            </div>
        </div>
        <div class="box-selection">
            <div class="vertical-center" onclick="location.href='TTServices.php?ParentId=<?php echo $parentId; ?>&Service=<?php echo urlencode($pageName); ?>&delId=<?php echo $service['Id']; ?>'">
                Delete
            </div>
        </div>
    </div>
</div>

<div class="add-button"><img src="assets/Add Button.png"></div>
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