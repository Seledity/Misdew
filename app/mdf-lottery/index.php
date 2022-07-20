<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$app_uqid = "mdf-lottery";
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM user_apps WHERE uid='$u_uid' && app_uqid='$app_uqid'")) == '0') {
	header("location: /hub");
	exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/app/mdf-lottery') {
  $loc_desc = "takin\' risks in MDF Lottery";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/app/mdf-lottery' WHERE uid='$u_uid'");
}
?>
<html>
	<head>
		<title>MDF Lottery</title>
	</head>
	<body>
    coming soon
  </body>
  </html>
