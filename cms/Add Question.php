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
    height:450px;
    border-radius:20px;
    margin-left:20%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
.name{
  margin-left:60px;
  font-size:30px;
  color:grey;
  padding-top:80px;

}
.text{
  margin-left:80px;
  border-radius:20px;
  border:1px solid grey;
  height:80px;
  width:350px;

}
.name1{
  margin-left:60px;
  font-size:30px;
  color:grey;
  margin-top:5%;
}
.text1{
  margin-left:100px;
  border-radius:20px;
  border:1px solid grey;
  height:0px;
  margin-top:5%;
  width:10px;
  

}
.name3{
  margin-top:10%;
}
.edit{
    height:60px;
    width:160px;
    background-size: contain;
    display: inline-block;
    cursor:pointer;
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 300px;
    margin-top:9%;
 
    
}
.heading{
margin-bottom:3px;
}
#hotspot{
        width:250px;
        height:50px;
        border-radius:10px;
        font-size:30px;
        text-align:center;
        border:1px solid grey;
        color:grey;
       
    }
    @media only screen and (max-width: 1200px) and (min-width:700px){
      .hello{
    border:1px solid grey;
    width:65%;
    height:450px;
    border-radius:20px;
    margin-left:20%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
.name{
  margin-left:20px;
  font-size:30px;
  color:grey;
  padding-top:80px;

}
.text{
  margin-left:30px;
  border-radius:20px;
  border:1px solid grey;
  height:80px;
  width:300px;

}
.name1{
  margin-left:20px;
  font-size:30px;
  color:grey;
  margin-top:5%;
}
.text1{
  margin-left:30px;
  border-radius:20px;
  border:1px solid grey;
  
  margin-top:5%;
  
  width:150px;
  

}
.name3{
  margin-top:10%;
}
.edit{
    height:60px;
    width:160px;
    background-size: contain;
    display: inline-block;
    cursor:pointer;
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
    cursor:pointer;
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 280px;
    margin-top:9%;
 
    
}
.heading{
margin-bottom:3px;
}
#hotspot{
        width:250px;
        height:50px;
        border-radius:10px;
        font-size:30px;
        text-align:center;
        border:1px solid grey;
        color:grey;
       
    }

    }






</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 20px">


<div style="width: 800px;height:100px;margin:auto;">
   
</div>

<div class="hello">
  <div>
    <h1 class="helloo">Add Question</h1>
  <div>
<div class="name3">
<form>
 <div> <label class="name"> Question</label>
  <input class="text"type="text"  name="fname"><br><br></div>
  <div><label class="name1">Response IT</label>
  <select class="text1" id="hotspot" name="hotspot">
    <option>Select Type Number</option>
  <option value="service" onclick="location.href='Service and Sectors.php';">TEXT</option>
  <option value="sector"onclick="location.href='Service and Sectors.php';">Number</option>
  </select>
</form>
  <div>

<div class="edit">
    <center><h3 onclick="location.href='Feedback form.php';" >Save</h3><center>
</div>


</div>
</body>
</html>