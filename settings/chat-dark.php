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
$chattheme = safe($_POST['chattheme']);
$user_tokken = safe($_POST['token']);
if(isset($chattheme)) {
  // On
  if($chattheme == 'yes' && $u_token == $user_tokken) {
    mysqli_query($conx, "UPDATE accounts SET u_chatdark_def='yes' WHERE uid='$u_uid'");
  }
  // Off
  if($chattheme == 'no' && $u_token == $user_tokken) {
    mysqli_query($conx, "UPDATE accounts SET u_chatdark_def='no' WHERE uid='$u_uid'");
  }
}
?>
