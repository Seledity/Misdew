<?php
$var = explode(' ', $chat_txt);

if ($var[0] == '-t') {

			$bot_id = "telegram bot id if u want to use this feature";
			$tel_chat_id = "telegram chat id to send msgs to if u want to use this feature";
			$url = 'https://api.telegram.org/bot' . $bot_id . '/getUpdates?offset=0';
			$result = file_get_contents($url);
			$result = json_decode($result, true);
			foreach ($result['result'] as $message) {
			}
			$chat_bot_txt = substr(strstr($chat_txt," "), 1);
			$botmsg = "💧 $u_username: $chat_bot_txt";
			$url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $botmsg .'&chat_id=' . $tel_chat_id;
			$result = file_get_contents($url);
			$result = json_decode($result, true);
}

if($var[0] == '/xpert' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='871'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "871";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='871'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='871'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='871'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+200 WHERE uid='871'");
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+200 WHERE uid='871'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('871', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}


if($var[0] == '/narjis' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='807'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "807";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='807'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='807'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='807'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+200 WHERE uid='807'");
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+200 WHERE uid='807'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('807', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}


if($var[0] == '/joseph' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='872'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "872";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='872'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='872'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='872'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+200 WHERE uid='872'");
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+200 WHERE uid='872'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('872', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}




if($var[0] == '/nazi' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='874'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "874";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='874'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='874'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='874'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+200 WHERE uid='874'");
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+200 WHERE uid='874'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('874', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}


if($var[0] == '/misdew' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='6'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='6'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='6'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='6'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+200 WHERE uid='6'");
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+200 WHERE uid='6'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('6', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}


if($var[0] == '/cooldude' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='642'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "642";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+120 WHERE uid='642'");
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='642'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='642'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='642'");
	}
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+120 WHERE uid='642'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('642', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}

if($var[0] == '/todo' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='641'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "641";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+120 WHERE uid='641'");
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='641'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='641'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='641'");
	}
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+120 WHERE uid='641'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('641', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}

if($var[0] == '/deku' && $var[1] && $u_cont_mang == 'yes') {
	$cgtq = mysqli_query($conx, "SELECT uid,username,chat_attack_hp FROM accounts WHERE uid='643'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	$unchathp = $cgtr['chat_attack_hp'];
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$stringgy = explode (' ', $chat_txt, 2);
	$stringgy = $stringgy[1];
	$jb_uid = "643";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'+120 WHERE uid='643'");
	if($unchathp <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='643'");
	}
	elseif($unchathp >= 100) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='643'");
	}
	else {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$unchathp'+2 WHERE uid='643'");
	}
	mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'+120 WHERE uid='643'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, bot_controller) VALUES ('643', '$stringgy', '$tstamp','$u_username')");
	$post = "n";
}


if ($var[0] == '/color' && $var[1]) {
	mysqli_query($conx, "UPDATE user_theme_colors SET username_color='$var[1]' WHERE uid='$u_uid' && theme_id='$g_themeid'");
	$post = "n";
}
if ($var[0] == '/tcolor' && $var[1]) {
	mysqli_query($conx, "UPDATE user_theme_colors SET text_color='$var[1]' WHERE uid='$u_uid' && theme_id='$g_themeid'");
	$post = "n";
}
if ($var[0] == '/clear' && $u_uid == '1') {
	mysqli_query($conx, "TRUNCATE TABLE chat");
	$post = "n";
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', 'Chat cleared.', '$tstamp')");
}

if ($var[0] == '/chat-rate' && $var[1] && $u_uid == '1') {
	$post = "n";
	mysqli_query($conx, "UPDATE chat_games SET msgs_since='$var[1]' WHERE game_uqid='$perrate'");
}
if ($var[0] == '/away') {
	$post = "n";
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has left Chat.', '$tstamp')");
}

if ($var[0] == '/lurk') {
	$post = "n";
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($u_patreon == 'yes') {
		if($u_lurker_mode == 'yes') {
			mysqli_query($conx, "UPDATE accounts SET lurker_mode='no' WHERE uid='$u_uid'");
		}
		else {
			mysqli_query($conx, "UPDATE accounts SET lurker_mode='yes' WHERE uid='$u_uid'");
		}
	}
	else {
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b>, you do not have access to the <b>/lurk</b> command.', '$tstamp')");
}
}




if ($var[0] == '/strike' && $u_username == 'Seledity') {
	$post = "n";
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	$asdfdsaf = mysqli_query($conx, "SELECT xpert_strikes FROM accounts WHERE uid='871'");
	$asdfdsafr = mysqli_fetch_assoc($asdfdsaf);
	$xpert_st = $asdfdsafr['xpert_strikes'];
	mysqli_query($conx, "UPDATE accounts SET xpert_strikes='$xpert_st'+1 WHERE uid='871'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has added a strike to <b>@xperttheef</b>.', '$tstamp')");
}


if ($var[0] == '/link' && $var[1]) {
	$post = "n";
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	$url = $var[1];
	$link_url = "<span id=\"mdLink\" onclick=\"window.open(\'$url\');\" style=\"font-weight: bold; text-decoration: underline;\">$url</span>";
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has sent a link: $link_url', '$tstamp')");
}


if ($var[0] == '/ricardo') {
	$post = "n";
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> <br>:ricardo:', '$tstamp')");
}


if ($var[0] == '/summon' && $var[1] && $u_funds >= '15') {
	$post = "n";
	$varrrrrrrrr = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,telegram_id,telegram_verf FROM accounts WHERE username='$varrrrrrrrr'");
	$cgsadftr = mysqli_fetch_assoc($sadfasdfas);
	$summoned_uid = $cgsadftr['uid'];
	$summon_uname = $cgsadftr['username'];
	$summon_telid = $cgsadftr['telegram_id'];
	$summon_telverf = $cgsadftr['telegram_verf'];
	if($summoned_uid != '') {
		if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$summoned_uid' && app_uqid='chat' && snooze='no'")) != '0') {
			function cgenRand($chatlength = 15) {
				return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $chatlength);
			}
			$chatstr = cgenRand();
		mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$chatstr','$summoned_uid','yes','chat','<span style=\"font-weight: bold;\">$u_username</span> has summoned you to Chat.','/chat','$tstamp')");
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		if($summon_telid != '' && $summon_telverf == 'yes') {
			$bot_id = "telegram bot id if u want to use this feature";
			$url = 'https://api.telegram.org/bot' . $bot_id . '/getUpdates?offset=0';
			$result = file_get_contents($url);
			$result = json_decode($result, true);
			foreach ($result['result'] as $message) {
			}
			$botmsg = "$u_username has summoned you to Chat. misdew.com/chat";
			$url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $botmsg .'&chat_id=' . $summon_telid;
			$result = file_get_contents($url);
			$result = json_decode($result, true);
		}
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-15 WHERE uid='$u_uid'");
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$jb_uid = "6";
		if($dis_uid == $jb_uid) {
				mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has summoned <b>@$summon_uname</b> to Chat. -15.00 MDF.', '$tstamp')");
	}
	else {
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to summon <b>@$summon_uname</b> to Chat but they have Chat snoozed.', '$tstamp')");
	}
	}
}

if ($var[0] == '/boop' && $var[1] && $u_funds >= '30') {
	$post = "n";
	$varrrrrrrrr = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT telegram_id,telegram_verf,uid,username FROM accounts WHERE username='$varrrrrrrrr'");
	$cgsadftr = mysqli_fetch_assoc($sadfasdfas);
	$summoned_uid = $cgsadftr['uid'];
	$summon_uname = $cgsadftr['username'];
	$summon_telid = $cgsadftr['telegram_id'];
	$summon_telverf = $cgsadftr['telegram_verf'];
	if($summoned_uid != '') {
		if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$summoned_uid' && app_uqid='chat' && snooze='no'")) != '0') {
			function cgenRand($chatlength = 15) {
				return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $chatlength);
			}
			$chatstr = cgenRand();
		mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$chatstr','$summoned_uid','yes','chat','<span style=\"font-weight: bold;\">$u_username</span> has booped you to Chat.','/chat','$tstamp')");
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		if($summon_telid != '' && $summon_telverf == 'yes') {
			$bot_id = "telegram bot id if u want to use this feature";
			$url = 'https://api.telegram.org/bot' . $bot_id . '/getUpdates?offset=0';
			$result = file_get_contents($url);
			$result = json_decode($result, true);
			foreach ($result['result'] as $message) {
			}
			$botmsg = "$u_username has booped you to Chat. misdew.com/chat";
			$url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $botmsg .'&chat_id=' . $summon_telid;
			$result = file_get_contents($url);
			$result = json_decode($result, true);
		}
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		//TELEGRAM NOTIF
		mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-30 WHERE uid='$u_uid'");
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$jb_uid = "6";
		if($dis_uid == $jb_uid) {
				mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has booped <b>@$summon_uname</b> to Chat. -30.00 MDF.', '$tstamp')");
	}
	else {
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to boop <b>@$summon_uname</b> to Chat but they have Chat snoozed.', '$tstamp')");
	}
	}
}

if ($var[0] == '/bal') {
	$post = "n";
	$chatt_funds = number_format((float)$u_funds, 2, '.', '');
	$chatt_funds = number_format($chatt_funds, 2, '.', ',');
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b>, you have <b>$chatt_funds MDF.</b>', '$tstamp')");
}

// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// Shield
if ($var[0] == '/shd' && $u_funds >= '300' && $u_chatgames == 'yes') {
	$post = "n";
	mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-300 WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE accounts SET chat_shield_tstamp='$tstamp'+60 WHERE uid='$u_uid'");
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has used a shield. [60s]', '$tstamp')");
}
// Shield+
if ($var[0] == '/shp' && $u_funds >= '700' && $u_chatgames == 'yes') {
	$post = "n";
	mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-700 WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE accounts SET chat_shield_tstamp='$tstamp'+120 WHERE uid='$u_uid'");
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has used a shield. [2min]', '$tstamp')");
}
// Shield++
if ($var[0] == '/shpp' && $u_funds >= '1200' && $u_chatgames == 'yes') {
	$post = "n";
	mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-1200 WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE accounts SET chat_shield_tstamp='$tstamp'+300 WHERE uid='$u_uid'");
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has used a shield. [5min]', '$tstamp')");
}
// SHOOT
if ($var[0] == '/s' && $var[1] && $u_funds >= '50' && $u_chatgames == 'yes') {
	$post = "n";
	$sakfsajadfjl = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,chat_attack_hp,chat_shield_tstamp,jailed FROM accounts WHERE username='$sakfsajadfjl'");
	$sadfas = mysqli_fetch_assoc($sadfasdfas);
	$sadf_uid = $sadfas['uid'];
	$sadf_uname = $sadfas['username'];
	$cchat_attack_hp = $sadfas['chat_attack_hp'];
	$cchat_shld_tstamp = $sadfas['chat_shield_tstamp'];
	$cchat_isjailed = $sadfas['jailed'];
	$new_cchat_attack_hp = $cchat_attack_hp-10;
	if($new_cchat_attack_hp <= 0) {
		$new_cchat_attack_hp = "0";
	}
	if($sadf_uid != '' && $sadf_uid != $u_uid) {
		if($cchat_attack_hp > '0') {
			if($cchat_isjailed == 'yes') {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to shoot <b>@$sadf_uname</b> but they are currently jailed.', '$tstamp')");
			}
			else {
			if($tstamp > $cchat_shld_tstamp) {
				mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$cchat_attack_hp'-10 WHERE uid='$sadf_uid'");
				mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-50 WHERE uid='$u_uid'");
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> shot <b>@$sadf_uname.</b> [HP: $new_cchat_attack_hp]', '$tstamp')");
			}
			else {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to shoot <b>@$sadf_uname</b> but they are currently shielded. B)', '$tstamp')");
			}
		}
		}
		else {
			$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
			$disr = mysqli_fetch_assoc($disq);
			$dis_id = $disr['id'];
			$dis_uid = $disr['uid'];
			$jb_uid = "6";
			if($dis_uid == $jb_uid) {
					mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
			mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to shoot <b>@$sadf_uname</b> but they are already dead..', '$tstamp')");
		}
}
}
// nuke
if ($var[0] == '/nuke' && $var[1] && $u_funds >= '10000' && $u_chatgames == 'yes') {
	$post = "n";
	$sakfsajadfjl = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,chat_attack_hp,chat_shield_tstamp,jailed FROM accounts WHERE username='$sakfsajadfjl'");
	$sadfas = mysqli_fetch_assoc($sadfasdfas);
	$sadf_uid = $sadfas['uid'];
	$sadf_uname = $sadfas['username'];
	$cchat_attack_hp = $sadfas['chat_attack_hp'];
	$cchat_shld_tstamp = $sadfas['chat_shield_tstamp'];
	$cchat_isjailed = $sadfas['jailed'];
	$new_cchat_attack_hp = $cchat_attack_hp-100;
	if($new_cchat_attack_hp <= 0) {
		$new_cchat_attack_hp = "0";
	}
	if($sadf_uid != '' && $sadf_uid != $u_uid) {
		if($cchat_attack_hp > '0') {
			if($cchat_isjailed == 'yes') {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to nuke <b>@$sadf_uname</b> but they are currently jailed.', '$tstamp')");
			}
			else {
			if($tstamp > $cchat_shld_tstamp) {
				mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$cchat_attack_hp'-100 WHERE uid='$sadf_uid'");
				mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-10000 WHERE uid='$u_uid'");
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> nuked <b>@$sadf_uname.</b> [HP: $new_cchat_attack_hp]', '$tstamp')");
			}
			else {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to nuke <b>@$sadf_uname</b> but they are currently shielded. B)', '$tstamp')");
			}
		}
		}
		else {
			$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
			$disr = mysqli_fetch_assoc($disq);
			$dis_id = $disr['id'];
			$dis_uid = $disr['uid'];
			$jb_uid = "6";
			if($dis_uid == $jb_uid) {
					mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
			mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to nuke <b>@$sadf_uname</b> but they are already dead..', '$tstamp')");
		}
}
}
// suicide
if ($var[0] == '/suicide' && $u_funds >= '10000' && $u_chatgames == 'yes') {
	$post = "n";
	$sakfsajadfjl = $u_username;
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,chat_attack_hp,chat_shield_tstamp,jailed FROM accounts WHERE username='$sakfsajadfjl'");
	$sadfas = mysqli_fetch_assoc($sadfasdfas);
	$sadf_uid = $sadfas['uid'];
	$sadf_uname = $sadfas['username'];
	$cchat_attack_hp = $sadfas['chat_attack_hp'];
	$cchat_shld_tstamp = $sadfas['chat_shield_tstamp'];
	$cchat_isjailed = $sadfas['jailed'];
	$new_cchat_attack_hp = $cchat_attack_hp-100;
	if($new_cchat_attack_hp <= 0) {
		$new_cchat_attack_hp = "0";
	}
	if($sadf_uid != '') {
		if($cchat_attack_hp > '0') {
			if($cchat_isjailed == 'yes') {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to commit suicide but they are currently jailed.', '$tstamp')");
			}
			else {
			if($tstamp > $cchat_shld_tstamp) {
				mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$cchat_attack_hp'-100 WHERE uid='$sadf_uid'");
				mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-10000 WHERE uid='$u_uid'");
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> commited suicide. [HP: $new_cchat_attack_hp]', '$tstamp')");
			}
			else {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to commit suicide but they are currently shielded. B)', '$tstamp')");
			}
		}
		}
		else {
			$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
			$disr = mysqli_fetch_assoc($disq);
			$dis_id = $disr['id'];
			$dis_uid = $disr['uid'];
			$jb_uid = "6";
			if($dis_uid == $jb_uid) {
					mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
			mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to commit suicide but they are already dead..', '$tstamp')");
		}
}
}
// Punch
if ($var[0] == '/p' && $var[1] && $u_funds >= '15' && $u_chatgames == 'yes') {
	$post = "n";
	$sakfsajadfjl = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,chat_attack_hp,chat_shield_tstamp,jailed FROM accounts WHERE username='$sakfsajadfjl'");
	$sadfas = mysqli_fetch_assoc($sadfasdfas);
	$sadf_uid = $sadfas['uid'];
	$sadf_uname = $sadfas['username'];
	$cchat_attack_hp = $sadfas['chat_attack_hp'];
	$cchat_shld_tstamp = $sadfas['chat_shield_tstamp'];
	$cchat_isjailed = $sadfas['jailed'];
	$new_cchat_attack_hp = $cchat_attack_hp-1;
	if($new_cchat_attack_hp <= 0) {
		$new_cchat_attack_hp = "0";
	}
	if($sadf_uid != '' && $sadf_uid != $u_uid) {
		if($cchat_attack_hp > '0') {
			if($cchat_isjailed == 'yes') {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to punch <b>@$sadf_uname</b> but they are currently jailed.', '$tstamp')");
			}
			else {
			if($tstamp > $cchat_shld_tstamp) {
				mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$cchat_attack_hp'-1 WHERE uid='$sadf_uid'");
				mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-15 WHERE uid='$u_uid'");
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> punched <b>@$sadf_uname.</b> [HP: $new_cchat_attack_hp]', '$tstamp')");
			}
			else {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to punched <b>@$sadf_uname</b> but they are currently shielded. B)', '$tstamp')");
			}
		}
		}
		else {
			$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
			$disr = mysqli_fetch_assoc($disq);
			$dis_id = $disr['id'];
			$dis_uid = $disr['uid'];
			$jb_uid = "6";
			if($dis_uid == $jb_uid) {
					mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
			mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to punched <b>@$sadf_uname</b> but they are already dead..', '$tstamp')");
		}
}
}
// stab
if ($var[0] == '/st' && $var[1] && $u_funds >= '30' && $u_chatgames == 'yes') {
	$post = "n";
	$sakfsajadfjl = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,chat_attack_hp,chat_shield_tstamp,jailed FROM accounts WHERE username='$sakfsajadfjl'");
	$sadfas = mysqli_fetch_assoc($sadfasdfas);
	$sadf_uid = $sadfas['uid'];
	$sadf_uname = $sadfas['username'];
	$cchat_attack_hp = $sadfas['chat_attack_hp'];
	$cchat_shld_tstamp = $sadfas['chat_shield_tstamp'];
	$cchat_isjailed = $sadfas['jailed'];
	$new_cchat_attack_hp = $cchat_attack_hp-5;
	if($new_cchat_attack_hp <= 0) {
		$new_cchat_attack_hp = "0";
	}
	if($sadf_uid != '' && $sadf_uid != $u_uid) {
		if($cchat_attack_hp > '0') {
			if($cchat_isjailed == 'yes') {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to stab <b>@$sadf_uname</b> but they are currently jailed.', '$tstamp')");
			}
			else {
			if($tstamp > $cchat_shld_tstamp) {
				mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='$cchat_attack_hp'-5 WHERE uid='$sadf_uid'");
				mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-30 WHERE uid='$u_uid'");
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> stabbed <b>@$sadf_uname.</b> [HP: $new_cchat_attack_hp]', '$tstamp')");
			}
			else {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to stabbed <b>@$sadf_uname</b> but they are currently shielded. B)', '$tstamp')");
			}
		}
		}
		else {
			$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
			$disr = mysqli_fetch_assoc($disq);
			$dis_id = $disr['id'];
			$dis_uid = $disr['uid'];
			$jb_uid = "6";
			if($dis_uid == $jb_uid) {
					mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
			mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to stabbed <b>@$sadf_uname</b> but they are already dead..', '$tstamp')");
		}
}
}
// BREAK SHIELD
if ($var[0] == '/bs' && $var[1] && $u_funds >= '1000' && $u_chatgames == 'yes') {
	$post = "n";
	$sakfsajadfjl = $var[1];
	$sadfasdfas = mysqli_query($conx, "SELECT uid,username,chat_attack_hp,chat_shield_tstamp,jailed FROM accounts WHERE username='$sakfsajadfjl'");
	$sadfas = mysqli_fetch_assoc($sadfasdfas);
	$sadf_uid = $sadfas['uid'];
	$sadf_uname = $sadfas['username'];
	$cchat_attack_hp = $sadfas['chat_attack_hp'];
	$cchat_shld_tstamp = $sadfas['chat_shield_tstamp'];
	$cchat_isjailed = $sadfas['jailed'];
	$new_cchat_attack_hp = $cchat_attack_hp-10;
	if($new_cchat_attack_hp <= 0) {
		$new_cchat_attack_hp = "0";
	}
	if($sadf_uid != '' && $sadf_uid != $u_uid) {
		if($cchat_attack_hp > '0') {
			if($cchat_isjailed == 'yes') {
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to break the shield of <b>@$sadf_uname</b> but they are currently jailed.', '$tstamp')");
			}
			else {
			if($tstamp < $cchat_shld_tstamp) {
				mysqli_query($conx, "UPDATE accounts SET chat_shield_tstamp='0' WHERE uid='$sadf_uid'");
				mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-1000 WHERE uid='$u_uid'");
				$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
				$disr = mysqli_fetch_assoc($disq);
				$dis_id = $disr['id'];
				$dis_uid = $disr['uid'];
				$jb_uid = "6";
				if($dis_uid == $jb_uid) {
						mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				}
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> broke the shield of <b>@$sadf_uname.</b>', '$tstamp')");
}
else {
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to break the shield of <b>@$sadf_uname</b> but they are not currently shielded.', '$tstamp')");
}
		}
	}
		else {
			$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
			$disr = mysqli_fetch_assoc($disq);
			$dis_id = $disr['id'];
			$dis_uid = $disr['uid'];
			$jb_uid = "6";
			if($dis_uid == $jb_uid) {
					mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
			mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> attempted to break the shield of <b>@$sadf_uname</b> but they are currently dead..', '$tstamp')");
		}
}
}
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
// CHAT ATTACK
if($var[0] == '/disable' && $var[1] == 'games' && $var[2] && $u_cont_mang == 'yes') {
	$varu = $var[2];
	$cgtq = mysqli_query($conx, "SELECT uid,username FROM accounts WHERE username='$varu'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	//
	// NEW: LOUNGE LOG
	// KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
	//
	$lounge_tstamp = time();
	$lounge_comments = "disabled chat games in chat";
	$lounge_action = "chatgme_dis";
	mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$uidg','$lounge_action','$lounge_comments','$lounge_tstamp')");
	//
	// NEW: LOUNGE LOG
	// KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
	//
	if($unameg != '') {
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$dis_pmuid = $disr['pmuid'];
		$msgtype = $disr['msgtype'];
		if($dis_uid == '6') {
			if($msgtype != 'pm') {
				mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
		}
		mysqli_query($conx, "UPDATE accounts SET chat_games='no' WHERE uid='$uidg'");
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$jb_uid = "6";
		if($dis_uid == $jb_uid) {
				mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', 'Chat games have been disabled for $unameg.', '$tstamp')");
		$post = "n";
	}
}

if($var[0] == '/enable' && $var[1] == 'games' && $var[2] && $u_cont_mang == 'yes') {
	$varu = $var[2];
	$cgtq = mysqli_query($conx, "SELECT uid,username FROM accounts WHERE username='$varu'");
  $cgtr = mysqli_fetch_assoc($cgtq);
  $uidg = $cgtr['uid'];
	$unameg = $cgtr['username'];
	//
	// NEW: LOUNGE LOG
	// KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
	//
	$lounge_tstamp = time();
	$lounge_comments = "enabled chat games in chat";
	$lounge_action = "chatgme_enbl";
	mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$uidg','$lounge_action','$lounge_comments','$lounge_tstamp')");
	//
	// NEW: LOUNGE LOG
	// KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
	//
	if($unameg != '') {
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$dis_pmuid = $disr['pmuid'];
		$msgtype = $disr['msgtype'];
		if($dis_uid == '6') {
			if($msgtype != 'pm') {
				mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
			}
		}
		mysqli_query($conx, "UPDATE accounts SET chat_games='yes' WHERE uid='$uidg'");
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$jb_uid = "6";
		if($dis_uid == $jb_uid) {
				mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', 'Chat games have been enabled for $unameg.', '$tstamp')");
		$post = "n";
	}
}





$cgggs = mysqli_query($conx, "SELECT * FROM chat_games WHERE game_uqid='active_online' ORDER BY id DESC LIMIT 1");
$cggrr = mysqli_fetch_assoc($cgggs);
$free_id = $cggrr['id'];
$free_left = $cggrr['msgs_since'];
if ($var[0] == '/csplit' && $var[1] == 'easter' && $u_csplown == 'no' && $free_left > 0) {
	mysqli_query($conx, "UPDATE accounts SET csplit_own='yes' WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE chat_games SET msgs_since='$free_left'-1 WHERE id='$free_id'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$u_username' WHERE uid='$u_uid' && theme_id='1'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$u_username' WHERE uid='$u_uid' && theme_id='2'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$u_username' WHERE uid='$u_uid' && theme_id='3'");
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has just been gifted cSplit! B) Happy Easter! Tap your username in the chat to use cSplit. It is not available yet on the DS mode.', '$tstamp')");
	$post = "n";
}









if ($var[0] == '/cspl' && $var[1] == 'buy' && $var[2] == $u_username && $u_cmsgs >= 10 && $u_funds >= 5 && $u_csplown == 'no') {
	mysqli_query($conx, "UPDATE accounts SET csplit_own='yes' WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-5 WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$u_username' WHERE uid='$u_uid' && theme_id='1'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$u_username' WHERE uid='$u_uid' && theme_id='2'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$u_username' WHERE uid='$u_uid' && theme_id='3'");
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has just purchased cSplit. Refresh the page and click your username above a message in Chat.', '$tstamp')");
	$post = "n";
}

if ($var[0] == '/milk' && $var[1] == 'cow' && $u_funds >= '10' && $u_chatgames == 'yes') {
	$chatgames = mysqli_query($conx, "SELECT * FROM chat_games WHERE game_uqid='milk_cow'");
	$cgr = mysqli_fetch_assoc($chatgames);
	$cg_tstamp = $cgr['tstamp'];
	$cg_msince = $cgr['msgs_since'];

	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$dis_pmuid = $disr['pmuid'];
	$msgtype = $disr['msgtype'];
	if($dis_uid == '6') {
		if($msgtype != 'pm') {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
	}

if($cg_msince >= 10) {
		//$milkcow_amnt = $cg_msince-10;
		$milkcow_amnt = rand(1,1000);
		mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+$milkcow_amnt WHERE uid='$u_uid'");
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, display_name) VALUES ('6', '<b>@$u_username</b> has milked the cow! +$milkcow_amnt MDF', '$tstamp','no')");
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', ':cow-gif:', '$tstamp')");
		mysqli_query($conx, "UPDATE chat_games SET uid='$u_uid' WHERE game_uqid='milk_cow'");
		$milkstamp = $tstamp + 3600;
		mysqli_query($conx, "UPDATE chat_games SET tstamp='$milkstamp' WHERE game_uqid='milk_cow'");
		mysqli_query($conx, "UPDATE chat_games SET msgs_since='0' WHERE game_uqid='milk_cow'");
}
else {
	mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-10 WHERE uid='$u_uid'");
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> has failed to milk the cow! 10 messages have not been sent since the last time, only $cg_msince have been sent! -10.00 MDF :angry_red:', '$tstamp')");
}
$post = "n";
}












/*

if ($var[0] == '/egg' && $var[1] == 'hunt' && $u_chatgames == 'yes') {
	$chatgames = mysqli_query($conx, "SELECT * FROM chat_games WHERE game_uqid='egg_hunt'");
	$cgr = mysqli_fetch_assoc($chatgames);
	$cg_tstamp = $cgr['tstamp'];
	$cg_msince = $cgr['msgs_since'];
	$cg_prezzy = $cgr['prize'];

	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$dis_pmuid = $disr['pmuid'];
	$msgtype = $disr['msgtype'];
	if($dis_uid == '6') {
		if($msgtype != 'pm') {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
	}

if($cg_msince >= 8) {
		$milkcow_amnt = $cg_msince-10;
		mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+$cg_prezzy WHERE uid='$u_uid'");
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, display_name) VALUES ('6', '<b>@$u_username</b> found an egg! B) There was +$cg_prezzy MDF inside. :drool:', '$tstamp','no')");
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', ':easter-gif:', '$tstamp')");
		mysqli_query($conx, "UPDATE chat_games SET uid='$u_uid' WHERE game_uqid='egg_hunt'");
		$milkstamp = $tstamp + 3600;
		mysqli_query($conx, "UPDATE chat_games SET tstamp='$milkstamp' WHERE game_uqid='egg_hunt'");
		$egg_prize_rand = rand(250,10000);
		mysqli_query($conx, "UPDATE chat_games SET prize='$egg_prize_rand' WHERE game_uqid='egg_hunt'");
		mysqli_query($conx, "UPDATE chat_games SET msgs_since='0' WHERE game_uqid='egg_hunt'");
}
else {
	$disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
	$disr = mysqli_fetch_assoc($disq);
	$dis_id = $disr['id'];
	$dis_uid = $disr['uid'];
	$jb_uid = "6";
	if($dis_uid == $jb_uid) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
	}
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> went searching for eggs but came back empty handed. :tear: Maybe try again after more messages have been sent? B)', '$tstamp')");
}
$post = "n";
}
*/











if ($var[0] == '/pm' && $var[1] && $var[2]) {
  $var1 = $var[1];
  $jtest = mysqli_query($conx, "SELECT uid FROM accounts WHERE username='$var1'");
  $ohlmao = mysqli_fetch_assoc($jtest);
  $uidofusername = $ohlmao['uid'];
  if($uidofusername && $uidofusername != $u_uid) {
    $string = explode (' ', $chat_txt, 3);
    $string = $string[2];
		$disq = mysqli_query($conx, "SELECT id,uid,pmuid FROM chat ORDER BY id DESC LIMIT 1");
		$disr = mysqli_fetch_assoc($disq);
		$dis_id = $disr['id'];
		$dis_uid = $disr['uid'];
		$dis_pmuid = $disr['pmuid'];

		if($dis_uid == $u_uid && $dis_pmuid == $uidofusername) {
			mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
		}
		// update online time
		mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp' WHERE uid='$u_uid'");
    mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, pmuid, msgtype) VALUES ('$u_uid', '$string', '$tstamp', '$uidofusername', 'pm')");
    $post = "n";
  }
}
?>
