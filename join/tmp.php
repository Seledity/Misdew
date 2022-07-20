<?php
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="#a64ca6">
  <link rel="stylesheet" type="text/css" href="/css/consistent.css">
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="apple-touch-icon" href="/img/logo.png">
</head>
<body>
  <center>
    <?php
    session_start();
    $back_button = yes;
    $linebreak = true;
    require_once("../inc/header.php");
    // possible session messages
    if (isset($_SESSION['m']) == 'all_req') {
      echo "<div class=\"error_msg\">All fields are required.</div> <br>";
      unset($_SESSION['m']);
    }
    elseif (isset($_SESSION['m4']) == 'user_leng') {
      echo "<div class=\"error_msg\">Your username must not be greater than 13 characters.</div> <br>";
      unset($_SESSION['m4']);
    }
    elseif (isset($_SESSION['m5']) == 'user_exi') {
      echo "<div class=\"error_msg\">That username already exists.</div> <br>";
      unset($_SESSION['m5']);
    }
    elseif (isset($_SESSION['m3']) == 'pdnm_aumna') {
      echo "<div class=\"error_msg\">Your username must be alphanumeric and the passwords you entered did not match.</div> <br>";
      unset($_SESSION['m3']);
    }
    elseif (isset($_SESSION['m2']) == 'user_alnum') {
      echo "<div class=\"error_msg\">Your username must be alphanumeric.</div> <br>";
      unset($_SESSION['m2']);
    }
    elseif (isset($_SESSION['m1']) == 'chec_yapass') {
      echo "<div class=\"error_msg\">The passwords you entered did not match.</div> <br>";
      unset($_SESSION['m1']);
    }
    elseif (isset($_SESSION['m6']) == 'gen_error') {
      echo "<div class=\"error_msg\">There was an error.</div> <br>";
      unset($_SESSION['m6']);
    }
    session_destroy();
    ?>
    <span style="color: #888; font-size: 12px; font-family: 'Dosis', sans-serif;">By joining, you are agreeing to our <a href="/privacy-policy.html" target="_blank" style="color: #888;">privacy policy.</a></span> <br><br>
    <form action="join.php" method="post" autocomplete="off">
      <table class="form_tble">
        <tr>
          <td>
            <input name="username" maxlength="13" type="text" placeholder="username" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input name="email" type="text" placeholder="email address" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input autocomplete="new-password" name="password" type="password" placeholder="password" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input name="confirm_password" type="password" placeholder="confirm password" class="form_input">
          </td>
        </tr>
        <tr>
          <td class="form_tdpad">
            <input type="submit" value="join" class="form_submit" onclick="this.disabled=true;this.value='joining...';this.form.submit();">
          </td>
        </tr>
      </table>
    </form>
    <table class="form_btap" onclick="window.location='/';">
      <tr>
        <td>
          tap to login
        </td>
      </tr>
    </table> <br>
    <div style="font-size: 13px; text-align: left; width: 95%; max-width: 500px; color: #808080; font-family: 'Dosis', sans-serif; padding-bottom: 10px;">
      <span style="font-size: 25px; font-weight: bold;">Feed</span> <br>
      This is an area where our members can post about anything that they desire. We enable others with the options to like, dislike, or comment on a post. Two of our most recent posts are below.
    </div>
    <?php
    if($u_emoji_type == '') {
      $u_emoji_type = 'facebook';
    }
    # SELECT TEN POSTS FROM FEED
    $feed_q = mysqli_query($conx, "SELECT id,uid,post,tstamp,random_str,visibility,edited,img FROM feed ORDER BY id DESC LIMIT 2");
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
      // Emoji+ replacement
      include("../inc/replace.php");
      # SELECT ACCOUNT DATA FOR FEED POSTS
      $usr_q = mysqli_query($conx, "SELECT username,picture,online_time FROM accounts WHERE uid='$feed_uid'");
      while($usr_r = mysqli_fetch_assoc($usr_q)) {
        // Account data
        $feed_username = $usr_r['username'];
        $feed_picture = $usr_r['picture'];
        $feed_onltime = $usr_r['online_time'];
        // Activity Dot
        $new_time = time() - $feed_onltime;
        $mens = round($new_time / 60);
        if($mens <= 1) { $cv_activeness = "#00FF00"; } // Active within one minute
        elseif($mens <= 2) { $cv_activeness = "#FFA500"; } // Active within two minutes
        elseif($mens < 5) { $cv_activeness = "#FFA500"; } // Active within five minutes
        else { $cv_activeness = "#FF0000"; } // Active over five minutes
        # SELECT THEME COLORS FOR ACCOUNTS
        $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$feed_uid' && theme_id='1'");
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
      if($comcnt_r != '1') { $cs = "s"; } // comment(s)
      // If a post has more than one like, set an 's' variable
      $likcnt_q = mysqli_query($conx, "SELECT id FROM feed_likes WHERE post_id='$feed_id'");
      $likcnt_r = number_format(mysqli_num_rows($likcnt_q));
      if($likcnt_r != '1') { $ls = "s"; } // like(s)
      // If a post has more than one dislike, set an 's' variable
      $dlikcnt_q = mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$feed_id'");
      $dlikcnt_r = number_format(mysqli_num_rows($dlikcnt_q));
      if($dlikcnt_r != '1') { $dls = "s"; } // dislike(s)
      # BEGIN ECHOING THE FEED POSTS
      echo "<div class=\"feed_post\" id=\"fp_1\" style=\"background-color: $username_color;\">";
      echo "<table class=\"post_table1\"><tr>";
      echo "<td class=\"ptb1_td1\" style=\"color: $feed_tcolor; width: 0%;\">";
      echo "<div style=\"position: relative; width: 36px; height: 36px; border-radius: 50px;\">";
      echo "<div style=\"background-color: $cv_activeness; border: 2px solid $username_color; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;\"></div>";
      echo "<img onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\" src=\"$feed_picture\" class=\"list_picture\"></div></td>";
      echo "<td class=\"ptb1_td1\" style=\"text-align: left; color: $feed_tcolor;\">";
      echo "<a onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\" style=\"text-decoration: none; color: $feed_tcolor; font-weight: bold;\">$feed_username</a></td>";
      echo "<td class=\"ptb1_td2\" style=\"color: $feed_tcolor;\">";
      echo "<i class=\"fa fa-angle-down\" aria-hidden=\"true\" onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\"></i></td></tr></table></div>";
      echo "<div class=\"feed_post\" id=\"fp_2\">";
      echo "<div class=\"fp_3\">";
      // Echo the post content.
      echo bbc(atname(nl2br($string)));
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
      echo "<td onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\" id=\"post_id_$feed_id\" class=\"ptb3_td1\">";
      echo "<i class='fa fa-thumbs-up'></i> like";
      echo "</td><td id=\"$feed_randomstr\" class=\"ptb3_td2\" onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\">";
      echo "<i class=\"fa fa-comment\" aria-hidden=\"true\"></i> ";
      echo "<span id=\"cmtbtn_$feed_randomstr\">comment</span></td>";
      echo "<td onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\" id=\"dpost_id_$feed_id\" class=\"ptb3_td3\">";
      echo "<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\"></i> dislike";
      echo "</td></tr></table>";
      echo "</div>";
      echo "<br>";
    }
    ?>
    <div style="font-size: 13px; text-align: left; width: 95%; max-width: 500px; color: #808080; font-family: 'Dosis', sans-serif; padding-bottom: 10px;">
      <span style="font-size: 25px; font-weight: bold;">Chat</span> <br>
      A location within us that members can speak to each other in. It is like a giant group conversation that anyone can be a part of. We also offer a secret messaging feature which can be used by tapping a username. Below is a snippet of the four most recent messages.
    </div>
    <?php
    echo "<div style=\"background-color: #fff; width: 95%; max-width: 500px; padding: 10px; text-align: left; overflow: hidden; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">";
    $chat_q = mysqli_query($conx, "SELECT id,uid,tstamp,message,pmuid,msgtype,display_name,mtype,imgurl FROM chat WHERE msgtype!='pm' ORDER BY id DESC LIMIT 4");
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
      include("../inc/replace.php");
      $usr_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$chat_uid'");
      while($usr_r = mysqli_fetch_assoc($usr_q)) {
        $chat_username = $usr_r['username'];
        $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$chat_uid' && theme_id='1'");
        while($usri_r = mysqli_fetch_assoc($usri_q)) {
          $username_color = $usri_r['username_color'];
          $chat_tcolor = $usri_r['text_color'];
        }
      }
          if($displayname == 'no') {
            $chat_username = "";
          }
          echo "<div onclick=\"alert('You must fully enter the website in order to perform this action. Create an account to do so if you have not already!')\" style=\"display:block\"><table style=\"float: left; width: 100%; text-align: left;\"><tr><td style=\"color: $username_color; font-family: 'Dosis', sans-serif; font-weight: bold;\"><span>$chat_username</span></td></tr></table>";
          // if message is an image
          if($mtype == 'img') {
            echo "<div style=\"word-wrap: break-word; border-radius: 20px; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 60%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\"><img src=\"$c_imgurl\" alt=\"\" width=\"100%\" style=\"display: block; height: auto;\"></div>";
          }
          // if message is normal
          else {
            echo "<div style=\"word-wrap: break-word; background-color: $username_color; padding: 10px; padding-left: 25px; padding-right: 25px; border-radius: 20px; color: $chat_tcolor; font-family: 'Dosis', sans-serif; display: inline-block; float: left; max-width: 90%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;\">" . $string . "</div>";
          }
          echo "</div>";
    }
    echo "</div>";

    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
