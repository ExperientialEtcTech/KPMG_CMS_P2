<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
$base_dir = "../../uploads/";
$uploadOk = 0;
$max_file_size=5000000;
$error_msg="";


if(isset($_POST['event_id']))
{
    // createFolder($base_dir);
    $file_dir=$base_dir.$_POST['event_id']."/screenshots/";
    $file_name = $file_dir . basename($_FILES["fileName"]["name"]);
    
	
    if (file_exists($file_name)) {
        $error_msg="ERROR file already exists";
        $file_name = array_diff(scandir($file_dir), array('.', '..'));
        
        $url = "http://10.188.7.135/uploads"."/".$_POST['event_id']."/screenshots/".$file_name[2];
		//echo json_encode(array("status"=>$error_msg, "url"=>$url));
	 	//print_r($url);
    }else{
	
		$uploadOk = 1;
		//print_r($uploadOk);
        createFolder($file_dir);
        $FileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
      
        // print_r($FileType);
        if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" ) {
            $error_msg="ERROR file type not allowed";
            $uploadOk = 0;
        }
        
        if ($_FILES["fileName"]["size"] > $max_file_size) {
            $error_msg="ERROR Max File size exceed";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $file_name)) {
            
            $url = "http://10.188.7.135/uploads"."/".$_POST['event_id']."/screenshots/".basename($_FILES["fileName"]["name"]);
            
            //Update the status of latest event_id row 
			//$sql = "UPDATE EventSignoff SET Status = ?, ScreenshotfilePath = ? WHERE Status = 1 AND BookingId = ? AND ID = (SELECT MAX(ID) FROM EventSignoff)";
			$sql = "UPDATE EventSignoff SET Status = ?, ScreenshotfilePath = ? WHERE Status = 1 AND BookingId = ? ";
			$status = 2;
			$event_id = $_POST['event_id'];
			$params1 = array(&$status, &$url, &$event_id);
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
			//print_r($url);
            if($stmt){
                if(sqlsrv_execute($stmt))
				{
					$error_msg="SUCCESS File ". htmlspecialchars( basename( $_FILES["fileName"]["name"])). " uploaded.";
				}else{
					$error_msg="Error Uploading File.";
				}
			} 
			
		}else {
				$error_msg="Error Uploading File.";
			}
    }
} else {
    $error_msg="ERROR event id not set";
}

echo json_encode(array("status"=>$error_msg, "url"=>$url));

function createFolder($folderPath)
{
    if (!file_exists($folderPathr)) {
        mkdir($folderPath, 0775, true);
    }
}

exit;
?>