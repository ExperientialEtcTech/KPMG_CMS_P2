<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
if (isset($_POST['event_id']) && $_POST['event_id']!="") {

	$event_id = $_POST['event_id']; 

	
	//$sqlQuery="SELECT ag.DateTime, ag.Title, ag.Status, ag_con.ContentPath, ag_con.ContentType FROM EventAgenda ag INNER JOIN EventAgendaContent ag_con ON ag.Id = ag_con.EventAgendaId WHERE ag.BookingId=? AND ag.Status = ? ORDER BY ag.DateTime ASC;";
	
	$sqlQuery="SELECT Status,Id, DateTime, Title FROM EventAgenda WHERE BookingId = ? AND Status = ? ORDER BY DateTime ASC;";
	$status = 1;
	$params1 = array(&$event_id, &$status);

	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sqlQuery, $params1, $options);

	if($stmt){
		if(sqlsrv_execute($stmt))
		{
			if(sqlsrv_num_rows($stmt)>0){  

				$agendaList = array();
				while($row = sqlsrv_fetch_array($stmt)){
					$temp = array();
					$temp['agenda_id'] =  $row['Id'];
					$temp['datetime'] = $row['DateTime'];
					$temp['agenda_title'] = $row['Title'];
					$temp['status'] = $row['Status'];
					//$temp['content_url'] = $row['ContentPath'];
					//$temp['content_type']= $row['ContentType'];
					
					//gets content array from eventagendacontent
					$EventAgendaId =  $row['Id'];
					$sqlContent="SELECT ContentPath, ContentType FROM EventAgendaContent WHERE EventAgendaId = ?";
					$paramsContent = array(&$EventAgendaId);
					$stmtContent = sqlsrv_prepare( $conn, $sqlContent, $paramsContent, $options);
					if(sqlsrv_execute($stmtContent)){
						if(sqlsrv_num_rows($stmtContent)>0){ 
							$content = array();
							while($rowContent = sqlsrv_fetch_array($stmtContent)){
								$temp1 = array();
								$temp1['content_url'] = $rowContent['ContentPath'];
								$temp1['content_type']= $rowContent['ContentType'];
								array_push($content, $temp1);	
							}
							//print_r($content);
						}else{
							$content = [];
						}
						$temp['content'] = $content;
					}

					// array_push($agendaList, [$agenda_id, $datetime, agenda_title, $status, $content_url, $content_type]);
					array_push($agendaList, $temp);

				}

				response($agendaList);
			}else{
				//echo "0 row";
				//response([]);
				
				//print_r("asd");
				$sql =  "SELECT * FROM MasterAgenda";
				//$params2 = array(&$event_id);
				//$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				
				$stmt1 = sqlsrv_prepare( $conn, $sql, [], $options);
				
				if($stmt1){ 
					if(sqlsrv_execute($stmt1)){
						$agendaList = array();
						if(sqlsrv_num_rows($stmt1)>0){
							while ($row = sqlsrv_fetch_array( $stmt1) ) {
								$temp = array();
								$temp['agenda_id'] =  $row['Id'];
								$temp['agenda_title'] = $row['Title'];
								$temp['status'] = "1";
								$temp['datetime'] = "";
								$temp['content'] = [];
								/*
								$temp['content_url'] = "";
								$temp['content_type']= "";
								*/
								array_push($agendaList, $temp);
							}
						}
					}else{
						response("No default Agendas found");
					}
					response($agendaList);
				}
			}
		}
	}
}else{
	response("Invalid Request");
}

function response($agendaList){

	$response['agendaList'] = $agendaList;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>

