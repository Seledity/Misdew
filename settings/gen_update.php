<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Update Data Saver
$upd_datasaver = safe($_POST['datasaver']);
if(isset($upd_datasaver)) {
  // On
  if($upd_datasaver == 'on') {
    mysqli_query($conx, "UPDATE accounts SET data_saver='$upd_datasaver' WHERE uid='$u_uid'");
  }
  // Off
  if($upd_datasaver == 'off') {
    mysqli_query($conx, "UPDATE accounts SET data_saver='$upd_datasaver' WHERE uid='$u_uid'");
  }
}
// Update Hubmain
$upd_hubmain = safe($_POST['hubmain']);
if(isset($upd_hubmain)) {
  // On
  if($upd_hubmain == 'on') {
    mysqli_query($conx, "UPDATE accounts SET hubmain='$upd_hubmain' WHERE uid='$u_uid'");
  }
  // Off
  if($upd_hubmain == 'off') {
    mysqli_query($conx, "UPDATE accounts SET hubmain='$upd_hubmain' WHERE uid='$u_uid'");
  }
}
?>
