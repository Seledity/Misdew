<?php
$this_page = "canvas";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$g_user = safe($_GET['u']);
if($g_user == '') {
  $g_user = $u_username;
}
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username FROM accounts WHERE username='$g_user'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_uid = $cnv_r['uid'];
$cnv_username = $cnv_r['username'];
$cv_qq = mysqli_query($conx, "SELECT * FROM canvas_comments WHERE uid_canvas='$cnv_uid' ORDER BY id DESC LIMIT 5");
$comment_count = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM canvas_comments WHERE uid_canvas='$cnv_uid' ORDER BY id DESC"));
if($comment_count == 0) {
  $cvq_comment = "No comments? What the heck. ]:[";
  $quest_username = "Misdew";
  $quest_picture = "/img/logo.png";
  $cv_activeness = "#a64ca6";
  $qusername_color = $cv_activeness;
  echo "<div class=\"comment\"><table><tr><td>";
  echo "<div class=\"comment_psize\">";
  echo "<div class=\"comment_activdot\" style=\"background-color: $cv_activeness;\"></div>";
  echo "<img src=\"$quest_picture\" class=\"list_picture\" onclick=\"window.location='/canvas/$quest_username';\"></div></td><td>";
  echo "<span class=\"interact_username\" style=\"color: $qusername_color; font-weight: bold;\" onclick=\"window.location='/canvas/$quest_username';\"> $quest_username </span> <br>";
  $string = $cvq_comment;
  require("../inc/replace.php");
  echo nl2br($string);
  echo "</td></tr></table></div>";
}
echo "<div id=\"ld_comments\">";
while($cv_qr = mysqli_fetch_assoc($cv_qq)) {
  $cvq_id = $cv_qr['id'];
  $cvq_uid_cmnter = $cv_qr['uid_poster'];
  $cvq_tstamp = $cv_qr['tstamp'];
  $cvq_comment = $cv_qr['content'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$cvq_uid_cmnter'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $cvq_uid_cmnter = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$cvq_uid_cmnter'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $cvq_uid_cmnter = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  # SELECT ACCOUNT DATA FOR QUESTIONS
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$cvq_uid_cmnter'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    // Account data
    $quest_username = $usr_r['username'];
    $quest_picture = $usr_r['picture'];
    $quest_onltime = $usr_r['online_time'];
    $quest_verf = $usr_r['md_verf'];
    if($quest_verf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> ";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $quest_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
    // Activity Dot
    $new_time = time() - $quest_onltime;
    $mens = round($new_time / 60);
    if($mens <= 1) { $cv_activeness = "#00FF00"; } // Active within one minute
    elseif($mens <= 2) { $cv_activeness = "#FFA500"; } // Active within two minutes
    elseif($mens < 5) { $cv_activeness = "#FF0000"; } // Active within five minutes
    else { $cv_activeness = "#FF0000"; } // Active over five minutes
    # SELECT THEME COLORS FOR ACCOUNTS
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$cvq_uid_cmnter' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      // Theme data
      $qusername_color = $usri_r['username_color'];
      $qquest_tcolor = $usri_r['text_color'];
    }
  }
  if($cvq_uid_cmnter != '286') {
  echo "<div class=\"comment\" style=\"word-break: break-word;\"><table><tr><td>";
  echo "<div class=\"comment_psize\">";
  echo "<div class=\"comment_activdot\" style=\"background-color: $cv_activeness;\"></div>";
  echo "<img src=\"$quest_picture\" class=\"list_picture\" onclick=\"window.location='/canvas/$quest_username';\"></div></td><td>";
  echo "<span class=\"interact_username\" style=\"color: $qusername_color; font-weight: bold;\" onclick=\"window.location='/canvas/$quest_username';\"> $quest_username $verif_check";
  echo "</span><span class=\"tago\" style=\"font-size: 11px;\">&bull; ";
  echo timeago($cvq_tstamp);
  echo " ago</span>";
  if($cnv_username == $u_username || $quest_username == $u_username || $u_comm_mang == 'yes') {
    echo "&nbsp; <i onclick=\"dComment('$cvq_id')\" class=\"fa fa-trash interact_delete\" aria-hidden=\"true\" style=\"color: $qusername_color; font-size: 13px;\"></i>";
  }
  echo "<br>";
  $string = $cvq_comment;
  require("../inc/replace.php");
  echo nl2br($string);
  echo "</td></tr></table></div>";
}
}
echo "</div>";
if($comment_count > 5) {
  echo "<div id=\"cLd\" onclick=\"loadComments();\">";
  echo "<div id=\"comments_loadmore\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>";
  echo "</div>";
}
?>
<input id="camount" type="hidden" value="5">
