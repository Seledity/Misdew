<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Update Data Saver
$upd_2fa = safe($_POST['toggle2FA']);
$tokenkey = safe($_POST['mdkey']);
if($tokenkey != $u_token) {
  header("location: /");
  exit();
}
if(isset($upd_2fa)) {
  // On
  if($upd_2fa == 'on') {
    $var_2fa = "enabled";
    mysqli_query($conx, "UPDATE accounts SET 2fa='$var_2fa' WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET auth_app='no' WHERE uid='$u_uid'");
  }
  // Off
  if($upd_2fa == 'off') {
    $var_2fa = "disabled";
    mysqli_query($conx, "UPDATE accounts SET 2fa='$var_2fa' WHERE uid='$u_uid'");
  }
}
?>
