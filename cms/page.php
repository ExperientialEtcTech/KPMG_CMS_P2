<?php
include_once('security.php');
?>
<!DOCTYPE html>   
<html>   
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title> Login Page </title> 
<style> 
 
a{
    text-decoration:none;
}
button .btn{
    margin-left:400px;
}
h1{
    margin-top:100px;
    color:blue;
}
input[type=text]{
        width: 25%;   
        margin: 8px 0;  
        padding: 20px 20px;   
        display: inline-block;  
        border:1px solid; 
        border-radius:10px;
        margin-top:20px;
        margin-left:100px;
         
        box-sizing: border-box; 

    }
   label{
       font-size:2em;
       color:grey;
   } 
   button{
    background-color: blue;  
       width: 10%;  
           
        padding: 15px;   
        margin: 10px 0px;   
        border-radius:10px;   
        cursor: pointer;  
        margin:70px;
         } 
a {
     color:White;
     font-size:2em;
     
 }         
   

</style>
<body>
<center> <h1> Event Details </h1> </center>
<div class="container">
<form>
<a  id="abc" href="index.php"><</a> 
  <center><label for="fname">Event name</label>
  <input type="text" id="fname" name="fname"><br><br><br>

  <label for="lname">Event time</label>
  <input type="text" id="lname" name="lname"><br><br>
  <button type="submit"><a href="Add Hotspot.php">continue</a></button></center>
</form>
</div>
</body>