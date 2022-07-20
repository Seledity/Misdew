<?php
require_once("../inc/conx.php");


$csplit_enable = safe($_POST['enable_cspl']);
if($csplit_enable == 'yes') {
  mysqli_query($conx, "UPDATE accounts SET csplit='on' WHERE uid='$u_uid'");
}
if($csplit_enable == 'no') {
  mysqli_query($conx, "UPDATE accounts SET csplit='off' WHERE uid='$u_uid'");
}
?>
