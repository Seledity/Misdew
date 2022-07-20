<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Get the member's ID of the conversation.
$cv_uqid = safe($_GET['i']);
$cv_adduid = safe($_GET['u']);
if(mysqli_num_rows($cv_slc = mysqli_query($conx, "SELECT id,uqid,uid,rank FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  echo "You do not belong to this conversation.";
  exit();
}
// Select original member conversation info.
$cv_rw = mysqli_fetch_array($cv_slc);
$cv_uid = $cv_rw['uid'];
$cv_rank = $cv_rw['rank'];
$add_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$cv_adduid'");
$add_r = mysqli_fetch_assoc($add_q);
$add_username = $add_r['username'];
$c_memb = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$cv_adduid'"));
$cva_s = mysqli_query($conx, "SELECT can_add FROM mail_convo WHERE uqid='$cv_uqid'");
$cva_r = mysqli_fetch_array($cva_s);
$cvo_cadd = $cva_r['can_add'];
// If the member is an admin.
if($cvo_cadd == 'yes' && $c_memb == '0') {
  mysqli_query($conx, "INSERT INTO mail_memb (uqid, uid, last_active) VALUES ('$cv_uqid', '$cv_adduid','$tstamp')");
  mysqli_query($conx, "INSERT INTO mail (uqid, uid_from, message, timestamp) VALUES ('$cv_uqid','6', '@$add_username has been added.', '$tstamp')");
  function genRand2($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $rstrTWO = genRand2();
  if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$cv_adduid' && app_uqid='mail' && snooze='no'")) != '0') {
    mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstrTWO','$cv_adduid','yes','mail','<span style=\"font-weight: bold;\">$u_username</span> added you to a conversation.','/mail/convo.php?i=$cv_uqid','$tstamp')");
  }
}
// The member does not meet any of the above checks.
else {
  echo "You do not belong to this conversation.";
  exit();
}
?>
