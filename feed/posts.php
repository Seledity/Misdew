<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}

function polltime($session_time) {
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

# SELECT TEN POSTS FROM FEED
$feed_q = mysqli_query($conx, "SELECT id,is_poll,uid,post,tstamp,random_str,visibility,edited,img,allow_comments FROM feed ORDER BY id DESC LIMIT 10");
while($feed_r = mysqli_fetch_assoc($feed_q)) {
  // Feed data
  $feed_id = $feed_r['id'];
  $feed_uid = $feed_r['uid'];
  $string = $feed_r['post'];
  $feed_tstamp = $feed_r['tstamp'];
  $feed_randomstr = $feed_r['random_str'];
  $feed_visibility = $feed_r['visibility'];
  $feed_edited = $feed_r['edited'];
  $feed_img = $feed_r['img'];
  $feed_allowcomments = $feed_r['allow_comments'];
  $feed_is_poll = $feed_r['is_poll'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$feed_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $feed_uid = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$feed_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $feed_uid = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  // Emoji+ replacement
  include("../inc/replace.php");
  # SELECT ACCOUNT DATA FOR FEED POSTS
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$feed_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    // Account data
    $feed_username = $usr_r['username'];
    $feed_picture = $usr_r['picture'];
    $feed_onltime = $usr_r['online_time'];
    $feed_vrf = $usr_r['md_verf'];
    if($feed_vrf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $feed_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC";
    }
    // DATA SAVER
    //
    // Activity Dot
    $new_time = time() - $feed_onltime;
    $mens = round($new_time / 60);
    if($mens <= 1) { $cv_activeness = "#00FF00"; } // Active within one minute
    elseif($mens <= 2) { $cv_activeness = "#FFA500"; } // Active within two minutes
    elseif($mens < 5) { $cv_activeness = "#FF0000"; } // Active within five minutes
    else { $cv_activeness = "#FF0000"; } // Active over five minutes
    # SELECT THEME COLORS FOR ACCOUNTS
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$feed_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      // Theme data
      $username_color = $usri_r['username_color'];
      $feed_tcolor = $usri_r['text_color'];
    }
    // Styling for the comment placeholders of each account attached to a post.
    echo "<style type=\"text/css\">";
    echo ".comment_$feed_username";
    echo "[placeholder]:empty:before {";
    echo "content: attr(placeholder);";
    echo "color: $feed_tcolor; }</style>";
  }
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
  # BEGIN ECHOING THE FEED POSTS
  if($feed_uid != '286') {
    echo "<div class=\"feed_post\" id=\"fp_1\" style=\"background-color: $username_color;\">";
    echo "<table class=\"post_table1\"><tr>";
    echo "<td class=\"ptb1_td1\" style=\"color: $feed_tcolor; width: 0%;\">";
    echo "<div style=\"position: relative; width: 36px; height: 36px; border-radius: 50px;\">";
    echo "<div style=\"background-color: $cv_activeness; border: 2px solid $username_color; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;\"></div>";
    echo "<img onclick=\"window.location='/canvas/$feed_username';\" src=\"$feed_picture\" class=\"list_picture\"></div></td>";
    echo "<td class=\"ptb1_td1\" style=\"text-align: left; color: $feed_tcolor;\">";
    echo "<a href=\"/canvas/$feed_username\" style=\"text-decoration: none; color: $feed_tcolor; font-weight: bold;\">$feed_username $verif_check</a></td>";
    echo "<td class=\"ptb1_td2\" style=\"color: $feed_tcolor;\">";
    echo "<i class=\"fa fa-angle-down\" aria-hidden=\"true\" onclick=\"expand('$feed_randomstr')\"></i></td></tr></table></div>";
    echo "<div id=\"$feed_randomstr\" class=\"post_more\" style=\"display: none;\">";
    // State whether or not a post has been edited.
    if($feed_edited == 'yes') {
      echo "edited ";
    }
    else {
      echo "posted ";
    }
    // State the timestamp of the post.
    echo timeago($feed_tstamp); echo" ago";
    // If the feed UID matches the current UID.
    if($feed_uid == $u_uid) {
      // Option to edit the post.
      echo "&nbsp; <i onclick=\"window.location='edit.php?i=$feed_randomstr';\" class=\"fa fa-pencil\" aria-hidden=\"true\"></i> &nbsp; ";
      // Option to remove the post.
      echo "<i class=\"fa fa-trash\" aria-hidden=\"true\" id=\"pdel_$feed_id\"></i>";
    }
    // If the feed UID does not match the current UID, but the current account is a content manager.
    ########## YOU WILL NEED TO MODIFY THIS CODE TO MATCH CANVAS STANDARDS FOR ROLES ##########
    if($feed_uid != $u_uid && $u_cont_mang == 'yes') {
      echo "&nbsp; &nbsp; <i class=\"fa fa-trash\" aria-hidden=\"true\" id=\"pdel_$feed_id\"></i>";
    }
    echo "&nbsp; <i onclick=\"window.location='post.php?i=$feed_randomstr';\" class=\"fa fa-expand\" aria-hidden=\"true\"></i>";
    ########## YOU WILL NEED TO MODIFY THIS CODE TO MATCH CANVAS STANDARDS FOR ROLES ##########
    echo "</div><div class=\"feed_post\" id=\"fp_2\">";
    echo "<div class=\"fp_3\">";
    // Echo the post content.
    echo bbc(atname(nl2br($string)));
    if($feed_is_poll == 'yes') {
      echo "<div id=\"innerpoll_$feed_randomstr\">";





      // Added Feed polls. 2021
      // Added Feed polls. 2021
      // Added Feed polls. 2021
      // Added Feed polls. 2021

        # SELECT POLL DATA FOR THE POST
        $fpoll_q = mysqli_query($conx, "SELECT * FROM feed_polls WHERE uqid='$feed_randomstr'");
        while($fpoll_r = mysqli_fetch_assoc($fpoll_q)) {
          // poll data
          $fpoll_question = $fpoll_r['poll_question'];
          $fpoll_opt1 = $fpoll_r['poll_opt1'];
          $fpoll_opt2 = $fpoll_r['poll_opt2'];
          $fpoll_opt3 = $fpoll_r['poll_opt3'];
          $fpoll_opt4 = $fpoll_r['poll_opt4'];
          $fpoll_opt5 = $fpoll_r['poll_opt5'];
          $fpoll_istimed = $fpoll_r['is_timed'];
          $fpoll_tstmpend = $fpoll_r['tstamp_end'];
          if(strlen($fpoll_opt1) >= 30) {
            $fpoll_optc1 = trim(substr($fpoll_opt1,0,30)) . "...";
          }
          else {
            $fpoll_optc1 = $fpoll_opt1;
          }
          if(strlen($fpoll_opt2) >= 30) {
            $fpoll_optc2 = trim(substr($fpoll_opt2,0,30)) . "...";
          }
          else {
            $fpoll_optc2 = $fpoll_opt2;
          }
          if(strlen($fpoll_opt3) >= 30) {
            $fpoll_optc3 = trim(substr($fpoll_opt3,0,30)) . "...";
          }
          else {
            $fpoll_optc3 = $fpoll_opt3;
          }
          if(strlen($fpoll_opt4) >= 30) {
            $fpoll_optc4 = trim(substr($fpoll_opt4,0,30)) . "...";
          }
          else {
            $fpoll_optc4 = $fpoll_opt4;
          }
          if(strlen($fpoll_opt5) >= 30) {
            $fpoll_optc5 = trim(substr($fpoll_opt5,0,30)) . "...";
          }
          else {
            $fpoll_optc5 = $fpoll_opt5;
          }
        }
        # SELECT RESPONSE DATA FOR THE POLL
        $fpoll_response_q = mysqli_query($conx, "SELECT * FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && uid='$u_uid'");
        while($fpoll_response_r = mysqli_fetch_assoc($fpoll_response_q)) {
          // poll response data
          $fpoll_option_picked = $fpoll_response_r['option_picked'];
        }
        echo "<br>";

        if($fpoll_option_picked != '') {
          $current_can_vote = "no";
        }
        else {
          $current_can_vote = "yes";
        }

        // total vote count
        $rest_c = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr'");
        $optt_cnt = mysqli_num_rows($rest_c);

        // count number of votes for each option
        $res_c1 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='1'");
        $opt1_cnt = mysqli_num_rows($res_c1);
        if($opt1_cnt != '1') {
          $count1_s = "s";
        }
        $res_c2 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='2'");
        $opt2_cnt = mysqli_num_rows($res_c2);
        if($opt2_cnt != '1') {
          $count2_s = "s";
        }
        $res_c3 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='3'");
        $opt3_cnt = mysqli_num_rows($res_c3);
        if($opt3_cnt != '1') {
          $count3_s = "s";
        }
        $res_c4 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='4'");
        $opt4_cnt = mysqli_num_rows($res_c4);
        if($opt4_cnt != '1') {
          $count4_s = "s";
        }
        $res_c5 = mysqli_query($conx, "SELECT uid FROM feed_poll_response WHERE poll_uqid='$feed_randomstr' && option_picked='5'");
        $opt5_cnt = mysqli_num_rows($res_c5);
        if($opt5_cnt != '1') {
          $count5_s = "s";
        }
        if($fpoll_option_picked == '1') {
          $current_picked1 = "background-color: $username_color !important; color: $feed_tcolor !important";
        }
        if($fpoll_option_picked == '2') {
          $current_picked2 = "background-color: $username_color !important; color: $feed_tcolor !important";
        }
        if($fpoll_option_picked == '3') {
          $current_picked3 = "background-color: $username_color !important; color: $feed_tcolor !important";
        }
        if($fpoll_option_picked == '4') {
          $current_picked4 = "background-color: $username_color !important; color: $feed_tcolor !important";
        }
        if($fpoll_option_picked == '5') {
          $current_picked5 = "background-color: $username_color !important; color: $feed_tcolor !important";
        }

        echo "<span style=\"font-size: 12px; color: #808080;\">A poll has been attached to this post. <br> </span>";
        if($fpoll_istimed == 'yes') {
          echo "<span style=\"font-size: 12px; color: #808080;\">There is a time limit- it will stop accepting responses in ";
          echo polltime($fpoll_tstmpend);
          echo ".</span>";
        }
        else {
          echo "<span style=\"font-size: 12px; color: #808080;\">There is no time limit set- responses are always accepted.</span>";
        }
        echo "<br><br><table style=\"width: 100%;\"><tr>";
        echo "<td>";
        echo "<span style=\"color: $username_color; font-weight: bold;\">$feed_username $verif_check</span><br>";
        echo "</td>";
        echo "</tr></table>";
        echo "<div style=\"border-radius: 8em; background-color: $username_color; padding: 8px; display: inline-block;\">";
        echo "<table style=\"width: 100%;\"><tr>";
        echo "<td style=\"font-weight: bold; color: $feed_tcolor; padding-left: 12px; padding-right: 12px;\">";
        echo "$fpoll_question";
        echo "</td>";
        echo "</tr></table>";
        echo "</div> <br><br>";
        echo "<span style=\"font-size: 12px; color: #808080;\">Select your response by tapping one of the options below.</span><br>";
        if($current_can_vote == 'no') {
          echo "<span style=\"font-size: 12px; color: #808080;\">You can change your response by tapping a new option.</span><br>";
        }

        echo "<br><table style=\"text-align: center; font-weight: bold; width: 100%;\"><tr>";
        echo "<td onclick=\"pollVote('1','$feed_randomstr');\" style=\"$current_picked1;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
        echo "$fpoll_opt1";
        echo "</td>";
        echo "<td onclick=\"pollVote('2','$feed_randomstr');\" style=\"$current_picked2;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
        echo "$fpoll_opt2";
        echo "</td>";
        if($fpoll_opt3 != '') {
          echo "<td onclick=\"pollVote('3','$feed_randomstr');\" style=\"$current_picked3;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
          echo "$fpoll_opt3";
          echo "</td>";
        }
        if($fpoll_opt4 != '') {
          echo "<td onclick=\"pollVote('4','$feed_randomstr');\" style=\"$current_picked4;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
          echo "$fpoll_opt4";
          echo "</td>";
        }
        if($fpoll_opt5 != '') {
          echo "<td onclick=\"pollVote('5','$feed_randomstr');\" style=\"$current_picked5;border-radius: 12px; padding: 4px; border: 3px solid $username_color; color: $username_color;\">";
          echo "$fpoll_opt5";
          echo "</td>";
        }
        echo "</tr></table>";


        echo "<div id=\"presults_$feed_randomstr\">";
        echo "<br>";
        echo "<span style=\"color: #808080; font-size: 14px;\">$opt1_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc1\"</span><br>";
        echo "<span style=\"color: #808080; font-size: 14px;\">$opt2_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc2\"</span><br>";
        if($fpoll_opt3 != '') {
          echo "<span style=\"color: #808080; font-size: 14px;\">$opt3_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc3\"</span><br>";
        }
        if($fpoll_opt4 != '') {
          echo "<span style=\"color: #808080; font-size: 14px;\">$opt4_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc4\"</span><br>";
        }
        if($fpoll_opt5 != '') {
          echo "<span style=\"color: #808080; font-size: 14px;\">$opt5_cnt voted </span> <span style=\"color: #808080; font-size: 14px; font-weight: bold;\">\"$fpoll_optc5\"</span><br>";
        }
        echo "<br><span style=\"color: #808080; font-size: 14px; font-weight: bold;\">Total Votes Received:</span> <span style=\"color: #808080; font-size: 14px;\">$optt_cnt</span><br>";
        echo "</div>";



      // Added Feed polls. 2021
      // Added Feed polls. 2021
      // Added Feed polls. 2021
      // Added Feed polls. 2021





      echo "</div>";
    }

    echo "</div><table class=\"post_table2\"><tr>";
    echo "<td class=\"ptb2_td1\">";
    // Like count within the post.
    echo "<span id=\"likecnt_$feed_id\">";
    echo "$likcnt_r like$ls";
    echo "</span> &nbsp;&nbsp; ";
    // Dislike count within the post.
    echo "<span id=\"dlikecnt_$feed_id\">";
    echo "$dlikcnt_r dislike$dls";
    echo "</span></td><td id=\"ccmt_cnt\" class=\"ptb2_td2\">";
    // Comment count within the post.
    echo "<span id=\"mpcomment_count\">";
    echo "$comcnt_r comment$cs";
    echo "</span></td></tr></table>";
    echo "<center><table class=\"post_table3\"><tr>";
    echo "<td id=\"post_id_$feed_id\" class=\"ptb3_td1\">";
    # Determine whether or not the current account has liked the post.
    $gett = mysqli_query($conx, "SELECT id FROM feed_likes WHERE post_id='$feed_id' && uid='$u_uid'");
    $isit = number_format(mysqli_num_rows($gett));
    if($isit == 0) { // Current account has not liked the post.
      echo "<i class='fa fa-thumbs-up'></i> like";
    }
    else { // Current account has like the post.
      echo "<span><i class='fa fa-thumbs-up'></i></span> unlike";
    }
    echo "</td><td id=\"$feed_randomstr\" class=\"ptb3_td2\" onclick=\"showComments(this);\">";
    echo "<i class=\"fa fa-comment\" aria-hidden=\"true\"></i> ";
    echo "<span id=\"cmtbtn_$feed_randomstr\">comment</span></td>";
    echo "<td id=\"dpost_id_$feed_id\" class=\"ptb3_td3\">";
    # Determine whether or not the current account has disliked the post.
    $gett = mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$feed_id' && uid='$u_uid'");
    $isit = number_format(mysqli_num_rows($gett));
    if($isit == "0") { // Current account has not disliked the post.
      echo "<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\"></i> dislike";
    }
    else { // Current account has disliked the post.
      echo "<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\"></i> undislike";
    }
    echo "</td></tr></table>";
    echo "<div id=\"comments_$feed_randomstr\" style=\"display: none;\">";
    /* LIST OF LIKES */
    /* LIST OF LIKES */
    echo "<div id=\"infosies_$feed_id\" style=\"font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;\">";
    include("dis_like_infosies.php");
    echo "</div>";
    /* LIST OF LIKES */
    /* LIST OF LIKES */
    echo "<div style=\"background-color: $username_color; width: 99%; padding: 5px;\">";
    echo "<table style=\"width: 95%; text-align: center;\"><tr>";
    echo "<td style=\"width: 100%;word-break:break-word;\">";
    echo "<input type=\"hidden\" name=\"feedc_id\" value=\"$feed_randomstr\">";
    // Write a comment.
    // If commenting is available.
    if($feed_allowcomments == 'yes') {
      echo "<div name=\"body\" class=\"comment_$feed_username\" id=\"comment_$feed_randomstr\" placeholder=\"Write a comment...\" style=\"font-family: 'Dosis', sans-serif; font-size: 15px; color: $feed_tcolor; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: $username_color; width: 98%; outline: none; text-align: left;\" contenteditable></div></td>";
    }
    else {
      echo "<div name=\"body\" class=\"comment_$feed_username\" id=\"comment_$feed_randomstr\" placeholder=\"Comments disabled.\" style=\"font-family: 'Dosis', sans-serif; font-size: 15px; color: $feed_tcolor; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: $username_color; width: 98%; outline: none; text-align: left;\"></div></td>";
    }
    echo "<td><button onclick=\"pComment('$feed_randomstr')\" style=\"-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: $feed_tcolor; color: $username_color; border-radius: 30px;\">";
    echo "<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>";
    if($feed_allowcomments == 'yes') {
      echo "</td><td><button onclick=\"cselectFile('$feed_randomstr');\" id=\"cfPath_$feed_randomstr\" style=\"-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: $feed_tcolor; color: $username_color; border-radius: 30px;\">";
    }
    else {
      echo "</td><td><button id=\"cfPath_$feed_randomstr\" style=\"-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: $feed_tcolor; color: $username_color; border-radius: 30px;\">";
    }
    echo "<span id=\"cloader_$feed_randomstr\">";
    echo "<i class=\"fa fa-paperclip\" aria-hidden=\"true\"></i>";
    echo "</span></button></td></tr></table>";
    echo "<form id=\"cimgUpl_$feed_randomstr\" action=\"img_upload.php\" enctype=\"multipart/form-data\" method=\"post\">";
    echo "<input type=\"hidden\" id=\"cfeedc_id\" value=\"$feed_randomstr\">";
    echo "<input id=\"cfBrowse_$feed_randomstr\" name=\"img\" type=\"file\" style=\"display: none;\">";
    echo "</form></div>";
    echo "<div id=\"comments_inner_$feed_randomstr\" style=\"word-wrap: break-word; overflow: auto;\"></div>";
    echo "</div></center></div>";
    echo "<br>";
  }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
function pollVote(op,uq) {
  var token = "<?php echo $u_token;?>";
  $.ajax({
    url: 'poll_vote.php',
    type: 'POST',
    data: { uq: uq, op: op, token: token },
    success: function(){
      pollRefresh(uq);
    },
    error: function() {
      pollRefresh(uq);
    }
  });
}
/**
 * Returns the style for a node.
 *
 * @param n The node to check.
 * @param p The property to retrieve (usually 'display').
 * @link http://www.quirksmode.org/dom/getstyles.html
 */
function getNodeStyle( n, p ) {
  return n.currentStyle ?
    n.currentStyle[p] :
    document.defaultView.getComputedStyle(n, null).getPropertyValue(p);
}

//IF THE NODE IS NOT ACTUALLY IN THE DOM then this won't take into account <div style="display: inline;">text</div>
//however for simple things like `contenteditable` this is sufficient, however for arbitrary html this will not work
function isNodeBlock(node) {
  if (node.nodeType == document.TEXT_NODE) {return false;}
  var d = getNodeStyle( node, 'display' );//this is irrelevant if the node isn't currently in the current DOM.
  if (d.match( /^block/ ) || d.match( /list/ ) || d.match( /row/ ) ||
      node.tagName == 'BR' || node.tagName == 'HR' ||
      node.tagName == 'DIV' // div,p,... add as needed to support non-DOM nodes
     ) {
    return true;
  }
  return false;
}

/**
 * Converts HTML to text, preserving semantic newlines for block-level
 * elements.
 *
 * @param node - The HTML node to perform text extraction.
 */
function htmlToText( htmlOrNode, isNode ) {
  var node = htmlOrNode;
  if (!isNode) {node = jQuery("<span>"+htmlOrNode+"</span>")[0];}
  //TODO: inject "unsafe" HTML into current DOM while guaranteeing that it won't
  //      change the visible DOM so that `isNodeBlock` will work reliably
  var result = '';
  if( node.nodeType == document.TEXT_NODE ) {
    // Replace repeated spaces, newlines, and tabs with a single space.
    result = node.nodeValue.replace( /\s+/g, ' ' );
  } else {
    for( var i = 0, j = node.childNodes.length; i < j; i++ ) {
      result += htmlToText( node.childNodes[i], true );
      if (i < j-1) {
        if (isNodeBlock(node.childNodes[i])) {
          result += '\n';
        } else if (isNodeBlock(node.childNodes[i+1]) &&
                   node.childNodes[i+1].tagName != 'BR' &&
                   node.childNodes[i+1].tagName != 'HR') {
          result += '\n';
        }
      }
    }
  }
  return result;
}
// Post comment to a post.
function pComment(feed_randomstr) {
  // Get the content of the editable div.
  var comment_input_id = $('#comment_' + feed_randomstr).html();
  // Convert the content.
  var comment_input = htmlToText(comment_input_id);
  // Post the content.
  if(comment_input.trim() != '') {
    $.ajax({
      url: 'cmtp.php?i=' + feed_randomstr,
      type: 'POST',
      data: { body: comment_input },
      success: function(){
        $('#comment_' + feed_randomstr).empty();
        commentsUp(feed_randomstr);
      },
      error: function() {
        //alert("error");
        $('#comment_' + feed_randomstr).empty();
        commentsUp(feed_randomstr);
      }
    });
  }
}
// Delete comment from a post.
function dComment(feed_randomstr, comment_id) {
  if (confirm("Delete?")) {
    $.ajax({
      url: 'delcmnt.php',
      type: 'GET',
      data: { id: comment_id },
      success: function(){
        commentsUp(feed_randomstr);
      },
      error: function() {
        //alert("error");
        commentsUp(feed_randomstr);
      }
    });
  }
}
function cselectFile(feed_randomstr) {
  document.getElementById('cfBrowse_' + feed_randomstr).click();
  document.getElementById('cfPath_' + feed_randomstr).value = document.getElementById('cfBrowse_' + feed_randomstr).value;
  imgcUpl(feed_randomstr);
}
function imgcUpl(feed_randomstr) {
  var form = document.forms.namedItem("cimgUpl_" + feed_randomstr);
  form.addEventListener('change', function(ev) {
    var oOutput = document.querySelector("div"),
    oData = new FormData(form);
    var oReq = new XMLHttpRequest();
    document.getElementById('cloader_' + feed_randomstr).innerHTML = "<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>";
    oReq.open("POST", "img_upload.php", true);
    oReq.onload = function(oEvent) {
      if (oReq.status == 200) {
        var cpic = oReq.responseText;
        if(cpic != '') {
          document.getElementById('cloader_' + feed_randomstr).innerHTML = "<i class=\"fa fa-paperclip\" aria-hidden=\"true\"></i>";
          var adpti = "[img=50% auto]" + cpic + "[/img]";
          document.getElementById("comment_" + feed_randomstr).innerHTML = document.getElementById("comment_" + feed_randomstr).innerHTML + adpti;
          setEndOfContenteditable(document.getElementById("comment_" + feed_randomstr));
        }
        else
          document.getElementById('cloader_' + feed_randomstr).innerHTML = "<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>";
        form.reset();
      }
    };
    oReq.send(oData);
    ev.preventDefault();
  }, false);
}
function setEndOfContenteditable(contentEditableElement)
{
    var range,selection;
    if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
    {
        range = document.createRange();//Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection();//get the selection object (allows you to change selection)
        selection.removeAllRanges();//remove any selections already made
        selection.addRange(range);//make the range you have just created the visible selection
    }
    else if(document.selection)//IE 8 and lower
    {
        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        range.select();//Select the range (make it the visible selection
    }
}
function showComments(comments) {
  var rstr = comments.id;
  var e = "comments_" + rstr;
  var e = document.getElementById(e);
  document.getElementById("cmtbtn_" + rstr).innerHTML = "comment..";
  // Fetch comments for the post
  var getcmts = new XMLHttpRequest();
  getcmts.open("GET", "inner_comments.php?i=" + rstr, true);
  getcmts.onreadystatechange = function(){
    if(getcmts.readyState == 4)
    if(getcmts.status == 200) {
      var inn_comments = getcmts.responseText;
      document.getElementById("comments_inner_" + rstr).innerHTML = inn_comments;
      document.getElementById("cmtbtn_" + rstr).innerHTML = "comment";
      if(e.style.display == '')
        e.style.display = 'none';
      else
        e.style.display = '';
    }
    else {
      alert("getcmts error");
    }
  };
  getcmts.send();
  return false;
}
function commentsUp(fdid) {
  var rstr = fdid;
  var e = "comments_" + rstr;
  var e = document.getElementById(e);
  document.getElementById("cmtbtn_" + rstr).innerHTML = "comment..";
  // Fetch comments for the post
  var getcmts = new XMLHttpRequest();
  getcmts.open("GET", "inner_comments.php?i=" + rstr, true);
  getcmts.onreadystatechange = function(){
    if(getcmts.readyState == 4)
    if(getcmts.status == 200) {
      var inn_comments = getcmts.responseText;
      document.getElementById("comments_inner_" + rstr).innerHTML = inn_comments;
      document.getElementById("cmtbtn_" + rstr).innerHTML = "comment";
    }
    else {
      alert("commentsUp error");
    }
  };
  getcmts.send();
  var mainPC = document.getElementById("mpcomment_count");
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "mpcomments.php?i=" + rstr, true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        mainPC.innerHTML = xhr.responseText;
      }
      else {
        alert("getcmts  error");
        mainPC.innerHTML = "getcmts error";
      }
    };
  xhr.send();
  mainPC.innerHTML = "...";
  return false;
}



