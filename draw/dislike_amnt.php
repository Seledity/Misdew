<?php
require_once("../inc/conx.php");
$i = safe($_GET['i']);
$cntq = mysqli_query($conx, "SELECT id FROM draw_dislikes WHERE draw_id='$i'");
$dislike_count = mysqli_num_rows($cntq);
if($dislike_count != '1') {
  $dislike_s_or_nah = "s";
}
else {
  $dislike_s_or_nah = "";
}
echo $dislike_count . " dislike" . $dislike_s_or_nah;
?>
