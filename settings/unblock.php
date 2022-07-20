<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Get Block ID
$blockid = safe($_POST['i']);
if(isset($blockid)) {
  mysqli_query($conx, "DELETE FROM blocking WHERE id='$blockid' && uid='$u_uid'");
}
?>
