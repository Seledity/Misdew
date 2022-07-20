<?php
require_once("../inc/conx.php");
$cnv_uid = safe($_GET['c']);
$cntq = mysqli_query($conx, "SELECT id FROM canvas_comments WHERE uid_canvas='$cnv_uid'");
echo mysqli_num_rows($cntq);
?>
