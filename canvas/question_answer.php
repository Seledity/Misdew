<?php
require_once("../inc/conx.php");
$quest_id = safe($_POST['quest_id']);
$answer = safe($_POST['answer']);
$qasker_q = mysqli_query($conx, "SELECT uid_asker FROM canvas_askbox WHERE id='$quest_id' && uid_canvas='$u_uid'");
$qasker_r = mysqli_fetch_assoc($qasker_q);
$qa_uid = $qasker_r['uid_asker'];
$qasker_qq = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$qa_uid'");
$qasker_rr = mysqli_fetch_assoc($qasker_qq);
$qa_username = $qasker_rr['username'];
mysqli_query($conx, "UPDATE canvas_askbox SET answer='$answer' WHERE id='$quest_id' && uid_canvas='$u_uid'");
mysqli_query($conx, "UPDATE canvas_askbox SET upd_tstamp='$tstamp' WHERE id='$quest_id' && uid_canvas='$u_uid'");
mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.001 WHERE uid='$u_uid'");
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$qa_uid' && app_uqid='canvas' && snooze='no'")) != '0') {
  function genRand($length = 15) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $rstr = genRand();
  mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstr','$qa_uid','yes','canvas','<span style=\"font-weight: bold;\">$u_username</span> answered your question.','/canvas/$u_username','$tstamp')");
}
?>
