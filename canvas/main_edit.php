<?php
require_once("../inc/conx.php");
$cnv_bio = safe($_POST['bio']);
mysqli_query($conx, "UPDATE accounts SET bio='$cnv_bio' WHERE uid='$u_uid'");
?>
