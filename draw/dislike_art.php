<?php
require_once("../inc/conx.php");
$i = safe($_POST['i']);
$cntq = mysqli_query($conx, "SELECT id FROM draw_dislikes WHERE draw_id='$i' && uid='$u_uid'");
$cntr = mysqli_fetch_assoc($cntq);
$like_id = $cntr['id'];
$has_disliked = mysqli_num_rows($cntq);
$drawe = mysqli_query($conx, "SELECT id FROM draw WHERE id='$i'");
$does_exist = mysqli_num_rows($drawe);
if($does_exist == '1') {
  if($has_disliked == '0') {
    mysqli_query($conx, "INSERT INTO draw_dislikes (uid, draw_id) VALUES ('$u_uid','$i')");
    exit();
  }
  else {
    mysqli_query($conx, "DELETE FROM draw_dislikes WHERE id='$like_id'");
    exit();
  }
}
else {
  exit();
}
?>
