<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$draw_id = safe($_POST['i']);
$draw_title = safe($_POST['title']);
$draw_desc = safe($_POST['desc']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM draw WHERE id='$draw_id' && uid='$u_uid'")) == '1') {
  if($draw_title) {
    mysqli_query($conx, "UPDATE draw SET name='$draw_title' WHERE id='$draw_id'");
  }
  if($draw_desc) {
    mysqli_query($conx, "UPDATE draw SET description='$draw_desc' WHERE id='$draw_id'");
  }
}
else {
  exit();
}
?>
