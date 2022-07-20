<?php
require_once("../inc/conx.php");
$chat_txt = mysqli_real_escape_string($conx, htmlentities($_POST['pmbody']));
$var1 = mysqli_real_escape_string($conx, htmlentities($_POST['pmu']));


if($chat_txt && $var1) {
    $jtest = mysqli_query($conx, "SELECT uid FROM accounts WHERE username='$var1'");
    $ohlmao = mysqli_fetch_assoc($jtest);
    $uidofusername = $ohlmao['uid'];
    if($uidofusername && $uidofusername != $u_uid) {
      $string = $chat_txt;
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
