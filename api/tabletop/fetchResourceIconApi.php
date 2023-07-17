<?php
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
*/
include_once('../../jwt/jwtAccess.php');
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST'); 
header("Content-Type:application/json");
include('../db.php');

$sql = "SELECT Id, ResourceName, ResourceType, IconUrl, LabelUrl FROM MuralResourcesMaster WHERE IsActive = 1";
$status=1;
$params1 = array();

$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
	$mural_hotspot=Array();
	//To fetch hotspots and hotspots label
    if($stmt){
        if(sqlsrv_execute($stmt)){

			if(sqlsrv_num_rows($stmt)>0)
            {
                while ($row = sqlsrv_fetch_array($stmt)) {
                    $temp=array("id"=>$row['Id'], "resource_name"=>$row['ResourceName'], "resource_type"=>$row['ResourceType'], "label_url"=>$row['LabelUrl'], "icon_url"=>$row['IconUrl']);
                    array_push($mural_hotspot, $temp);
                }
                response($mural_hotspot);
				
            }else{
                response("No entries");
            }
		}

	}else{

		response("No record Found");
	}
	
      

function response($mural_hotspot){
	$response['response'] = $mural_hotspot;
	
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>
