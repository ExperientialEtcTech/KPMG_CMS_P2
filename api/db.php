<?php
error_reporting(1);
$basePath="E:\App server\httpdocs";
//$baseUrl="http://10.188.7.135/";
$baseUrl="https://kpmg.experientialetc.com/";
$serverName = "WIN-E96D4GOVBBU"; //10.188.7.73,1113
$connectionInfo = array( "Database"=>"KPMG_InnovationCenter", "UID"=>"sa", "PWD"=>"Admin@123","TrustServerCertificate"=>True,"Encrypt"=>True,"CharacterSet"=>"UTF-8");
//$connectionInfo = array( "Database"=>"KPMG_InnovationCenter", "UID"=>"KPMGInnovationCenter", "PWD"=>"Pv@91Kg#72Xz","TrustServerCertificate"=>True,"Encrypt"=>True,"CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!$conn) {
     echo "Connection could not be established.";
     die( print_r( sqlsrv_errors(), true));
}
function insert_log($conn,$module="",$callingUrl="",$calledUrl="",$calledData="",$response="")
{
	global $conn;
	$sql = "INSERT INTO AppLogs (datetime,module,callingUrl,calledUrl,calledData,response) VALUES (GETDATE(),'".$module."','".$callingUrl."','".$calledUrl."','".$calledData."','".$response."')";

    $params1 = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sql, $params1, $options);

	if($stmt){
		sqlsrv_execute($stmt);
	}
}
?>