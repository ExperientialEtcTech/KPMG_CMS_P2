<?php
include_once('security.php');
include_once('config.php');
include_once('jwt.php');

$searchQuery=$_POST['Tags'];
$postData = array("query"=>$searchQuery,"showimage"=>"false","showvideo"=>"true","showpdf"=>"false");

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
            onclick="updateKaleidoscope('<?php echo $file['fileUrl'];?>','<?php echo $file['fileType'];?>')">Select</button>

    </div>
    <div class="box-selection">
        <button class="btn btn-primary viewBtn" type="button"
            onclick="showKaleidoscope('<?php echo $file['fileUrl'];?>','<?php echo $file['fileType'];?>')">View</button>
    </div>


    <?php
		
			}
		}
?>

</body>

</html>