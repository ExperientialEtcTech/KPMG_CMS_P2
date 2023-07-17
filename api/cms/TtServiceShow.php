<?php
include_once('../../jwt/jwtAccess.php');
header("Content-Type:application/json");
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
$details=array();

$sql="SELECT Id,Service, icon FROM TtServicesMaster WHERE Id=? AND IsActive=1";
$ServiceId = 0;
if(isset($_POST['ServiceId']))
{
	$ServiceId=$_POST['ServiceId'];

    $params = array(&$ServiceId);

    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_prepare( $conn, $sql, $params, $options);

    if($stmt){
        if(sqlsrv_execute($stmt))
        {
            if(sqlsrv_num_rows($stmt)>0){
                while($row = sqlsrv_fetch_array($stmt))
                {
                    $temp=array("Id"=>$row['Id'],"Service"=>$row['Service'],"icon"=>$row['icon']);
                    array_push($details, $temp);
                }
                response($details);
            }else{
                response( NULL);
            }
        }
        
        
    }else{
    die(print_r(sqlsrv_errors(), true)); 
        response( NULL);
    }
    sqlsrv_close($conn);
} else {
    response("Param not set");
}


function response($details)
{
	
	$response['services'] = $details;

	$json_response = json_encode($response);
	echo $json_response;
}
?>