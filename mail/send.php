<?php
require_once("../inc/conx.php");
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  die("You do not belong to this conversation.");
  exit();
}
$chat_txt = mysqli_real_escape_string($conx, htmlentities($_POST['body']));

if($chat_txt && $post != 'n') {
	$disq = mysqli_query($conx, "SELECT id,uid_from,pmuid FROM mail WHERE uqid='$cv_uqid' ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid_from'];
	$dis_pmuid = $disr['pmuid'];
	if($dis_uid == $u_uid) {
		if($msgtype != 'pm') {
			mysqli_query($conx, "UPDATE mail SET display_name='no' WHERE id='$dis_id'");
		}
	}
	// update online time
	mysqli_query($conx, "UPDATE mail_memb SET chat_time='$tstamp' WHERE uqid='$cv_uqid' && uid='$u_uid'");
	mysqli_query($conx, "INSERT INTO mail (uqid, uid_from, message, timestamp) VALUES ('$cv_uqid','$u_uid', '$chat_txt', '$tstamp')");
  mysqli_query($conx, "UPDATE mail_memb SET last_active='$tstamp' WHERE uqid='$cv_uqid'");
  sleep(2);
  mysqli_query($conx, "UPDATE mail_memb SET latest_read='no' WHERE uqid='$cv_uqid' && uid!='$u_uid'");
  sleep(8);
  $notur_s = mysqli_query($conx, "SELECT uid FROM mail_memb WHERE uqid='$cv_uqid' && latest_read='no' && sent='no'");
  while($notur_r = mysqli_fetch_assoc($notur_s)) {
    mysqli_query($conx, "UPDATE mail_memb SET sent='yes' WHERE uqid='$cv_uqid'");
    $n_uid = $notur_r['uid'];
    $n_sent = $notur_r['sent'];
    $n_lread = $notur_r['latest_read'];
    sleep(2);
    mysqli_query($conx, "UPDATE mail_memb SET sent='yes' WHERE uqid='$cv_uqid'");
    //if($latest_read == 'no') {
      if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$n_uid' && app_uqid='mail' && snooze='no'")) != '0') {
        mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$tstamp','$n_uid','yes','mail','You have unread messages.','/mail/convo.php?i=$cv_uqid','$tstamp')");
      //}
    }
  }
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.01 WHERE uid='$u_uid'");
}
?>
