<?php
include_once('security.php');
?>
<?php
include_once('config.php');
include_once('jwt.php');
if(isset($_POST['save']))
{
	$errMsg="";
	
	$postData = array();
	$url = 'https://api.openweathermap.org/data/2.5/weather?q='.$_POST["fname"].'&mode=json&units=metric&APPID='; // insert actual APPID
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data');
	$response = json_decode($jsonResponse,true);

	if($response['cod']!="200")
	{
		$errMsg="Invalid City";
	} else {
		$postDataSave = array("cities"=>$_POST['fname'], "CityType"=>$_POST['hotspot']);
		$urlSave = $apiBaseUrl.'cms/addWeatherCity.php';

		$jsonResponse = rest_call('POST',$urlSave, $postDataSave,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
		header("Location : weather.php");
		exit;
		//hotspot
	}
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
	<style>
		*,
*::before,
*::after {
  box-sizing: border-box;
}

@media (prefers-reduced-motion: no-preference) {
  :root {
    scroll-behavior: smooth;
  }
}
	.ui-helper-hidden-accessible { display:none; }
	.ui-menu-item{
		background-color: white;
		border-style: solid;
		width:200px;
	}
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
    height:465px;
    border-radius:20px;
    margin-left:20%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
label {
  font-size:30px;
  color:grey;
}
.text{
  margin-left:40px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:300px;
  font-size: 20px;
  font-family: 'UNIVERSFORKPMG-BOLD';
  src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
  color: grey;
}

.name3{
  margin-top:15%;
}
.edit{
    height:50px;
    width:170px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 270px;
    margin-top:12%;
 
    
}
.heading{
margin-bottom:3px;
}
#hotspot{
        font-size:30px;
        text-align:center;
        border:1px solid grey;
        color:grey;

}
@media only screen and (max-width: 1200px) and (min-width:900px) {
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
  margin-left:40px;
  font-size:30px;
  color:grey;
  padding-top:80px;

}
.text{
  margin-left:40px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:300px;
  font-size: 20px;
  font-family: 'UNIVERSFORKPMG-BOLD';
  src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
}

.name3{
  margin-top:15%;
}
.edit{
    height:50px;
    width:170px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 200px;
    margin-top:15%;
 
    
}
.heading{
margin-bottom:3px;
}


  
}
@media only screen and (max-width: 900px)and (min-width:400px){
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
  margin-left:40px;
  font-size:30px;
  color:grey;
  padding-top:80px;

}
.text{
  margin-left:15px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:150px;

}

.name3{
  margin-top:15%;
}
.edit{
    height:50px;
    width:170px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 130px;
    margin-top:25%;
 
    
}
.heading{
margin-bottom:3px;
}

}
@media only screen and (max-width: 800px)and (min-width:500px){
.hello{
    border:1px solid grey;
    width:55%;
    height:400px;
    border-radius:20px;
    margin-left:20%;
    margin-top:30%;
}
.helloo{
    text-align:center;
    color:darkblue;
}
.text{
  margin-left:15px;
  border-radius:20px;
  border:1px solid grey;
  height:50px;
  width:200px;

}

.name3{
  margin-top:15%;
}
.edit{
    height:50px;
    width:170px;
    background-size: contain;
    display: inline-block;
   
    background-image:url('assets/Rectangle-80.png');
    background-repeat:no-repeat;
    color: #FFFFFF;
   
    font-size: 18px;
    padding-bottom:60px;
    margin-left: 130px;
    margin-top:25%;
}
.heading{
margin-bottom:3px;
}

}

input:focus, input:focus-visible {
		outline: none;
	}

  .add-weather-form {
        max-width: 700px;
        margin: 20px auto 0px auto;
    }
    .add-weather-form-row {
        display: flex;
        margin-bottom: 50px;
        align-items: center;
        justify-content: center;
    }
    .add-weather-form-row .box-selection:first-of-type {
        min-width: 300px;
    }
    .btn-custom-small {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-width: 270px;
        height: 60px;
        color: #fff;
        background: #00338d;
        font-size: 22px;
        text-decoration: none;
        border-radius: 10px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        cursor: pointer;
        border: 0px;
        padding: 0px 30px;
    }
    .justify-content-between {
        justify-content: space-between;
    }
    .justify-content-center {
        justify-content: center;
    }
	input[type='text'] {
		border-radius: 10px;
		border: solid 1px grey;
		background-image: url('assets/Group 159.png');
		background-size: 24px;
		background-repeat: no-repeat;
		background-position: 97%;
		padding: 10px 50px 10px 10px;
		font-family: Arial;
		color: #777;
		font-size: 30px;
		font-weight: 500;
		text-align: left !important;
		width: 400px;
		min-height: 30px;
	}
	select {
		padding: 10px 10px 10px 10px;
		font-family: Arial;
		color: #777;
		font-size: 26px !important;
		font-weight: 500;
		text-align: left !important;
		width: 400px;
		min-height: 30px;
		border-radius: 10px;
	}
</style>	
</head>

<body>
	<div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 40px">

<?php // echo $errMsg; ?>

	<div style="width: 800px;height:100px;margin:auto;">
		<div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:40px;"onclick="location.href='Weather.php';"></div>
		<div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
	   Add Weather</div>
	</div>
   




<div class="add-weather-form">
	<form method="post">
		<div class="add-weather-form-row  justify-content-between">
			<label>Location</label>
			<input type="text"  name="fname" id="fname">
		</div>
		<div class="add-weather-form-row justify-content-between">
			<label>City Type</label>
			<select id="hotspot" name="hotspot" >
				<option value="0" >Secondary City</option>
				<option class="abc"value="1">Primary City</option>
			</select>
		</div>
    <div class="add-weather-form-row justify-content-center">
        <input type="submit" name="save" id="save" value="Save" class="btn-custom-small"/>
    </div>
	</form>
</div>
</body>
</html>