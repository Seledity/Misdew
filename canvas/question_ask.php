<?php
require_once("../inc/conx.php");
$question = safe($_POST['question']);
$ask_type = safe($_POST['ask_type']);
$canv_uid = safe($_POST['cnv_uid']);
if($canv_uid != $u_uid) {
  if($ask_type == 'anon' && $question !='') {
    mysqli_query($conx, "INSERT INTO canvas_askbox (uid_canvas, uid_asker, anonymous, question, upd_tstamp) VALUES ('$canv_uid','$u_uid','yes','$question','$tstamp')");
    mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$canv_uid' && app_uqid='canvas' && snooze='no'")) != '0') {
      function genRand($length = 15) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }
      $rstr = genRand();
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$canv_uid','yes','canvas','<span style=\"font-weight: bold;\">Someone</span> asked a question.','/canvas','$tstamp')");
    }
  }
  elseif($ask_type == 'norm' && $question !='') {
    mysqli_query($conx, "INSERT INTO canvas_askbox (uid_canvas, uid_asker, anonymous, question, upd_tstamp) VALUES ('$canv_uid','$u_uid','no','$question','$tstamp')");
    mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$canv_uid' && app_uqid='canvas' && snooze='no'")) != '0') {
      function genRand($length = 15) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }
      $rstr = genRand();
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$canv_uid','yes','canvas','<span style=\"font-weight: bold;\">$u_username</span> asked a question.','/canvas','$tstamp')");
    }
  }
  else {
    exit();
  }
}
?>
