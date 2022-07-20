<?php
require_once("../inc/conx.php");
echo "<div id=\"ld_alerts\">";
include_once("../inc/alerts.php");
echo "</div>";
echo "<script>setInterval('upAlerts()', 20000);</script>";
?>
