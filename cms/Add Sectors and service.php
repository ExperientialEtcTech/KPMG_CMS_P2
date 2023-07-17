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
.name{
  margin-left:25%;
  margin-top:100px;;
  font-size:30px;
  color:grey;
}
.name1{
  margin-left:25%;
  margin-top:200px;;
  font-size:30px;
  color:grey;
}
.text{
  margin-left:120px;
  border-radius:10px;
  border:1px solid grey;
  height:50px;
  width:400px;
  padding-left:15px;
  font-size:20px;

}

.edit{
        
        height:60px;
        width:150px;
        background-size: contain;
       background-image:url('assets/Rectangle-80.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        cursor:pointer;
        margin-left:600px;
        margin-top:10%;
        font-size:25px;
        padding-top:13px;
        text-align:center;
        position: relative;
        margin-right:30%;
     }
     #hotspot{
        width:420px;
        height:60px;
        border-radius:10px;
        font-size:30px;
        text-align:center;  
        border:1px solid grey;
        color:grey;
        margin-left:140px;
        cursor:pointer;
       
    }





    

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 60px">

<form action="select_template.php" method="post">
<div style="width: 800px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor:pointer;"onclick="location.href='serviceandsectors.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
   Add Sectors/Services</div>
</div><br><br><br>


<div>
  <label class="name"> Name</label>
  <input class="text"type="text" name="fname"><br><br><br>
  <br><label class="name1"> Type</label>
  <select id="hotspot" name="hotspot" >
<option style="display: none">Select Type</option><br><br>

  <br><option class="abc"value="select hotspot1">Service</br></option><br><br><hr><vr>
  <option value="select hotspot2" >Sector</option>
  
</select>
<div class="edit"onclick="location.href='serviceandSectors.php';">
    Save
</div>
</div>
</div>

  



</body>
</html>
