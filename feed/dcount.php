<?php
/* Coded by Neonacid64 */
require_once("../inc/conx.php");
$id = safe($_GET['id']);

$likcnt_q = mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$id'");
$likcnt_r = number_format(mysqli_num_rows($likcnt_q));
if($likcnt_r != '1') {
  $lsz = "s";
}

  echo "$likcnt_r dislike$lsz";

?>
