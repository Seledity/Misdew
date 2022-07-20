<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
# it looks like this file didnt even encrypt the emails here idk if this file is in use but GL and take note of that to fix that bug yw
$gtoken = safe($_POST['token']);
if($gtoken == $u_token) {
  mysqli_query($conx, "UPDATE accounts SET email_secure='' WHERE uid='$u_uid'");
}
else {
  header("location: /");
}
?>
