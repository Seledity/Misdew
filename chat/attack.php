<?php
require_once("../inc/conx.php");
$attack_method = mysqli_real_escape_string($conx, htmlentities($_POST['a']));
$attacked_username = mysqli_real_escape_string($conx, htmlentities($_POST['u']));
$attack_method = strtolower($attack_method);
if($attack_method == 'punch') {
  $attackkkk = 'p';
}
if($attack_method == 'stab') {
  $attackkkk = 'st';
}
if($attack_method == 'shoot') {
  $attackkkk = 's';
}
if($attack_method == 'nuke') {
  $attackkkk = 'nuke';
}
if($attack_method == 'use break shield on') {
  $attackkkk = 'bs';
}
$attacked_username = strtolower($attacked_username);
$chat_txt = "/" . $attackkkk . " " . $attacked_username;
$var = explode(' ', $chat_txt);



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
?>
