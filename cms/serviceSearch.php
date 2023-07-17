<?php
include_once('config.php');
include_once('jwt.php');


$searchQuery=$_POST['Tags'];
$showVideo=$_POST['showVideo'];
$showImage=$_POST['showImage'];
$showPdf=$_POST['showPdf'];


$postData = array("query"=>$searchQuery,"showvideo"=>$showVideo,"showimage"=>$showImage,"showpdf"=>$showPdf);
$url = $apiBaseUrl.'cms/searchFile.php';

$jsonResponse = rest_call('POST',$url, $postData,'multipart/form-data',"Bearer ".$_COOKIE['kpmg-access']);

$response = json_decode($jsonResponse,true)['files'];


?>
<!DOCTYPE html>
<html>

<head>


    <script src="./welcomeScript1.js"></script>

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
    <div class="box-selection-text">
        <div class="vertical-center4">
            <?php echo $file['fileName']; ?>
        </div>
    </div>
    <div class="box-selection">
        <button class="btn btn-primary viewBtn" type="button" id="select"
            onclick="updateService('<?php echo $file['fileUrl'];?>','<?php echo $file['fileType'];?>')">Select</button>

    </div>
    <div class="box-selection">
        <button class="btn btn-primary viewBtn" type="button"
            onclick="showService('<?php echo $file['fileUrl'];?>','<?php echo $file['fileType'];?>')">View</button>
    </div>


    <?php
		
			}
		}
?>

</body>

</html>