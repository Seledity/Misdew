<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp' WHERE uid='$u_uid'");
echo "<center><span style=\"color: #333333; font-size: 12px; font-family: 'Dosis', sans-serif;\">Current rate per message: <b>+$chat_msg_per_rate</b> MDF - don't spam</span></center>";


$new = $tstamp - 60;
// if active, display them
$sc_onl = mysqli_query($conx, "SELECT username FROM accounts WHERE chat_time >= $new && chat_istyping='yes' ORDER BY username");
$l_cnt = mysqli_num_rows($sc_onl);
$onlci = mysqli_query($conx, "SELECT tstamp FROM chat ORDER BY id DESC LIMIT 1");
$cironl = mysqli_fetch_assoc($onlci);
$chatac = $cironl['tstamp'];
// selects user accounts
$slct_onl = mysqli_query($conx, "SELECT chat_istyping,uid,username,chat_time,chat_attack_hp,chat_shield_tstamp,md_verf FROM accounts ORDER BY username");
$separator = '';

while($slc_on = mysqli_fetch_array($slct_onl))
  {
$online_username = $slc_on['username'];
$online_uid = $slc_on['uid'];
$online_time = $slc_on['chat_time'];
$online_verf = $slc_on['md_verf'];
$online_typing = $slc_on['chat_istyping'];
$on_chat_attack_hp = $slc_on['chat_attack_hp'];
  $on_chat_shield_tstamp = $slc_on['chat_shield_tstamp'];
$usrif_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$online_uid' && theme_id='$g_themeid'");
while($usrif_r = mysqli_fetch_assoc($usrif_q)) {
  $cusername_color = $usrif_r['username_color'];
  $cchat_tcolor = $usrif_r['text_color'];
}
// math stuff for time ago function
$differ = time() - $online_time;
$mins = round($differ / 60);

if ($mins <= 1 && $online_typing == 'yes') {
  echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-weight: bold; font-size: 12px;\">$separator</span>";
  echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-weight: bold; font-size: 12px;\">$online_username</span>";
  if (!$separator) $separator = ', ';
}
}
if($l_cnt == 1) {
  echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-weight: bold; font-size: 12px;\"> is typing...</span>";
}
elseif($l_cnt >= 2) {
  echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-weight: bold; font-size: 12px;\"> are typing...</span>";
}
else {

}

