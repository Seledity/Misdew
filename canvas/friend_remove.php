<?php
require_once("../inc/conx.php");
$remove_uid = safe($_POST['remove_uid']);
mysqli_query($conx, "DELETE FROM friends WHERE uid_req='$remove_uid' && uid_rec='$u_uid'");
mysqli_query($conx, "DELETE FROM friends WHERE uid_req='$u_uid' && uid_rec='$remove_uid'");
?>
