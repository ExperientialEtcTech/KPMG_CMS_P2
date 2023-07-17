<?php
include_once('security.php');
$senderPage=explode("/",$_SERVER['HTTP_REFERER']);
$senderArrayLength=count($senderPage);
$senderPage=$senderPage[$senderArrayLength-1];
//print_r($senderPage);

switch ($senderPage) {
  case "login.php":
      if(f_checkLogin($_POST['user'],$_POST['pass']))
      {
        header("location: select_template.php");
      } else {
          header("location: error.php");
      }
    break;

  default:
    exit;
}

function f_checkLogin($user,$pass)
{
    if($user=="admin")
    {
        return true;
    } else {
        return false;
    }
}
?>