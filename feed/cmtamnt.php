<?php
require_once("../inc/conx.php");
$getrstr = safe($_GET['i']);
$cntq = mysqli_query($conx, "SELECT id FROM feed_comments WHERE post_rstr='$getrstr'");
echo mysqli_num_rows($cntq);
?>
