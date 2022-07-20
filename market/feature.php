<?php
$this_page = "market";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$p_app_uqid = safe($_POST['app_uqid']);
$p_u_token = safe($_POST['token']);
// If POSTED token is not equal to the correct user token.
if($p_u_token != $u_token) {
  exit();
}
else {
  // If the POSTED app UQID is invalid.
  if(mysqli_num_rows($appq = mysqli_query($conx, "SELECT uqid FROM apps WHERE uqid='$p_app_uqid'")) == 0) {
    exit();
  }
  else {
    // If user is not a content manager.
    if($u_cont_mang != 'yes') {
      exit();
    }
    else {
      mysqli_query($conx, "UPDATE market SET promo_hotkey='top_featured' WHERE uqid='$p_app_uqid'");
      mysqli_query($conx, "UPDATE market SET promo_tstamp='$tstamp' WHERE uqid='$p_app_uqid'");
      exit();
    }
  }
}
?>
