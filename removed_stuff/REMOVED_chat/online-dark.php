<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  exit();
}
function shieldtime($session_time) {
  $time_difference = $session_time - time();
  $seconds = $time_difference;
  $minutes = round($time_difference/60);
  $hours = round($time_difference/3600);
  $days = round($time_difference/86400);
  $weeks = round($time_difference/604800);
  $months = round($time_difference/2419200);
  $years = round($time_difference/29030400);
  $s_ago = "s"; $m_ago = "m"; $h_ago = "h"; $w_ago = "w"; $d_ago = "d";
  if($seconds <= 59) { echo "$seconds$s_ago"; }
  else if($minutes <= 59) {
    if($minutes == 1) { echo "1$m_ago"; }
    else { echo "$minutes$m_ago"; }
  }
  else if($hours <= 23) {
    if($hours == 1) { echo "1$h_ago"; }
    else { echo "$hours$h_ago"; }
  }
  else if($days <= 6) {
    if($days == 1) { echo "1$d_ago"; }
    else { echo "$days$d_ago"; }
  }
  else if($weeks > 0) {
    if($weeks == 1) { echo "1$w_ago"; }
    else { echo "$weeks$w_ago"; }
  }
}
$new = $tstamp - 60;
// if active, display them
$sc_onl = mysqli_query($conx, "SELECT username FROM accounts WHERE chat_time >= $new ORDER BY username");
$l_cnt = mysqli_num_rows($sc_onl);
$onlci = mysqli_query($conx, "SELECT tstamp FROM chat ORDER BY id DESC LIMIT 1");
$cironl = mysqli_fetch_assoc($onlci);
$chatac = $cironl['tstamp'];

$HUAHHH = time() - $chatac;
$mens = round($HUAHHH / 60);
if($mens <= 1) {
echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_go\"></i> <span class=\"darkmd\" style=\"font-weight: bold;\">$l_cnt</span> <span class=\"darkmd\">online.</span>";
}
elseif($mens <= 2) {
  echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_slow\"></i> <span class=\"darkmd\" style=\"font-weight: bold;\">$l_cnt</span> <span class=\"darkmd\">online.</span>";
}
elseif($mens < 5) {
  echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_slow\"></i> <span class=\"darkmd\" style=\"font-weight: bold;\">$l_cnt</span> <span class=\"darkmd\">online.</span>";
}
else {
  echo "<i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"color_dead\"></i> <span class=\"darkmd\" style=\"font-weight: bold;\">$l_cnt</span> <span class=\"darkmd\">online.</span>";
}
echo " &nbsp;&nbsp;&nbsp;<span onclick=\"moreX('show');moreX('sticker_bar');moreX('sticker_bar_xtra');\" style=\"font-weight: bold; font-size: 12px; color: #7f7f7f;\">[toggle sticker bar]</span>";
echo "<br>";
?>
<span class="online_list">
  <?php
  // selects user accounts
  $slct_onl = mysqli_query($conx, "SELECT uid,username,chat_time,chat_attack_hp,chat_shield_tstamp,md_verf FROM accounts ORDER BY username");
  $separator = '';
  while($slc_on = mysqli_fetch_array($slct_onl))
    {
  $online_username = $slc_on['username'];
  $online_uid = $slc_on['uid'];
  $online_time = $slc_on['chat_time'];
  $on_chat_attack_hp = $slc_on['chat_attack_hp'];
  $online_verf = $slc_on['md_verf'];
    $on_chat_shield_tstamp = $slc_on['chat_shield_tstamp'];
  $usrif_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$online_uid' && theme_id='$g_themeid'");
  while($usrif_r = mysqli_fetch_assoc($usrif_q)) {
    $cusername_color = $usrif_r['username_color'];
    $cchat_tcolor = $usrif_r['text_color'];
  }
  // math stuff for time ago function
  $differ = time() - $online_time;
  $mins = round($differ / 60);

  // if active, display them
  /* BEFORE ATTACK MADE
  if ($mins <= 1) {
    echo $separator;
    echo "<a href=\"/canvas/$online_username\" class=\"onl_username\" style=\"color: $cusername_color !important;\">$online_username</a>";
    if (!$separator) $separator = ', ';
  }*/

  if ($mins <= 1) {
    if($on_chat_attack_hp <= 0) {
      $on_chat_attack_hp = "0";
    }
    if($on_chat_attack_hp == 0) {
      $is_dead = "; rip";
    }
    else {
      $is_dead = "";
    }
    if($on_chat_shield_tstamp > $tstamp) {
      $is_shield = "| <i class=\"fa fa-shield\" aria-hidden=\"true\"></i> ";
    }
    else {
      $is_shield = "";
    }

    if($on_chat_attack_hp >= 75) {
      $hp_color = "#333333";
    }
    elseif($on_chat_attack_hp >= 26) {
      $hp_color = "#7f7f7f";
    }
    else {
      $hp_color = "#b2b2b2";
    }
    if($online_verf == 'yes') {
      echo "<i style=\"color: #7f7f7f;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> ";
    }
    echo "<a href=\"/canvas/$online_username\" style=\"color: $cusername_color\" class=\"onl_username\">$online_username</a>; <span class=\"darkmd\" style=\"color: #000; font-size: 12px;\">$on_chat_attack_hp HP$is_dead $is_shield"; if($on_chat_shield_tstamp > $tstamp) { echo shieldtime($on_chat_shield_tstamp); echo " left"; } echo "</span>";
    echo "<br>";
    echo "<div style=\"width: 100%; background-color: #4c4c4c;\">
    <div style=\"background-color: $hp_color; width: $on_chat_attack_hp%; max-width: 100%;\">&nbsp;</div>
    </div>";
  }
}
echo "<br>";
echo "<center style=\"font-size: 12px;\">
<b>Chat Games</b> <br>
Chat Attack is currently underway. <br>
If your HP drops below 0- you will be jailed for 2min. <br>
Use the commands below to attack other users or to save yourself. <br>
Each chat message restores 2 HP- don't spam. <br>
If the Chat stops working, you are probably dead. Refresh the page. <br>
This game is meant to be fun- enjoy! <br><br>

<b>Punch</b> <br>
<b style=\"color: #a64ca6;\">/p USER</b> [-1 HP; COST: -15 MDF] <br>
<b>Stab</b> <br>
<b style=\"color: #a64ca6;\">/st USER</b> [-5 HP; COST: -30 MDF] <br>
<b>Shoot</b> <br>
<b style=\"color: #a64ca6;\">/s USER</b> [-10 HP; COST: -50 MDF] <br>
<b>Nuke</b> <br>
<b style=\"color: #a64ca6;\">/nuke USER</b> [-100 HP; COST: -10,000 MDF] <br>
<b>Break Shield</b> <br>
<b style=\"color: #a64ca6;\">/bs USER</b> [COST: -1,000 MDF] <br><br>
<b>Use Shield</b> <br>
<b style=\"color: #a64ca6;\">/shd</b> [DURATION: 60s; COST: -300 MDF] <br>
<b>Use Shield+</b> <br>
<b style=\"color: #a64ca6;\">/shp</b> [DURATION: 2min; COST: -700 MDF] <br>
<b>Use Shield++</b> <br>
<b style=\"color: #a64ca6;\">/shpp</b> [DURATION: 5min; COST: -1,200 MDF] <br>
</center>";
?> <br>
