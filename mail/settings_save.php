<?php
require_once("../inc/conx.php");
$canmail = safe($_GET['canmail']);
$newcvs = safe($_GET['newcvs']);
# SET WHO CAN MAIL YOU
if($canmail == 'friends' OR $canmail == 'anyone' OR $canmail == 'nobody') {
  mysqli_query($conx, "UPDATE accounts SET who_can_mail='$canmail' WHERE uid='$u_uid'");
}
# SET WHETHER OR NOT TO GENERATE RANDOM DETAILS ON NEW CONVOS
if($newcvs == 'on' OR $newcvs == 'off') {
  mysqli_query($conx, "UPDATE accounts SET mail_random_gen='$newcvs' WHERE uid='$u_uid'");
}
?>
