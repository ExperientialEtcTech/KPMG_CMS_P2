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
    .hello{
    border:1px solid grey;
    width:50%;
    height:400px;
    border-radius:20px;
    margin-left:20%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
.name{
  margin-left:80px;
  font-size:30px;
  color:grey;
  pa-top:80px;

}
.text{
  margin-left:180px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:250px;

}
.name1{
  margin-left:100px;
  font-size:30px;
  color:grey;
  margin-top:5%;
}
.text1{
  margin-left:180px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  margin-top:5%;
  width:250px;
  

}
.name3{
  margin-top:18%;
  margin-left:39%;
  color:grey;

}
.edit{
    height:60px;
    width:160px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 230px;
    margin-top:5%;
 
    
}
.heading{
margin-bottom:3px;
}
.name4{
  height:60px;
    width:150px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
    text-align:center;
    font-size:25px;
    padding-top:14px;
    margin-left:36%;

}
.name5{
  height:60px;
    width:150px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
    text-align:center;
    font-size:25px;
    padding-top:15px;
    margin-left:36%;

}
@media only screen and (max-width: 1300px) and (min-width:700px){
.hello{
    border:1px solid grey;
    width:50%;
    height:430px;
    border-radius:20px;
    margin-left:20%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
.name{
  margin-left:80px;
  font-size:30px;
  color:grey;
  pa-top:80px;

}
.text{
  margin-left:180px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:250px;

}
.name1{
  margin-left:100px;
  font-size:30px;
  color:grey;
  margin-top:5%;
}
.text1{
  margin-left:180px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  margin-top:5%;
  width:250px;
  

}
.name3{
  margin-top:28%;
  margin-left:39%;
  color:grey;

}


.name4{
  height:60px;
    width:150px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
    text-align:center;
    font-size:25px;
   
    margin-left:36%;
    

}
.name5{
  height:60px;
    width:150px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
    text-align:center;
    font-size:25px;
   
    margin-left:36%;
    margin-top:3%;

}
}









</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 20px">


<div style="width: 800px;height:100px;margin:auto;">
   
</div>

<div class="hello">
  <div>
    <h1 class="helloo">Add Kalediscope</h1>
  <div>
<div class="name3">
   
     <h3>Slide name</h3>
    
</div> 
<div class="name4">select side</div>  
  <div><br>
  <div class="name5"onclick="location.href='kalediscope.php';">Save</div>  
  <div>





</div>
</body>
</html>
