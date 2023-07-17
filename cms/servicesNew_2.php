<?php
include_once('config.php');
include_once('jwt.php');

$parentId=0;
$pageName="Services";
if(isset($_GET['ParentId']))
{
    $parentId=$_GET['ParentId'];
    $pageName=urldecode($_GET['Service']);
}

if(isset($_GET['delId']))
{
    $delId=$_GET['delId'];
    $postData2 = array("delId"=>&$_GET['delId']);
    $url2 = $apiBaseUrl.'cms/TtServicesDel.php';

    $jsonResponse = rest_call('POST',$url2, $postData2,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
}

if(isset($_POST['addservice']))
{
    $postData1 = array("parentid"=>&$_POST['parentid'],"service"=>&$_POST['service'],"servicetype"=>&$_POST['servicetype'],"iconUrl"=>&$_POST['iconUrl']);
    $url1 = $apiBaseUrl.'cms/TtServicesAdd.php';

    $jsonResponse = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
}

$postData = array("parentId"=>&$parentId);
$url = $apiBaseUrl.'cms/TtServicesShow.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true)['services'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPMG || Services</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/customstyle.css">
</head>
<body style="background: none;">
    <div class="container services-page">
        <div class="title-bar">
            <a href="javascript: void(0);" class="left-arrow">
                Back
            </a>
            <h1>Services</h1>
        </div>
        <div class="services-container">
            <div class="container-fluid">
<?php
foreach($response as $service)
{
?>
                <div class="row mb-5">
                    <div class="col-sm-3 d-flex align-items-center">
                        <label class="label">
                            Item 01
                        </label>
                    </div>
                    <div class="col-sm-9 d-flex justify-content-between">
                        <button class="btn-custom-xxsmall">
							View <br>Sub Service
						</button>
                        <button class="btn-custom-xxsmall">
							View <br>Content
						</button>
                        <button class="btn-custom-xxsmall">
							Edit
						</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
<?php
}
?>
                <div class="row mb-5">
                    <div class="col-sm-3 d-flex align-items-center">
                        <label class="label">
                            Item 02
                        </label>
                    </div>
                    <div class="col-sm-9 d-flex justify-content-between">
                        <button class="btn-custom-xxsmall">
							View <br>Sub Service
						</button>
                        <button class="btn-custom-xxsmall">
							View <br>Content
						</button>
                        <button class="btn-custom-xxsmall">
							Edit
						</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-3 d-flex align-items-center">
                        <label class="label">
                            Item 03
                        </label>
                    </div>
                    <div class="col-sm-9 d-flex justify-content-between">
                        <button class="btn-custom-xxsmall">
							View <br>Sub Service
						</button>
                        <button class="btn-custom-xxsmall">
							View <br>Content
						</button>
                        <button class="btn-custom-xxsmall">
							Edit
						</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-3 d-flex align-items-center">
                        <label class="label">
                            Item 04
                        </label>
                    </div>
                    <div class="col-sm-9 d-flex justify-content-between">
                        <button class="btn-custom-xxsmall">
							View <br>Sub Service
						</button>
                        <button class="btn-custom-xxsmall">
							View <br>Content
						</button>
                        <button class="btn-custom-xxsmall">
							Edit
						</button>
                        <button class="btn-delete"><img src="assets/Delete icon.png"></button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="add-button" id="btnadd"><img src="assets/Add Button.png"></div>
    </div>
</body>
</html> 