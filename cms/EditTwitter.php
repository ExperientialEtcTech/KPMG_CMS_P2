<?php
include_once('security.php');

include_once('config.php');
include_once('jwt.php');
if(isset($_GET['id'])){
	$id = $_GET['id']; 
}

if(isset($_POST['submit'])){
	$inputHandle = $_POST['handle'];
	//echo $inputHandle;
	$postData = array("id"=>$id, "twitter_handles"=>$inputHandle);
	$url = $apiBaseUrl.'cms/editTwitterHandles.php';

	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
	//alert($inputHandle);
	//$response = json_decode($jsonResponse,true)['handles'];
}
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
  margin-left:120px;
  font-size:30px;
  color:grey;
  padding-top:70px;

}
.text{
  margin-left:40px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:250px;

  
  
}

.name3{
  margin-top:13%;
}
.edit{
    height:60px;
    width:150px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 230px;
    margin-top:15%;
 
    
}
@media only screen and (max-width: 1200px) and (min-width:700px){
  .hello{
    border:1px solid grey;
    width:70%;
    height:400px;
    border-radius:20px;
    margin-left:20%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
.name{
  margin-left:70px;
  font-size:30px;
  color:grey;
  padding-top:70px;

}
.text{
  margin-left:40px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:250px;
  

  
  
}

.name3{
  margin-top:13%;
}
.edit{
    height:60px;
    width:150px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 240px;
    margin-top:15%;
 
    
}

}







</style>
<body>
<div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 20px">


<div style="width: 800px;height:100px;margin:auto;">

    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"onclick="location.href='Twitter.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
    Add Twitter</div>
</div>


<div class="hello">
  <div>
    <h1 class="helloo">Add Twitter</h1>
  <div>
<div class="name3">
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id = "subform">
 <div> <label class="name">TwitterHandle</label>

 
 <input class="text"type="text" id ="handle" name="handle"style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;height:40px;background-position:right;"/></div>
  <div class="edit">
	<center><input type="submit" name="submit" value = "submit" /><center>
</div>
 
</form>
  <div>

</div>

</body>
</html>
