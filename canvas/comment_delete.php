<?php
require_once("../inc/conx.php");
$c_id = safe($_GET['c_id']);
$cv_qq = mysqli_query($conx, "SELECT id,uid_canvas,uid_poster FROM canvas_comments WHERE id='$c_id'");
$cv_qr = mysqli_fetch_assoc($cv_qq);
$cvq_id = $cv_qr['id'];
$cvq_uidc = $cv_qr['uid_canvas'];
$cvq_uid_cmnter = $cv_qr['uid_poster'];
if($cvq_uidc == $u_uid || $cvq_uid_cmnter == $u_uid || $u_cont_mang == 'yes') {
  mysqli_query($conx, "DELETE FROM canvas_comments WHERE id='$c_id'");
}
exit();
?>
