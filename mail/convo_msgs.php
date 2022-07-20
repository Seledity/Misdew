<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  die("<center><span class=\"no_mail\"><br>You do not belong to this conversation.<br><br></span></center>");
  exit();
}
mysqli_query($conx, "UPDATE mail_memb SET latest_read='yes' WHERE uqid='$cv_uqid' && uid='$u_uid'");
mysqli_query($conx, "UPDATE mail_memb SET sent='no' WHERE uqid='$cv_uqid' && uid='$u_uid'");
$chat_q = mysqli_query($conx, "SELECT id,uid_from,message,timestamp,display_name,mtype,imgurl FROM mail WHERE uqid='$cv_uqid' ORDER BY id DESC LIMIT 75");
while($chat_r = mysqli_fetch_assoc($chat_q)) {
  $chat_id = $chat_r['id'];
  $chat_uid = $chat_r['uid_from'];
  $string = $chat_r['message'];
  $chat_tstamp = $chat_r['timestamp'];
  $msg_type = $chat_r['msgtype'];
  $displayname = $chat_r['display_name'];
  $mtype = $chat_r['mtype'];
  $c_imgurl = $chat_r['imgurl'];
  include("../inc/replace.php");
  $usr_q = mysqli_query($conx, "SELECT username,md_verf FROM accounts WHERE uid='$chat_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $chat_username = $usr_r['username'];
    $chat_verif = $usr_r['md_verf'];
    if($chat_verif == 'yes') {
      $verif_check = " <i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$chat_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = $usri_r['username_color'];
      $chat_tcolor = $usri_r['text_color'];
    }
  }
  if($chat_username == $u_username) {
    if($displayname == 'no') {
      $chat_username = "";
      $verif_check = "";
    }
    echo "<div style=\"display:block\"><table style=\"float: right; width: 100%; text-align: right;\"><tr><td style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\">$chat_username$verif_check</td></tr></table>";
    // if message is an image
    if($mtype == 'img') {
      //
      // Data Saver
      if($u_datasaver == 'on') {
        echo "<div onclick=\"expand('$chat_id')\" style=\"word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">[view image]</div>";
      }
      else {
        echo "<div onclick=\"expand('$chat_id')\" style=\"word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\"><img src=\"$c_imgurl\" alt=\"\" width=\"100%\" style=\"display: block; height: auto;\"></div>";
      }
      // Data Saver
      //
    }
    // if message is normal
    else {
      echo "<div onclick=\"expand('$chat_id')\" style=\"word-wrap: break-word; background-color: $username_color; padding: 10px; padding-left: 25px; padding-right: 25px; border-radius: 20px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>";
    }
    echo "<table id=\"$chat_id\" style=\"display: none; float: right; width: 100%; text-align: right;\"><tr>";
    if($mtype == 'img') {
      echo "<td class=\"tago\"><a href=\"$c_imgurl\" class=\"link_view\" target=\"_blank\">view image</a> <br>";
      echo "sent "; echo timeago($chat_tstamp); echo " ago</td></tr></table></div>";
    }
    else {
      echo "<td class=\"tago\">sent "; echo timeago($chat_tstamp); echo " ago</td></tr></table></div>";
    }
  }
  else {
    if($displayname == 'no') {
      $chat_username = "";
      $verif_check = "";
    }
    echo "<div style=\"display:block\"><table style=\"float: left; width: 100%; text-align: left;\"><tr><td style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\">$chat_username$verif_check</td></tr></table>";
    // if message is an image
    if($mtype == 'img') {
      //
      // Data Saver
      if($u_datasaver == 'on') {
        echo "<div onclick=\"expand('$chat_id')\" style=\"word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">[view image]</div>";
      }
      else {
        echo "<div onclick=\"expand('$chat_id')\" style=\"word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\"><img src=\"$c_imgurl\" alt=\"\" width=\"100%\" style=\"display: block; height: auto;\"></div>";
      }
      // Data Saver
      //
    }
    // if message is normal
    else {
      echo "<div onclick=\"expand('$chat_id')\" style=\"word-wrap: break-word; background-color: $username_color; padding: 10px; padding-left: 25px; padding-right: 25px; border-radius: 20px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>";
    }
    echo "<table id=\"$chat_id\" style=\"display: none; float: right; width: 100%; text-align: left;\"><tr>";
    if($mtype == 'img') {
      echo "<td class=\"tago\"><a href=\"$c_imgurl\" class=\"link_view\" target=\"_blank\">view image</a> <br>";
      echo "sent "; echo timeago($chat_tstamp); echo " ago</td></tr></table></div>";
    }
    else {
      echo "<td class=\"tago\">sent "; echo timeago($chat_tstamp); echo " ago</td></tr></table></div>";
    }
  }
}
?>
<script>
function expand(id) {
  var e = document.getElementById(id);
  if(e.style.display == '')
  e.style.display = 'none';
  else
  e.style.display = '';
}
</script>
