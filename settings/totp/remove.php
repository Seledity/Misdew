<?php
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Update Data Saver
$tokenkey = safe($_GET['mdkey']);
if($tokenkey != $u_token) {
  header("location: /");
  exit();
}
else {
    mysqli_query($conx, "UPDATE accounts SET auth_app='no' WHERE uid='$u_uid'");
    header("location: /settings/totp");
    exit();
}
?>
