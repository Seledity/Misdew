<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$amount = safe($_GET['amntcnt']);
$post_id = safe($_GET['i']);
$cmt_q = mysqli_query($conx, "SELECT id,uid,post,tstamp,random_str,edited,img FROM feed_comments WHERE post_rstr='$post_id' ORDER BY id DESC LIMIT $amount,10");
while($cmt_r = mysqli_fetch_assoc($cmt_q)) {
  $cmt_id = $cmt_r['id'];
  $cmt_uid = $cmt_r['uid'];
  $string = $cmt_r['post'];
  $cmt_tstamp = $cmt_r['tstamp'];
  $cmt_randomstr = $cmt_r['random_str'];
  $cmt_edited = $cmt_r['edited'];
  $cmt_img = $cmt_r['img'];
  include("../inc/replace.php");
  $usr_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$cmt_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $cmt_username = $usr_r['username'];
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$cmt_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = $usri_r['username_color'];
      $cmt_tcolor = $usri_r['text_color'];
    }
  }
  $likcnt_q = mysqli_query($conx, "SELECT id FROM feedcmt_likes WHERE cmt_id='$cmt_id'");
  $likcnt_r = number_format(mysqli_num_rows($likcnt_q));
  if($likcnt_r == '1') {
    $ls = "";
  }
  else {
    $ls = "s";
  }
  echo "<div class=\"cmt_post\" id=\"fp_1\" style=\"max-width: 430px; width: 80%; background-color: $username_color;\">
  <table class=\"post_table1\">
      <tr>
      <td class=\"ptb1_td1\" style=\"color: $cmt_tcolor;\"><a href=\"/canvas/$cmt_username\" style=\"text-decoration: none; color: $cmt_tcolor; font-weight: bold;\">$cmt_username</a></td>
      <td class=\"ptb1_td2\" style=\"color: $cmt_tcolor;\"><i class=\"fa fa-angle-down\" aria-hidden=\"true\" onclick=\"expand('$cmt_randomstr')\"></i></td>
    </tr>
  </table>
</div>
<div id=\"$cmt_randomstr\" class=\"post_more\" style=\"max-width: 430px; width: 80%; display: none;\">";
if($cmt_edited == 'yes') {
  echo "edited ";
}
else {
  echo "posted ";
}
echo timeago($cmt_tstamp); echo" ago";
if($cmt_uid == $u_uid) {
  if($cmt_img != 'yes') {
    echo "&nbsp; <i onclick=\"window.location='editc.php?i=$cmt_randomstr';\" class=\"fa fa-pencil\" aria-hidden=\"true\"></i> - ";
  }
  else {
    echo "&nbsp; ";
  }
  echo "<i class=\"fa fa-trash\" aria-hidden=\"true\" id=\"cdel_$cmt_id\"></i>";
}
if($cmt_uid != $u_uid && $u_rank == 'mod') {
  echo "&nbsp; <i class=\"fa fa-trash\" aria-hidden=\"true\" id=\"cdel_$cmt_id\"></i>";
}
echo "</div>
<div class=\"cmt_post\" id=\"fp_2\" style=\"max-width: 430px; width: 80%; text-align: left;\">
  <div class=\"fp_3\">";
    echo bbc(atname(nl2br($string)));
      echo "</div>
  <table class=\"post_table2\" style=\"padding-bottom: 10px;\">
    <tr>
      <td class=\"ptb2_td1\" id=\"cmt_id_$cmt_id\"><span id=\"likecnt_$cmt_id\"><i class='fa fa-thumbs-up'"; if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feedcmt_likes WHERE cmt_id='$cmt_id' && uid='$u_uid'")) == '1') { echo " id=\"like_simple\" "; } echo "></i> $likcnt_r like$ls</span></td>
    </tr>
  </table>
</div><br>
";
}
?>
