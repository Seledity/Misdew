<?php
require_once("../inc/conx.php");
$gtoken = safe($_GET['t']);
if($gtoken == $u_token && $logged_in == true && $u_jailed != 'yes') {
  $kill = '';
  setcookie("akgnxoPwqlIs", $kill, time()+3600*24*30, '/', '.misdew.com');
  setcookie("LoILilzcnmwe", $kill, time()+3600*24*30, '/', '.misdew.com');
  setcookie("puTtxXvbEkOo", $kill, time()+3600*24*30, '/', '.misdew.com');
  header("location: /");
  exit();
}
else {
  header("location: /");
  exit();
}
?>
