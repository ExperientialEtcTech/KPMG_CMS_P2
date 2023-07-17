<?php
include_once('jwt/jwtAccess.php');
header("Content-Type:application/json");
$base_dir = "uploads/";
$file_dir=$base_dir.$_POST['eventID']."/";

$files = array_diff(scandir($file_dir), array('.', '..'));
echo json_encode($files);
?>