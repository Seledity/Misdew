<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$feed_id = safe($_GET['i']);

$like_q = mysqli_query($conx, "SELECT uid FROM feed_likes WHERE post_id='$feed_id'");
$likcnt_r = mysqli_num_rows($like_q);
if($likcnt_r == 0) {
  echo "nobody <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>";
}
while($like_r = mysqli_fetch_array($like_q)) {
  $like_uid = $like_r['uid'];
  // selects user data for each heart
  $likeu_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$like_uid'");
  while($likeu_r = mysqli_fetch_array($likeu_q)) {
    $like_username = $likeu_r['username'];
  }
  echo $separator;
  echo "<a href=\"/profile/?u=$like_username\" class=\"like_username\">$like_username</a>";
  if (!$separator) $separator = ', ';
}
?>
