<?php
require_once("../inc/conx.php");
$cnv_type = safe($_POST['type']);
$ptoken = safe($_POST['token']);
if($ptoken != $u_token) {
  exit();
}
if($cnv_type == 'css') {
  mysqli_query($conx, "UPDATE accounts SET css='' WHERE uid='$u_uid'");
}
if($cnv_type == 'design') {
  mysqli_query($conx, "DELETE FROM canvas_design WHERE uid='$u_uid'");
  mysqli_query($conx, "INSERT INTO canvas_design (uid) VALUES ('$u_uid')");
}
exit();
?>