$chat_q = mysqli_query($conx, "SELECT id,uid,tstamp,message,pmuid,msgtype,display_name,mtype,imgurl,telegram FROM chat ORDER BY id DESC LIMIT 35");
while($chat_r = mysqli_fetch_assoc($chat_q)) {
  $chat_id = $chat_r['id'];
  $chat_uid = $chat_r['uid'];
  $chat_tstamp = $chat_r['tstamp'];
  $string = $chat_r['message'];
  $pmuid = $chat_r['pmuid'];
  $msg_type = $chat_r['msgtype'];
  $displayname = $chat_r['display_name'];
  $mtype = $chat_r['mtype'];
  $c_imgurl = $chat_r['imgurl'];
  $sent_telegram = $chat_r['telegram'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$chat_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $chat_uid = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$chat_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $chat_uid = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  if($chat_uid != '286') {
  include("../inc/replace.php");
  $usr_q = mysqli_query($conx, "SELECT username,csplit,sticker,md_verf FROM accounts WHERE uid='$chat_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $chat_username = $usr_r['username'];
    $chat_sticker = $usr_r['sticker'];
    $chat_csplit = $usr_r['csplit'];
    $chat_md_verf = $usr_r['md_verf'];
    if($chat_md_verf == 'yes') {
      $verif_check = "<i style=\"\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> ";
    }
    else {
      $verif_check = "";
    }
    $usri_q = mysqli_query($conx, "SELECT * FROM user_theme_colors WHERE uid='$chat_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = "#4c4c4c";
      $chat_tcolor = "#4c4c4c";
      $csplit1_color = "#4c4c4c";
      $csplit2_color = "#4c4c4c";
      $csplit3_color = "#4c4c4c";
      $csplit1_name = $usri_r['csplit1_name'];
      $csplit2_name = $usri_r['csplit2_name'];
      $csplit3_name = $usri_r['csplit3_name'];
    }
  }
  // whisper data
  $usr_qq = mysqli_query($conx, "SELECT username,csplit,sticker,md_verf FROM accounts WHERE uid='$pmuid'");
  while($usr_rr = mysqli_fetch_assoc($usr_qq)) {
    $chat_usernamer = $usr_rr['username'];
    $chat_csplitt = $usr_rr['csplit'];
    $chat_stickerr = $usr_rr['sticker'];
    $chat_md_verffffff = $usr_rr['md_verf'];
    if($chat_md_verffffff == 'yes') {
      $verif_checkkkkk = "<i style=\"\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> ";
    }
    else {
      $verif_checkkkkk = "";
    }
    $usri_qq = mysqli_query($conx, "SELECT * FROM user_theme_colors WHERE uid='$pmuid' && theme_id='$g_themeid'");
    while($usri_rr = mysqli_fetch_assoc($usri_qq)) {
      $username_colorr = "#4c4c4c";
      $chat_tcolorr = "#4c4c4c";
      $csplit1_colorr = "#4c4c4c";
      $csplit2_colorr = "#4c4c4c";
      $csplit3_colorr = "#4c4c4c";
      $csplit1_namee = $usri_rr['csplit1_name'];
      $csplit2_namee = $usri_rr['csplit2_name'];
      $csplit3_namee = $usri_rr['csplit3_name'];
    }
  }
/*   vvv   IF THE CHAT MESSAGE TYPE IS A WHISPER    vvvv   */
  if($msg_type == 'pm') {
    if($chat_username == $u_username) {
      if($chat_csplitt == 'on') {
        if($chat_stickerr != '') {
          $whisper_stickerr = "<img src=\"$chat_stickerr\" alt=\"\" style=\"height: 16px;\">";
        }
        if($chat_sticker != '') {
          $whisper_sticker = "<img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\">";
        }
        $tochat_usernamer = "<i class=\"fa fa-arrow-right\"></i> <span style=\"color: $csplit1_colorr !important; font-weight: bold;\">$csplit1_namee</span><span style=\"color: $csplit2_colorr !important; font-weight: bold;\">$csplit2_namee</span><span style=\"color: $csplit3_colorr !important; font-weight: bold;\">$csplit3_namee</span> $verif_checkkkkk $whisper_stickerr";
      }
      else {
        $tochat_usernamer = "<i class=\"fa fa-arrow-right\"></i> <span style=\"font-weight: bold;\">$chat_usernamer</span> <img src=\"$chat_stickerr\" alt=\"\" style=\"height: 16px;\">$verif_checkkkkk";
      }
      if($chat_stickerr != '') {
        $whisper_stickerr = "<img src=\"$chat_stickerr\" alt=\"\" style=\"height: 16px;\">";
      }
      if($chat_sticker != '') {
        $whisper_sticker = "<img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\"> ";
      }
      if($displayname == 'no') {
        $chat_username = "";
        $tochat_usernamer = "";
        $csplit1_name = "";
        $csplit2_name = "";
        $csplit3_name = "";
        $whisper_sticker = "";
        $whisper_stickerr = "";
        $verif_checkkkkk = "";
        $verif_check = "";
      }
      echo "  <div style=\"display:block\">
              <table style=\"float: right; width: 100%; text-align: right;\"><tr><td onclick=\"csplBox();expandAnim('csplit_hidden');\" style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\">";
              if($chat_csplit == 'on') {
                echo "$whisper_sticker$verif_check<span style=\"color: $csplit1_color !important;\">$csplit1_name</span><span style=\"color: $csplit2_color !important;\">$csplit2_name</span><span style=\"color: $csplit3_color !important;\">$csplit3_name</span>";
              }
              else {
                echo "$whisper_sticker$verif_check$chat_username";
              }
              echo " <span style=\"color: $username_colorr; font-family: 'Dosis', sans-serif; font-weight: normal;\">$tochat_usernamer</span></td></tr></table>
              <div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; padding: 10px; padding-left: 25px; padding-right: 25px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>
              <table id=\"$chat_id\" style=\"display: none; float: right; width: 100%; text-align: right;\"><tr><td class=\"tago\">sent "; echo timeago($chat_tstamp); echo " ago"; if($sent_telegram == 'yes') { echo " via Telegram";} echo"</td></tr></table>
        </div>";
      }
      elseif($pmuid == $u_uid) {
        if($chat_csplit == 'on') {
          $chat_username_cspl = "<img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\"> <span style=\"color: $csplit1_color !important;\">$csplit1_name</span><span style=\"color: $csplit2_color !important;\">$csplit2_name</span><span style=\"color: $csplit3_color !important;\">$csplit3_name</span>";
        }
        else {
          $chat_username_cspl = "<img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\"> $chat_username";
        }
        $fromchatr_usernamer = "$chat_username_cspl $verif_check <i onclick=\"writePM('$chat_username');\" class=\"fa fa-reply\" aria-hidden=\"true\"></i>";
        if($displayname == 'no') {
          $chat_username = "";
          $fromchatr_usernamer = "";
        }
        echo "<div style=\"display:block\">
            <table style=\"float: left; width: 100%; text-align: left;\"><tr><td style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\">$fromchatr_usernamer</td></tr></table>
            <div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; padding: 10px; padding-left: 25px; padding-right: 25px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>
            <table id=\"$chat_id\" style=\"display: none; float: right; width: 100%; text-align: left;\"><tr><td class=\"tago\">sent "; echo timeago($chat_tstamp); echo " ago"; if($sent_telegram == 'yes') { echo " via Telegram";} echo"</td></tr></table>
      </div>";
    }
  }
/*   ^^^   IF THE CHAT MESSAGE TYPE IS A WHISPER   ^^^   */
/* #################################################### */
/*   vvv   IF THE CHAT MESSAGE IS NORMAL    vvvv   */
  else {
    if($chat_username == $u_username) {
      if($displayname == 'no') {
        $chat_username = "";
        $csplit1_name = "";
        $csplit2_name = "";
        $csplit3_name = "";
        $verif_check = "";
      }
      echo "<div style=\"display:block\"><table style=\"float: right; width: 100%; text-align: right;\"><tr><td onclick=\"csplBox();expandAnim('csplit_hidden');\" style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\">";
      if($chat_csplit == 'on') {
        echo $verif_check;
        echo "<span style=\"color: $csplit1_color !important;\">$csplit1_name</span><span style=\"color: $csplit2_color !important;\">$csplit2_name</span><span style=\"color: $csplit3_color !important;\">$csplit3_name</span>";
        if($chat_sticker != '' && $displayname != 'no') {
          echo " <img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\">";
        }
      }
      else {
        echo $verif_check;
        echo $chat_username;
        if($chat_sticker != '' && $displayname != 'no') {
          echo " <img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\">";
        }
      }
      echo "</td></tr></table>";
      // if message is an image
      if($mtype == 'img') {
        //
        // Data Saver
        if($u_datasaver == 'on') {
          echo "<div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">[view image]</div>";
        }
        else {
          echo "<div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\"><img src=\"$c_imgurl\" alt=\"\" width=\"100%\" style=\"display: block; height: auto;\"></div>";
        }
        // Data Saver
        //
      }
      // if message is normal
      else {
        echo "<div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word;  padding: 10px; padding-left: 25px; padding-right: 25px; border-radius: 20px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: right; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>";
      }
      echo "<table id=\"$chat_id\" style=\"display: none; float: right; width: 100%; text-align: right;\"><tr>";
      if($mtype == 'img') {
        echo "<td class=\"tago\"><a href=\"$c_imgurl\" class=\"link_view\" target=\"_blank\">view image</a> <br>";
        echo "sent "; echo timeago($chat_tstamp); echo " ago"; if($sent_telegram == 'yes') { echo " via Telegram";} echo"</td></tr></table></div>";
      }
      else {
        echo "<td class=\"tago\">sent "; echo timeago($chat_tstamp); echo " ago"; if($sent_telegram == 'yes') { echo " via Telegram";} echo"</td></tr></table></div>";
      }
    }
    else {
      if($displayname == 'no') {
        $chat_username = "";
        $csplit1_name = "";
        $csplit2_name = "";
        $csplit3_name = "";
        $verif_check = "";
      }
      echo "<div style=\"display:block\"><table style=\"float: left; width: 100%; text-align: left;\"><tr><td style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\"><span onclick=\"writePM('$chat_username');\">";
      if($chat_csplit == 'on') {
        if($chat_sticker != '' && $displayname != 'no') {
          echo "<img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\"> ";
        }
        echo "<span style=\"color: $csplit1_color !important;\">$csplit1_name</span><span style=\"color: $csplit2_color !important;\">$csplit2_name</span><span style=\"color: $csplit3_color !important;\">$csplit3_name</span>";
      }
      else {
        if($chat_sticker != '' && $displayname != 'no') {
          echo "<img src=\"$chat_sticker\" alt=\"\" style=\"height: 16px;\"> ";
        }
        echo $chat_username;
      }
      echo " " . $verif_check;
      echo "</span></td></tr></table>";
      // if message is an image
      if($mtype == 'img') {
        //
        // Data Saver
        if($u_datasaver == 'on') {
          echo "<div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">[view image]</div>";
        }
        else {
          echo "<div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\"><img src=\"$c_imgurl\" alt=\"\" width=\"100%\" style=\"display: block; height: auto;\"></div>";
        }
        // Data Saver
        //
      }
      // if message is normal
      else {
        echo "<div onclick=\"expand('$chat_id')\" style=\"border: 1px solid #4c4c4c; word-wrap: break-word; background-color: #000; box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); word-wrap: break-word; padding: 10px; padding-left: 25px; padding-right: 25px; border-radius: 20px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>";
      }
      echo "<table id=\"$chat_id\" style=\"display: none; float: right; width: 100%; text-align: left;\"><tr>";
      if($mtype == 'img') {
        echo "<td class=\"tago\"><a href=\"$c_imgurl\" class=\"link_view\" target=\"_blank\">view image</a> <br>";
        echo "sent "; echo timeago($chat_tstamp); echo " ago"; if($sent_telegram == 'yes') { echo " via Telegram";} echo"</td></tr></table></div>";
      }
      else {
        echo "<td class=\"tago\">sent "; echo timeago($chat_tstamp); echo " ago"; if($sent_telegram == 'yes') { echo " via Telegram";} echo"</td></tr></table></div>";
      }
    }
  }
/*   ^^^   IF THE CHAT MESSAGE TYPE IS NORMAL   ^^^   */
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
function expandAnim(id) {
  var e = document.getElementById(id);
  if(e.style.display == '') {
    $("#csplit_hidden").slideUp(500);
  }
  else {
    $("#csplit_hidden").slideDown(500);
    e.style.display = '';
  }
}
</script>
