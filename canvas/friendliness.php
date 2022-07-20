<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$cnv_uid = safe($_POST['cnv_uid']);
$action = safe($_POST['action']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM accounts WHERE uid='$cnv_uid'")) == '0') {
  header("location: /hub");
  exit();
}
$usr_fgq = mysqli_query($conx, "SELECT friendliness FROM account_figures WHERE uid='$cnv_uid'");
$usr_fgr = mysqli_fetch_assoc($usr_fgq);
$cnv_friendliness = $usr_fgr['friendliness'];
if($action == 'down') {
  if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM friendliness WHERE uid='$u_uid' && uid_to='$cnv_uid' && action='down'")) == '0') {
    mysqli_query($conx, "INSERT INTO friendliness (uid, uid_to, action) VALUES ('$u_uid','$cnv_uid','down')");
    mysqli_query($conx, "UPDATE account_figures SET friendliness='$cnv_friendliness'-1 WHERE uid='$cnv_uid'");
  }
}
if($action == 'up') {
  if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM friendliness WHERE uid='$u_uid' && uid_to='$cnv_uid' && action='up'")) == '0') {
    mysqli_query($conx, "INSERT INTO friendliness (uid, uid_to, action) VALUES ('$u_uid','$cnv_uid','up')");
    mysqli_query($conx, "UPDATE account_figures SET friendliness='$cnv_friendliness'+1 WHERE uid='$cnv_uid'");
  }
}
?>
