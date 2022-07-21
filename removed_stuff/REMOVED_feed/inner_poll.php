<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}

$post_uq = safe($_GET['uq']);
$feed_randomstr = $post_uq;

function polltime($session_time) {
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
// Added Feed polls. 2021
// Added Feed polls. 2021
// Added Feed polls. 2021
// Added Feed polls. 2021

$feed_q = mysqli_query($conx, "SELECT id,uid,post,tstamp,random_str,visibility,edited,img,allow_comments FROM feed WHERE random_str='$feed_randomstr'");
while($feed_r = mysqli_fetch_assoc($feed_q)) {
  // Feed data
  $feed_id = $feed_r['id'];
  $feed_uid = $feed_r['uid'];
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$feed_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    // Account data
    $feed_username = $usr_r['username'];
    $feed_vrf = $usr_r['md_verf'];
    if($feed_vrf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
  }
  # SELECT THEME COLORS FOR ACCOUNTS
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$feed_uid' && theme_id='$g_themeid'");
  while($usri_r = mysqli_fetch_assoc($usri_q)) {
    // Theme data
    $username_color = $usri_r['username_color'];
    $feed_tcolor = $usri_r['text_color'];
  }
}

  # SELECT POLL DATA FOR THE POST
  $fpoll_q = mysqli_query($conx, "SELECT * FROM feed_polls WHERE uqid='$feed_randomstr'");
  while($fpoll_r = mysqli_fetch_assoc($fpoll_q)) {
    // poll data
    $fpoll_question = $fpoll_r['poll_question'];
    $fpoll_opt1 = $fpoll_r['poll_opt1'];
    $fpoll_opt2 = $fpoll_r['poll_opt2'];
    $fpoll_opt3 = $fpoll_r['poll_opt3'];
    $fpoll_opt4 = $fpoll_r['poll_opt4'];
    $fpoll_opt5 = $fpoll_r['poll_opt5'];
    $fpoll_istimed = $fpoll_r['is_timed'];
    $fpoll_tstmpend = $fpoll_r['tstamp_end'];
    if(strlen($fpoll_opt1) >= 30) {
      $fpoll_optc1 = trim(substr($fpoll_opt1,0,30)) . "...";
    }
    else {
      $fpoll_optc1 = $fpoll_opt1;
    }
    if(strlen($fpoll_opt2) >= 30) {
      $fpoll_optc2 = trim(substr($fpoll_opt2,0,30)) . "...";
    }
    else {
      $fpoll_optc2 = $fpoll_opt2;
    }
    if(strlen($fpoll_opt3) >= 30) {
      $fpoll_optc3 = trim(substr($fpoll_opt3,0,30)) . "...";
    }
    else {
      $fpoll_optc3 = $fpoll_opt3;
    }
    if(strlen($fpoll_opt4) >= 30) {
      $fpoll_optc4 = trim(substr($fpoll_opt4,0,30)) . "...";
    }
    else {
      $fpoll_optc4 = $fpoll_opt4;
    }
    if(strlen($fpoll_opt5) >= 30) {
      $fpoll_optc5 = trim(substr($fpoll_opt5,0,30)) . "...";
    }
    else {
      $fpoll_optc5 = $fpoll_opt5;
    }
  }
  # SELECT RESPONSE DATA FOR THE POLL
  $fpoll_response_q = mysqli_query($conx, "SELECT * FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && uid='$u_uid'");
  while($fpoll_response_r = mysqli_fetch_assoc($fpoll_response_q)) {
    // poll response data
    $fpoll_option_picked = $fpoll_response_r['option_picked'];
  }
  echo "<br>";

  if($fpoll_option_picked != '') {
    $current_can_vote = "no";
  }
  else {
    $current_can_vote = "yes";
  }

  // total vote count
  $rest_c = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr'");
  $optt_cnt = mysqli_num_rows($rest_c);

  // count number of votes for each option
  $res_c1 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='1'");
  $opt1_cnt = mysqli_num_rows($res_c1);
  if($opt1_cnt != '1') {
    $count1_s = "s";
  }
  $res_c2 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='2'");
  $opt2_cnt = mysqli_num_rows($res_c2);
  if($opt2_cnt != '1') {
    $count2_s = "s";
  }
  $res_c3 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='3'");
  $opt3_cnt = mysqli_num_rows($res_c3);
  if($opt3_cnt != '1') {
    $count3_s = "s";
  }
  $res_c4 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='4'");
  $opt4_cnt = mysqli_num_rows($res_c4);
  if($opt4_cnt != '1') {
    $count4_s = "s";
  }
  $res_c5 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='5'");
  $opt5_cnt = mysqli_num_rows($res_c5);
  if($opt5_cnt != '1') {
    $count5_s = "s";
  }
  if($fpoll_option_picked == '1') {
    $current_picked1 = "background-color: $username_color !important; color: $feed_tcolor !important";
  }
  if($fpoll_option_picked == '2') {
    $current_picked2 = "background-color: $username_color !important; color: $feed_tcolor !important";
  }
  if($fpoll_option_picked == '3') {
    $current_picked3 = "background-color: $username_color !important; color: $feed_tcolor !important";
  }
  if($fpoll_option_picked == '4') {
    $current_picked4 = "background-color: $username_color !important; color: $feed_tcolor !important";
  }
  if($fpoll_option_picked == '5') {
    $current_picked5 = "background-color: $username_color !important; color: $feed_tcolor !important";
  }

  echo "<span style=\"font-size: 12px; color: #808080;\">A poll has been attached to this post. <br> </span>";
  if($fpoll_istimed == 'yes') {
    echo "<span style=\"font-size: 12px; color: #808080;\">There is a time limit- it will stop accepting responses in ";
    echo polltime($fpoll_tstmpend);
    echo ".</span>";
  }
  else {
    echo "<span style=\"font-size: 12px; color: #808080;\">There is no time limit set- responses are always accepted.</span>";
  }
  echo "<br><br><table style=\"width: 100%;\"><tr>";
  echo "<td>";
  echo "<span style=\"color: $username_color; font-weight: bold;\">$feed_username $verif_check</span><br>";
  echo "</td>";
  echo "</tr></table>";
  echo "<div style=\"border-radius: 8em; background-color: $username_color; padding: 8px; display: inline-block;\">";
  echo "<table style=\"width: 100%;\"><tr>";
  echo "<td style=\"font-weight: bold; color: $feed_tcolor; padding-left: 12px; padding-right: 12px;\">";
  echo "$fpoll_question";
  echo "</td>";
  echo "</tr></table>";
  echo "</div> <br><br>";
  echo "<span style=\"font-size: 12px; color: #808080;\">Select your response by tapping one of the options below.</span><br>";
  if($current_can_vote == 'no') {
    echo "<span style=\"font-size: 12px; color: #808080;\">You can change your response by tapping a new option.</span><br>";
  }

  echo "<br><table style=\"text-align: center; font-weight: bold; width: 100%;\"><tr>";
  echo "<td onclick=\"pollVote('1','$feed_randomstr');\" style=\"$current_picked1;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
  echo "$fpoll_opt1";
  echo "</td>";
  echo "<td onclick=\"pollVote('2','$feed_randomstr');\" style=\"$current_picked2;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
  echo "$fpoll_opt2";
  echo "</td>";
  if($fpoll_opt3 != '') {
    echo "<td onclick=\"pollVote('3','$feed_randomstr');\" style=\"$current_picked3;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
    echo "$fpoll_opt3";
    echo "</td>";
  }
  if($fpoll_opt4 != '') {
    echo "<td onclick=\"pollVote('4','$feed_randomstr');\" style=\"$current_picked4;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
    echo "$fpoll_opt4";
    echo "</td>";
  }
  if($fpoll_opt5 != '') {
    echo "<td onclick=\"pollVote('5','$feed_randomstr');\" style=\"$current_picked5;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
    echo "$fpoll_opt5";
    echo "</td>";
  }
  echo "</tr></table>";


  echo "<div id=\"presults_$feed_randomstr\">";
  echo "<br>";
  echo "<span style=\"color: #808080; font-size: 14px;\">$opt1_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc1\"</span><br>";
  echo "<span style=\"color: #808080; font-size: 14px;\">$opt2_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc2\"</span><br>";
  if($fpoll_opt3 != '') {
    echo "<span style=\"color: #808080; font-size: 14px;\">$opt3_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc3\"</span><br>";
  }
  if($fpoll_opt4 != '') {
    echo "<span style=\"color: #808080; font-size: 14px;\">$opt4_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc4\"</span><br>";
  }
  if($fpoll_opt5 != '') {
    echo "<span style=\"color: #808080; font-size: 14px;\">$opt5_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc5\"</span><br>";
  }
  echo "<br><span style=\"color: #808080; font-size: 14px; font-weight: bold;\">Total Votes Received:</span> <span style=\"color: #808080; font-size: 14px;\">$optt_cnt</span><br>";
  echo "</div>";



// Added Feed polls. 2021
// Added Feed polls. 2021
// Added Feed polls. 2021
// Added Feed polls. 2021
?>
