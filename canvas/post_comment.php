<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$comment = safe($_POST['comment']);
$canv_uid = safe($_POST['cnv_uid']);
if($comment !='') {
  mysqli_query($conx, "INSERT INTO canvas_comments (uid_canvas, uid_poster, content, tstamp) VALUES ('$canv_uid','$u_uid','$comment','$tstamp')");
  if($canv_uid != $u_uid) {
    mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$canv_uid' && app_uqid='canvas' && snooze='no'")) != '0') {
      function genRand($length = 15) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }
      $rstr = genRand();
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$canv_uid','yes','canvas','<span style=\"font-weight: bold;\">$u_username</span> left a comment.','/canvas','$tstamp')");
    }
  }
}
else {
  exit();
}
?>
