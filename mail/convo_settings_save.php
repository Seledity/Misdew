<?php
require_once("../inc/conx.php");
$cv_uqid = safe($_GET['i']);
$memb_add = safe($_GET['memb_add']);
$cv_name = safe($_GET['cv_name']);
$cv_color = safe($_GET['cv_color']);
if(mysqli_num_rows($cvo_slc = mysqli_query($conx, "SELECT id,rank FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  echo "<div class=\"mail_cont\"><br><span class=\"no_mail\">You do not belong to this conversation.</span><br><br></div>";
  exit();
}
$cvo_rw = mysqli_fetch_array($cvo_slc);
$cvo_rank = $cvo_rw['rank'];
if($cvo_rank == 'admin') {
  if($memb_add) {
    if($memb_add == 'yes' OR $memb_add == 'no') {
      mysqli_query($conx, "UPDATE mail_convo SET can_add='$memb_add' WHERE uqid='$cv_uqid'");
    }
  }
}
if($cv_name) {
  mysqli_query($conx, "UPDATE mail_convo SET name='$cv_name' WHERE uqid='$cv_uqid'");
}
if($cv_color) {
  mysqli_query($conx, "UPDATE mail_convo SET main_color='$cv_color' WHERE uqid='$cv_uqid'");
}
?>
