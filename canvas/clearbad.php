<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$cnv_uid = safe($_POST['cnv_uid']);
$uu_uid = safe($_POST['uu_uid']);
$uu_token = safe($_POST['token']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM accounts WHERE uid='$cnv_uid'")) == '0') {
  header("location: /hub");
  exit();
}
if($cnv_uid == $u_uid && $uu_token == $u_token) {
  if($u_funds >= 1000000) {
    mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-1000000 WHERE uid='$u_uid'");
    mysqli_query($conx, "DELETE FROM account_strikes WHERE uid_issuee='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET strikes='0' WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET jailed_count='0' WHERE uid='$u_uid'");
  }
  else {
    header("location: /hub");
    exit();
  }
}
else {
  header("location: /hub");
  exit();
}
?>
