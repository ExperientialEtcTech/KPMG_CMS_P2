<?php
	session_start();
	include("phptextClass.php");	
	
	/*create class object*/
	$phptextObj = new phptextClass();	
	/*phptext function to genrate image with text*/
	header('Content-type:image/jpg');
	$phptextObj->phpcaptcha('#94d178','#2650dd',120,40,10,25);	
 ?>