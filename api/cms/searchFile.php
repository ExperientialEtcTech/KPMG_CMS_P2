<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$showVideo="video";
$showImage="image";
$showPdf="pdf";

if(isset($_POST['showvideo'])&&($_POST['showvideo']=="false"))
{
	$showVideo="na";
}

if(isset($_POST['showimage'])&&($_POST['showimage']=="false"))
{
	$showImage="na";
}

if(isset($_POST['showpdf'])&&($_POST['showpdf']=="false"))
{
	$showPdf="na";
}

if(!isset($_POST['query']))
{
	response("Invalid Param");
	exit;
}
	$sql="SELECT Id,FileName,FilePath,FileType FROM MasterContent WHERE (Tags LIKE ? OR Categories LIKE ? OR FileName LIKE ?) AND (FileType=? OR FileType=? OR FileType=?)";
    $tags="%".$_POST['query']."%";

$params1 = array(&$tags,&$tags,&$tags,$showVideo,$showImage,$showPdf);
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
if($stmt){
	if(sqlsrv_execute($stmt))
	{
		if(sqlsrv_num_rows($stmt)>0){
			while($row = sqlsrv_fetch_array($stmt)){
				$temp=array("file_id"=>$row['Id'],"fileName"=>$row['FileName'],"fileUrl"=>$row['FilePath'],"fileType"=>$row['FileType']);
            	array_push($details, $temp);
			}
			response($details);
		} else {
			response(NULL);
		}
	} else {
		die(print_r(sqlsrv_errors(), true)); 
	}
} else {
	die(print_r(sqlsrv_errors(), true)); 
}

function response($details)
{
	
	$response['files'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>