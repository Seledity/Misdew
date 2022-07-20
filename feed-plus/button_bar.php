<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$post_id = safe($_GET['i']);
$feed_q = mysqli_query($conx, "SELECT * FROM feed WHERE id='$post_id'");
$feed_r = mysqli_fetch_assoc($feed_q);
$feed_id = $feed_r['id'];
$feed_uid = $feed_r['uid'];
$usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$feed_uid' && theme_id='$g_themeid'");
$usri_r = mysqli_fetch_assoc($usri_q);
$username_color = $usri_r['username_color'];
$feed_tcolor = $usri_r['text_color'];
// If a post has more than one comment, set an 's' variable
$comcnt_q = mysqli_query($conx, "SELECT id FROM feed_comments WHERE post_id='$feed_id'");
$comcnt_r = number_format(mysqli_num_rows($comcnt_q));
if($comcnt_r == '1') { $cs = ""; } else { $cs = "s"; } // comment(s)
// If a post has more than one like, set an 's' variable
$likcnt_q = mysqli_query($conx, "SELECT id FROM feed_likes WHERE post_id='$feed_id'");
$likcnt_r = number_format(mysqli_num_rows($likcnt_q));
if($likcnt_r == '1') { $ls = ""; } else { $ls = "s"; } // like(s)
// If a post has more than one dislike, set an 's' variable
$dlikcnt_q = mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$feed_id'");
$dlikcnt_r = number_format(mysqli_num_rows($dlikcnt_q));
if($dlikcnt_r == '1') { $dls = ""; } else { $dls = "s"; } // dislike(s)
# SEE IF A USER HAS LIKED OR DISLIKED POSTS
# SET THE COLOR OF THE BUBBLES ACCORDINGLY
$did_user_like = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed_likes WHERE post_id='$feed_id' && uid='$u_uid'"));
if($did_user_like >= '1') {
  $post_like_color = "$username_color";
  $post_like_bgcolor = "$feed_tcolor";
}
else {
  $post_like_color = "$feed_tcolor";
  $post_like_bgcolor = "$username_color";
}
$did_user_dislike = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$feed_id' && uid='$u_uid'"));
if($did_user_dislike >= '1') {
  $post_dislike_color = "$username_color";
  $post_dislike_bgcolor = "$feed_tcolor";
}
else {
  $post_dislike_color = "$feed_tcolor";
  $post_dislike_bgcolor = "$username_color";
}
echo "

<div onclick=\"postLike('$feed_id')\" id=\"lpost_id_$feed_id\" class=\"feedp_like\" style=\"background-color: $post_like_bgcolor;\"><i class=\"fa fa-thumbs-up\" style=\"color: $post_like_color;\"></i></div>
<div onclick=\"showComments('show_comments_$feed_id','$feed_id','$username_color','$feed_tcolor');\" id=\"cmtbtn_$feed_id\" class=\"feed_cmt_btn\" style=\"background-color: $username_color\"><i id=\"cmtbtxt_$feed_id\" class=\"fa fa-comment\" style=\"color: $feed_tcolor;\"></i></div>
<div onclick=\"postDislike('$feed_id')\" id=\"dpost_id_$feed_id\" class=\"feedp_dislike\" style=\"background-color: $post_dislike_bgcolor;\"><i class=\"fa fa-thumbs-down\" style=\"color: $post_dislike_color;\"></i></div>

";

 ?>
