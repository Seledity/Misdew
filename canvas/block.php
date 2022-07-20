<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Get Block ID
$blockid = safe($_POST['uid']);
if(isset($blockid)) {
  # PREVENT BLOCKING OF STAFF #
  $cnv_q = mysqli_query($conx, "SELECT comm_mang,cont_mang,design_police,peacekeeper FROM accounts WHERE uid='$blockid'");
  $cnv_r = mysqli_fetch_assoc($cnv_q);
  $cnv_uid = $cnv_r['uid'];
  $cnv_username = $cnv_r['username'];
  $cnv_picture = $cnv_r['picture'];
  $cnv_comm_mang = $cnv_r['comm_mang'];
  $cnv_cont_mang = $cnv_r['cont_mang'];
  $cnv_design_pol = $cnv_r['design_police'];
  $cnv_peacekpr = $cnv_r['peacekeeper'];
  # If account is a bot.
  if($cnv_bot == 'yes') {
    exit();
  }
  # Display the appropriate badges earned by the user.
  // Community Manager Badge.
  if($cnv_comm_mang == 'yes') {
    exit();
  }
  // Account Manager Badge.
  if($cnv_cont_mang == 'yes') {
    exit();
  }
  // Design Police Badge.
  if($cnv_design_pol == 'yes') {
    exit();
  }
  // Peacekeeper Badge.
  if($cnv_peacekpr == 'yes') {
    exit();
  }
  mysqli_query($conx, "INSERT INTO blocking (uid, blocked_uid, tstamp) VALUES ('$u_uid','$blockid','$tstamp')");
  mysqli_query($conx, "DELETE FROM friends WHERE uid_req='$blockid' && uid_rec='$u_uid'");
  mysqli_query($conx, "DELETE FROM friends WHERE uid_rec='$blockid' && uid_req='$u_uid'");
}
?>
