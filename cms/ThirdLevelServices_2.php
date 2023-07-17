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
    .btn{
        
        height: 55px;
        width:290px;
        margin-top:10px;
        margin-left: 250px;
        border-radius: 15px;
        border: none;
        margin-bottom:50px;
        background-color:darkblue;
        color:white;
    }
    .btn1{
        
        height: 55px;
        width:140px;
        margin-left: 250px;
        border-radius: 15px;
        border: none;
        
    }
    .add-button {
        padding-right:140px;
        
        float:right;
        
    }

    
    

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">

<form action="select_template.php" method="post">
<div style="width: 800px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='SecondLevelServices_2.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
Third Level Services</div>
</div>

<div style="width: 1200px;height:100px;margin:auto;">
    
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;" >Item 01</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">Delete </button>
     
      
</div>
<div style="width: 1200px;height:100px;margin:auto;">
    
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;">Item 02</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">Delete </button>
     
      
</div>
<div style="width: 1200px;height:100px;margin:auto;">
    
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;" >Item 03</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">Delete </button>
     
      
</div>
<div style="width: 1200px;height:100px;margin:auto;">
    
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;" >Item 04</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">Delete </button>
      
</div>
<div class="add-button"><img src="assets/Add Button.png"></div>


</form>
        </div>
</body>
</html>
