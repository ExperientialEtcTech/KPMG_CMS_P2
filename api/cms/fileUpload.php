<?php
include_once('../../jwt/jwtAccess.php');
include_once('../db.php');
header("Content-Type:application/json");

$uploadOk = 1;
$max_file_size=500000000;
//336960581
$error_msg="";

//print_r(($_POST['filePath']));
//https://kpmg.experientialetc.com/cms/FileUpload.php
if(isset($_POST['filePath']))
{
    $file_name = $_POST["filePath"] ."/". basename($_FILES["fileName"]["name"]);
    $FileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

    $finalFileName=basename($_FILES["fileName"]["name"]);
    $finalUrl=str_replace($basePath,$baseUrl,$_POST['filePath']);
    $finalUrl=str_replace("\\","/",$finalUrl)."/".$finalFileName;
    $finalFileType="";
    $finalTags=$_POST['tags'];
    $finalCat=$_POST['category'];

if($FileType=="pdf")
    $finalFileType="pdf";
if($FileType=="mp4")
    $finalFileType="video";
if($FileType=="jpg")
    $finalFileType="image";
if($FileType=="jpeg")
    $finalFileType="image";
if($FileType=="png")
    $finalFileType="image";
if($FileType=="gif")
    $finalFileType="image";

    if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "gif" && $FileType != "mp4" && $FileType != "pdf" ) {
        $error_msg="ERROR file type not allowed";
        $uploadOk = 0;
    }


    $mime_type = mime_content_type($_FILES["fileName"]["tmp_name"]);

    $allowed_file_types = ['image/png', 'image/jpeg', 'image/jpg', 'application/pdf', 'application/mp4', 'video/mp4'];
    if (! in_array($mime_type, $allowed_file_types)) {
        $error_msg="ERROR file MIME type not allowed".$mime_type;
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
            $isDeleted=0;
            $sql = 'INSERT INTO MasterContent ("FileName","FilePath","FileType","Tags","Categories","IsDeleted") VALUES (?,?,?,?,?,?)';
            $params = array(&$finalFileName,&$finalUrl,&$finalFileType,&$finalTags,&$finalCat,$isDeleted);
            $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
            $stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
            sqlsrv_execute($stmt);
        } else {
            $error_msg="Error Uploading File.";
			$uploadOk = 0;
        }
    }
} else {
    $error_msg="File Path";
	$uploadOk = 0;
}
//error_log("Called File Upload api: ".$error_msg." , File Size: ".$_FILES['fileName']['size']);
echo json_encode(array("msg"=>$error_msg,"status"=>$uploadOk));

exit;
?>