<?php
include_once('../../jwt/jwtAccess.php');
include_once('../db.php');

$data=json_decode(file_get_contents('php://input'), true);

$folder=$data['filePath']."\\".$data['fileName'];
//$filepath=$data['filePath'];
$finalFileName=$data['fileName'];

$resp="";
$fileType=explode(".",$finalFileName);
$fileType=$fileType[count($fileType)-1];
if($fileType=="pdf"||$fileType=="gif"||$fileType=="jpg"||$fileType=="jpeg"||$fileType=="mp4"||$fileType=="png")
{
    if (!file_exists($folder)) {
        $resp="File does not Exist";
        //mkdir($folder);
    } else {
        $sql = 'UPDATE MasterContent SET IsDeleted=1 WHERE FileName=?';
        $params = array(&$finalFileName,&$filepath);
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_prepare( $conn, $sql, $params, $options);
        sqlsrv_execute($stmt);
        unlink($folder);
       $resp="File Deleted";
    }
} else {
    $resp="File type deletion not allowed";
}

	//$response['response'] = $resp;

	$json_response = json_encode($resp);
	echo $json_response;

?>