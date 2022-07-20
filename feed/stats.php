<?php
/* Coded by Neonacid64 */
/*
require_once("../inc/conx.php");

  $feed_q = mysqli_query($conx, "SELECT id,uid,post,tstamp,random_str,visibility,edited,img,is_poll FROM feed ORDER BY id ASC");
  while($feed_r = mysqli_fetch_assoc($feed_q)) {
    // Feed data
    $feed_id = $feed_r['id'];
    $likcnt_q = mysqli_query($conx, "SELECT id FROM feed_likes WHERE post_id='$feed_id'");
    $likcnt_r = number_format(mysqli_num_rows($likcnt_q));
    if($likcnt_r != '1') {
      $lsz = "s";
    }
    echo $feed_id;
    echo ": ";
    echo $likcnt_r;
    echo "<br>";
}
*/
?>
