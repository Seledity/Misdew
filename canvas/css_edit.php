<?php
require_once("../inc/conx.php");
$cnv_css = safe($_POST['css']);
mysqli_query($conx, "UPDATE accounts SET css='$cnv_css' WHERE uid='$u_uid'");
?>
