<?php
$this_page = "market";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$p_remove = safe($_GET['t']);
$p_app_uqid = safe($_POST['app_uqid']);
$p_u_token = safe($_POST['token']);
$p_u_rating = safe($_POST['rating_num']);
// If rating is an invalid value.
if($p_u_rating == '1' OR $p_u_rating == '2' OR $p_u_rating == '3' OR $p_u_rating == '4' OR $p_u_rating == '5') {
}
else {
  exit();
}
// If POSTED token is not equal to the correct user token.
if($p_u_token != $u_token) {
  exit();
}
else {
  $app_prchsd = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE app_uqid='$p_app_uqid' && uid='$u_uid'"));
  if($app_prchsd != 0) {
    if($p_remove == 'r') {
      mysqli_query($conx, "DELETE FROM market_ratings WHERE app_uqid='$p_app_uqid' && uid='$u_uid'");
      exit();
    }
    // If user has already rated app.
    if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM market_ratings WHERE app_uqid='$p_app_uqid' && uid='$u_uid'")) != 0) {
      exit();
    }
    // If the POSTED app UQID is invalid.
    if(mysqli_num_rows($appq = mysqli_query($conx, "SELECT uqid FROM apps WHERE uqid='$p_app_uqid'")) == 0) {
      exit();
    }
    // POSTED data has made it through all checks.
    else {
      $appr = mysqli_fetch_assoc($appq);
      $app_uqid = $appr['uqid'];
      mysqli_query($conx, "INSERT INTO market_ratings (uid,app_uqid,rating) VALUES ('$u_uid','$p_app_uqid','$p_u_rating')");
      exit();
    }
  }
}
?>
