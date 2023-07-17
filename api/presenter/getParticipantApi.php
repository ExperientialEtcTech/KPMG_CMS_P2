<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
if (isset($_POST['event_id']) && $_POST['event_id']!=""){
$details=Array();
	$eventid = $_POST['event_id'];
	//Added by shubham - 30/08
	//$sql = "SELECT Name,EmailAddress FROM VisitorWelcomeDetails WHERE BookingId = ?";
	$sql = "SELECT Name,EmailAddress FROM VisitorWelcomeDetails WHERE BookingId = ? AND RfidNumber != 'NULL'";
	$params1 = array(&$eventid);

	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);
	
	if($stmt){
        if(sqlsrv_execute($stmt)){
            if(sqlsrv_num_rows($stmt)>0)
            {
                while ($row = sqlsrv_fetch_array($stmt)) {
                    $temp=array("Name"=>$row['Name'], "EmailAddress"=>$row['EmailAddress']);
                    array_push($details, $temp);
                }
                response($details);
            }else{
                response($details);
            }

            // response("Success");
        }else{
            response("Failed");
        }

    }else{
        response("Failed");
    }
}else{
	response("Invalid Params");
}	


function response($details)
{
	
	$response['details'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>
