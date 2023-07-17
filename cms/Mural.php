<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');
$status=1;
$postData = array(&$status);
$url = 'https://kpmg.experientialetc.com/api/cms/showAllResource.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true);

$respData = $response['resources'];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>KPMG || Manage Resource</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

</head>

<body class="body-bg">
    <div class="container-lg">
        <div class="welcome-screen">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-1 col-lg-1 col-1">
                    <span class="arrow-left-image" onclick="location.href='TableTop.php';">
                        <img src="assets/login.png" alt="login" /></span>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-11 col-lg-11 col-11 common-welcome-color welcome-screen-font"
                    onclick="location.href='select_template.php';">
                    <span class="welcome">Manage Resource</span>
                </div>
            </div>
            <form action="UpdateWelcomeScreen.php" method="post" id="muralForm">
                <div class="row justify-content-md-center">
                    <div class=" col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        <div class=" table-responsive">
                            <!-- table -->
                            <table class="table">
                                <thead>

                                </thead>
                                <tbody>
                                    <form id="manageForm">
                                        <?php foreach($respData as $key => $value) { ?>
                                        <tr style="vertical-align: middle;">
                                            <td></td>
                                            <th colspan="2" class="subText"><?php echo $value['ResourceName'] ?> -
                                                <?php echo $value['ResourceType'] ?> :</th>

                                            <td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="myBtn1"
                                                    onclick="window.location = 'EditResource.php?type=<?php echo $value['ResourceType']; ?>&resourceName=<?php echo urlencode($value['ResourceName']); ?>&id=<?php echo $value['Id']; ?>'">
                                                    Edit
                                                </button>
                                                <button class="btn btn-primary viewBtn" type="button" id="deleteId"
                                                    onclick="window.location.href='deleteResource.php?id=<?php echo $value['Id']; ?>'">
                                                    Delete
                                                </button>
                                            </td>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </form>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="box-selection1">
                </div>

            </form>

        </div>
        <div class="img1 muralAddImage">
            <a href="AddResource.php"><img src="assets/Add Button.png" alt="Add Image" id="AddImage"></a>
        </div>
    </div>





</body>

</html>