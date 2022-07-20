<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  exit();
}
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  die("You do not belong to this conversation.");
  exit();
}
$new = $tstamp - 29.9;
// if active, display them
$sc_onl = mysqli_query($conx, "SELECT uid FROM mail_memb WHERE uqid='$cv_uqid' && chat_time >= $new ORDER BY uid");
$l_cnt = mysqli_num_rows($sc_onl);
$onlci = mysqli_query($conx, "SELECT timestamp FROM mail WHERE uqid='$cv_uqid' ORDER BY id DESC LIMIT 1");
$cironl = mysqli_fetch_assoc($onlci);
$chatac = $cironl['timestamp'];

$HUAHHH = time() - $chatac;
$mens = round($HUAHHH / 60);
if($mens <= 1) {
echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_go\"></i> <span style=\"font-weight: bold;\">$l_cnt</span> online.<br>";
}
elseif($mens <= 2) {
  echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_slow\"></i> <span style=\"font-weight: bold;\">$l_cnt</span> online.<br>";
}
elseif($mens < 5) {
  echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_slow\"></i> <span style=\"font-weight: bold;\">$l_cnt</span> online.<br>";
}
else {
  echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_dead\"></i> <span style=\"font-weight: bold;\">$l_cnt</span> online.<br>";
}
?>
<span class="online_list">
  <?php
  // selects user accounts
  $slct_onl = mysqli_query($conx, "SELECT chat_time,uid FROM mail_memb WHERE uqid='$cv_uqid' ORDER BY chat_time DESC");
  $separator = '';
  while($slc_on = mysqli_fetch_array($slct_onl))
    {
  $online_time = $slc_on['chat_time'];
  $online_uid = $slc_on['uid'];
  $usr_q = mysqli_query($conx, "SELECT username,md_verf FROM accounts WHERE uid='$online_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $online_username = $usr_r['username'];
    $online_verf = $usr_r['md_verf'];
    if($online_verf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
  }
  // math stuff for time ago function
  $differ = time() - $online_time;
  $mins = round($differ / 60);

  // if active, display them
  if ($mins < .30) {
    echo $separator;
    echo "<a href=\"/canvas/$online_username\" class=\"mail_onl_username\">$online_username $verif_check</a>";
    if (!$separator) $separator = ', ';
  }
}
?>
