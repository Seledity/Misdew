<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
    $shout_q = mysqli_query($conx, "SELECT * FROM shouts ORDER BY id DESC LIMIT 1");
    while($shout_r = mysqli_fetch_assoc($shout_q)) {
      $shout_id = $shout_r['id'];
      $shout_uid = $shout_r['uid'];
      $shout_text = $shout_r['texts'];
      $shout_timeleft = $shout_r['time_left'];
      $shout_cost = $shout_r['mdf_cost'];
      $shout_tstamp = $shout_r['tstamp'];
      function release_time($session_time) {
      	$time_difference = $session_time - time();
        $seconds = $time_difference;
        $minutes = round($time_difference/60);
        $hours = round($time_difference/3600);
        $days = round($time_difference/86400);
        $weeks = round($time_difference/604800);
        $months = round($time_difference/2419200);
        $years = round($time_difference/29030400);
        $s_ago = "s"; $m_ago = "m"; $h_ago = "h"; $w_ago = "w"; $d_ago = "d";
        if($seconds <= 59) { echo "$seconds$s_ago"; }
        else if($minutes <= 59) {
          if($minutes == 1) { echo "1$m_ago"; }
          else { echo "$minutes$m_ago"; }
        }
        else if($hours <= 23) {
          if($hours == 1) { echo "1$h_ago"; }
          else { echo "$hours$h_ago"; }
        }
        else if($days <= 6) {
          if($days == 1) { echo "1$d_ago"; }
          else { echo "$days$d_ago"; }
        }
        else if($weeks > 0) {
          if($weeks == 1) { echo "1$w_ago"; }
          else { echo "$weeks$w_ago"; }
        }
      }
      if($shout_timeleft >= $tstamp) {
        $shout_yn = "yes";
      }
      else {
        $shout_yn = "no";
      }
      $shouuut_q = mysqli_query($conx, "SELECT username,md_verf FROM accounts WHERE uid='$shout_uid'");
      while($shouuut_r = mysqli_fetch_assoc($shouuut_q)) {
        $shout_username = $shouuut_r['username'];
        $shout_verf = $shouuut_r['md_verf'];
        if($shout_verf == 'yes') {
          $verif_check = "<i style=\"\" style=\"color: #4c4c4c;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
        }
        else {
          $verif_check = "";
        }
      }
      $usrrrrri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$shout_uid' && theme_id='$g_themeid'");
      while($usrrrri_r = mysqli_fetch_assoc($usrrrrri_q)) {
        $shoutusername_color = $usrrrri_r['username_color'];
        $shoutchat_tcolor = $usrrrri_r['text_color'];
      }
      $string = $shout_text;
      include("../inc/replace.php");
if($shout_yn == "no") {
      echo "
    <div onclick=\"writePost();fpostb.focus();\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);width: 60%; max-width: 300px; background-color: #4DA64D; font-family: 'Dosis', sans-serif; padding: 8px; border-radius: 8em; color: #fff;\">
      <table style=\"font-weight: bold; text-align: center;\">
        <tr>
          <td>
            There aren't any shouts right now.
          </td>
        </tr>
        <tr>
          <td>
            Tap to send a shout.
          </td>
        </tr>
      </table>
    </div>
    <br>";
  }
  else {
    $did_you_like = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$shout_id' && likedis='like' && uid='$u_uid'"));
    if($did_you_like >= '1') {
      $like_css = "border: 1px solid $shoutusername_color; background-color: $shoutchat_tcolor;";
      $like_font = "color: $shoutusername_color;";
    }
    else {
      $like_css = "border: 1px solid $shoutchat_tcolor; background-color: $shoutusername_color;";
      $like_font = "color: $shoutchat_tcolor;";
    }
    $did_you_dislike = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$shout_id' && likedis='dislike' && uid='$u_uid'"));
    if($did_you_dislike >= '1') {
      $dislike_css = "border: 1px solid $shoutusername_color; background-color: $shoutchat_tcolor;";
      $dislike_font = "color: $shoutusername_color;";
    }
    else {
      $dislike_css = "border: 1px solid $shoutchat_tcolor; background-color: $shoutusername_color;";
      $dislike_font = "color: $shoutchat_tcolor;";
    }
    echo "
    <div class=\"shout_div_contain\">
    <div onclick=\"shoutLikeDis('$shout_id','like');\" class=\"shout_like\" style=\"$like_css\"><i class=\"fa fa-thumbs-up\" style=\"$like_font\"></i></div>
    <div onclick=\"shoutLikeDis('$shout_id','dislike');\" class=\"shout_dislike\" style=\"$dislike_css\"><i class=\"fa fa-thumbs-down\" style=\"$dislike_font\"></i></div>
  <div style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: $shoutusername_color; font-family: 'Dosis', sans-serif; padding: 8px; border-radius: 1em; color: $shoutchat_tcolor;\">
    <table style=\"text-align: center;\">
      <tr>
        <td>
          <i class=\"fa fa-bullhorn\"></i> <i class=\"fa fa-bullhorn\"></i> <span style=\"font-size: 12px;\">"; echo release_time($shout_timeleft); echo " left</span>";  echo" <i class=\"fa fa-bullhorn\"></i> <i class=\"fa fa-bullhorn\"></i>
          <br>
        </td>
      </tr>
      <tr>
        <td>
          <span style=\"font-size: 18px; font-weight: bold;\">$string</span> <br>  <span style=\"font-size: 12px;\"><b>$verif_check $shout_username</b></span> <span style=\"font-size: 11px;\">
        </td>
      </tr>
    </table>
  </div></div>
  <div id=\"shout_likedis\" style=\"padding-top: 8px; font-family: 'Dosis', sans-serif; color: #808080; font-size: 12px;\">";
  $like_cnt = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$shout_id' && likedis='like'"));
  $dislike_cnt = mysqli_num_rows($slcq = mysqli_query($conx, "SELECT id FROM shout_likedis WHERE shout_id='$shout_id' && likedis='dislike'"));
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
  echo "</div>
  <br>";
  }

}
    ?>
