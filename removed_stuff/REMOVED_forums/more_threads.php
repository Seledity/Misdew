<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$amount = safe($_GET['amntcnt']);
$default_spindle_uqid = safe($_GET['u']);

  $threads_q = mysqli_query($conx, "SELECT * FROM forum_threads WHERE spindle_uqid='$default_spindle_uqid' && draft='no' ORDER BY id DESC LIMIT $amount,10");
  while($threads_r = mysqli_fetch_assoc($threads_q)) {
    $thread_id = $threads_r['id'];
    $thread_uid = $threads_r['uid'];
    /* GET USER INFO */
    $usr_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$thread_uid'");
    while($usr_r = mysqli_fetch_assoc($usr_q)) {
      $thread_username = $usr_r['username'];
    }
    $usri_qq = mysqli_query($conx, "SELECT * FROM user_theme_colors WHERE uid='$thread_uid' && theme_id='$g_themeid'");
    while($usri_rr = mysqli_fetch_assoc($usri_qq)) {
      $thread_color = $usri_rr['username_color'];
      $thread_tcolor = $usri_rr['text_color'];
    }
    $thread_name = $threads_r['name'];
    $thread_content = $threads_r['content'];
    $spindle_desc = $threads_r['description'];
    $sspindle_tstamp = $threads_r['tstamp'];
    $sspindle_actstamp = time() - $sspindle_tstamp;
    $sminutes = round($sspindle_actstamp / 60);
    if($sminutes <= 60) {
      $sspindle_actdot = "#00FF00";
    }
    elseif($sminutes <= 90) {
      $sspindle_actdot = "#FFA500";
    }
    elseif($sminutes < 120) {
      $sspindle_actdot = "#FF0000";
    }
    else {
      $sspindle_actdot = "#FF0000";
    }
    /* GET A COUNT OF HOW MANY REPLIES THE THREAD HAS */
    $thread_reply_cont = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM forum_replies WHERE thread_id='$thread_id' ORDER BY id"));
    $thread_reply_cont = number_format($thread_reply_cont);
    /* REPLY COUNT GRAMMAR */
    if($thread_reply_cont != '1') {
      $thread_reply_grammar = "replies";
    }
    else {
      $thread_reply_grammar = "reply";
    }
    /* GET A COUNT OF HOW MANY VIEWS THE THREAD HAS */
    $thread_view_cont = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM forum_views WHERE thread_id='$thread_id' ORDER BY id"));
    $thread_view_cont = number_format($thread_view_cont);
    /* VIEW COUNT GRAMMAR */
    if($thread_view_cont != '1') {
      $thread_view_grammar = "views";
    }
    else {
      $thread_view_grammar = "view";
    }
  echo "<div class=\"threads_cont\">
    <table class=\"spindle_info_cont\">
      <tr>
        <td class=\"thread_info\">
          <span class=\"thread_name\" style=\"color: $thread_color;\" onclick=\"toThread('$thread_id','$thread_name');\">
            <i class=\"fa fa-external-link-square\" aria-hidden=\"true\"></i> <span id=\"thd_$thread_id\">$thread_name</span>
          </span> <br>
          <span style=\"color: $thread_color; font-size: 11px;\">thread has <span style=\"font-weight: bold;\">$thread_reply_cont</span> $thread_reply_grammar and <span style=\"font-weight: bold;\">$thread_view_cont</span> $thread_view_grammar<br>
          <span style=\"color: $thread_color; font-size: 11px;\">created by <span style=\"font-weight: bold;\">$thread_username</span>; ";
          echo "<span class=\"tago\" style=\"font-size: 10px;\">";
          echo timeago($sspindle_tstamp);
          echo " ago</span>";
          /* forum latest reply */
          /* replier UID */
          $latest_q = mysqli_query($conx, "SELECT uid,tstamp FROM forum_replies WHERE thread_id='$thread_id' ORDER BY id DESC LIMIT 1");
          while($latest_r = mysqli_fetch_assoc($latest_q)) {
            $replier_uid = $latest_r['uid'];
            $reply_tstamp = $latest_r['tstamp'];

          /* replier username */
          $latest_qu = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$replier_uid'");
          while($latest_ru = mysqli_fetch_assoc($latest_qu)) {
            $replier_username = $latest_ru['username'];
          }
            /* replier colors */
          $tusri_qq = mysqli_query($conx, "SELECT * FROM user_theme_colors WHERE uid='$replier_uid' && theme_id='$g_themeid'");
          while($tusri_rr = mysqli_fetch_assoc($tusri_qq)) {
            $replier_color = $tusri_rr['username_color'];
            $replier_tcolor = $tusri_rr['text_color'];
          }
          echo "<br>
          <span style=\"color: $replier_color; font-size: 11px;\">latest post by <span style=\"font-weight: bold;\">$replier_username</span>; ";
          echo "<span class=\"tago\" style=\"font-size: 10px;\">";
          echo timeago($reply_tstamp);
          echo " ago</span>";
        }
          echo "<br>
        </td>
        <td class=\"thread_actcont\">
         <i onclick=\"expand('thrd_$thread_id')\" class=\"fa fa-scissors\" aria-hidden=\"true\" id=\"thrd_snippet\"></i>
          <i class=\"fa fa-circle\" aria-hidden=\"true\" style=\"font-size: 8px; color: $sspindle_actdot;\"></i>
        </td>
      </tr>
    </table></div>
    <div id=\"thrd_$thread_id\" class=\"threads_cont\" style=\"display: none;\">
      <table class=\"spindle_info_cont\">
        <tr>
          <td class=\"thread_info\">";
          echo nl2br($thread_content);
          echo "</td>
        </tr>
      </table></div>";
}
?>
