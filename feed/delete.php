<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  //header("location: /");
  exit();
}
$id = safe($_GET['id']);
$powner = mysqli_num_rows((mysqli_query($conx, "SELECT id FROM feed WHERE uid='$u_uid' && id='$id'")));
$psqlr = mysqli_fetch_assoc($pselc);
if($powner == '1' && $u_cont_mang != 'yes') {
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'-.05 WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-.25 WHERE uid='$u_uid'");
  mysqli_query($conx, "DELETE FROM feed WHERE id='$id'");
  mysqli_query($conx, "DELETE FROM feed_likes WHERE post_id='$id'");
  mysqli_query($conx, "DELETE FROM feed_comments WHERE post_id='$id'");
  mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE post_id='$id'");
  //header("location: /feed");
  exit();
}
elseif($powner == '1' && $u_cont_mang == 'yes') {
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'-.05 WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-.25 WHERE uid='$u_uid'");
  mysqli_query($conx, "DELETE FROM feed WHERE id='$id'");
  mysqli_query($conx, "DELETE FROM feed_likes WHERE post_id='$id'");
  mysqli_query($conx, "DELETE FROM feed_comments WHERE post_id='$id'");
  mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE post_id='$id'");
  //header("location: /feed");
  exit();
}
elseif($powner != '1' && $u_cont_mang == 'yes') {
  mysqli_query($conx, "DELETE FROM feed WHERE id='$id'");
  mysqli_query($conx, "DELETE FROM feed_likes WHERE post_id='$id'");
  mysqli_query($conx, "DELETE FROM feed_comments WHERE post_id='$id'");
  mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE post_id='$id'");
  //header("location: /feed");
  exit();
}
exit();
?>
