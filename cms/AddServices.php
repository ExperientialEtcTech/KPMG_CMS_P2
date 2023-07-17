<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || Add Services</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
</head>
<body>
<form action="services.php" method="post">
    <div class="container add-services">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow" onclick="location.href='services.php';">
                Back
            </a>
            <h1>Add Services</h1>
        </div>
        <div class="content-block">
            <div class="text-box-container">
                <input type="text" class="text-box">
            </div>
            <button class="btn-custom">
                Save
            </button>
        </div>
    </div>
</form>
</body>
</html>