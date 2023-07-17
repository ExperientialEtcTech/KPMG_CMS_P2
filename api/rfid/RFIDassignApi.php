<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

if (!(empty($_POST['emp_name']) && empty($_POST['rfid']) && empty($_POST['email_id']) && empty($_POST['company']) && empty($_POST['datetime']) && empty($_POST['img_url'])))
{
}else{
	response(0, "Invalid Params");
	exit;
}

include('../db.php');



// $details = "Success";
// response($details);
$empname= $_POST['emp_name'];
$rfid = $_POST['rfid'];
$email_id = $_POST['email_id'];

$company= $_POST['company'];
$datetime = date('Y-m-d H:i:s', $_POST['datetime']);

//date_default_timezone_set('Asia/Kolkata');
//$datetime = time();
$imgurl=$_POST['img_url'];
//$imgurl= "https://experientialetc.com/KPMG-test/assets/Male.png";
$bookingId=$_POST['booking_id'];

	$sql="SELECT * FROM VisitorWelcomeDetails WHERE RfidNumber = ?";

	$params1 = array(&$rfid);

	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
		if($stmt){
			if(sqlsrv_execute($stmt))
			{
				if(sqlsrv_num_rows($stmt)>0){
					response(0, "RFID is already assigned");
				} else {

					$sql2="INSERT INTO VisitorWelcomeDetails(Name, RfidNumber, OrganizationName, EmailAddress, BookingDateTime, 	VisitorImage, BookingId) VALUES (?,?,?,?,?,?,?)";
					$params2 = array(&$empname,$rfid,$company,$email_id,$datetime,$imgurl,$bookingId);

					$options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt2 = sqlsrv_prepare( $conn, $sql2, $params2, $options2);
					if($stmt2){
						if(sqlsrv_execute($stmt2))
						{
							//Commented and added by shubhamJ - For incrementing counter for times the rfid number is mapped - start - 30/6/23
							//$sql3 = "UPDATE MasterRfid SET AssignedStatus = 1 WHERE RfidNumber = ? AND AssignedStatus = 0";
							$sql3 = "UPDATE MasterRfid SET AssignedStatus = 1, TimesMapped = TimesMapped + 1  WHERE RfidNumber = ? AND AssignedStatus = 0";
							//Commented and added by shubhamJ - For incrementing counter for times the rfid number is mapped - end - 30/6/23
							$params3 = array(&$rfid);
							$stmt3 = sqlsrv_prepare( $conn, $sql3, $params3, $options);
							if($stmt3){
								if(sqlsrv_execute($stmt3))
								{
									response(1, "RFID is successfully assigned");
								}else{
									response(0, "Failed to assign rfid2");
								}
							}else{
								die(print_r(sqlsrv_errors(), true)); 
							}
							
						} else {
							//die(print_r(sqlsrv_errors(), true)); 
							response(0, "Failed to assign rfid3");
						}
					}


				}
			}
		}


function response($status, $msg)
{

	$response['status'] = $status;
	$response['msg'] = $msg;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>
