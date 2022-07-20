<?php
require_once("../inc/conx.php");
$napp_uqid = safe($_POST['i']);
if($napp_uqid) {
  $toggleit = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE snooze='yes' && uid='$u_uid' && app_uqid='$napp_uqid'"));
  if($toggleit == 1) {
    mysqli_query($conx, "UPDATE user_apps SET snooze='no' WHERE uid='$u_uid' && app_uqid='$napp_uqid'");
  }
  elseif($toggleit == 0) {
    mysqli_query($conx, "UPDATE user_apps SET snooze='yes' WHERE uid='$u_uid' && app_uqid='$napp_uqid'");
  }
  exit();
}
else {
  exit();
}
?>
