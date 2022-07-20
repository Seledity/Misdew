<?php
require_once("../inc/conx.php");
$gtoken = safe($_GET['t']);
$gid = safe($_GET['i']);
if($gtoken == $u_token && $logged_in == true && $gid) {
  if($gid == 'droplets') {
    mysqli_query($conx, "UPDATE accounts SET hub_theme='droplets' WHERE uid='$u_uid'");
  }
  elseif($gid == 'stars') {
    mysqli_query($conx, "UPDATE accounts SET hub_theme='stars' WHERE uid='$u_uid'");
  }
  elseif($gid == 'galaxy') {
    mysqli_query($conx, "UPDATE accounts SET hub_theme='galaxy' WHERE uid='$u_uid'");
  }
  header("location: /hub");
  exit();
}
else {
  header("location: /");
  exit();
}
?>
