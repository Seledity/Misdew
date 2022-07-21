<?php
require_once("../inc/conx.php");
$chat_txt = mysqli_real_escape_string($conx, htmlentities($_POST['body']));
require_once("commands.php");



	mysqli_query($conx, "UPDATE accounts SET chat_istyping='no' WHERE uid='$u_uid'");



if($chat_txt && $post != 'n') {
	mysqli_query($conx, "UPDATE accounts SET chat_istyping='no' WHERE uid='$u_uid'");
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
	mysqli_query($conx, "UPDATE accounts SET chat_istyping='no' WHERE uid='$u_uid'");
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('$u_uid', '$chat_txt', '$tstamp')");
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
}


if (strpos(strtolower($chat_txt), '@misdew') !== false) {
	$bot_called = "yes";
	if (strpos(strtolower($chat_txt), 'hi') !== false) {
		$bot_basic = "hi";
	}
	elseif (strpos(strtolower($chat_txt), 'hello') !== false) {
		$bot_basic = "hi";
	}
	elseif (strpos(strtolower($chat_txt), 'hey') !== false) {
		$bot_basic = "hi";
	}
	else {
		$bot_basic = "yes";
	}
}
if (strpos(strtolower($chat_txt), '@md') !== false) {
	$bot_called = "yes";
	if (strpos(strtolower($chat_txt), 'hi') !== false) {
		$bot_basic = "hi";
	}
	elseif (strpos(strtolower($chat_txt), 'hello') !== false) {
		$bot_basic = "hi";
	}
	elseif (strpos(strtolower($chat_txt), 'hey') !== false) {
		$bot_basic = "hi";
	}
	else {
		$bot_basic = "yes";
	}
}


if($bot_called == 'yes' && $bot_basic == 'hi') {
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
		$botmsgs=array("Hello $u_username B)","hi $u_username","yo","hi B)","sup $u_username :pepe:");
		$botrandmsg=array_rand($botmsgs);
		$bot_msg = $botmsgs[$botrandmsg];
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '$bot_msg', '$tstamp')");
}



if($bot_called == 'yes' && $bot_basic == 'yes') {
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
		$botmsgs=array("@$u_username, you know what. If you brought more users to MD.. you would be pretty cool. B) like me","I am bored asf.","My job is to #MakeMDgr8again","What are you up to, $u_username?","I wish this site had more active users..","B)","bring your friends to misdew");
		$botrandmsg=array_rand($botmsgs);
		$bot_msg = $botmsgs[$botrandmsg];
		mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '$bot_msg', '$tstamp')");
}
// move this to another file
/*
$chatlower = strtolower($chat_txt);
if (strpos($chatlower, 'todoroki') !== false) {
    $todo = true;
}
   if($todo == true) {
		 $strings = array(
    ':/',
    '...'
	);
	$key = array_rand($strings);
	$chat_txt = $strings[$key];

	$timez = array('7','9','11','12','15','18');
	$sleepy = array_rand($timez);
	$sleep_time = $timez[$sleepy];
	sleep($sleep_time);
	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('641', '$chat_txt', '$tstamp')");
   }




	 $chatlowwer = strtolower($chat_txt);
	 if (strpos($chatlowwer, 'deku') !== false) {
	     $toddo = true;
	 }
	    if($toddo == true) {
	 		 $strings = array(
	     ':|',
	     'I am falling asleep..',
			 'Oops, falling asleep again, lol',
			 'Falling asleep..',
	 	);
	 	$key = array_rand($strings);
	 	$chatt_txt = $strings[$key];

	$timez = array('7','9','11','12','15','18');
	 	$sleepy = array_rand($timez);
	 	$sleep_time = $timez[$sleepy];
	 	sleep($sleep_time);
	 	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('643', '$chatt_txt', '$tstamp')");
	    }

			$chatlowweer = strtolower($chat_txt);
	 	 if (strpos($chatlowweer, 'cooldude') !== false) {
	 	     $toddddo = true;
	 	 }
	 	    if($toddddo == true) {
	 	 		 $strings = array(
	 	     ':O',
	 	     'im out of town rn.',
	 			 'i will bbl',
	 			 'dude im bored asf',
	 	 	);
	 	 	$key = array_rand($strings);
	 	 	$chaat_txt = $strings[$key];

	$timez = array('7','9','11','12','15','18');
	 	 	$sleepy = array_rand($timez);
	 	 	$sleep_time = $timez[$sleepy];
	 	 	sleep($sleep_time);
	 	 	mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('642', '$chaat_txt', '$tstamp')");
	 	    }




*/





