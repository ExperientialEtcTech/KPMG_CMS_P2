<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
$base_dir = "../../uploads/";
$uploadOk = 1;
$max_file_size=50000000;
$error_msg="";

if(isset($_POST['eventID']))
{
	if (!file_exists($base_dir) && !is_dir($base_dir) ) {
    	createFolder($base_dir);       
	}
	
    //createFolder($base_dir);
    $file_dir=$base_dir.$_POST['eventID']."/"."media/";
	if (!file_exists($file_dir) && !is_dir($file_dir) ) {
    	createFolder($file_dir);       
	}
	
	//Added on 4/8 - Shubham
	
	//createfolder whiteboard
	$whiteboard_file_dir=$base_dir.$_POST['eventID']."/"."whiteboard";
	if (!file_exists($whiteboard_file_dir) && !is_dir($whiteboard_file_dir) ) {
    	createFolder($whiteboard_file_dir);       
	}
	
	//createfolder screenshot
	$screenshot_file_dir=$base_dir.$_POST['eventID']."/"."screenshots/";
	if (!file_exists($screenshot_file_dir) && !is_dir($screenshot_file_dir) ) {
    	createFolder($screenshot_file_dir);       
	}
	//Added on 4/8 - Shubham
    //createFolder($file_dir);

    $file_name = $file_dir . basename($_FILES["fileName"]["name"]);
    $FileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif" && $FileType != "mp4" ) {
        $error_msg="ERROR file type not allowed";
        $uploadOk = 0;
    }

    if (file_exists($file_name)) {
		unlink($file_name);
        //$error_msg="ERROR file already exists";
        //$uploadOk = 0;
    }

    if ($_FILES["fileName"]["size"] > $max_file_size) {
        $error_msg="ERROR Max File size exceed";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $file_name)) {
            $error_msg="SUCCESS File ". htmlspecialchars( basename( $_FILES["fileName"]["name"])). " uploaded.";
			$uploadOk = 1;
        } else {
            $error_msg="Error Uploading File.";
			$uploadOk = 0;
        }
    }
} else {
    $error_msg="ERROR event id not set";
	$uploadOk = 0;
}
error_log("Called upload media api: ".$error_msg." , File Size: ".$_FILES['fileName']['size']);
echo json_encode(array("msg"=>$error_msg,"status"=>$uploadOk));

function createFolder($folderPath)
{
    if (!file_exists($folderPathr)) {
        mkdir($folderPath, 0775, true);
    }
}

exit;
?>