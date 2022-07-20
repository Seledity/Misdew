<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$draw_id = safe($_POST['i']);
$tstamp = time();
mysqli_query($conx, "UPDATE draw SET collections='yes' WHERE uid='$u_uid' && id='$draw_id'");
mysqli_query($conx, "UPDATE draw SET order_tstamp='$tstamp' WHERE uid='$u_uid' && id='$draw_id'");
?>