if($chat_txt == 'Hey, bros.'){

				$snd_msg1 = "'641', 'bro this site sucks so bad'";
				$snd_msg2 = "'641', 'but it is so awesome'";
				$snd_msg3 = "'642', 'this site is awesome'";
				$snd_msg4 = "'643', 'definitely can agree on that.'";
				$snd_msg5 = "'641', 'it is designed so perfectly'";
				$snd_msg6 = "'642', 'i can agree with that'";
				$snd_msg7 = "'642', 'better and cheaper than a stupid switch'";
				$snd_msg8 = "'641', 'Why are you so triggered dude?'";
				$snd_msg9 = "'642', 'triggered? can i not have an opinion?'";
				$snd_msg10 = "'643', 'You do seem pretty flamed.'";
				$snd_msg11 = "'642', 'whatever this site is a piece of shit anyways'";
				$snd_msg12 = "'641', 'You are entitled to your own opinion, yes, but there is no reason to act so autistic in such a simple convo.'";
				$snd_msg13 = "'642', 'how did you know i was autistic?'";
				$snd_msg14 = "'643', 'xD'";
				$snd_msg15 = "'641', 'LOL'";
				$snd_msg16 = "'642', 'you know its not really that funny..'";
				$snd_msg17 = "'642', 'not everyone is perfect'";
				$snd_msg18 = "'641', 'That is for sure.'";
				$snd_msg19 = "'643', 'lololol'";
				$snd_msg20 = "'642', 'just you wait ill show you all'";
				$snd_msg21 = "'643', 'What is that supposed to mean?'";
				$snd_msg22 = "'642', 'it means you better shut your stupid fucking mouth before i know your god damn teeth in you gay anime fucker'";
				$snd_msg23 = "'641', 'know? It seems I am having trouble comprehending your autism.'";
				$snd_msg24 = "'642', 'knock*'";
				$snd_msg25 = "'643', 'This is gold'";
				$snd_msg26 = "'642', 'K'";
				$snd_msg27 = "'643', 'Anyway, I will be back on later. I will see you guys then (hopefully not the retard).'";
				$snd_msg28 = "'641', 'I feel my IQ dropping.'";
				$snd_msg29 = "'641', 'I am going to have to go soon too, not sure if I can handle all of this autism. XD'";
				$snd_msg30 = "'642', 'OMG MOM BROUGH HOME PIZZA HUT'";
				$snd_msg31 = "'641', 'How old are you? lol'";
				$snd_msg32 = "'642', '12'";
				$snd_msg33 = "'641', 'That explains quite a lot.'";
				$snd_msg34 = "'642', 'mom said i cant use my ipod while i eat bc i might get grease on it so ill be right back okay'";
				$snd_msg35 = "'641', 'Like I give a damn to stay here just for you. I will be back on later as well, got some things to do.'";
				$snd_msg36 = "'642', 'pizzzAAA is awesome wwowaA'";
				$snd_msg37 = "'642', 'i wonder if its time to milk the cow'";
				$snd_msg38 = "'642', '/milkcow'";
				$snd_msg39 = "'642', 'why isnt this working'";
				$snd_msg40 = "'6', 'cooldude101, there hasn\'t been 20 messages since the last cow milking! -$0.25'";
				$snd_msg41 = "'642', 'fucking kms'";

				 sleep(5);
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg1, '$tstamp')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '641') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg2, '$tstamp+17')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg3, '$tstamp+27')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg4, '$tstamp+32')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg5, '$tstamp+42')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg6, '$tstamp+52')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '642') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg7, '$tstamp+62')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg8, '$tstamp+72')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg9, '$tstamp+82')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg10, '$tstamp+92')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg11, '$tstamp+102')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg12, '$tstamp+112')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg13, '$tstamp+122')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg14, '$tstamp+132')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg15, '$tstamp+142')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg16, '$tstamp+152')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '642') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg17, '$tstamp+162')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg18, '$tstamp+172')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg19, '$tstamp+182')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg20, '$tstamp+192')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg21, '$tstamp+202')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg22, '$tstamp+212')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg23, '$tstamp+222')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg24, '$tstamp+232')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg25, '$tstamp+242')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg26, '$tstamp+245')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg27, '$tstamp+262')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg28, '$tstamp+272')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '641') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg29, '$tstamp+284')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg30, '$tstamp+294')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg31, '$tstamp+304')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg32, '$tstamp+314')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg33, '$tstamp+324')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg34, '$tstamp+334')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg35, '$tstamp+344')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg36, '$tstamp+354')");

				    sleep(20);
						// hide previous username insert
					 // hide previous username insert
						 $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
						 $disr = mysqli_fetch_assoc($disq);
						 $dis_id = $disr['id'];
						 $dis_uid = $disr['uid'];
						 if($dis_uid == '642') {
							 mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
						 }
						 // hide previous username insert
						 // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg37, '$tstamp+364')");

				    sleep(20);
						// hide previous username insert
					 // hide previous username insert
						 $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
						 $disr = mysqli_fetch_assoc($disq);
						 $dis_id = $disr['id'];
						 $dis_uid = $disr['uid'];
						 if($dis_uid == '642') {
							 mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
						 }
						 // hide previous username insert
						 // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg38, '$tstamp+374')");

				    sleep(20);
						// hide previous username insert
					 // hide previous username insert
						 $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
						 $disr = mysqli_fetch_assoc($disq);
						 $dis_id = $disr['id'];
						 $dis_uid = $disr['uid'];
						 if($dis_uid == '642') {
							 mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
						 }
						 // hide previous username insert
						 // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg39, '$tstamp+384')");
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg40, '$tstamp+394')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg41, '$tstamp+404')");

}






