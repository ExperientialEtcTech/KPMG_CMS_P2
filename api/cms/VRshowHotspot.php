<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");

if(isset($_POST['ServiceVideoId'])){
		$details=array();
		$status=1;
		$ServiceVideoId = $_POST['ServiceVideoId'];

	
		$sql = "SELECT rel.Id AS RelativeId, rel.HotspotTo, servcon.Name, servcon.Labels, rel.PosX, rel.PosY, rel.PosZ, rel.RotX, rel.RotY, rel.RotZ FROM RelativeHotspots rel JOIN VRServiceVideos servcon ON ( rel.HotspotFrom = ? and servcon.ServiceId = rel.ServiceId and rel.HotspotTo = servcon.Id and rel.IsActive = servcon.IsActive and servcon.IsActive = ?)";
		$temp2 = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$param = array(&$ServiceVideoId, &$status);
		$stmt = sqlsrv_prepare( $conn, $sql, $param, $options);
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				while ($row1 = sqlsrv_fetch_array($stmt)){
							$temp1 = array();
							$position = array();
							$rotation = array();
							
							$temp1['Id'] = $row1['RelativeId'];
							$temp1['name'] = $row1['Name'];
							$temp1['hotspotTo'] = $row1['HotspotTo'];
							$temp1['tagname'] = $row1['Labels'];
							
							$position['x'] = $row1['PosX'];
							$position['y'] = $row1['PosY'];
							$position['z'] = $row1['PosZ'];

							$rotation['x'] = $row1['RotX'];
							$rotation['y'] = $row1['RotY'];
							$rotation['z'] = $row1['RotZ'];

							$temp1['position'] = $position;
							$temp1['rotation'] = $rotation;
							//print_r($temp1['name']);
							array_push($temp2, $temp1);
						}
				$details['LocationHotspot'] = $temp2;
				
			}else{
				$details['LocationHotspot'] = Array("status"=>"0","msg"=>"No hotspots found.");
			}
		}else{
			die(print_r(sqlsrv_errors(), true)); 
			response(Array("status"=>"0","msg"=>"Fail"));
		}
	
	
		$sql2 = "SELECT * FROM HotspotContent WHERE VideoId = ? AND IsActive = ?";
		$temp4 = array();

		$params2 = array(&$ServiceVideoId, &$status);
		$stmt2 = sqlsrv_prepare($conn,$sql2, $params2, $options);
		if(sqlsrv_execute($stmt2)){
			if(sqlsrv_num_rows($stmt2)>0){
				while ($row2 = sqlsrv_fetch_array( $stmt2) ) {
					$temp3 = array();

					$position1 = array();
					$rotation1 = array();
					$temp3['Id'] = $row2['Id'];
					$temp3['type'] = $row2['Type'];
					$temp3['content'] = $row2['Content'];

					$position1['x'] = $row2['PosX'];
					$position1['y'] = $row2['PosY'];
					$position1['z'] = $row2['PosZ'];

					$rotation1['x'] = $row2['RotX'];
					$rotation1['y'] = $row2['RotY'];
					$rotation1['z'] = $row2['RotZ'];

					$temp3['position'] = $position1;
					$temp3['rotation'] = $rotation1;

					array_push($temp4, $temp3);
					//print_r($temp4);
				}
				$details['ContentHotspot'] = $temp4;
			}else{
				$details['ContentHotspot'] = Array("status"=>"0","msg"=>"No hotspots found.");
			}
		}else{
			die(print_r(sqlsrv_errors(), true)); 
			response(Array("status"=>"0","msg"=>"Fail"));
		}
		response($details);		
				
} else {
    response(Array("status"=>"0","msg"=>"Invalid values"));
}



function response($details)
{
	
	$response['hotspot'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>