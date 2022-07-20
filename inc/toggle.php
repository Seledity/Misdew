<?php
require_once("../inc/conx.php");
$gtoken = safe($_GET['t']);
$gid = safe($_GET['i']);
if($gtoken == $u_token && $logged_in == true && $gid) {
  $ver = mysqli_query($conx, "SELECT uid,app_uqid FROM notifs WHERE id='$gid'");
  $s = mysqli_fetch_assoc($ver);
  $notif_uid = $s['uid'];
  $napp_uqid = $s['app_uqid'];
  if($notif_uid == $u_uid) {
    $toggleit = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE snooze='yes' && uid='$u_uid' && app_uqid='$napp_uqid'"));
    if($toggleit == 1) {
      mysqli_query($conx, "UPDATE user_apps SET snooze='no' WHERE uid='$u_uid' && app_uqid='$napp_uqid'");
      echo "snooze";
    }
    elseif($toggleit == 0) {
      mysqli_query($conx, "UPDATE user_apps SET snooze='yes' WHERE uid='$u_uid' && app_uqid='$napp_uqid'");
      echo "wake";
    }
    exit();
  }
  exit();
}
else {
  exit();
}
?>
