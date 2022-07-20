<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$draw_id = safe($_POST['i']);
$dwq = mysqli_query($conx, "SELECT location FROM draw WHERE id='$draw_id'");
$dwr = mysqli_fetch_assoc($dwq);
$file = $dwr['location'];
unlink(".." . $file);
mysqli_query($conx, "DELETE FROM draw WHERE id='$draw_id' && uid='$u_uid'");
?>
