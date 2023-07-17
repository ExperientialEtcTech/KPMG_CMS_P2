<?php
include_once('security.php');

include_once('config.php');
include_once('jwt.php');
?>
<html>
	<head>
	    <script 
			src="assets/js/jquery-3.6.0.js">
		</script>
		<script>
			$(document).ready(function() {
				$("span a").click(function(event){
					if($(this).attr('id')=="selfile")
					{
						$('#selectedFile').val($(this).attr('value'));
					} else {
						if($(this).attr("value")=="..")
						{
							var res = $("#filePath").val().split("\\");
							var path="";
							for (let i = 0; i < res.length-1; i++) {
								path=path+res[i];
								if(i<res.length-2)
									path=path+"\\";
							}
							window.parent.CallParent(path);
						} else {
							window.parent.CallParent($("#filePath").val()+"\\"+$(this).attr("value"));
						}
					}
				});
				
			});
		</script>

	</head>
	<body>
<?php
$path=$_GET['filePath'];
$files = array_diff(scandir($path), array('.'));
foreach($files as $file)
{
	if(is_dir($path."/".$file)||($file==".."))
	{
		?>
				<span><a id="selfolder" value='<?php echo $file; ?>'>
					<div class="file-upload-icon">
						<img src="assets/icon-folder.png" alt="">
						<div class="file-upload-name">
							<?php echo $file; ?>
						</div>
					</div>
				</a></span>
		<?php
		//echo '<span><span1><a id="selfolder" value="'.$file.'" style="color:DodgerBlue;">'.$file.'</a></span1></span><br>';
	} else {
		?>
				<span><a id="selfile" value='<?php echo $file; ?>'>
					<div class="file-upload-icon">
						<img src="assets/icon-file.png" alt="">
						<div class="file-upload-name">
						<?php echo $file; ?>
						</div>
					</div>
				</a></span>
		<?php
		//echo '<span><a id="selfile" value="'.$file.'" style="color:MediumSeaGreen;">'.$file.'</a></span><br>';
	}
}
?>

	</body>
</html>