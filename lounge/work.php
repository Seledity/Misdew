<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_cont_mang == 'yes' || $u_comm_mang == 'yes' || $u_design_pol == 'yes' || $u_peacekpr == 'yes') { }
else { header("location: /"); exit(); }
$waction = safe($_POST['a']);
$paction = safe($_POST['p']);
$is_evade = safe($_POST['e']);
$affct_username = safe($_POST['username']);
$notif_inp = safe($_POST['notif_inp']);
$wrk_q = mysqli_query($conx, "SELECT uid,strikes,jailed_count,release_time FROM accounts WHERE username='$affct_username'");
$wrk_r = mysqli_fetch_assoc($wrk_q);
$affct_uid = $wrk_r['uid'];
$affct_strikes = $wrk_r['strikes'];
$affct_jailed_count = $wrk_r['jailed_count'];
$affct_release_time = $wrk_r['release_time'];
$wrk_qq = mysqli_query($conx, "SELECT behavior FROM account_figures WHERE uid='$affct_uid'");
$wrk_rr = mysqli_fetch_assoc($wrk_qq);
$affct_behavior = $wrk_rr['behavior'];
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM accounts WHERE username='$affct_username'")) == '0' && $waction != 'notify') {
  header("location: throw_error");
  exit();
}
// Community Manager Permissions
if($u_comm_mang == 'yes') {
  # NOTIFICATION
  if($waction == 'notify') {
    function genRand2($length = 10) {
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
    $rstrTWO = genRand2();
    $queryq = mysqli_query($conx, "SELECT uid FROM accounts WHERE verified='yes'");
    while($rowr = mysqli_fetch_array($queryq)) {
      $uid_accs = $rowr['uid'];
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, tstamp) VALUES ('$rstrTWO','$uid_accs','no','misdew','$notif_inp','$tstamp')");
    }
  }
  # PROMOTING ACCOUNTS
  if($waction == 'promote') {
    // Community Manager
    if($paction == 'comm') { $prom = "comm_mang"; }
    // Content Manager
    elseif($paction == 'cont') { $prom = "cont_mang"; }
    // Design Police
    elseif($paction == 'des') { $prom = "design_police"; }
    // Peacekeeper
    elseif($paction == 'pea') { $prom = "peacekeeper"; }
    // Fail
    else { exit(); }
    # PROMOTION
    if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM accounts WHERE username='$affct_username' && $prom='yes'")) != '0') {
      header("location: throw_error");
      exit();
    }
    mysqli_query($conx, "UPDATE accounts SET $prom='yes' WHERE username='$affct_username'");
  }
  # DEMOTING ACCOUNTS
  if($waction == 'demote') {
    // Community Manager
    if($paction == 'comm') { $prom = "comm_mang"; }
    // Content Manager
    elseif($paction == 'cont') { $prom = "cont_mang"; }
    // Design Police
    elseif($paction == 'des') { $prom = "design_police"; }
    // Peacekeeper
    elseif($paction == 'pea') { $prom = "peacekeeper"; }
    // Fail
    else { exit(); }
    # PROMOTION
    if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM accounts WHERE username='$affct_username' && $prom='no'")) != '0') {
      header("location: throw_error");
      exit();
    }
    mysqli_query($conx, "UPDATE accounts SET $prom='no' WHERE username='$affct_username'");
  }
}
// Content Manager Permissions
if($u_cont_mang == 'yes') {
  # SPAM CLEANUP
  if($waction == 'cln') {
    //
    // NEW: LOUNGE LOG
    // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
    //
    $lounge_tstamp = time();
    $lounge_comments = "used the spam cleanup tool";
    $lounge_action = "spam_cln";
    mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$affct_uid','$lounge_action','$lounge_comments','$lounge_tstamp')");
    //
    // NEW: LOUNGE LOG
    // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
    //
    mysqli_query($conx, "DELETE FROM feed WHERE uid='$affct_uid'");
    mysqli_query($conx, "DELETE FROM feed_comments WHERE uid='$affct_uid'");
    mysqli_query($conx, "DELETE FROM friends WHERE uid_req='$affct_uid'");
    mysqli_query($conx, "DELETE FROM friends WHERE uid_rec='$affct_uid'");
    mysqli_query($conx, "DELETE FROM market_ratings WHERE uid='$affct_uid'");
    mysqli_query($conx, "DELETE FROM draw_comments WHERE uid='$affct_uid'");
    mysqli_query($conx, "DELETE FROM draw WHERE uid='$affct_uid'");
    mysqli_query($conx, "DELETE FROM canvas_comments WHERE uid_poster='$affct_uid'");
    mysqli_query($conx, "DELETE FROM canvas_askbox WHERE uid_asker='$affct_uid'");
    mysqli_query($conx, "DELETE FROM chat WHERE uid='$affct_uid'");
  }
  # STRIKING ACCOUNTS
  if($waction == 'str') {
    $codeq = mysqli_query($conx, "SELECT num,weight,content,seconds FROM codes WHERE num='$paction'");
    $coder = mysqli_fetch_assoc($codeq);
    $code_num = $coder['num'];
    $code_weight = $coder['weight'];
    $code_content = $coder['content'];
    $code_seconds = $coder['seconds'];
    // Jail time, or nah?
    $jq = mysqli_query($conx, "SELECT violation_time,last_strike,seconds FROM account_strikes WHERE uid_issuee='$affct_uid' ORDER BY id DESC LIMIT 1");
    $jr = mysqli_fetch_assoc($jq);
    $j_laststr = $jr['last_strike'];
    $j_seconds = $jr['seconds'];
    $j_vtime = $jr['violation_time'];
    if($j_laststr == 'no') {
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$tstamp','$affct_uid','no','misdew','<span style=\"font-weight: bold;\">$u_username</span> has issued you a strike. <br> <span style=\"font-size: 15px;\">Violated Code &num;$code_num - $code_weight</span>','','$tstamp')");
      mysqli_query($conx, "UPDATE accounts SET strikes='$affct_strikes'+1 WHERE uid='$affct_uid'");
      mysqli_query($conx, "UPDATE accounts SET jailed_count='$affct_jailed_count'+1 WHERE uid='$affct_uid'");
      mysqli_query($conx, "UPDATE accounts SET jailed='yes' WHERE uid='$affct_uid'");
      // Total Jail Time
      $time_to_serve = time() + $j_seconds;
      $time_to_serve = $time_to_serve + $code_seconds;
      $total_weight = "$code_weight + $j_vtime";
      mysqli_query($conx, "UPDATE accounts SET release_time='$time_to_serve' WHERE uid='$affct_uid'");
      mysqli_query($conx, "INSERT INTO account_strikes (uid_issuee,uid_issuer,violation_code,violation_time,last_strike,total_time,issued_tstamp) VALUES ('$affct_uid','$u_uid','$code_num','$code_weight','yes','$total_weight','$tstamp')");
      mysqli_query($conx, "UPDATE account_figures SET behavior='$affct_behavior'-10 WHERE uid='$affct_uid'");
    }
    else {
      if($is_evade == 'evade') {
        //
        // NEW: LOUNGE LOG
        // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
        //
        $lounge_tstamp = time();
        $lounge_comments = "added extra jail to a user for evading";
        $lounge_action = "usr_evad";
        mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$affct_uid','$lounge_action','$lounge_comments','$lounge_tstamp')");
        //
        // NEW: LOUNGE LOG
        // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
        //
        mysqli_query($conx, "UPDATE accounts SET release_time='$affct_release_time'+604800 WHERE uid='$affct_uid'");
        mysqli_query($conx, "UPDATE account_figures SET behavior='$affct_behavior'-20 WHERE uid='$affct_uid'");
      }
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$tstamp','$affct_uid','no','misdew','<span style=\"font-weight: bold;\">$u_username</span> has issued you a strike. <br> <span style=\"font-size: 15px;\">Violated Code &num;$code_num - $code_weight</span>','','$tstamp')");
      mysqli_query($conx, "UPDATE accounts SET strikes='$affct_strikes'+1 WHERE uid='$affct_uid'");
      mysqli_query($conx, "INSERT INTO account_strikes (uid_issuee,uid_issuer,violation_code,violation_time,last_strike,issued_tstamp,seconds) VALUES ('$affct_uid','$u_uid','$code_num','$code_weight','no','$tstamp','$code_seconds')");
      mysqli_query($conx, "UPDATE account_figures SET behavior='$affct_behavior'-10 WHERE uid='$affct_uid'");
      //
      // NEW: LOUNGE LOG
      // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
      //
      $lounge_tstamp = time();
      $lounge_comments = "striked a user for Code #$code_num";
      $lounge_action = "usr_strk";
      mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$affct_uid','$lounge_action','$lounge_comments','$lounge_tstamp')");
      //
      // NEW: LOUNGE LOG
      // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
      //
    }
  }
  # STRIKING ACCOUNTS
  if($waction == 'perma') {
    $code_weight = "&infin;";
    $code_seconds = '';
    //
    // NEW: LOUNGE LOG
    // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
    //
    $lounge_tstamp = time();
    $lounge_comments = "perma banned a user";
    $lounge_action = "perma_ban";
    mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$affct_uid','$lounge_action','$lounge_comments','$lounge_tstamp')");
    //
    // NEW: LOUNGE LOG
    // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
    //
    mysqli_query($conx, "INSERT INTO account_strikes (uid_issuee,uid_issuer,violation_code,violation_time,last_strike,issued_tstamp,seconds) VALUES ('$affct_uid','$u_uid','0','$code_weight','no','$tstamp','$code_seconds')");
    mysqli_query($conx, "UPDATE accounts SET jailed='yes' WHERE uid='$affct_uid'");
    mysqli_query($conx, "UPDATE accounts SET release_time='perma' WHERE uid='$affct_uid'");
    mysqli_query($conx, "UPDATE account_figures SET behavior='0' WHERE uid='$affct_uid'");
  }
  # PARDONING ACCOUNTS
  if($waction == 'pardon') {
    //
    // NEW: LOUNGE LOG
    // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
    //
    $lounge_tstamp = time();
    $lounge_comments = "unbanned a user";
    $lounge_action = "usr_pardn";
    mysqli_query($conx, "INSERT INTO lounge_log (uid, uid_affected, action, comments, tstamp) VALUES ('$u_uid','$affct_uid','$lounge_action','$lounge_comments','$lounge_tstamp')");
    //
    // NEW: LOUNGE LOG
    // KEEP STAFF UNDER CONTROL AND MAKE SURE THEY ARE BEHAVING
    //
    mysqli_query($conx, "UPDATE accounts SET jailed='no' WHERE uid='$affct_uid'");
    mysqli_query($conx, "UPDATE accounts SET release_time='' WHERE uid='$affct_uid'");
  }
}
// Design Police Permissions
if($u_design_pol == 'yes') {
  # DISABLE DESIGN
  if($waction == 'disable') {
    mysqli_query($conx, "UPDATE canvas_design SET uid='_$affct_uid' WHERE uid='$affct_uid'");
	mysqli_query($conx, "UPDATE accounts SET css='' WHERE uid='$affct_uid'");
  }
  # ENABLE DESIGN
  if($waction == 'enable') {
    mysqli_query($conx, "UPDATE canvas_design SET uid='$affct_uid' WHERE uid='_$affct_uid'");
  }
}
// Peacekeeper Permissions
if($u_peacekpr == 'yes') {

}
?>
