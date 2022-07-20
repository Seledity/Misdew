<?php
$this_page = "cloud";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$gettoken = safe($_GET['vkey']);
if($u_cloudterms == 'yes') {
  echo "<h1>You have already accepted the <a href=\"https://misdew.com/cloud/file-terms.html\">terms</a> for your acccount. This cannot be undone. Please email <b>me@justa.us</b> for options</h1>";
  exit();
}
if($gettoken == $u_token && $u_cloudterms == 'no') {
mysqli_query($conx, "UPDATE accounts SET cloudterms='yes' WHERE uid='$u_uid'");
header("location: https://misdew.com/cloud");
}
else {
  header("location: /");
  exit();
}
?>
