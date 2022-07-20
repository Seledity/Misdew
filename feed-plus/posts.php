<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$asc_or_dsc = safe($_GET['s']);
if($asc_or_dsc == '') {
  $asc_or_dsc = "DESC";
}
# SELECT TEN POSTS FROM FEED
$feed_q = mysqli_query($conx, "SELECT id,is_poll,uid,post,tstamp,random_str,visibility,edited,img,allow_comments FROM feed ORDER BY id $asc_or_dsc LIMIT 15");
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
  # SEE IF A USER HAS LIKED OR DISLIKED POSTS
  # SET THE COLOR OF THE BUBBLES ACCORDINGLY
  $did_user_like = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed_likes WHERE post_id='$feed_id' && uid='$u_uid'"));
  if($did_user_like >= '1') {
    $post_like_color = "$username_color";
    $post_like_bgcolor = "$feed_tcolor";
  }
  else {
    $post_like_color = "$feed_tcolor";
    $post_like_bgcolor = "$username_color";
  }
  $did_user_dislike = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$feed_id' && uid='$u_uid'"));
  if($did_user_dislike >= '1') {
    $post_dislike_color = "$username_color";
    $post_dislike_bgcolor = "$feed_tcolor";
  }
  else {
    $post_dislike_color = "$feed_tcolor";
    $post_dislike_bgcolor = "$username_color";
  }
  # BEGIN ECHOING THE FEED POSTS
  if($feed_uid != '286') {
    if($feed_is_poll == 'yes') {
      echo "poll post faggot <br><br>";
    }
    else {
    echo "

    <div style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top-left-radius: 1em;border-top-right-radius: 1em; font-family: 'Dosis', sans-serif; color: $feed_tcolor; width: 95%; max-width: 500px; background-color: $username_color;\">
      <table style=\"width: 100%; padding: 10px; padding-top: 5px; padding-bottom: 5px;text-align: left;\">
        <tr>
          <td>
            <i class=\"fa fa-align-left\"></i>
          </td>
          <td style=\"text-align: left;\">
            <div style=\"position: relative; width: 36px; height: 36px; border-radius: 50px;\">
              <div style=\"background-color: $cv_activeness; border: 2px solid $username_color; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;\">
              </div>
              <img onclick=\"window.open('/canvas/$feed_username');\" src=\"$feed_picture\" class=\"list_picture\">
            </div>
          </td>
          <td style=\"width: 100%;font-weight: bold;text-align: left;\">
            <span onclick=\"window.open('/canvas/$feed_username');\">$feed_username</span> $verif_check <span style=\"font-weight: normal; font-size: 12px;\">&bull; "; if($feed_edited == 'yes') { echo "<span style=\"font-weight: normal; font-size: 12px;\">edited</span> "; } echo timeago($feed_tstamp); echo " ago</span>
          </td>";
          if($feed_uid == $u_uid) {
            // Option to edit the post.
            echo "<td style=\"font-weight: bold;text-align: right;\">
              <i class=\"fa fa-pencil\"></i>
            </td>
            <td style=\"font-weight: bold;text-align: right;\"></td>";
            // Option to remove the post.
            echo "<td style=\"font-weight: bold;text-align: right;\">
              <i class=\"fa fa-trash\" id=\"pdel_$feed_id\"></i>
            </td>
            <td style=\"font-weight: bold;text-align: right;\"></td>";
          }
          // If the feed UID does not match the current UID, but the current account is a content manager.
          ########## YOU WILL NEED TO MODIFY THIS CODE TO MATCH CANVAS STANDARDS FOR ROLES ##########
          if($feed_uid != $u_uid && $u_cont_mang == 'yes') {
            echo "<td style=\"font-weight: bold;text-align: right;\">
              <i class=\"fa fa-trash\" id=\"pdel_$feed_id\"></i>
            </td>
            <td style=\"font-weight: bold;text-align: right;\"></td>";
          }
          echo "<td onclick=\"window.open('post.php?i=$feed_randomstr');\" style=\"font-weight: bold;text-align: right;\">
            <i class=\"fa fa-external-link-square\"></i>
          </td>
        </tr>
      </table>
    </div>
    <div style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;\">
      <table style=\"word-break: break-word; overflow: auto;width: 100%; padding: 10px; text-align: left;\">
        <tr>
          <td>";
            echo bbc(atname(nl2br($string)));
          echo "</td>
        </tr>
      </table>
    </div>
    <div style=\"border-top: 1px solid #cecece; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #808080; width: 95%; max-width: 500px; background-color: #E5E5E5;\">
      <table style=\"font-size: 13px; color: #808080; text-align: center; width: 100%; padding: 10px; padding-bottom: 0px; padding-top: 0px; text-align: left;\">
        <tr>
          <td style=\"text-align: left; width: 33.3333333333%;\">
            <span id=\"likecnt_$feed_id\"><span style=\"font-weight: bold;\">$likcnt_r</span> like$ls</span>
          </td>
          <td style=\"text-align: center; width: 33.3333333333%;\">
            <span id=\"cmtcnt_$feed_id\"><span style=\"font-weight: bold;\">$comcnt_r</span> comment$cs</span>
          </td>
          <td style=\"text-align: right; width: 33.3333333333%;\">
            <span id=\"dlikecnt_$feed_id\"><span style=\"font-weight: bold;\">$dlikcnt_r</span> dislike$dls</span>
          </td>
        </tr>
      </table>
    </div>
    <div class=\"feedp_div_contain\">
    <div id=\"pbutton_bar_$feed_id\">
    <div onclick=\"postLike('$feed_id')\" id=\"lpost_id_$feed_id\" class=\"feedp_like\" style=\"background-color: $post_like_bgcolor;\"><i class=\"fa fa-thumbs-up\" style=\"color: $post_like_color;\"></i></div>
    <div onclick=\"loadComments('$feed_randomstr', '$feed_id');showComments('show_comments_$feed_id','$feed_id','$username_color','$feed_tcolor','$feed_randomstr');\" id=\"cmtbtn_$feed_id\" class=\"feed_cmt_btn\" style=\"background-color: $username_color\"><i id=\"cmtbtxt_$feed_id\" class=\"fa fa-comment\" style=\"color: $feed_tcolor;\"></i></div>
    <div onclick=\"postDislike('$feed_id','$username_color','$feed_tcolor')\" id=\"dpost_id_$feed_id\" class=\"feedp_dislike\" style=\"background-color: $post_dislike_bgcolor;\"><i class=\"fa fa-thumbs-down\" style=\"color: $post_dislike_color;\"></i></div>
    </div>
  <div style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: $username_color; font-family: 'Dosis', sans-serif; padding: 2px;  color: #fff;\">
    &nbsp;
  </div></div>
  <div id=\"show_comments_$feed_id\" style=\"display: none; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-bottom-left-radius: 1em;border-bottom-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;\">
    <div style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: $username_color; width: 100%; background-color: $feed_tcolor;\">
      <table style=\"width: 100%; text-align: left;padding-top: 18px;\">
        <tr>
          <td style=\"color: $username_color; font-size: 12px;\">
            liked by <span id=\"likedby_$feed_id\" style=\"font-weight: bold;color:$username_color !important;\">...</span><br>
            disliked by <span id=\"dislikedby_$feed_id\" style=\"font-weight: bold;color:$username_color !important;\">...</span>
          </td>
        </tr>
      </table>
    </div>
    <div style=\"box-shadow: 0 1px 6px rgba(0,0,0,0.16), 0 1px 6px rgba(0,0,0,0.23);padding-top: 4px; padding-bottom: 4px;text-align: left;font-family: 'Dosis', sans-serif; color: $feed_tcolor; width: 100%; background-color: $username_color;\">
      <table style=\"width: 100%; color: $feed_tcolor; padding-right: 8px; padding-left: 8px;\">
        <tr>
          <td>
            <i class=\"fa fa-image\"></i>
          </td>
          <td></td>
          <td>
            <i class=\"fa fa-film\"></i>
          </td>
          <td style=\"width: 100%;word-break:break-word;\">
            <div name=\"body\" class=\"comment_$feed_username\" id=\"comment_\" placeholder=\"write a comment...\" style=\"width: 98%;padding: 8px;font-family: 'Dosis', sans-serif; font-size: 15px; color: $feed_tcolor; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: $username_color; outline: none; text-align: left;\" contenteditable></div>
          </td>
          <td style=\"padding-left: 8px;\">
            <i class=\"fa fa-paper-plane\"></i>
          </td>
        </tr>
      </table>
    </div>
    <div id=\"load_comments_$feed_id\" style=\"word-wrap: break-word; overflow: auto;\">
    <div style=\"padding: 8px; color: #808080;\">loading comments...</div>
    </div>
  </div>
  <br><br>


    ";
  }
}
}
?>
<script>
function morePosts() {
  var sort_view = document.getElementById("feedp_sort").value;
  document.getElementById("load_more").innerHTML = '<div id=\"load_more\"> <table onclick=\"morePosts();\" style=\"width: 60%; max-width: 300px; border-spacing: 10px; text-align: center;\"> <tr> <td class=\"feed_new_tds\" style=\"background-color: #ff3c64; font-size: 20px;\"> <img src=\"https://i.imgur.com/pvQ0NaJ.gif\" height=\"16\" width=\"16\" alt=\"\" style=\"border:0;\"> </td> </tr> </table> </div>';
  var amount = document.getElementById("amount").value;
  var content = document.getElementById("contained_posts");
  $.ajax({
    type: 'get',
    url: 'more_posts.php',
    data: {
      amntcnt:amount,sort:sort_view
    },
    success: function(more_content) {
      content.innerHTML = content.innerHTML+more_content;
      document.getElementById("amount").value = Number(amount)+15;
    }
  });
  var getcount = new XMLHttpRequest();
  getcount.open("GET", "contamnt.php", true);
  getcount.onreadystatechange = function(){
    if(getcount.readyState == 4)
    if(getcount.status == 200) {
      document.getElementById("load_more").innerHTML = '<div id=\"load_more\"> <table onclick=\"morePosts();\" style=\"width: 60%; max-width: 300px; border-spacing: 10px; text-align: center;\"> <tr> <td class=\"feed_new_tds\" style=\"background-color: #ff3c64; font-size: 20px;\"> <i class=\"fa fa-chevron-circle-down fa-lg\"></i> </td> </tr> </table> </div>';
      var numCont = getcount.responseText;
      if(numCont <= Number(amount) + 15) {
        document.getElementById("load_more").innerHTML = "";
      }
    }
    else{
      alert("getcount error");
      document.getElementById("load_more").innerHTML = '<div id=\"load_more\"> <table onclick=\"morePosts();\" style=\"width: 60%; max-width: 300px; border-spacing: 10px;text-align: center;\"> <tr> <td class=\"feed_new_tds\" style=\"background-color: #ff3c64; font-size: 20px;\"> <i class=\"fa fa-chevron-circle-down fa-lg\"></i> </td> </tr> </table> </div>';
    }
  };
  getcount.send();
  return false;
}
var Del = document.querySelectorAll("i[id^=pdel_]");
[].forEach.call(Del, function(dt){
  dt.onclick = function(e){
    if (confirm("Delete?")) {
      var dto = new XMLHttpRequest();
      dto.open("GET", "delete.php?id=" + dt.id.match(/([0-9]*)$/)[0], true);
      dto.onreadystatechange = function(){
        if (dto.readyState == 4)
          if(dto.status == 200) {
            upPosts();
          }
          else {
            alert('Feed request failed. Please check your connection and try again.');
          }
      };
      dto.send();
      return false;
    }
  };
});
</script>
