<?php
//include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
//header("Access-Control-Allow-Methods: POST");

	//print_r($_POST['ServiceId']);
	//print_r($_GET['ServiceId']);
if(isset($_GET['ServiceId']) && $_GET['ServiceId'] != ""){
	$ServiceId = $_GET['ServiceId'];
	$result ="SELECT serv.Id, servcon.Name, serv.ServiceOrder, servcon.ContentFilePath, servcon.Id AS ServiceContentId  FROM VRServiceVideos servcon JOIN VRServices serv ON (serv.Id = servcon.ServiceId  AND serv.IsActive = 1 AND servcon.IsActive = 1) WHERE ServiceId = ?";
			$params = array(&$ServiceId);
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt = sqlsrv_prepare( $conn, $result, $params, $options);
			if($stmt){
				sqlsrv_execute($stmt);
				if(sqlsrv_num_rows($stmt)>0){
					$services = array();
					while ($row = sqlsrv_fetch_array($stmt)){
							$temp = array();
							$status=1;
							$temp['name'] =  $row['Name'];
							$temp['contentURL'] = $row['ContentFilePath'];

							$ServiceContentId = $row['ServiceContentId'];
							//print_r($ServiceContentId);
							//$sql1 = mysqli_query($mysqli,"SELECT servcon.Name, reloc.posx, reloc.posy, reloc.posz, reloc.rotx, reloc.roty, reloc.roty  FROM `relativeLocations` reloc JOIN `servicecontent` servcon ON ( reloc.HotspotIdFrom = '$ServiceContentId' and servcon.ServiceId = reloc.ServiceId and reloc.HotspotTo = servcon.ServiceContentId and servcon.Status = 1);");

							$sql1 = "SELECT servcon.Name, servcon.Labels, rel.PosX, rel.PosY, rel.PosZ, rel.RotX, rel.RotY, rel.RotZ FROM RelativeHotspots rel JOIN VRServiceVideos servcon ON ( rel.HotspotFrom = ? and servcon.ServiceId = rel.ServiceId and rel.HotspotTo = servcon.Id and servcon.IsActive = ? and rel.IsActive = ?)";

							$temp2 = array();
							$params1 = array(&$ServiceContentId, &$status, &$status);
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$stmt1 = sqlsrv_prepare( $conn, $sql1, $params1, $options);

							if($stmt1){
								sqlsrv_execute($stmt1);
								if(sqlsrv_num_rows($stmt1)>0){
									while ($row1 = sqlsrv_fetch_array( $stmt1)){
										$temp1 = array();
										$position = array();
										$rotation = array();

										$temp1['name'] = $row1['Name'];
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
								}
							}
							$temp['LocationHotspot'] = $temp2;


							//$sql2 = mysqli_query($mysqli,"SELECT Content,type,hotspot1_pos_x, hotspot1_pos_x, hotspot1_pos_y, hotspot1_pos_z,hotspot1_rot_x, hotspot1_rot_y, hotspot1_rot_z FROM `hotspot_content` WHERE `ServiceContentId`= $ServiceContentId AND `Status` = 1 ");
							$sql2 = "SELECT * FROM HotspotContent WHERE VideoId = ? AND IsActive = ?";
							$temp4 = array();

							$params2 = array(&$ServiceContentId, &$status);
							$stmt2 = sqlsrv_prepare($conn,$sql2, $params2, $options);
							if($stmt2){
								sqlsrv_execute($stmt2);
								if(sqlsrv_num_rows($stmt2)>0){
									while ($row2 = sqlsrv_fetch_array( $stmt2) ) {
										$temp3 = array();

										$position1 = array();
										$rotation1 = array();

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
									$temp['hotspot'] = $temp4;
								}
							}
							array_push($services, $temp);


					}

					//print_r($services);
					//array_push($response, $services);
					

				}else{
					response("Failed");
				}

			}else{
					response("Failed");
				}
	response($services);
}else{
	die(print_r(sqlsrv_errors(), true));
	response($response);
};
function response($res)
{
	
	$response['service'] = $res;
	$json_response = json_encode($response);
	echo $json_response;
}
?>