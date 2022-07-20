<?php
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Update Data Saver
$tokenkey = safe($_POST['mdkey']);
$p_secret = safe($_POST['secret']);
$p_codeSUB = safe($_POST['code']);
$p_codeCHK = safe($_POST['code_chk']);
if($tokenkey != $u_token) {
  header("location: /");
  exit();
}
if($p_codeSUB != $p_codeCHK) {
  echo "The code you provided did not match what was generated on our end. Please try again.";
  exit();
}
else {
  mysqli_query($conx, "UPDATE accounts SET 2fa='disabled' WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET auth_app='yes' WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET auth_secret='$p_secret' WHERE uid='$u_uid'");
    header("location: /settings/totp");
    exit();
}
?>
