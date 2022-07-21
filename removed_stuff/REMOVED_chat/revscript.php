<?php
require_once("../inc/conx.php");
$chat_txt = mysqli_real_escape_string($conx, htmlentities($_POST['body']));
require_once("commands.php");







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
    }
	}

$snd_msg1 = "'641', 'Guys, I am totally loving my brand new Nintendo Switch.'";
$snd_msg2 = "'641', 'The joycons are awesome.'";
$snd_msg3 = "'642', 'the switch is gay'";
$snd_msg4 = "'643', 'I am going to be getting one in a few weeks, really excited about that.'";
$snd_msg5 = "'641', 'Mario Kart has always been one of my favorite games and Mario Kart 8 is LIT on the switch.'";
$snd_msg6 = "'642', 'i have an original 3ds'";
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


  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg1, '$tstamp')");
  sleep(7);
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
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg2, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg3, '$tstamp')");
  sleep(5);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg4, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg5, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg6, '$tstamp')");
  sleep(10);
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
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg7, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg8, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg9, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg10, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg11, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg12, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg13, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg14, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg15, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg16, '$tstamp')");
  sleep(10);
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
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg17, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg18, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg19, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg20, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg21, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg22, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg23, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg24, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg25, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg26, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg27, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg28, '$tstamp')");
  sleep(12);
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
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg29, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg30, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg31, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg32, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg33, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg34, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg35, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg36, '$tstamp')");
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
    sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg37, '$tstamp')");
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
    sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg38, '$tstamp')");
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
    sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg39, '$tstamp')");
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
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg40, '$tstamp')");
  sleep(10);
  mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ($snd_msg41, '$tstamp')");


}
?>
