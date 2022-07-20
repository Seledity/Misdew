<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  die("You do not belong to this conversation.");
  exit();
}
// update online time
mysqli_query($conx, "UPDATE mail_memb SET chat_time='$tstamp' WHERE uqid='$cv_uqid' && uid='$u_uid'");
mysqli_query($conx, "UPDATE mail_memb SET latest_read='yes' WHERE uqid='$cv_uqid' && uid='$u_uid'");
mysqli_query($conx, "UPDATE mail_memb SET sent='no' WHERE uqid='$cv_uqid' && uid='$u_uid'");
?>
