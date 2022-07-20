<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$get_shoutID = safe($_GET['id']);
$like_cnt = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$get_shoutID' && likedis='like'"));
$dislike_cnt = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$get_shoutID' && likedis='dislike'"));
if($like_cnt == '0') {
  $like_likes = "likes";
}
elseif($like_cnt == '1') {
  $like_likes = "like";
}
else {
  $like_likes = "likes";
}
if($dislike_cnt == '0') {
  $dislike_dislikes = "dislikes";
}
elseif($dislike_cnt == '1') {
  $dislike_dislikes = "dislike";
}
else {
  $dislike_dislikes = "dislikes";
}
echo "$like_cnt $like_likes, $dislike_cnt $dislike_dislikes";
 ?>
