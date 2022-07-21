<?php
require_once("../inc/conx.php");
$spindle_uqid = safe($_GET['u']);
$cntq = mysqli_query($conx, "SELECT id FROM forum_threads WHERE spindle_uqid='$spindle_uqid' && draft='no'");
echo mysqli_num_rows($cntq);
?>
