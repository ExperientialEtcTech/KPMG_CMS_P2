<?php

include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

$sql = "SELECT BookingId, SignOffTrigger, FeedbackFlag FROM EventSignoff WHERE Id = (SELECT MAX(Id) FROM EventSignoff) AND Status = ?";
$update = "UPDATE EventSignoff SET Status = 1  WHERE BookingId = ?";

$status = 0;

$params1 = array(&$status);
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt1 = sqlsrv_prepare( $conn, $sql, $params1, $options);
	$details = array();
    if($stmt1){
		
        $checkEntry = False;
        if(sqlsrv_execute($stmt1)){
            if(sqlsrv_num_rows($stmt1)>0){
            
                 while ($row = sqlsrv_fetch_array( $stmt1) ) {
					$details['eventId'] = $row['BookingId'];
					$details['signoff_trigger'] = $row['SignOffTrigger'];
					$details['feedback_flag'] = $row['FeedbackFlag']; 
					
                    $checkEntry = True;
                }
                
            }else{
                response("No entries");
            }

            // response("Success");
        }else{
            response("Failed1");
        }
		//close statement
		//$stmt1->close();
    }else{
        response("Failed2");
    }

$params2 = array(&$details['eventId']);
$stmt2 = sqlsrv_prepare( $conn, $update, $params2, $options);
    //To update
	if($checkEntry){
		if($stmt2){
			if(sqlsrv_execute($stmt2)){
					response($details);
				}else{
					response("Failed");
				}

				//close statement
				//$stmt2->close();
			}else{
				response("Failed to update");
			}
	}



function response($res)
{

	$response['res'] = $res;
	$json_response = json_encode($response);
	echo $json_response;
}
?>