function pollRefresh(uq) {
  var rstr = uq;
  var e = "innerpoll_" + rstr;
  var e = document.getElementById(e);
  // Fetch poll for the post
  var getpolls = new XMLHttpRequest();
  getpolls.open("GET", "inner_poll.php?uq=" + rstr, true);
  getpolls.onreadystatechange = function(){
    if(getpolls.readyState == 4)
    if(getpolls.status == 200) {
      var inn_polls = getpolls.responseText;
      document.getElementById("innerpoll_" + rstr).innerHTML = inn_polls;
    }
    else {
      alert("error");
    }
  };
  getpolls.send();
  return false;
}





function expand(id) {
  var e = document.getElementById(id);
  if(e.style.display == '')
    e.style.display = 'none';
  else
    e.style.display = '';
}
function loadmore() {
  document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
  var amount = document.getElementById("amount").value;
  var content = document.getElementById("ld_posts");
  $.ajax({
    type: 'get',
    url: 'moreposts.php',
    data: {
      amntcnt:amount
    },
    success: function(more_content) {
      content.innerHTML = content.innerHTML+more_content;
      document.getElementById("amount").value = Number(amount)+10;
    }
  });
  var getcount = new XMLHttpRequest();
  getcount.open("GET", "contamnt.php", true);
  getcount.onreadystatechange = function(){
    if(getcount.readyState == 4)
    if(getcount.status == 200) {
      document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
      var numCont = getcount.responseText;
      if(numCont <= Number(amount) + 10) {
        document.getElementById("more_div").innerHTML = "";
      }
    }
    else{
      alert("getcount error");
      document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
    }
  };
  getcount.send();
  return false;
}
</script>
