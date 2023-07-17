<?php
//include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");

if (isset($_POST['rfidnumber'])){
	$sql = "SELECT AssignedStatus FROM MasterRfid WHERE RfidNumber = ? ";
   

		$rfidnumber= $_POST['rfidnumber'];
        $params1 = array(&$rfidnumber);

        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

       
        if($stmt){
            if(sqlsrv_execute($stmt))
            {
                if(sqlsrv_num_rows($stmt)>0){
                    $row = sqlsrv_fetch_array($stmt);
                   	
					$AssignedStatus = $row['AssignedStatus'];
					
                } else {
					$AssignedStatus = "NULL";
				}
            } else {
                die(print_r(sqlsrv_errors(), true)); 
				
            }
            
            
        }else{
            die(print_r(sqlsrv_errors(), true)); 
            $temparray=NULL;
        }
        
    
    sqlsrv_close($conn);
    response($AssignedStatus);
} else {
	response('no params');
}

function response($creds)
{
	$response['status'] = $creds;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>