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
        height:30px;
        width:200px;
       
        display: inline-block;
        
       
        
        
        text-align: center;
        font-size: 25px;
        
        
    }

    .box-selection-text {
        height:40px;
        width:100px;
        background-size: contain;
        display: inline-block;
        margin:20px;
        
        
        
        text-align: left;
        font-size: 25px;
        vertical-align: middle;
        width:450px;
       
        
        
    }

    .vertical-center {
        margin: 0;
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        margin-right:50%;
        
    }
    .vertical-centers {
        margin: 0;
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        margin-left:40%;
        font-size:30px;
        color:grey;
    }
    .text1{
        border:1px solid grey;
        height:50px;
        width:300px;
        border-radius: 10px;
    }
    .edit{
    height:1000px;
    width:250px;
    background-size: contain;
    display: inline-block;
    margin:20px;
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
    text-align:center;
    font-size: 25px;
    vertical-align: middle;
    margin-left: 350px;
    margin-top:50px;
    padding-bottom:50px;
}

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">

<form action="select_template.php" method="post">
<div style="width: 800px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;" onclick="location.href='SignOff.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
    EditSignOffMessage</div>
</div>

<div style="width: 1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
          Name
        </div>
    </div>
    <div class="box-selection">
        <div class="vertical-center">
        <input class="text1" type="text" id="lname" name="lname" value=""style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;background-position:right;">
        </div>
    </div>
    
    
</div>

<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
            Meeting
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
        <input class="text1" type="text" id="lname" name="lname" value=""style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;background-position:right;"> 
        </div>
    </div>
    
</div>

<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
            Subject
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
        <input  class= "text1" type="text" id="lname" name="lname" value="" style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;background-position:right;">
        
        </div>
    </div>
    
</div>


<div style="width:  1000px;margin:auto;height:100px;">
    <div class="box-selection-text">
        <div class="vertical-centers">
      
           Date and time    
        </div>
    </div>
    <div class="box-selection" >
        <div class="vertical-center">
        <input class="text1" type="text" id="lname" name="lname" value=""style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;background-position:right;">
        </div>
    </div>
    <div class="edit">
    <h3>Add Message</h3>
</div>
    
</div>




</form>
        </div>
</body>
</html>
