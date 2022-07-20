<?php
require_once("../inc/conx.php");
$sticky_id = mysqli_real_escape_string($conx, htmlentities($_POST['stickyid']));
$sticky_token = mysqli_real_escape_string($conx, htmlentities($_POST['token']));

//$chat_txt = ":ricardo:";

if($sticky_id == 'pepe') {
  $chat_txt = ":pepe:";
}
elseif($sticky_id == 'roblock') {
  $chat_txt = ":roblock:";
}
elseif($sticky_id == 'pepe-punch') {
  $chat_txt = ":pepe-punch:";
}
elseif($sticky_id == 'pepe-gun1') {
  $chat_txt = ":pepe-gun1:";
}
elseif($sticky_id == 'pepe-mk') {
  $chat_txt = ":pepe-mk:";
}
elseif($sticky_id == 'pepe-sad1') {
  $chat_txt = ":pepe-sad1:";
}
elseif($sticky_id == 'pepe-weetawd') {
  $chat_txt = ":pepe-weetawd:";
}
elseif($sticky_id == 'pepe-HAHA') {
  $chat_txt = ":pepe-HAHA:";
}
elseif($sticky_id == 'easter-pepe') {
  $chat_txt = ":easter-pepe:";
}
elseif($sticky_id == 'cow-gif') {
  $chat_txt = ":cow-gif:";
}
elseif($sticky_id == 'easter-gif') {
  $chat_txt = ":easter-gif:";
}
elseif($sticky_id == 'ricardo-smile') {
  $chat_txt = ":ricardo-smile:";
}
elseif($sticky_id == 'ricardo') {
  $chat_txt = ":ricardo:";
}
elseif($sticky_id == 'wojak') {
  $chat_txt = ":wojak:";
}
elseif($sticky_id == 'withered') {
  $chat_txt = ":withered:";
}
elseif($sticky_id == 'pepe-eyes') {
  $chat_txt = ":pepe-eyes:";
}
elseif($sticky_id == 'pepe-k') {
  $chat_txt = ":pepe-k:";
}
elseif($sticky_id == 'lock') {
  $chat_txt = ":lock:";
}
elseif($sticky_id == 'pepe-grog') {
  $chat_txt = ":pepe-grog:";
}
else {
  exit();
}


$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
$disr = mysqli_fetch_assoc($disq);
$dis_id = $disr['id'];
$dis_uid = $disr['uid'];
$dis_pmuid = $disr['pmuid'];
$msgtype = $disr['msgtype'];
if($dis_uid == $u_uid) {
  if($msgtype != 'pm') {
    mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
    //mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+.85 WHERE uid='$u_uid'");
  }
}



// extra stuff from send.php
mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+$chat_msg_per_rate WHERE uid='$u_uid'");
if($u_chat_attack_hp < 100) {
  mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$u_chat_attack_hp'+2 WHERE uid='$u_uid'");
}
// update online time
mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp' WHERE uid='$u_uid'");
mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.01 WHERE uid='$u_uid'");

// INSERT STICKY INTO CHAT
// INSERT STICKY INTO CHAT
// INSERT STICKY INTO CHAT
// INSERT STICKY INTO CHAT
mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('$u_uid', '$chat_txt', '$tstamp')");
// INSERT STICKY INTO CHAT
// INSERT STICKY INTO CHAT
// INSERT STICKY INTO CHAT
// INSERT STICKY INTO CHAT
// Chat Games
$chatgames = mysqli_query($conx, "SELECT msgs_since FROM chat_games WHERE game_uqid='milk_cow' ORDER BY id DESC LIMIT 1");
$cgr = mysqli_fetch_assoc($chatgames);
$cg_msince = $cgr['msgs_since'];
mysqli_query($conx, "UPDATE chat_games SET msgs_since='$cg_msince'+1 WHERE game_uqid='milk_cow'");
// Chat Games
$chategames = mysqli_query($conx, "SELECT msgs_since FROM chat_games WHERE game_uqid='egg_hunt' ORDER BY id DESC LIMIT 1");
$cegr = mysqli_fetch_assoc($chategames);
$ceg_msince = $cegr['msgs_since'];
mysqli_query($conx, "UPDATE chat_games SET msgs_since='$ceg_msince'+1 WHERE game_uqid='egg_hunt'");

mysqli_query($conx, "UPDATE accounts SET total_cmsgs='$u_cmsgs'+1 WHERE uid='$u_uid'");

?>
