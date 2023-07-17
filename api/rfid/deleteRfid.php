<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");

if (isset($_POST['rfidnumber'])){
	
	$sqlMaster = "SELECT * FROM MasterRfid WHERE RfidNumber = ? AND AssignedStatus = 1";
	$rfidnumber= $_POST['rfidnumber'];
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$paramsMaster = array(&$rfidnumber);
	$stmt = sqlsrv_prepare( $conn, $sqlMaster, $paramsMaster, $options);
	if($stmt){
		if(sqlsrv_execute($stmt))
		{
			if(sqlsrv_num_rows($stmt)>0){
				$sql = "UPDATE VisitorWelcomeDetails SET RfidNumber = 'NULL' WHERE RfidNumber = ? ";
				$params1 = array(&$rfidnumber);
				$stmt1 = sqlsrv_prepare( $conn, $sql, $params1, $options);


				if($stmt1){
					if(sqlsrv_execute($stmt1))
					{
						if(sqlsrv_num_rows($stmt1)>0){
							
							$sqlMaster2 = "UPDATE MasterRfid SET AssignedStatus = 0 WHERE RfidNumber = ? AND AssignedStatus = 1";
							$paramsMaster2 = array(&$rfidnumber);
							$stmtMaster2 = sqlsrv_prepare( $conn, $sqlMaster2, $paramsMaster2, $options);
							if($stmtMaster2){
								if(sqlsrv_execute($stmtMaster2))
								{
									if(sqlsrv_num_rows($stmtMaster2)>0){
										$status = "Successfull";
									}else{
										$status = "Failed";
										die(print_r($status.sqlsrv_errors(), true)); 
									}
								}else{
									$status = "Failed to update in masterrfid";
									die(print_r($status.sqlsrv_errors(), true)); 
								}
							}else{
								$status = "Failed to prepare statement";
								die(print_r($status.sqlsrv_errors(), true)); 
							}
							
							
						} else {
							$status = "no record";
						}
					} else {
						die(print_r($status.sqlsrv_errors(), true)); 

					}
				}else{
					die(print_r($status.sqlsrv_errors(), true)); 
					$temparray=NULL;
				}
			} else {
				$status = "no record";
			}
		} else {
			die(print_r(sqlsrv_errors(), true)); 

		}
	}else{
			
	}
    sqlsrv_close($conn);
    response($status);
} else {
	response('no params');
}

function response($creds)
{
	$response['msg'] = $creds;
	$json_response = json_encode($response);
	insert_log($conn,"cms",$_SERVER['REMOTE_ADDR'],basename($_SERVER['PHP_SELF']),json_encode($_POST),$json_response);
	echo $json_response;
}
?>