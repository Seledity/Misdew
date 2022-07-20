<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$gtoken = safe($_POST['token']);
if($gtoken == $u_token) {
  $current_pass = safe($_POST['curr_passwd']);
  $new_uname = safe($_POST['new_uname']);
  $u_password = $y['password'];
  $u_namechange = $y['uname_change'];
  // numbers and letters only
  if(!ctype_alnum($new_uname)) {
    header("location: /throw_error");
    exit();
  }
  // if username already exists
  $q = mysqli_query($conx, "SELECT username FROM accounts WHERE username='$new_uname'");
  $c = mysqli_num_rows($q);
  if($c > 0) {
    header("location: /throw_error");
    exit();
  }
  // If current password is correct
  // hash the password
  $password_hashed = hash("sha256",$u_username.$current_pass);
  $new_password_hashed = hash("sha256",$new_uname.$current_pass);
  if($password_hashed == $u_password) {
    if($u_namechange == 'no') {
      mysqli_query($conx, "UPDATE accounts SET username='$new_uname' WHERE uid='$u_uid'");
      mysqli_query($conx, "UPDATE accounts SET password='$new_password_hashed' WHERE uid='$u_uid'");
      mysqli_query($conx, "UPDATE accounts SET uname_change='yes' WHERE uid='$u_uid'");
      if($u_csplown == 'yes') {
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$new_uname' WHERE uid='$u_uid' && theme_id='1'");
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit2_name='' WHERE uid='$u_uid' && theme_id='1'");
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit3_name='' WHERE uid='$u_uid' && theme_id='1'");

        mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$new_uname' WHERE uid='$u_uid' && theme_id='2'");
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit2_name='' WHERE uid='$u_uid' && theme_id='2'");
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit3_name='' WHERE uid='$u_uid' && theme_id='2'");

        mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$new_uname' WHERE uid='$u_uid' && theme_id='3'");
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit2_name='' WHERE uid='$u_uid' && theme_id='3'");
        mysqli_query($conx, "UPDATE user_theme_colors SET csplit3_name='' WHERE uid='$u_uid' && theme_id='3'");
      }
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
