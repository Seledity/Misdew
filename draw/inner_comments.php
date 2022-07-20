<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$draw_id = safe($_GET['i']);
# SELECT COMMENTS
$cmt_cnt = mysqli_num_rows($cmt_q = mysqli_query($conx, "SELECT id,uid,tstamp,content FROM draw_comments WHERE draw_id='$draw_id' ORDER BY id DESC"));
if($cmt_cnt == 0) {
  echo "<div style=\"padding: 12px; font-family: 'Dosis', sans-serif;\" class=\"no_cont\">
  No comments <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>
  </div>";
}
while($cmt_r = mysqli_fetch_assoc($cmt_q)) {
  $cmt_id = $cmt_r['id'];
  $cmt_uid = $cmt_r['uid'];
  $cmt_tstamp = $cmt_r['tstamp'];
  $string = $cmt_r['content'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$cmt_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $cmt_uid = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$cmt_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $cmt_uid = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  include("../inc/replace.php");
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$cmt_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $cmt_username = $usr_r['username'];
    $cmt_pic = $usr_r['picture'];
    $cmt_onltime = $usr_r['online_time'];
    $cmnt_vrf = $usr_r['md_verf'];
    if($cmnt_vrf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $cmt_pic = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
    $HUAHHH = time() - $cmt_onltime;
    $mens = round($HUAHHH / 60);
    if($mens <= 1) {
      $cv_activeness = "#00FF00";
    }
    elseif($mens <= 2) {
      $cv_activeness = "#FFA500";
    }
    elseif($mens < 5) {
      $cv_activeness = "#FF0000";
    }
    else {
      $cv_activeness = "#FF0000";
    }
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$cmt_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = $usri_r['username_color'];
      $cmt_tcolor = $usri_r['text_color'];
    }
  }
  if($cmt_uid != '286') {
  echo "<table style=\"padding-bottom: 5px; padding-top: 5px; font-family: 'Dosis', sans-serif; width: 100%;\"><tr><td>
      <div style=\"position: relative; width: 36px; height: 36px; border-radius: 50px;\">
      <div style=\"background-color: $cv_activeness; border: 2px solid #fff; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;\"></div> <img onclick=\"window.location='/canvas/$cmt_username';\" src=\"$cmt_pic\" class=\"list_picture\"></div></td>";
      echo "<td style=\"width: 100%; text-align: left;\"><span onclick=\"window.location='/canvas/$cmt_username';\" style=\"color: $username_color; font-weight: bold;\">$cmt_username $verif_check</span>";
      echo "<span class=\"tago\" style=\"font-size: 9px;\"> &bull; ";
      echo timeago($cmt_tstamp);
      echo " ago</span> &nbsp;";
      if($cmt_uid == $u_uid) {
        echo "<i onclick=\"dComment('$cmt_id');\" class=\"fa fa-trash\" aria-hidden=\"true\" style=\"font-size: 13px; color: $username_color\"></i>";
      }
      echo "<br><span style=\"font-size: 14px;\">"; echo bbc(atname(nl2br($string))); echo "</span>";
      echo "</td></tr></table>";
    }
}
?>
