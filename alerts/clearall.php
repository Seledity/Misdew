<?php
require_once("../inc/conx.php");
$gtoken = safe($_GET['t']);
if($gtoken == $u_token && $logged_in == true) {
  $notif_cnt = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM notifs WHERE uid='$u_uid'"));
  if($notif_cnt > 10 && $tstamp >= $u_notifc) {
    $newstamp = $tstamp + 86400;
		mysqli_query($conx, "UPDATE accounts SET notif_clear='$newstamp' WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+100 WHERE uid='$u_uid'");
  }
  mysqli_query($conx, "DELETE FROM notifs WHERE uid='$u_uid'");
  header("location: /alerts");
  exit();
}
else {
  header("location: /alerts");
  exit();
}
?>
