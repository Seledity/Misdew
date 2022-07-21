<?php
/* Coded by Neonacid64 */
require_once("../inc/conx.php");
$id = safe($_GET['i']);

$query = mysqli_query($conx, "SELECT * FROM feed_comments WHERE post_rstr= '$id'");
$amount = mysqli_num_rows($query);
if($amount != '1') {
  $lsz = "s";
}
echo "$amount comment$lsz";
?>
