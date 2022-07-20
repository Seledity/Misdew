<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$text = mysqli_real_escape_string($conx, htmlentities($_POST['body']));
$shout_time_picked = mysqli_real_escape_string($conx, htmlentities($_POST['timeslot']));
$shout_q = mysqli_query($conx, "SELECT * FROM shouts ORDER BY id DESC LIMIT 1");
while($shout_r = mysqli_fetch_assoc($shout_q)) {
  $shout_uid = $shout_r['uid'];
  $shout_text = $shout_r['texts'];
  $shout_timeleft = $shout_r['time_left'];
  $shout_cost = $shout_r['mdf_cost'];
  $shout_tstamp = $shout_r['tstamp'];
  if($shout_timeleft >= $tstamp) {
    $shout_yn = "yes";
  }
  else {
    $shout_yn = "no";
  }
  if (strlen($text)<80) {
    $shout_goodboi = "yes";
}

// shout times and fees
// shout times and fees
// shout times and fees
if($shout_time_picked == '1') {
  $shout_time_cost = "1000";
  $cost_mdf = "1,000";
  $time_left = $tstamp + 3600;
}
elseif($shout_time_picked == '2') {
  $shout_time_cost = "2000";
  $cost_mdf = "2,000";
  $time_left = $tstamp + 7200;
}
elseif($shout_time_picked == '3') {
  $shout_time_cost = "3000";
  $cost_mdf = "3,000";
  $time_left = $tstamp + 10800;
}
elseif($shout_time_picked == '4') {
  $shout_time_cost = "4000";
  $cost_mdf = "4,000";
  $time_left = $tstamp + 14400;
}
elseif($shout_time_picked == '5') {
  $shout_time_cost = "5000";
  $cost_mdf = "5,000";
  $time_left = $tstamp + 18000;
}
else {
  $shout_time_cost = "1000";
  $cost_mdf = "1,000";
  $time_left = $tstamp + 3600;
}
// shout times and fees
// shout times and fees
// shout times and fees
if($u_funds >= $shout_time_cost && $shout_yn == 'no' && $shout_goodboi == 'yes') {
mysqli_query($conx, "INSERT INTO shouts (uid, texts, tstamp, time_left, mdf_cost) VALUES ('$u_uid','$text','$tstamp','$time_left','$cost_mdf')");
mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.08 WHERE uid='$u_uid'");
mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-$shout_time_cost WHERE uid='$u_uid'");
header("location: /hub");
exit();
}
else {
  exit();
}
}
?>
