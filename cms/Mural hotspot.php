<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/showHotspots.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

//$response = json_decode($jsonResponse,true);
$response = $jsonResponse;
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
        height:200px;
        width:150px;
        background-size: contain;
        display: inline-block;
        margin:20px;
        background-image:url('assets/Rectangle-76.png');
        background-repeat:no-repeat;
        color: #FFFFFF;
        text-align: center;
        font-size: 25px;
        vertical-align: middle;
    }

    .vertical-center {
        margin: 0;
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .heading{
        font-size:30px;
        margin-top:4%;
        color:#00338D;
        
    }
    #hotspot{
        width:25%;
        height:50px;
        border-radius:10px;
        /*font-size:30px;*/
		font-size:22px;
        text-align:center;
        border:1px solid grey;
        color:grey;
        cursor:pointer;
       
    }
    

</style>
<body>
        <div class="search" id = "searchDiv" style="margin: auto;width: 100%;position: absolute;top: 70px">

<form action="select_template.php" method="post">
<div style="width: 1000px;height:100px;margin:auto;">
    <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;cursor:pointer;"onclick="location.href='Mural.php';"></div>
    <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
    Manage Hotspot <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"onclick="location.href='login.php';"></div>
</div>
<center><h3 class="heading">Select hotspot</h3>
<div>
<select id="hotspot" name="hotspot" onChange="leaveChange();">
    <option style="display: none">Select Hotspot</option>
    <!--<option value="select hotspot4"onclick="location.href='Service and Sectors.php';">Select hotspot4</option>-->
</select>
</div>
</center>




    

</div>

</form>
        </div>
        <script>
            function leaveChange() {
				var select = document.getElementById("hotspot");
				var hotspot_id = select.value;
				//sessionStorage.setItem('hotspot_id', hotspot_id);
                location.href='https://kpmg.experientialetc.com/cms/serviceandsectors.php?id='+hotspot_id;     
            }
			response = <?php  print_r($response); ?>;
			//console.log(response.mural_hotspot);
			const select = document.querySelector('select');
			for(i=0;i<response.mural_hotspot.length;i++){
				//console.log(response.mural_hotspot[i].hotspot_id);
				HotspotName = response.mural_hotspot[i].hotspot_label;
				HotspotId = response.mural_hotspot[i].hotspot_id;
				select.options.add(new Option(HotspotName, HotspotId));
				
			}
			
        </script>
</body>
</html>
