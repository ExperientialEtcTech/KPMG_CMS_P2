<?php
include_once('config.php');
include_once('jwt.php');

if(isset($_POST['update']))
{
    $Id=$_GET['ServiceId'];
    $service_name=$_POST['service_name'];

    $postData2 = array("Id"=>&$Id,"Service"=>&$service_name);

    $url2 = $apiBaseUrl.'cms/TtServicesUpdate.php';

    $jsonResponse = rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    header("Location : TTServices.php?type=services");
}

$serviceId=$_GET['ServiceId'];
$postData = array("ServiceId"=>&$serviceId);
$url = $apiBaseUrl.'cms/TtServiceShow.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true)['services'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || Edit Services</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
</head>

<body>
    <form method="post">
        <div class="container edit-services">
            <div class="title-bar">
                <a href="javascript: void(0);" class="left-arrow" style="margin-bottom:30px;"
                    onclick="location.href='TTServices.php?type=services'">
                    Back
                </a>
                <h1>Edit Services
                    <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                        onclick="location.href='login.php';">
                </h1>
            </div>
            <div class="content-block">
                <div class="edit-services-row">
                    <label>Service Name</label>
                    <div>
                        <input type="text" class="text-box" value="<?php echo $response[0]['Service']; ?>"
                            name="service_name">
                    </div>
                </div>
                <button class="btn-custom-small" type="submit" name="update">
                    Save
                </button>
            </div>
        </div>
    </form>
</body>

</html>