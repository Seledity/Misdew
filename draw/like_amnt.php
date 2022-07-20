<?php
require_once("../inc/conx.php");
$i = safe($_GET['i']);
$cntq = mysqli_query($conx, "SELECT id FROM draw_likes WHERE draw_id='$i'");
$like_count = mysqli_num_rows($cntq);
if($like_count != '1') {
  $like_s_or_nah = "s";
}
else {
  $like_s_or_nah = "";
}
echo $like_count . " like" . $like_s_or_nah;
?>
