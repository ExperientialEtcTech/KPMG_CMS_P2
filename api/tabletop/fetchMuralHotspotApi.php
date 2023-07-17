<?php
include_once('../../jwt/jwtAccess.php');
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
*/

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST'); 
header("Content-Type:application/json");
include('../db.php');
//"SELECT mmhp.`hotspot_id`, mmhp.`hotspot_label`, mphpssi.`resource_id`, mmssl.`resource_name`, mmssl.`type`, mhpc.`content_url`, mhpc.`content_type` FROM `mural_hp_resource_info` mphpssi LEFT JOIN `mural_master_hotspot` mmhp ON (mphpssi.hotspot_id = mmhp.hotspot_id) RIGHT JOIN `mural_master_resource_list` mmssl ON (mphpssi.resource_id = mmssl.resource_id) RIGHT JOIN `mural_hp_content` mhpc ON (mphpssi.hp_resource_id = mhpc.hp_resource_id)"

	$status=1;
    
    //$sql = "SELECT mmhp.Id, mmhp.HotspotLabel, mphpssi.ResourceId, mmssl.ResourceName, mmssl.ResourceType, mhpc.FilePath, mhpc.FileType FROM MuralHotspotResources mphpssi LEFT JOIN MuralHotspotsMaster mmhp ON (mphpssi.HotspotId = mmhp.Id) RIGHT JOIN MuralResourcesMaster mmssl ON (mphpssi.ResourceId = mmssl.Id) RIGHT JOIN MuralHotspotContent mhpc ON (mphpssi.Id = mhpc.HotspotResourceId)";


$sql = "SELECT mmhp.Id, mmhp.HotspotLabel, mphpssi.ResourceId, mmssl.ResourceName, mmssl.ResourceType, mhpc.FilePath, mhpc.FileType FROM MuralHotspotResources mphpssi LEFT JOIN MuralHotspotsMaster mmhp ON (mphpssi.HotspotId = mmhp.Id) RIGHT JOIN MuralResourcesMaster mmssl ON (mphpssi.ResourceId = mmssl.Id) RIGHT JOIN MuralHotspotContent mhpc ON (mphpssi.Id = mhpc.HotspotResourceId) WHERE mphpssi.IsActive = 1 AND mmhp.IsActive = 1 AND mmssl.IsActive = 1 AND mhpc.IsActive = 1";

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
                    $temp=array("hotspot_id"=>$row['Id'], "hotspot_label"=>$row['HotspotLabel'], "resource_id"=>$row['ResourceId'], "resource_name"=>$row['ResourceName'], "resource_type"=>$row['ResourceType'], "content_url"=>$row['FilePath'], "content_type"=>$row['FileType']);
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
	$response['mural_hotspot'] = $mural_hotspot;
	
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>
