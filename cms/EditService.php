<?php
include_once('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
    <title>KPMG</title>
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
        width:500px;
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
    .text{
        margin-left: 30%;
        border:solid grey;
        font-size:25px;
        
    }
    .edit{
        
        height:60px;
        width:150px;
        background-size: contain;
       background-image:url('assets/Rectangle-80.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        
        margin-left:400px;
        margin-top:1%;
        font-size:25px;
        padding-top:13px;
        text-align:center;
        position: relative;
     }
     .btn{
        
        height: 65px;
        width:250px;
        margin-top:10px;
        margin-left: 400px;
        border-radius: 15px;
        border: none;
        margin-bottom:50px;
        background-color:darkblue;
        color:white;
        font-size:25px;
    }

    

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">


<div style="width: 800px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='Services_2.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
Edit Service </div>
</div>
<input class="text" type=text placeholder="Search Logo"style="width: 540px;height: 60px; border-radius: 10px;background-image:url('assets/Group 348.png');background-repeat:no-repeat;padding-left:30px;background-position:right;">
<div style="width: 1000px;margin:auto;height:100px;">

    <div class="box-selection-text">
        <div class="vertical-centers">
           1. Service 01
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            Select
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            View
        </div>
    </div>
    
</div>

<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
        2. Service 02
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            Select
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            View
        </div>
    </div>
    
</div>

<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
        3. Service 03
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
        Select
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            View
        </div>
    </div>
    
    
</div>
<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
        4. Service 04
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
        Select
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
            View
        </div>
    </div>
    <div>
    <button class="btn"onclick="location.href='Services_2.php';">Save</button>
</div>
    
    
</div>









        </div>
</body>
</html>
