<?php
# you dont rlly need this file unless ur sending chat messages to a telegram chat / group with ur telegram bot and u input the key below
require_once("../inc/conx.php");
$chat_txt = mysqli_real_escape_string($conx, htmlentities($_POST['body']));







if($chat_txt && $post != 'n') {
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
		mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+$chat_msg_per_rate WHERE uid='$u_uid'");
		if($u_chat_attack_hp < 100) {
			mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$u_chat_attack_hp'+2 WHERE uid='$u_uid'");
		}
	// update online time
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp' WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.01 WHERE uid='$u_uid'");
  $bot_id = "TELEGRAM BOT ID FROM BOTFATHER";
  $tel_chat_id = "telegram chat id u want the sht sent to";
  $url = 'https://api.telegram.org/bot' . $bot_id . '/getUpdates?offset=0';
  $result = file_get_contents($url);
  $result = json_decode($result, true);
  foreach ($result['result'] as $message) {
  }
  $botmsg = "$u_username: $chat_txt";
  $url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $botmsg .'&chat_id=' . $tel_chat_id;
  $result = file_get_contents($url);
  $result = json_decode($result, true);
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('$u_uid', '$chat_txt', '$tstamp')");
	// Chat Games
	$chatgames = mysqli_query($conx, "SELECT msgs_since FROM chat_games WHERE game_uqid='milk_cow' ORDER BY id DESC LIMIT 1");
	$cgr = mysqli_fetch_assoc($chatgames);
	$cg_msince = $cgr['msgs_since'];
	mysqli_query($conx, "UPDATE chat_games SET msgs_since='$cg_msince'+1 WHERE game_uqid='milk_cow'");
	mysqli_query($conx, "UPDATE accounts SET total_cmsgs='$u_cmsgs'+1 WHERE uid='$u_uid'");
}


?>
