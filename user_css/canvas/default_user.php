<?php
header('Content-Type: text/css');
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$g_user = safe($_GET['u']);
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT css FROM accounts WHERE username='$g_user'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_css = $cnv_r['css'];
echo $cnv_css;
?>
