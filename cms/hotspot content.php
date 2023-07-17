<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KPMG</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
</head>
<body>
<form action="select_template.php" method="post">
    <div class="container hotspot-content position-relative">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow" onclick="location.href='vrscreen.php';">
                Back
            </a>
            <h1>Hotspot Content</h1>
        </div>
        <div class="content-block">
            <button class="btn-custom" onclick="location.href='360 video service 1.php';">
                Service 01
            </button>
            <button class="btn-custom" onclick="location.href='360 video service 2.php';">
                Service 01
            </button>
            <button class="btn-custom" onclick="location.href='360 video service 3.php';">
                Service 01
            </button>
        </div>
        
        <div class="add-button" onclick="location.href='Add Hotspot.php';">
            add button
        </div>
    </div>
</form>

</body>
</html>
