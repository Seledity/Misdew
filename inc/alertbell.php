<?php
require_once("../inc/conx.php");

$extra = mysqli_query($conx, "SELECT uid FROM notifs WHERE uid='$u_uid' && viewed='no' ORDER BY id");
$ncount = mysqli_num_rows($extra);
if($ncount > 0) {
  $alert_bell_color = "#ffff99";
}
if($ncount <= 0) {
  $ncount = "";
}
echo "<i id=\"header_tds\" style=\"color: $alert_bell_color !important;\" class=\"fa fa-bell\" aria-hidden=\"true\"></i>";
?>
