<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$post_token = mysqli_real_escape_string($conx, htmlentities($_POST['token']));
$post_id = mysqli_real_escape_string($conx, htmlentities($_POST['id']));
$post_likedis = mysqli_real_escape_string($conx, htmlentities($_POST['likedis']));

$did_you_like = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$post_id' && likedis='like' && uid='$u_uid'"));
$did_you_dislike = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$post_id' && likedis='dislike' && uid='$u_uid'"));

if($post_token == $u_token) {
  if($post_likedis == 'like') {
    if($did_you_like >= '1') {
      mysqli_query($conx, "DELETE FROM shout_likedis WHERE uid='$u_uid' && shout_id='$post_id' && likedis='like'");
    }
    elseif($did_you_dislike >= '1') {
      mysqli_query($conx, "DELETE FROM shout_likedis WHERE uid='$u_uid' && shout_id='$post_id' && likedis='dislike'");
      mysqli_query($conx, "INSERT INTO shout_likedis (shout_id, uid, likedis) VALUES ('$post_id', '$u_uid', '$post_likedis')");
    }
    elseif($did_you_dislike == '0') {
      mysqli_query($conx, "INSERT INTO shout_likedis (shout_id, uid, likedis) VALUES ('$post_id', '$u_uid', '$post_likedis')");
    }
  }
  if($post_likedis == 'dislike') {
    if($did_you_dislike >= '1') {
      mysqli_query($conx, "DELETE FROM shout_likedis WHERE uid='$u_uid' && shout_id='$post_id' && likedis='dislike'");
    }
    elseif($did_you_like >= '1') {
      mysqli_query($conx, "DELETE FROM shout_likedis WHERE uid='$u_uid' && shout_id='$post_id' && likedis='like'");
      mysqli_query($conx, "INSERT INTO shout_likedis (shout_id, uid, likedis) VALUES ('$post_id', '$u_uid', '$post_likedis')");
    }
    elseif($did_you_like == '0') {
      mysqli_query($conx, "INSERT INTO shout_likedis (shout_id, uid, likedis) VALUES ('$post_id', '$u_uid', '$post_likedis')");
    }
  }
}
?>
