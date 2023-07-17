<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
if(isset($_POST['save']))
{
	$errMsg="";
	
	$postData = array();
	$url = 'https://api.openweathermap.org/data/2.5/weather?q='.$_POST["fname"].'&mode=json&units=metric&APPID=11d13ae5034256d2b02b40b79743d41e'; // insert actual APPID
	$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data');
	$response = json_decode($jsonResponse,true);
$response['cod']=200;// remove in production after openweather domain is allowed in colab
	if($response['cod']!="200")
	{
		$errMsg="Invalid City";
	} else {
       if($_POST['hotspot']==1){
            for ($i=0; $i <=1 ; $i++) { 
               $postDataSave = array("cities"=>$_POST['fname'], "CityType"=>$_POST['hotspot']);
            $urlSave = $apiBaseUrl.'cms/addWeatherCity.php';

            $jsonResponse1 = rest_call('POST',$urlSave, $postDataSave,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
            }
           
        }
        else{
            $postDataSave = array("cities"=>$_POST['fname'], "CityType"=>$_POST['hotspot']);
            $urlSave = $apiBaseUrl.'cms/addWeatherCity.php';

            $jsonResponse1 = rest_call('POST',$urlSave, $postDataSave,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
        }
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
	
	<!-- Added by shubham - 17/10 - Start -->
    <script src= "assets/js/jquery.min.js"></script>
    <script src= "assets/js/session_check.js"></script>
	<!-- Added by shubham - 17/10 - End -->
	
    <style>
    .ui-helper-hidden-accessible {
        display: none;
    }

    .ui-menu-item {
        background-color: white;
        border-style: solid;
        width: 200px;
    }

    body {

        margin: 0px;
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }


    @font-face {
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    p {
        font-family: 'UNIVERSFORKPMG-BOLD';
        src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    }

    .hello {
        border: 1px solid grey;
        width: 50%;
        height: 465px;
        border-radius: 20px;
        margin-left: 20%;
        margin-top: 30%;
    }
    .save{
        width: 200px;
        border-radius: 10px;
        background-color: #00338D;
        height:45px;
        font-size: 18px;
        color: white;
        border: none;
        cursor: pointer;"
    }
    .save:hover{
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
}


    .helloo {
        text-align: center;
        color: darkblue;
    }

    .name {
        margin-left: 100px;
        font-size: 30px;
        color: grey;
        padding-top: 120px;

    }

    .text {
        margin-left: 40px;
        border-radius: 10px;
        border: 1px solid grey;
        height: 50px;
        width: 300px;

    }

    .name3 {
        margin-top: 15%;
    }

    .edit {
        height: 50px;
        width: 170px;
        background-size: contain;
        display: inline-block;

        background-image: url('assets/Rectangle-80.png');
        background-repeat: no-repeat;
        color: #FFFFFF;

        font-size: 18px;
        padding-bottom: 60px;
        margin-left: 270px;
        margin-top: 12%;


    }

    .heading {
        margin-bottom: 3px;
    }
  


    #hotspot {
        width: 300px;
        height: 50px;
        border-radius: 10px;
        font-size: 30px;
        text-align: center;
        border: 1px solid grey;
        color: grey;
        margin-left: 35px;

    }
   
    @media only screen and (max-width: 1200px) and (min-width:900px) {
        .hello {
            border: 1px solid grey;
            width: 50%;
            height: 450px;
            border-radius: 20px;
            margin-left: 20%;
        }

        .helloo {
            text-align: center;
            color: darkblue;
        }

        .name {
            margin-left: 40px;
            font-size: 30px;
            color: grey;
            padding-top: 80px;

        }

        .text {
            margin-left: 40px;
            border-radius: 10px;
            border: 1px solid grey;
            height: 50px;
            width: 300px;

        }

        .name3 {
            margin-top: 15%;
        }

        .edit {
            height: 50px;
            width: 170px;
            background-size: contain;
            display: inline-block;

            background-image: url('assets/Rectangle-80.png');
            background-repeat: no-repeat;
            color: #FFFFFF;

            font-size: 18px;
            padding-bottom: 60px;
            margin-left: 200px;
            margin-top: 15%;


        }

        .heading {
            margin-bottom: 3px;
        }
        .save{
        width: 200px;
        border-radius: 10px;
        background-color: #00338D;
        height:45px;
        font-size: 18px;
        color: white;
        border: none;
        cursor: pointer;"
    }
    .save:hover{
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
}



    }

    @media only screen and (max-width: 900px)and (min-width:400px) {
        .hello {
            border: 1px solid grey;
            width: 50%;
            height: 400px;
            border-radius: 20px;
            margin-left: 20%;
        }

        .helloo {
            text-align: center;
            color: darkblue;
        }

        .name {
            margin-left: 40px;
            font-size: 30px;
            color: grey;
            padding-top: 80px;

        }

        .text {
            margin-left: 15px;
            border-radius: 10px;
            border: 1px solid grey;
            height: 50px;
            width: 150px;

        }
        .save{
        width: 200px;
        border-radius: 10px;
        background-color: #00338D;
        height:45px;
        font-size: 18px;
        color: white;
        border: none;
        cursor: pointer;"
    }
    .save:hover{
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
}

        .name3 {
            margin-top: 15%;
        }

        .edit {
            height: 50px;
            width: 170px;
            background-size: contain;
            display: inline-block;

            background-image: url('assets/Rectangle-80.png');
            background-repeat: no-repeat;
            color: #FFFFFF;

            font-size: 18px;
            padding-bottom: 60px;
            margin-left: 130px;
            margin-top: 25%;


        }

        .heading {
            margin-bottom: 3px;
        }

    }

    @media only screen and (max-width: 800px)and (min-width:500px) {
        .hello {
            border: 1px solid grey;
            width: 55%;
            height: 400px;
            border-radius: 20px;
            margin-left: 20%;
            margin-top: 40%;
        }

        .helloo {
            text-align: center;
            color: darkblue;
        }

        .name {
            margin-left: 40px;
            font-size: 30px;
            color: grey;
            padding-top: 80px;


        }
        .save{
        width: 200px;
        border-radius: 10px;
        background-color: #00338D;
        height:45px;
        font-size: 18px;
        color: white;
        border: none;
        cursor: pointer;"
    }
    .save:hover{
    background-color: #38b2d7ba;
    outline: none;
    border: none;
    color: #f0fff0;
    cursor:pointer;
    transition:0.1s;
}

        .text {
            margin-left: 15px;
            border-radius: 10px;
            border: 1px solid grey;
            height: 50px;
            width: 200px;
            

        }

        .name3 {
            margin-top: 15%;
        }

        .edit {
            height: 50px;
            width: 170px;
            background-size: contain;
            display: inline-block;

            background-image: url('assets/Rectangle-80.png');
            background-repeat: no-repeat;
            color: #FFFFFF;

            font-size: 18px;
            padding-bottom: 60px;
            margin-left: 130px;
            margin-top: 25%;
        }

        .heading {
            margin-bottom: 3px;
        }

    }
    </style>
</head>

<body>
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px">

        <?php echo $errMsg; ?>

        <div style="width: 1000px;height:100px;margin:auto;">
            <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:40px;cursor: pointer;"
                onclick="location.href='Weather.php';"></div>
            <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
                Add Weather
                <div style="height:50px;float: right;background-image:url('assets/Group 563.png');background-repeat:no-repeat;padding-left:80px; background-size: contain;cursor:pointer;"
                        onclick="location.href='index.php';">
                <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                    onclick="location.href='login.php';"></div>
            </div><br><br>





            <div style="width: 800px;height:100px;margin:auto;">
                <form method="post">
                    <div style="margin-top:50px;">
                        <label class="name">Location</label>
                        <input class="text" type="text" name="fname" id="fname"
                            style="background-image:url('assets/Group 159.png');background-repeat:no-repeat;background-position:260px;height:40px;padding-left:20px;width:280px;">
                    </div>
                    <div style="margin-top:50px;">
                        <label class="name">City Type</label>
                        <select id="hotspot" name="hotspot">
                            <option value="0">Secondary City</option>
                            <option class="abc" value="1">Primary City</option>
                        </select>
                    </div>
                    <div style="width: 200px;margin-left:auto;margin-right:auto;margin-top:50px;
                    ">
                        <input  type="submit" name="save" class="save" value="Save"
                           
                            class="searchb" />
                            
                    </div>
                </form>
            </div>
</body>

</html>