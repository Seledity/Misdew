<?php
require_once("../inc/conx.php");
$i = safe($_POST['i']);
mysqli_query($conx, "DELETE FROM draw_comments WHERE id='$i' && uid='$u_uid'");
?>
