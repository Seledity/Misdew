<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$gtoken = safe($_POST['token']);
if($gtoken == $u_token) {
  $current_pass = safe($_POST['current']);
  $new_pass = safe($_POST['new_pass']);
  $conf_pass = safe($_POST['conf_pass']);
  $u_password = $y['password'];
  // If current password is correct
  // hash the password
  $password_hashed = hash("sha256",$u_username.$current_pass);
  if($password_hashed == $u_password) {
    if($new_pass == $conf_pass) {
      // hash the password
      $password_hashed = hash("sha256",$u_username.$new_pass);
      mysqli_query($conx, "UPDATE accounts SET password='$password_hashed' WHERE uid='$u_uid'");
    }
    else {
      header("location: /throw_error");
    }
  }
  else {
    header("location: /throw_error");
  }
}
else {
  header("location: /throw_error");
}
?>
