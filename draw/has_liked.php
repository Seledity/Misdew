<?php
require_once("../inc/conx.php");
$i = safe($_GET['i']);
$hasl = mysqli_query($conx, "SELECT id FROM draw_likes WHERE draw_id='$i' && uid='$u_uid'");
$hasr = mysqli_fetch_assoc($hasl);
$has_liked = mysqli_num_rows($hasl);
if($has_liked == '0') {
  echo "like";
}
else {
  echo "unlike";
}
?>
