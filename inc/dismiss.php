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
    mysqli_query($conx, "DELETE FROM notifs WHERE id='$gid'");
    exit();
  }
  exit();
}
else {
  exit();
}
?>
