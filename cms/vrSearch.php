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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <!--<script src="./welcomeScript1.js"></script>-->
	<script>
	function showDataModel(data, type) {
  let filename = data.substring(data.lastIndexOf("/") + 1);
  document.getElementById("fileName").innerText = filename;
  let html = "";
  if (type == "image") {
    html = "<img src='" + data + "' alt='image' class='img-fluid'>";
  } else if (type == "video") {
    html =
      "<video controls id='video-src'><source src='" + data + "' type='video/mp4'></video>";
  } else if (type == "pdf") {
    html = `<iframe   src="${data}">`;
  } else {
    html = "<span>Preview is not available</span>";
  }
  document.getElementById("changeViewBody").innerHTML = html;
  document.getElementById("changeViewModelUpdate").style.display = "block";
}
</script>
    <script>
    $(document).ready(function() {
        $("span a").click(function(event) {
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
            <button class="btn btn-primary viewBtn" type="button" id="select"
                onclick="UpdateDataVR('<?php echo $file['fileUrl'];?>','<?php echo $file['fileType'];?>')">Select</button>

        </div>
    </div>
    <?php
		
			}
		}
?>

</body>

</html>