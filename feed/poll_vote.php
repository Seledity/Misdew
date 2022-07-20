<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}

$post_uq = safe($_POST['uq']);
$post_option = safe($_POST['op']);
$post_token = safe($_POST['token']);


if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed_polls WHERE uqid='$post_uq'")) != '1') {
  header("location: /feed");
  exit();
}

if($u_token == $post_token) {

$query = mysqli_query($conx, "SELECT * FROM feed_poll_response WHERE poll_uqid = '$post_uq' && uid = '$u_uid'");
$amount = mysqli_num_rows($query);
if($amount == 0){
  mysqli_query($conx, "INSERT INTO feed_poll_response (uid, tstamp, option_picked, poll_uqid) VALUES ('$u_uid', '$tstamp', '$post_option', '$post_uq')");
}
else {
  mysqli_query($conx, "UPDATE feed_poll_response SET option_picked='$post_option' WHERE poll_uqid='$post_uq' && uid='$u_uid'");
}
}
?>
