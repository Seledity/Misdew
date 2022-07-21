<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$id = safe($_GET['id']);
$powner = mysqli_num_rows((mysqli_query($conx, "SELECT id FROM feed_comments WHERE uid='$u_uid' && id='$id'")));
if($powner == '1' && $u_rank != 'mod') {
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'-.03 WHERE uid='$u_uid'");
  mysqli_query($conx, "DELETE FROM feed_comments WHERE id='$id'");
  mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE cmt_id='$id'");
  header("location: /feed");
  exit();
}
elseif($powner == '1' && $u_rank == 'mod') {
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'-.03 WHERE uid='$u_uid'");
  mysqli_query($conx, "DELETE FROM feed_comments WHERE id='$id'");
  mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE cmt_id='$id'");
  header("location: /feed");
  exit();
}
elseif($powner != '1' && $u_rank == 'mod') {
  mysqli_query($conx, "DELETE FROM feed_comments WHERE id='$id'");
  mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE cmt_id='$id'");
  header("location: /feed");
  exit();
}
exit();
?>
