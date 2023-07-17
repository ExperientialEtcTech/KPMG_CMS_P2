<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

$searchQuery=$_POST['Tags'];
$showVideo="true";
$showImage="true";
$showPdf="true";

if(isset($_POST['showvideo'])&&($_POST['showvideo']=="false"))
{
        $showVideo="false";
}
if(isset($_POST['showpdf'])&&($_POST['showpdf']=="false"))
{
        $showPdf="false";
}
if(isset($_POST['showimage'])&&($_POST['showimage']=="false"))
{
        $showImage="false";
}

$postData = array("query"=>$searchQuery,"showvideo"=>$showVideo,"showimage"=>$showImage,"showpdf"=>$showPdf);

$url = $apiBaseUrl.'cms/searchFile.php';
$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);
$response = json_decode($jsonResponse,true)['files'];
?>
<!DOCTYPE html>
<html>

<head>
    <script src="assets/js/jquery-3.6.0.js">
    </script>
    <!-- <script src="./welcomeScript1.js"></script> -->
    <script>
    $(document).ready(function() {
        $("s1 button").click(function(event) {
            if ($(this).attr('id') == "selFile") {
                $('#' + $('#inputtest').val()).val($(this).attr('value'));
                window.parent.CallParent();
            }
        });

    });
    </script>

</head>

<body>


    <?php
  

		if(is_null($response))
		{
			echo "NO Files Found";
		} else {
			foreach($response as $file)
			{
				?>
    <div class="d-flex justify-content-center">
        <div class="box-selection-text">
            <div class="vertical-center4">
                <?php echo $file['fileName']; ?>
            </div>
        </div>
        <div class="box-selection">
            <button class="btn btn-primary viewBtn" type="button"
                onclick="showDataModel('<?php echo $file['fileUrl'];?>','<?php echo $file['fileType'];?>')">View</button>
        </div>

        <div class="box-selection">
            
            <s1><button class="btn btn-primary viewBtn" type="button" name ="selFile" id="selFile" value="<?php echo $file["fileUrl"]; ?>">Select</button></s1>
<!-- onclick="UpdateData('<?php //echo $file['fileUrl'];?>','<?php //echo $file['fileType'];?>')" -->
        </div>
    </div>
    <?php
		
			}
		}
?>

</body>

</html>