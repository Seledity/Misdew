<?php
require_once("../inc/conx.php");
$chat_typing = mysqli_real_escape_string($conx, htmlentities($_POST['typing']));
$chat_token = mysqli_real_escape_string($conx, htmlentities($_POST['token']));
if($u_token == $chat_token) {
  if($u_chatyping != 'yes') {
  mysqli_query($conx, "UPDATE accounts SET chat_istyping='yes' WHERE uid='$u_uid'");
}
}
else {
  exit();
}
?>
