<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$gtoken = safe($_POST['token']);
if($gtoken == $u_token) {
  function genRand1($length = 50) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $genran_str1 = genRand1();
  mysqli_query($conx, "UPDATE accounts SET rstringa='$genran_str1' WHERE uid='$u_uid'");
  exit();
}
?>
