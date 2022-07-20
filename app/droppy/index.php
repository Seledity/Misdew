<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$app_uqid = "droppy";
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM user_apps WHERE uid='$u_uid' && app_uqid='$app_uqid'")) == '0') {
	header("location: /hub");
	exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/app/droppy') {
  $loc_desc = "takin\' care of their Droppy";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/app/droppys' WHERE uid='$u_uid'");
}
?>
<html>
	<head>
		<title>Droppy</title>
	</head>
	<body>
    coming soon
  </body>
  </html>
