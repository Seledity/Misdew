<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($chat_dark == 'no') {
  header("location: /");
  exit();
}
// Update Data Saver
$headerfloat = safe($_POST['headerfloat']);
$user_tokken = safe($_POST['token']);
if(isset($headerfloat)) {
  // On
  if($headerfloat == 'on' && $u_token == $user_tokken) {
    mysqli_query($conx, "UPDATE accounts SET header_float='on' WHERE uid='$u_uid'");
  }
  // Off
  if($headerfloat == 'no' && $u_token == $user_tokken) {
    mysqli_query($conx, "UPDATE accounts SET header_float='no' WHERE uid='$u_uid'");
  }
}
?>
