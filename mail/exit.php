<?php
$this_page = "mail";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Get the member's ID of the conversation.
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows($cv_slc = mysqli_query($conx, "SELECT id,uqid,uid FROM mail_memb WHERE id='$cv_uqid'")) == '0') {
  echo "You do not belong to this conversation.";
  exit();
}
// Select original member conversation info.
$cv_rw = mysqli_fetch_array($cv_slc);
$cvo_uqid = $cv_rw['uqid'];
$cv_uid = $cv_rw['uid'];
// Check if the user is in the conversation and select their own member info.
$cv_cnt = mysqli_num_rows($cvo_slc = mysqli_query($conx, "SELECT uid,rank FROM mail_memb WHERE uqid='$cvo_uqid' && uid='$u_uid'"));
$cvo_rw = mysqli_fetch_array($cvo_slc);
$cvo_uid = $cvo_rw['uid'];
$cvo_rank = $cvo_rw['rank'];
// If the member is an admin.
if($cvo_rank == 'admin') {
  // Remove the member from the conversation.
  // If they are removing themself.
  $add_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$cv_uid'");
  $add_r = mysqli_fetch_assoc($add_q);
  $removed_username = $add_r['username'];
  if($cvo_uid == $cv_uid) {
    $del_uid = $u_uid;
    $who = "@$u_username exited the conversation.";
  }
  // If they are removing another member.
  else {
    $del_uid = $cv_uid;
    $who = "@$u_username exited @$removed_username from the conversation.";
  }
  mysqli_query($conx, "DELETE FROM mail_memb WHERE id='$cv_uqid' && uid='$del_uid'");
  mysqli_query($conx, "INSERT INTO mail (uqid, uid_from, message, timestamp) VALUES ('$cvo_uqid','6', '$who', '$tstamp')");
}
// If the member is not an admin and is only removing themself.
elseif($cv_cnt == '1' && $cvo_uid == $cv_uid) {
  // Remove the member from the conversation.
  mysqli_query($conx, "DELETE FROM mail_memb WHERE id='$cv_uqid' && uid='$u_uid'");
  mysqli_query($conx, "INSERT INTO mail (uqid, uid_from, message, timestamp) VALUES ('$cvo_uqid','6', '@$u_username exited the conversation.', '$tstamp')");
}
// The member does not meet any of the above checks.
else {
  echo "You do not belong to this conversation.";
  exit();
}
?>
