<?php
//include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");

if (isset($_POST['email']) && isset($_POST['bookingId'])){
	$sql = "SELECT RfidNumber, EmailAddress,Name,BookingId FROM VisitorWelcomeDetails WHERE (BookingId=? AND EmailAddress=?) AND RfidNumber != 'NULL' ";
   

$email= $_POST['email'];
$bookingId= $_POST['bookingId'];
        $params1 = array(&$bookingId,&$email);

        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

       
        if($stmt){
            if(sqlsrv_execute($stmt))
            {
                if(sqlsrv_num_rows($stmt)>0){
                    $row = sqlsrv_fetch_array($stmt);
                   	
					$assigned_rfid_number = $row['RfidNumber'];
					
                } else {
					//echo "no record ".$email."<>".$bookingId."<br>";
				}
            } else {
                die(print_r(sqlsrv_errors(), true)); 
				
            }
            
            
        }else{
            die(print_r(sqlsrv_errors(), true)); 
            $temparray=NULL;
        }
        
    
    sqlsrv_close($conn);
    response($assigned_rfid_number);
} else {
	response('no params');
}

function response($creds)
{
	$response['list'] = $creds;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>