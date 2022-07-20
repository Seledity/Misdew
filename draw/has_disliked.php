<?php
require_once("../inc/conx.php");
$i = safe($_GET['i']);
$hasl = mysqli_query($conx, "SELECT id FROM draw_dislikes WHERE draw_id='$i' && uid='$u_uid'");
$hasr = mysqli_fetch_assoc($hasl);
$has_disliked = mysqli_num_rows($hasl);
if($has_disliked == '0') {
  echo "dislike";
}
else {
  echo "undislike";
}
?>
