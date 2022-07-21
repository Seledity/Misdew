<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$gtoken = safe($_POST['token']);
$gtheme = safe($_POST['theme']);
if($gtoken == $u_token) {
  if($gtheme == '1') {
    mysqli_query($conx, "UPDATE accounts SET theme='$gtheme' WHERE uid='$u_uid'");
    exit();
  }
  if($gtheme == '2') {
    mysqli_query($conx, "UPDATE accounts SET theme='$gtheme' WHERE uid='$u_uid'");
    exit();
  }
  if($gtheme == '3') {
    mysqli_query($conx, "UPDATE accounts SET theme='$gtheme' WHERE uid='$u_uid'");
    exit();
  }
}
else {
  header("location: /throw_error");
}
?>
