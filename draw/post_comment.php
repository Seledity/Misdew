<?php
require_once("../inc/conx.php");
$comment = safe($_POST['comment']);
$draw_id = safe($_POST['draw_id']);
$dwqq = mysqli_query($conx, "SELECT uid FROM draw WHERE id='$draw_id'");
$dwrr = mysqli_fetch_assoc($dwqq);
$draw_uid = $dwrr['uid'];
if($comment !='') {
  mysqli_query($conx, "INSERT INTO draw_comments (uid, draw_id, content, tstamp) VALUES ('$u_uid','$draw_id','$comment','$tstamp')");
  if($draw_uid != $u_uid) {
    mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$draw_uid' && app_uqid='draw' && snooze='no'")) != '0') {
      function genRand($length = 15) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }
      $rstr = genRand();
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$draw_uid','yes','draw','<span style=\"font-weight: bold;\">$u_username</span> left a comment.','/draw/?i=$draw_id','$tstamp')");
    }
  }
}
else {
  exit();
}
?>
