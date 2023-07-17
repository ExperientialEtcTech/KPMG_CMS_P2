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

    .btn{
        
        height: 65px;
        width:155px;
        margin-top:70px;
        margin-left: 50px;
        border-radius: 15px;
        border: none;
        margin-bottom:50px;
        background-color:darkblue;
        color:white;
        cursor: pointer;
        font-size: 20px;
    }
    .btn1{
        
        height: 65px;
        width:155px;
        margin-left: 50px;
        border-radius: 15px;
        border: none;
        
    }
    .btn2{
        
        height: 65px;
        width:130px;
        
        margin-left: 50px;
        border-radius: 15px;
        border: none;
        
        
    }
    .add-button {
        right:30px;
        bottom:10px;
        float:right;
        
    }
    .lbl{
        font-size:25px;
        color:Grey;
        padding-left:200px;
        padding-top:200px;
    }
    .img{
        padding-left:40px;
    
       
    }

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">

<form action="select_template.php" method="post">
<div style="width: 800px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='TableTop.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
Services

</div>
</div>

<div style="width: 1200px;height:100px;margin:auto;">
    <label class="lbl">Item 01</label>
     <button class="btn" onclick="location.href='ItemSubServices.php';" >
     View Sub Service
    </button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='FirstLevelServices_2.php';">View Content</button>
      <button class="btn2" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='EditService.php';">Edit</button>
      <img class="img"src="assets/Delete icon.png">
</div>
<div style="width: 1200px;height:100px;margin:auto;">
    <label class="lbl">Item 02</label>
    
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='ItemSubServices.php';">View<br> Sub Service</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">View Content</button>
      <button class="btn2" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='';">Edit</button>
      <img class="img"src="assets/Delete icon.png">
</div>
<div style="width: 1200px;height:100px;margin:auto;">
    <label class="lbl">Item 03</label>
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='ItemSubServices';">View<br> Sub Service</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">View Content</button>
      <button class="btn2" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='';">Edit</button>
      <img class="img"src="assets/Delete icon.png">
</div>
<div style="width: 1200px;height:100px;margin:auto;">
    <label class="lbl">Item 04</label>
     <button class="btn" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='ItemSubServices';">View<br> Sub Service</button>
      <button class="btn1" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='">View Content</button>
      <button class="btn2" style="background-color: darkblue;color:white;font-size: 20px;" onclick="location.href='';">Edit</button>
      <img class="img"src="assets/Delete icon.png">
</div>

    <div class="add-button"><img src="assets/Add Button.png"></div>

    

</form>
        </div>
      
</body>
</html>
