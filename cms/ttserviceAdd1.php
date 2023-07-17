<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

$parentId=$_GET['ParentId'];
$pageName="Services";
if(isset($_GET['Service']))
{
    $pageName="Add Service for ".urldecode($_GET['Service']);
}


if(isset($_POST['addservice']))
{
    $postData1 = array("parentid"=>&$_POST['parentid'],"service"=>&$_POST['service'],"servicetype"=>&$_POST['servicetype'],"iconUrl"=>&$_POST['iconUrl']);
    $url1 = $apiBaseUrl.'cms/TtServicesAdd.php';

    $jsonResponse = rest_call('POST',$url1, $postData1,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
    ?>
<script>
alert("Record Added");
window.location.href =
    "TTServices.php?ParentId=<?php echo $_GET['ParentId']; ?>&Service=<?php echo $_GET['Service']; ?>";
</script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/stylewelcome.css">
    <title>KPMG</title>

    <script src="assets/js/jquery-3.6.0.js"></script>
    <script>
    $(document).ready(function() {

        // search button click
        $("#textbtn").click(function() {
            var request = $.ajax({
                type: "POST",
                url: "filesearch.php",
                data: {
                    Tags: $("#filetag").val()
                },
                dataType: "html"
            });

            request.done(function(msg) {
                $('#filebrowser').html(msg);
            });

            request.fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });

        });

        //$('#filebrowser').load('filelist.php?filePath='+$("#filePath").val(), function() {
        //});
        window.CallParent = function(filePathlocal) {
            //$('#filePath').val(filePathlocal);
            //$("#filebrowser").html("");
            //$('#filebrowser').load('filelist.php?filePath='+$("#filePath").val(), function() {
            //});
        }
    });
    </script>
</head>
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

.box-selection {
    height: 50px;
    min-width: 100px;
    background-size: contain;
    display: inline-block;
    margin: 20px;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    /* background-color: #00338d; */
    border-radius: 10px;
}


.box-selection-text {
    height: 80px;
    width: 80px;
    background-size: contain;
    display: inline-block;
    background-image: url('assets/Rectangle-80.png');
    background-repeat: no-repeat;
    color: #FFFFFF;
    text-align: center;
    font-size: 25px;
    vertical-align: middle;
    width: 500px;
    background-image: none;
    color: #000000;

}

.vertical-center {
    margin: 0;
    position: relative;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 20px;
    cursor: pointer;
}

.vertical-centers {
    margin: 0;
    position: relative;
    top: 60%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    margin-left: 20%;
    color: grey;
    font-size: 25px;
}

.img1 {
    float: right;
    padding-right: 200px;
}

.box-selection1 {
    height: 80px;
    float: right;
    width: 27%;
    top: 60%;
}

.add-button {
    right: 10px;
    bottom: 10px;
    position: fixed;
}

.del-image {
    height: 32px;
    margin-top: 13%;

}

.text {
    margin-left: 30%;
    border: solid grey;

}


.modal-content {
    border-radius: 15px;
    border: solid 1px #ccc;
    background-color: #fff;
    -webkit-box-shadow: 0px 10px 15px 10px rgba(0, 0, 0, 0.04);
    -moz-box-shadow: 0px 10px 15px 10px rgba(0, 0, 0, 0.04);
    box-shadow: 0px 10px 15px 10px rgba(0, 0, 0, 0.04);
}

.modal-content .modal-header {
    padding: 0px;
    position: relative;
}

.modal-content .modal-header h2 {
    padding: 0px 0px 40px 0px;
    margin: 0px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    src: url("font/UNIVERSFORKPMG-BOLD.TTF") format("truetype");
    text-align: center;
    color: #00338d;
    font-size: 40px;
}

.modal-content .modal-header .close {
    position: absolute;
    top: 0px;
    right: 5px;
    padding: 0px;
    float: none;
    line-height: normal;
}

.modal-content .modal-center-content {
    margin: 0px 50px;
}

.btn-custom-small {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-width: 157px;
    height: 50px;
    color: #fff;
    background: #00338d;
    font-size: 24px;
    text-decoration: none;
    border-radius: 10px;
    font-family: 'UNIVERSFORKPMG-BOLD';
    cursor: pointer;
    border: 0px;
    padding: 0px 30px;
}

