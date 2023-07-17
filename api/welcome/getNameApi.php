<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
date_default_timezone_set('Asia/Kolkata');
if (isset($_POST['rfid_no']) && $_POST['rfid_no']!="") {

	$rfid_no = $_POST['rfid_no'];
	
	$sql = "SELECT * FROM VisitorWelcomeDetails WHERE RFIDNumber = ?";

    $params1 = array(&$rfid_no);
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
	
	if($stmt){
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$row = sqlsrv_fetch_array($stmt);

				$datetime=$row['BookingDateTime']->getTimestamp();

				$dt = new DateTime("@$datetime");
				$dt->setTimezone(new DateTimeZone('Asia/Kolkata'));
				$date = $dt->format('F j, Y'); 
				$time = $dt->format('g:i A'); 
				response($row['Name'], $row['OrganizationName'], $date, $time, $rfid_no, $row['VisitorImage'],  "Success");

			}else{
				//response( NULL, NULL,  NULL, NULL, $rfid_no, NULL, "No Records Found");
			}
		}
	}
	}else{
		response( NULL, NULL,  NULL, NULL,  NULL, NULL, "Invalid Request");
	}

function response($emp_name, $company, $date, $time, $rfid_no, $img_path, $status){
	$response['emp_name'] = $emp_name;
	$response['company'] = $company;
	$response['date'] = $date;
	$response['time'] = $time;
	$response['rfid_no'] = $rfid_no;
	$response['img_path'] = $img_path;
	$response['status'] = $status;

	$json_response = json_encode($response);
	echo $json_response;
}
?>