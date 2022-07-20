<?php
require_once("../inc/conx.php");
$add_uid = safe($_POST['add_uid']);
$t = safe($_GET['t']);
if($t == 'acc') {
  if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM friends WHERE uid_rec='$u_uid' && uid_req='$add_uid'")) != 0) {
    mysqli_query($conx, "UPDATE friends SET accepted='yes' WHERE uid_rec='$u_uid' && uid_req='$add_uid'");
    mysqli_query($conx, "UPDATE friends SET accepted='yes' WHERE uid_rec='$add_uid' && uid_req='$u_uid'");
    mysqli_query($conx, "UPDATE friends SET tstamp='$tstamp' WHERE uid_rec='$u_uid' && uid_req='$add_uid'");
    mysqli_query($conx, "UPDATE friends SET tstamp='$tstamp' WHERE uid_rec='$add_uid' && uid_req='$u_uid'");
    mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$add_uid' && app_uqid='canvas' && snooze='no'")) != '0') {
      function genRand($length = 15) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }
      $rstr = genRand();
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$add_uid','yes','canvas','<span style=\"font-weight: bold;\">$u_username</span> accepted your friendship.','/canvas/$u_username','$tstamp')");
    }
  }
}
else {
  if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM friends WHERE uid_rec='$u_uid' && uid_req='$add_uid'")) == 0) {
    mysqli_query($conx, "INSERT INTO friends (uid_req,uid_rec,orig_uid) VALUES ('$u_uid','$add_uid','$u_uid')");
    mysqli_query($conx, "INSERT INTO friends (uid_req,uid_rec,orig_uid) VALUES ('$add_uid','$u_uid','$u_uid')");
    mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$add_uid' && app_uqid='canvas' && snooze='no'")) != '0') {
      function genRand($length = 15) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }
      $rstr = genRand();
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$add_uid','yes','canvas','<span style=\"font-weight: bold;\">$u_username</span> requested your friendship.','/canvas','$tstamp')");
    }
  }
}
?>
