<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$postid = safe($_GET['i']);
if($feed_id) {
  $postid = $feed_id;
}
$dcnt = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT uid FROM feed_likes WHERE post_id='$postid'"));
if($dcnt == '0') {
  echo "nobody <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>";
}
$sseparator = '';
while($slcr = mysqli_fetch_assoc($slcq)) {
  $uuid = $slcr['uid'];
  $sslcq = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$uuid'");
  while($sslcr = mysqli_fetch_assoc($sslcq)) {
    $uusername = $sslcr['username'];
  }
  echo $sseparator;
  echo "<span onclick=\"window.open('/canvas/$uusername');\">$uusername</span>";
  if (!$sseparator) $sseparator = ', ';
}
?>
