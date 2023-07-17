<?php
error_reporting(0);
session_start();
header("X-Frame-Options: DENY");
header("Access-Control-Allow-Mathods: GET,POST");
header("X-XSS-Protection: 1");
header("Content-Security-Policy: script-src 'Unsafe-inline' 'unsafe-eval' 'self'");
if(!isset($_SESSION['username']))
{
    //header('HTTP/1.0 403 Forbidden');
    header("Location : login.php");
    //echo "Access Denied";
    exit;
}
$decoded=explode(".",$_COOKIE['kpmg-access']);
$decip=json_decode(base64_decode($decoded[1]),true)['ip'];
if(isset($decip))
{
if($decip!==$_SERVER['REMOTE_ADDR'])
{
	echo "Access Denied invalid ip";
	exit;
}
}
if(isset($_SESSION['raw-username']))
{
    $filename=$_SESSION['raw-username'].'-fp.lock';
    $myfile = fopen($filename, "w") or die("Unable to open file!".$filename);
    $txt = "Javed Akhtar\n";
    fwrite($myfile, $txt);
    fclose($myfile);
}
?>