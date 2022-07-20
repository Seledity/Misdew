<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$draw_id = safe($_POST['i']);
mysqli_query($conx, "UPDATE draw SET collections='no' WHERE uid='$u_uid' && id='$draw_id'");
?>
