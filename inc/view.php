<?php
require_once("../inc/conx.php");
$gtoken = safe($_GET['t']);
$gid = safe($_GET['i']);
if($gtoken == $u_token && $logged_in == true && $gid) {
  $ver = mysqli_query($conx, "SELECT uid,app_uqid,view_link,viewed FROM notifs WHERE id='$gid'");
  $s = mysqli_fetch_assoc($ver);
  $notif_uid = $s['uid'];
  $napp_uqid = $s['app_uqid'];
  $napp_href = $s['view_link'];
  $napp_viewed = $s['viewed'];
  if($notif_uid == $u_uid) {
    if($napp_viewed == 'no') {
      mysqli_query($conx, "UPDATE notifs SET viewed='yes' WHERE id='$gid'");
    }
    header("location: $napp_href");
    exit();
  }
  exit();
}
else {
  exit();
}
?>
