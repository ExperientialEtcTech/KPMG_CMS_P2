<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");

//echo isset($_POST['email']);

if ((isset($_POST['email']))){
	//Added by shubham  - 29/08
	//$sql = "SELECT EmailAddress,Name,BookingId FROM VisitorWelcomeDetails WHERE BookingId=? AND EmailAddress=?";
	/*$sql = "SELECT EmailAddress,Name,BookingId FROM VisitorWelcomeDetails WHERE (BookingId=? OR EmailAddress=? OR CentreId = ? ) AND RfidNumber != 'NULL' ";*/
	$sql = "SELECT EmailAddress,Name,BookingId FROM VisitorWelcomeDetails WHERE (BookingId=? OR EmailAddress=?) AND RfidNumber != 'NULL' ";
    //$bookingId = $_POST['bookingId'];
    $emails=json_decode($_POST['email']);
    $temparray=Array();

    foreach($emails as $record)
    {

$email=explode("<>",$record)[0];
$bookingId=explode("<>",$record)[1];
		//$CentreId=explode("<>",$record)[2];
        //$params1 = array(&$bookingId,&$email,&$CentreId);
 		$params1 = array(&$bookingId,&$email);
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

        
        if($stmt){
            if(sqlsrv_execute($stmt))
            {
                if(sqlsrv_num_rows($stmt)>0){
                    while($row = sqlsrv_fetch_array($stmt))
                    {
                        //$arr=$row['EmailAddress']=>$row['Name'];
                        //array_push($temparray[$row["EmailAddress"]]=$row["Name"]);
//echo $row['EmailAddress'];
array_push($temparray,$row['EmailAddress']."<>".$row['BookingId']);
                    }
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
        
    }
    sqlsrv_close($conn);
    response($temparray);
} else {
	response(NULL);
}

function response($creds)
{
	$response['list'] = $creds;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>