.modal-content .popup-row {
    display: flex;
    margin-bottom: 30px;
}

.justify-content-center {
    justify-content: center;
}

.d-flex {
    display: flex;
}

.modal-content .popup-col {
    align-items: center;
    padding: 0px 10px;
}

.width3 {
    width: 35%;
}

.width7 {
    width: 65%;
}

.text-box {
    border: solid 1px #ccc;
    font-family: 'UNIVERSFORKPMG-BOLD';
    border-radius: 6px;
    min-height: 50px;
    padding: 15px;
    width: 100%;
    color: #00338d;
    -webkit-box-shadow: 0px 6px 10px 6px rgba(0, 0, 0, 0.04);
    -moz-box-shadow: 0px 6px 10px 6px rgba(0, 0, 0, 0.04);
    box-shadow: 0px 6px 10px 6px rgba(0, 0, 0, 0.04);
}

.text-box:focus,
.text-box:focus-visible {
    border: solid 1px #ccc;
    outline: none;
}

.form-control-file-container {
    position: relative;
}

.form-control-file-container .btn-custom-small {
    font-size: 18px;
    height: 44px;
}

.form-control-file-container .form-control[type=file] {
    position: absolute;
    top: 0px;
    left: 0px;
    opacity: 0;
    width: 160px;
    height: 44px;
}

.modal-content .popup-col label {
    color: #838383;
    font-size: 20px;
    font-family: 'UNIVERSFORKPMG-BOLD';
}

.mb-0 {
    margin-bottom: 0px !important;
}

select {
    font-size: 20px;
}

.tt-row {
    width: 800px;
    margin: auto;
    display: flex;
    justify-content: space-between;
}

.tt-row .box-selection:first-of-type {
    min-width: 400px;
}
</style>


<body>
    <input type="hidden" name="inputtest" id="inputtest" value="iconUrl" />
    <div class="search" id="searchDiv" style="margin: auto;width: 100%;position: absolute;top: 50px">

        <div style="width: 1000px;height:100px;margin:auto;">
            <div style="height:50px;float: left;background-image:url('assets/login.png');cursor:pointer;background-repeat:no-repeat;padding-left:50px;"
                onclick="location.href='TTServices.php?type=services'"></div>
            <div style="height:50px;text-align: center;color: #00338D;text-align: center;font-size: 45px;margin:0px;">

                <?php
                echo $pageName;
            ?>

                <div style="height:50px;float: right;background-image:url('assets/Logout button.png');background-repeat:no-repeat;padding-left:50px; background-size: contain;cursor:pointer;"
                    onclick="location.href='login.php';">
                </div>
            </div>

            <form method="POST">
                <input type="hidden" name="parentid" value="<?php echo $parentId; ?>" />
                <div class="popup-row" style="margin-left:auto;margin-right:auto;width:500px;">
                    <div class="popup-col d-flex width3">
                        <label>Service Name</label>
                    </div>
                    <div class="popup-col width7">
                        <input type="text" name="service" class="text-box" />
                    </div>
                </div><br><br>
                <div id="browserdiv" class="popup-row" style="margin-left:auto;margin-right:auto;width:500px;">
                    <b><u>Select Icon (Optional)</u></b><br>
                    <input type="text" name="filetag" id="filetag" class="text-box" style="width:300px;"
                        placeholder="Search Tags" />
                    <input type="button" name="textbtn" id="textbtn" value="Search" class="btn-custom-small"
                        style="float:right;" />
                    <div id="filebrowser" style="width:400px;height:400px;"></div><br>
                </div>


                <div class="popup-row" style="margin-left:auto;margin-right:auto;width:800px;">
                    <div class="popup-col d-flex width3">
                        <label>Icon Url</label>
                    </div>
                    <div class="popup-col">
                        <input type="text" name="iconUrl" id="iconUrl" class="text-box" />
                    </div>
                </div>
                <br>
                <div class="popup-row" style="margin-left:auto;margin-right:auto;width:200px;">
                    <input type="submit" name="addservice" class="btn-custom-small" value="Save" />
                </div>
            </form>


        </div>
    </div>

</body>

</html>