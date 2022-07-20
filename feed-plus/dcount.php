<?php
/* Coded by Neonacid64 */
require_once("../inc/conx.php");
$id = safe($_GET['id']);

$dislikcnt_q = mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$id'");
$dislikcnt_r = number_format(mysqli_num_rows($dislikcnt_q));
if($dislikcnt_r != '1') {
  $dlsz = "s";
}

  echo "<span style=\"font-weight: bold;\">$dislikcnt_r</span> dislike$dlsz";

?>
