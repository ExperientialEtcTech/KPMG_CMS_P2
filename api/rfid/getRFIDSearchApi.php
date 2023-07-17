<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
// header('Access-Control-Allow-Origin: *');
//or
// header('Access-Control-Allow-Origin: http://localhost/KPMG/RFID/index.php');

/*
SELECT vis.Name, vis.EmailAddress, vis.BookingId, boo.OrganizationName,  vis.MobileNumber, boo.BookingDateTime, vis.BookingId, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE vis.Name LIKE '%Ru%';

*/

if ((isset($_POST['nameText']) || isset($_POST['organization'])  || isset($_POST['email_id']))){
    
    //to check payload variables 
    if(isset($_POST['nameText']) && isset($_POST['organization']) && isset($_POST['email_id'])){
        $name = $_POST['nameText'];
        $organization = $_POST['organization'];
        $email_id = $_POST['email_id'];
		
		$name = "%" . $name . "%";
		$email_id = "%" . $email_id . "%";
		$organization = "%" . $organization . "%";
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE emp_name LIKE '%{$name}%' AND company LIKE '%{$organization}%' AND email_id LIKE '%{$email_id}%'");
		
		$sql = "SELECT vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE vis.Name LIKE ? AND boo.OrganizationName LIKE ? AND vis.EmailAddress LIKE ?";
		
		$params = array(&$name, &$organization, &$email_id);
		
    }elseif(isset($_POST['nameText']) && isset($_POST['organization'])){
        $name = $_POST['nameText'];
        $organization = $_POST['organization'];
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE emp_name LIKE '%{$name}%' AND company LIKE '%{$organization}%'");
		$name = "%" . $name . "%";
		$organization = "%" . $organization . "%";
		$sql = "SELECT  vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE vis.Name LIKE ? AND boo.OrganizationName LIKE ?";
	
		$params = array(&$name, &$organization);
        
    }elseif(isset($_POST['organization']) && isset($_POST['email_id'])){
        $email_id = $_POST['email_id'];
        $organization = $_POST['organization'];
		$email_id = "%" . $email_id . "%";
		$organization = "%" . $organization . "%";
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE company LIKE '%{$organization}%' AND email_id LIKE '%{$email_id}%'");
		
		$sql = "SELECT vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE boo.OrganizationName LIKE ? AND vis.EmailAddress LIKE ?";
	
		$params = array( &$organization, &$email_id);
        
    }elseif(isset($_POST['nameText']) && isset($_POST['email_id'])){
        $name = $_POST['nameText'];
        $email_id = $_POST['email_id'];
		$name = "%" . $name . "%";
		$email_id = "%" . $email_id . "%";
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE emp_name LIKE ? AND email_id LIKE ?");
		
		$sql = "SELECT vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE vis.Name LIKE ? AND vis.EmailAddress LIKE ?";
	
		$params = array(&$name, &$email_id);
        
    }elseif(isset($_POST['nameText'])){
        $name = $_POST['nameText'];
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE emp_name LIKE '%{$name}%'");
		$name = "%" . $name . "%";
		$sql = "SELECT vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE vis.Name LIKE ?;";

		$params = array(&$name);
        
    }elseif(isset($_POST['organization'])){
        $organization = $_POST['organization'];
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE company LIKE '%{$organization}%'");
		$organization = "%" . $organization . "%";
		$sql = "SELECT vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime, vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE boo.OrganizationName LIKE ?";
	
		$params = array(&$organization);
        
    }elseif(isset($_POST['email_id'])){
        $email_id = $_POST['email_id'];
		$email_id = "%" . $email_id . "%";
        //$sql = mysqli_query($mysqli,"SELECT * FROM userdata WHERE email_id LIKE '%{$email_id}%'");
		$sql = "SELECT vis.Id, vis.Id, vis.Name, vis.EmailAddress, vis.BookingId, vis.MobileNumber, boo.OrganizationName, boo.BookingDateTime,  vis.ParticipantImageUrl FROM VisitorDetails vis JOIN BookingDetails boo ON vis.BookingId = boo.BookingId WHERE vis.EmailAddress LIKE ?";
	
		$params = array(&$email_id);
    }

    $creds = array();
    $tempArr = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

	if($stmt){
		if(sqlsrv_execute($stmt)){	
			if(sqlsrv_num_rows($stmt)>0){	
	        		while ($row = sqlsrv_fetch_array( $stmt) ) {
						// print_r($row); 
						$tempArr['Id'] =  $row['Id'];
						$tempArr['emp_name'] =  $row['Name'];
						$tempArr['company'] =  $row['OrganizationName'];
						$tempArr['email_id'] =  $row['EmailAddress'];
						$tempArr['MobileNumber'] =  $row['MobileNumber'];
						$tempArr['event_id'] =  $row['BookingId'];
						$tempArr['datetime'] =  $row['BookingDateTime'];
						$tempArr['img_url'] =  $row['ParticipantImageUrl'];
						
						
						//to check if rfid is assigned already 
						$check_name = $row['Name'];
						$check_company = $row['OrganizationName'];
						$check_email=$row['EmailAddress'];
						//$check_sql = mysqli_query($mysqli,"SELECT * FROM user_rfid WHERE emp_name = '$check_name' AND `company` = '$check_company';");

						$check_sql = "SELECT * FROM VisitorWelcomeDetails WHERE Name = ? AND OrganizationName = ? AND EmailAddress = ?";
						$params1 = array(&$check_name, &$check_company,&$check_email);
						$stmt1 = sqlsrv_prepare( $conn, $check_sql, $params1, $options);
						
						if($stmt1){
    						if(sqlsrv_execute($stmt1)){
								if(sqlsrv_num_rows($stmt1)>0){
									$tempArr['rfid_status'] =  1;
								}else{
									$tempArr['rfid_status'] =  0;
								}
							}
						}
						
						array_push($creds, $tempArr);
					}
				response($creds);
			}else{
				// echo "<script>alert(' No such name as $nameText');</script>";
				response(NULL);
			}
		}
    }else{
		response(NULL);
	}
}



function response($creds)
{
	
	$response['cred'] = $creds;
	$response['no_of_cards'] = count($creds);
	

	// $response['date'] = $date;
	//  $response['time'] = $time;
	

	
	$json_response = json_encode($response);
	echo $json_response;
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
}
?>
