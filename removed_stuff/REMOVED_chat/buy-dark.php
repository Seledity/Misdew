<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$token_get = safe($_GET['t']);

if($u_funds >= 50 && $chat_dark == 'no' && $token_get == $u_token) {
mysqli_query($conx, "UPDATE accounts SET chat_dark='yes' WHERE uid='$u_uid'");
mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-50 WHERE uid='$u_uid'");
header("location: /chat/dark.php");
exit();
}
else {
  header("location: /");
  exit();
}
?>
