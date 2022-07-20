<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_cont_mang == 'yes' || $u_comm_mang == 'yes' || $u_design_pol == 'yes' || $u_peacekpr == 'yes') { }
else { header("location: /"); exit(); }
$gg_username = safe($_GET['i']);
$ggq = mysqli_query($conx, "SELECT uid,username,current_ip,uagent,upd_uagent FROM accounts WHERE username='$gg_username'");
$ggr = mysqli_fetch_assoc($ggq);
$gg_uid = $ggr['uid'];
if($gg_uid == '') {
  echo "That username does not exist.";
}
//
// NEW: LOUNGE LOG
// KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
//
$lounge_tstamp = time();
$lounge_comments = "used the alt account check";
$lounge_action = "alt_chk";
mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$gg_uid','$lounge_action','$lounge_comments','$lounge_tstamp')");
//
// NEW: LOUNGE LOG
// KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
//
$gg_username = $ggr['username'];
$gg_currip = $ggr['current_ip'];
$gg_uagent = $ggr['uagent'];
$gg_upduagent = $ggr['upd_uagent'];
// User theme colors
$usri_q2 = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$gg_uid' && theme_id='$g_themeid'");
$usri_r2 = mysqli_fetch_assoc($usri_q2);
$username_color = $usri_r2['username_color'];
$username_tcolor = $usri_r2['text_color'];
echo "<table style=\"word-wrap:break-word;table-layout: fixed;width: 100%;\"><tr>";
echo "<td style=\"font-weight: bold; color: $username_color;\"><i class=\"fa fa-certificate\" aria-hidden=\"true\"></i> $gg_username</td>";
echo "</tr><tr>";
echo "<td style=\"font-size: 12px;\">$gg_currip</td>";
echo "</tr><tr>";
echo "<td style=\"font-size: 12px;\">$gg_uagent</td>";
echo "</tr><tr>";
echo "<td style=\"font-size: 12px; font-weight: bold;\">This Updates Constantly:</td>";
echo "</tr><tr>";
echo "<td style=\"font-size: 12px;\">$gg_upduagent</td>";
echo "</tr></table>";
$ggcnt = mysqli_num_rows($ggq = mysqli_query($conx, "SELECT uid,username,current_ip,uagent FROM accounts WHERE current_ip='$gg_currip' AND username!='$gg_username'"));
while($ggr = mysqli_fetch_assoc($ggq)) {
  $gg_uid = $ggr['uid'];
  $ggg_username = $ggr['username'];
  $gg_currip = $ggr['current_ip'];
  $gg_uagent = $ggr['uagent'];
  // User theme colors
  $usri_q2 = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$gg_uid' && theme_id='$g_themeid'");
  $usri_r2 = mysqli_fetch_assoc($usri_q2);
  $username_color = $usri_r2['username_color'];
  $username_tcolor = $usri_r2['text_color'];
  echo "<table style=\"word-wrap:break-word;table-layout: fixed;width: 100%;\"><tr>";
  echo "<td style=\"font-weight: bold; color: $username_color;\">$ggg_username</td>";
  echo "</tr><tr>";
  echo "<td style=\"font-size: 12px;\">$gg_currip</td>";
  echo "</tr><tr>";
  echo "<td style=\"font-size: 12px;\">$gg_uagent</td>";
  echo "</tr></table>";
}
if($ggcnt != '0') {
  //echo "<table style=\"width: 100%; text-align: center; font-size: 13px;\"><tr><td>Possible detection of evasion. <br> If correct, please add an additional week.</td></tr></table>";
}
?>