if($chat_txt == 'Hello, you guys.'){
//641=todoroki; edgy
//642=cooldude101; dumb
//643=deku; smart
				$snd_msg1 = "'641', 'yo im so bored rn. nobody ever talks in chat.'";//todo
				$snd_msg2 = "'641', 'its lame af'";//todo
				$snd_msg3 = "'642', 'ga ga ging ging muthafucka'";//cooldude
				$snd_msg4 = "'643', 'tf?'";//deku
				$snd_msg5 = "'641', 'what in the shit you talkin like that for, cooldude?'";//todo
				$snd_msg6 = "'642', 'what? all i said was ga GA ginG giNG mutHAfuKca'";//cooldude
				$snd_msg7 = "'642', 'do you have a problem, todo? what about you, deku? got a fuckin problem? say it to my face you stupid fucks'";//cooldude
				$snd_msg8 = "'641', 'Why are you so angry rn? Calm tf down.'";//todo
				$snd_msg9 = "'642', 'i can talk however the fuck i want bitch'";//cooldude
				$snd_msg10 = "'643', 'You need to take a chill pill, cooldude.'";//deku
				$snd_msg11 = "'642', 'whatever....'";//cooldude
				$snd_msg12 = "'641', 'lol'";//todo
				$snd_msg13 = "'642', 'ga gA ging gIng this site is cool but ppl like u are so mean :tear:'";//cooldude
				$snd_msg14 = "'643', 'Sorry.'";//deku
				$snd_msg15 = "'641', 'You were the one who started being mean'";//todo
				$snd_msg16 = "'642', 'you know its not that hard to be nice'";//cooldude
				$snd_msg17 = "'642', 'you should try saying ga ga ging ging its awesome...'";//cooldude
				$snd_msg18 = "'641', 'I might try it... idk tho. Pretty odd.'";//todo
				$snd_msg19 = "'643', 'It is pretty weird.'";//deku
				$snd_msg20 = "'642', 'come on guys... try it!!!! oWo'";//cooldude
				$snd_msg21 = "'643', 'ga GA GING GING GA GA GING GING ga GA ging GING!!!!'";//deku
				$snd_msg22 = "'642', 'hell yeah dude just like that. this is how we do it nanananananNA!! now you do it todo'";//cooldude
				$snd_msg23 = "'641', 'okok. Let me see... GA GA GING GING'";//todo
				$snd_msg24 = "'642', 'now u guys are getting it. fuck yeah!!!'";//cooldude
				$snd_msg25 = "'643', 'still kinda weird tho'";//deku
				$snd_msg26 = "'642', 'whatever...'";//cooldude
				$snd_msg27 = "'643', 'Im gonna go afk for a bit. See you guys later.";//deku
				$snd_msg28 = "'641', 'alright'";//todo
				$snd_msg29 = "'641', 'Hold up, imma go do something too. See ya cooldude lmao'";//todo
				$snd_msg30 = "'642', 'OMG OMG OMG OMG GUYS GUYS OMG GUYS GUESS WHAT OMG'";//cooldude
				$snd_msg31 = "'641', 'what dude? hurry up I gotta go'";//todo
				$snd_msg32 = "'642', 'my... my MOM... BROUGHT HOME MCDONALDS!!! WOOOOOOOOOOO!!! SHIT, FUCK YEAH!!!! Ba da ba buh buh! Im lovin it shit!'";//cooldude
				$snd_msg33 = "'641', 'Um, okay.'";//todo
				$snd_msg34 = "'642', 'mommy says i cant be on misdew right now tho so goodbye for now guys *rawr*'";//cooldude
				$snd_msg35 = "'641', 'so weird. im outta here'";//todo
				$snd_msg36 = "'642', 'omg the fries are fuckin cold. as fuckin always son of a fucking bitch.'";//cooldude
				$snd_msg37 = "'642', 'hol up. imma milk the cow real quick fuck yeah'";//cooldude
				$snd_msg38 = "'642', '/m i lk co w'";//cooldude
				$snd_msg39 = "'642', 'why the fuck is this shit not working'";//cooldude
				$snd_msg40 = "'6', 'cooldude101 has failed to milk the cow! There hasn\'t been 10 messages since the last time, only 1,000 have been sent! -0.25 MDF'";
				$snd_msg41 = "'642', 'that doesnt even making any fucking sense. bbl'";//cooldude

				 sleep(5);
				mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg1, '$tstamp')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '641') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg2, '$tstamp+17')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg3, '$tstamp+27')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg4, '$tstamp+32')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg5, '$tstamp+42')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg6, '$tstamp+52')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '642') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg7, '$tstamp+62')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg8, '$tstamp+72')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg9, '$tstamp+82')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg10, '$tstamp+92')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg11, '$tstamp+102')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg12, '$tstamp+112')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg13, '$tstamp+122')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg14, '$tstamp+132')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg15, '$tstamp+142')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg16, '$tstamp+152')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '642') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg17, '$tstamp+162')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg18, '$tstamp+172')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg19, '$tstamp+182')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg20, '$tstamp+192')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg21, '$tstamp+202')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg22, '$tstamp+212')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg23, '$tstamp+222')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg24, '$tstamp+232')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg25, '$tstamp+242')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg26, '$tstamp+245')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg27, '$tstamp+262')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg28, '$tstamp+272')");
				  sleep(20);
				  // hide previous username insert
				  // hide previous username insert
				    $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
				    $disr = mysqli_fetch_assoc($disq);
				    $dis_id = $disr['id'];
				    $dis_uid = $disr['uid'];
				    if($dis_uid == '641') {
				      mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
				    }
				    // hide previous username insert
				    // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg29, '$tstamp+284')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg30, '$tstamp+294')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg31, '$tstamp+304')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg32, '$tstamp+314')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg33, '$tstamp+324')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg34, '$tstamp+334')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg35, '$tstamp+344')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg36, '$tstamp+354')");

				    sleep(20);
						// hide previous username insert
					 // hide previous username insert
						 $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
						 $disr = mysqli_fetch_assoc($disq);
						 $dis_id = $disr['id'];
						 $dis_uid = $disr['uid'];
						 if($dis_uid == '642') {
							 mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
						 }
						 // hide previous username insert
						 // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg37, '$tstamp+364')");

				    sleep(20);
						// hide previous username insert
					 // hide previous username insert
						 $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
						 $disr = mysqli_fetch_assoc($disq);
						 $dis_id = $disr['id'];
						 $dis_uid = $disr['uid'];
						 if($dis_uid == '642') {
							 mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
						 }
						 // hide previous username insert
						 // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg38, '$tstamp+374')");

				    sleep(20);
						// hide previous username insert
					 // hide previous username insert
						 $disq = mysqli_query($conx, "SELECT id,uid FROM chat ORDER BY id DESC LIMIT 1");
						 $disr = mysqli_fetch_assoc($disq);
						 $dis_id = $disr['id'];
						 $dis_uid = $disr['uid'];
						 if($dis_uid == '642') {
							 mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
						 }
						 // hide previous username insert
						 // hide previous username insert
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg39, '$tstamp+384')");
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg40, '$tstamp+394')");
				  sleep(20);
				  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg41, '$tstamp+404')");

}
?>
