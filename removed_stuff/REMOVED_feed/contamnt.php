<?php
require_once("../inc/conx.php");
$cntq = mysqli_query($conx, "SELECT id FROM feed");
echo mysqli_num_rows($cntq);
?>
