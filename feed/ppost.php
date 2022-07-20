<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: https://misdew.com");
  exit();
}
$id = mysqli_real_escape_string($conx, htmlentities($_POST['body']));
$edit = mysqli_real_escape_string($conx, htmlentities($_POST['edit']));


$pollquest = mysqli_real_escape_string($conx, htmlentities($_POST['pollquest']));
$pollquest = trim($pollquest);
$pollopt1 = mysqli_real_escape_string($conx, htmlentities($_POST['pollopt1']));
$pollopt1 = trim($pollopt1);
$pollopt2 = mysqli_real_escape_string($conx, htmlentities($_POST['pollopt2']));
$pollopt2 = trim($pollopt2);
$pollopt3 = mysqli_real_escape_string($conx, htmlentities($_POST['pollopt3']));
$pollopt3 = trim($pollopt3);
$pollopt4 = mysqli_real_escape_string($conx, htmlentities($_POST['pollopt4']));
$pollopt4 = trim($pollopt4);
$pollopt5 = mysqli_real_escape_string($conx, htmlentities($_POST['pollopt5']));
$pollopt5 = trim($pollopt5);


$getrstr = safe($_GET['i']);
$getshare = safe($_GET['share']);
$getidq = mysqli_query($conx, "SELECT id FROM feed WHERE random_str='$getrstr'");
$getidr = mysqli_fetch_assoc($getidq);
$getsid = $getidr['id'];
$edited = "";
function genRand($length = 15) {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
$rstr = genRand();
$rstr = $u_uid.$rstr;
if($edit) {
  $id = $edit;
  if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed WHERE random_str='$getrstr' && uid='$u_uid'")) == '1') {
    mysqli_query($conx, "UPDATE feed SET post='$id' WHERE random_str='$getrstr' && uid='$u_uid'");
    mysqli_query($conx, "UPDATE feed SET edited='yes' WHERE random_str='$getrstr' && uid='$u_uid'");
    mysqli_query($conx, "UPDATE feed SET tstamp='$tstamp' WHERE random_str='$getrstr' && uid='$u_uid'");
  }
  header("location: https://misdew.com/feed/post.php?i=$getrstr");
  exit();
}
elseif($getshare) {
  if($getsid == '') {
    header("location: https://misdew.com/feed");
    exit();
  }
  mysqli_query($conx, "INSERT INTO feed (uid, post, tstamp, random_str, visibility, shared_id, shared_rstr) VALUES ('$u_uid','$id','$tstamp','$rstr','public','$getsid','$getrstr')");
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.05 WHERE uid='$u_uid'");
  header("location: https://misdew.com/feed");
  exit();
}
else {
  mysqli_query($conx, "INSERT INTO feed (uid, post, tstamp, random_str, visibility) VALUES ('$u_uid','$id','$tstamp','$rstr','public')");
  if($pollquest != '') {
    mysqli_query($conx, "UPDATE feed SET is_poll='yes' WHERE random_str='$rstr'");
    mysqli_query($conx, "INSERT INTO feed_polls (uid, uqid, tstamp, poll_question, poll_opt1, poll_opt2, poll_opt3, poll_opt4, poll_opt5, is_timed) VALUES ('$u_uid','$rstr','$tstamp','$pollquest','$pollopt1','$pollopt2','$pollopt3','$pollopt4','$pollopt5','no')");
  }
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.05 WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'+.25 WHERE uid='$u_uid'");
  header("location: https://misdew.com/feed");
  exit();
}
?>
