<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$id = safe($_POST['body']);
$edit = safe($_POST['edit']);
$getrstr = safe($_GET['i']);
$getidq = mysqli_query($conx, "SELECT id,uid,allow_comments FROM feed WHERE random_str='$getrstr'");
$getidr = mysqli_fetch_assoc($getidq);
$getid = $getidr['id'];
$poster = $getidr['uid'];
$commenting = $getidr['allow_comments'];
$geteidq = mysqli_query($conx, "SELECT post_rstr FROM feed_comments WHERE random_str='$getrstr'");
$geteidr = mysqli_fetch_assoc($geteidq);
$geteid = $geteidr['post_rstr'];
$edited = "";
if($edit) {
  $id = $edit;
  if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed_comments WHERE random_str='$getrstr' && uid='$u_uid'")) == '1') {
    mysqli_query($conx, "UPDATE feed_comments SET post='$id' WHERE random_str='$getrstr' && uid='$u_uid'");
    mysqli_query($conx, "UPDATE feed_comments SET edited='yes' WHERE random_str='$getrstr' && uid='$u_uid'");
    mysqli_query($conx, "UPDATE feed_comments SET tstamp='$tstamp' WHERE random_str='$getrstr' && uid='$u_uid'");
  }
  header("location: post.php?i=$geteid");
  exit();
}
else {
  if($commenting == 'no') {
    exit();
    die();
  }
  function genRand($length = 15) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $rstr = genRand();
  function genRand2($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $rstrTWO = genRand2();
  mysqli_query($conx, "UPDATE account_figures SET activeness='$f_activeness'+.03 WHERE uid='$u_uid'");
  mysqli_query($conx, "INSERT INTO feed_comments (post_rstr, uid, tstamp, post, random_str, post_id) VALUES ('$getrstr','$u_uid','$tstamp','$id','$rstr','$getid')");
  if($poster != $u_uid) {
    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$poster' && app_uqid='feed' && snooze='no'")) != '0') {
      mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('$rstrTWO','$poster','yes','feed','<span style=\"font-weight: bold;\">$u_username</span> commented on your post.','/feed/post.php?i=$getrstr','$tstamp')");
    }
  }
  header("location: /feed");
  exit();
}
?>
