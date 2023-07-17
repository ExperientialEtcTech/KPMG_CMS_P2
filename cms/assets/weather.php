<?php
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = $apiBaseUrl.'cms/showWeather.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true)['files'];
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

.row-data {
    width: 800px;
    height: 100px;
    margin: auto;
}

.row-data-left {
    float: left;
}

.row-data-right {
    float: right;
}

.add-button {
    right: 10px;
    bottom: 10px;
    position: fixed;
}

.map-red {
    width: 50px;
    height: 57px
}
</style>

<body>
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 60px" />

    <div class="row-data">
        <div style="height:50px;float: left;background-image:url('assets/login.png');background-repeat:no-repeat;padding-left:50px;"
            onclick="location.href='table top idle state.php';"></div>
        <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">
            Weather</div>
    </div>

    <?php
foreach ($response as $value) {
?>
    <div class="row-data">
        <div class="row-data-left">

            <div class="row-data-left">
                <?php if($value['CityType']!==1){
                echo '<img src="assets/Location icon.png">';
            }
            else{
                echo '<img src="assets/Group258-01.png" class="map-red"/>';
            }   
            ?>
            </div>
            <div class="row-data-right" style="padding-left:50px;">
                <h3><?php echo $value['cities']; ?></h3>
            </div>
        </div>
        <div class="row-data-right"><a href="delweather.php?id=<?php echo $value['cities']; ?>"><img
                    src="assets/Delete icon.png"></a></div>
    </div>
    <?php
}
?>


    <div class="add-button"><a href="AddWeather.php"><img src="assets/Add Button.png"></a></div>
</body>

</html>