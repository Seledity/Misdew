<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp' WHERE uid='$u_uid'");
echo "<center><span style=\"color: #808080; font-size: 12px; font-family: 'Dosis', sans-serif;\">Current rate per message: +$chat_msg_per_rate MDF - don't spam</span></center>";
$chat_q = mysqli_query($conx, "SELECT id,uid,tstamp,message,pmuid,msgtype,display_name,mtype,imgurl FROM chat ORDER BY id DESC LIMIT 30");
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
  $usr_q = mysqli_query($conx, "SELECT username,csplit,sticker FROM accounts WHERE uid='$chat_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $chat_username = $usr_r['username'];
    $chat_sticker = $usr_r['sticker'];
    $chat_csplit = $usr_r['csplit'];
    $usri_q = mysqli_query($conx, "SELECT * FROM user_theme_colors WHERE uid='$chat_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = $usri_r['username_color'];
      $chat_tcolor = $usri_r['text_color'];
      $csplit1_color = $usri_r['csplit1_color'];
      $csplit2_color = $usri_r['csplit2_color'];
      $csplit3_color = $usri_r['csplit3_color'];
      $csplit1_name = $usri_r['csplit1_name'];
      $csplit2_name = $usri_r['csplit2_name'];
      $csplit3_name = $usri_r['csplit3_name'];
    }
  }
  // whisper data
  $usr_qq = mysqli_query($conx, "SELECT username,csplit,sticker FROM accounts WHERE uid='$pmuid'");
  while($usr_rr = mysqli_fetch_assoc($usr_qq)) {
    $chat_usernamer = $usr_rr['username'];
    $chat_csplitt = $usr_rr['csplit'];
    $chat_stickerr = $usr_rr['sticker'];
    $usri_qq = mysqli_query($conx, "SELECT * FROM user_theme_colors WHERE uid='$pmuid' && theme_id='$g_themeid'");
    while($usri_rr = mysqli_fetch_assoc($usri_qq)) {
      $username_colorr = $usri_rr['username_color'];
      $chat_tcolorr = $usri_rr['text_color'];
      $csplit1_colorr = $usri_rr['csplit1_color'];
      $csplit2_colorr = $usri_rr['csplit2_color'];
      $csplit3_colorr = $usri_rr['csplit3_color'];
      $csplit1_namee = $usri_rr['csplit1_name'];
      $csplit2_namee = $usri_rr['csplit2_name'];
      $csplit3_namee = $usri_rr['csplit3_name'];
    }
  }
/*   vvv   IF THE CHAT MESSAGE TYPE IS A WHISPER    vvvv   */
  if($msg_type == 'pm') {

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
        echo $chat_username;
      }
    }
    else {
      if($displayname == 'no') {
        $chat_username = "";
        $csplit1_name = "";
        $csplit2_name = "";
        $csplit3_name = "";
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
</script>
