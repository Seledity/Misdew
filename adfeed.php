
<!DOCTYPE html>
<html>
<head>
  <title>Feed - Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="#a64ca6">
  <link rel="stylesheet" type="text/css" href="/css/consistent.css">
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="apple-touch-icon" href="/img/logo.png">
  <style type="text/css">
  body {
    background-color: ;
  }
  #header_tds {
    color:  !important;
  }
  </style>
</head>
<body onload="resetPosts();">
  <center>
    <div class="header">
  <table style="width: 100%; text-align: center;">
    <tr>
      <td style="padding-left: 15px;" onclick="window.window.history.go(-1); return false;"><i id="header_tds" class="fa fa-arrow-left" aria-hidden="true"></i></td>      <td style="width: 100%;" onclick="window.location='/hub';"><img src="/img/header.png" alt="" style="width: 40%; padding-top: 5px;"></td>
      <td style="padding-right: 15px;" onclick="var log_conf=confirm('Logout?');if(log_conf == true){window.location='/logout?t=okgKxfURmH';}"><i id="header_tds" class="fa fa-sign-out" aria-hidden="true"></i></td>
    </tr>
  </table>
</div>

<br><div id="ld_alerts"><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function upAlerts() {
  $.get("/inc/alerts.php", function(d) {
    $("#ld_alerts").html(d);
  });
}
var Alerts = document.querySelectorAll("a[id^=tid_]");
[].forEach.call(Alerts, function(notif){
  notif.onclick = function(e){
      var notifo = new XMLHttpRequest();
      notifo.open("GET", "/inc/toggle.php?t=okgKxfURmH&&i=" + notif.id.match(/([0-9]*)$/)[0], true);
      notifo.onreadystatechange = function(){
        if (notifo.readyState == 4)
          if(notifo.status == 200) {
            upAlerts();
          }
          else {
            alert("error");
          }
      };
      notif.innerHTML = "...";
      notifo.send();
      return false;
  };
});
var Alerts = document.querySelectorAll("a[id^=did_]");
[].forEach.call(Alerts, function(notif){
  notif.onclick = function(e){
      var notifo = new XMLHttpRequest();
      notifo.open("GET", "/inc/dismiss.php?t=okgKxfURmH&&i=" + notif.id.match(/([0-9]*)$/)[0], true);
      notifo.onreadystatechange = function(){
        if (notifo.readyState == 4)
          if(notifo.status == 200) {
            upAlerts();
          }
          else {
            alert("error");
          }
      };
      notif.innerHTML = "...";
      notifo.send();
      return false;
  };
});
</script>
</div><script>setInterval('upAlerts()', 10000);</script><script>function expand(id) {
      var e = document.getElementById(id);
      if(e.style.display == 'block')
      e.style.display = 'none';
      else
      e.style.display = 'block';
    }</script><script>
function showSpoiler(obj) {
  var spoiler_hidden = obj.parentNode.getElementsByTagName("div")[0];
  if(spoiler_hidden.style.display == "none") {
    spoiler_hidden.style.display = "";
    obj.innerHTML = "<i class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i>";
  }
  else {
    spoiler_hidden.style.display = "none";
    obj.innerHTML = "<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>";
  }
}
</script>
    <div id="postIt" style="display: none;">
      <form id="feed_form" method="post" action="ppost.php">
        <table class="postbox_tb">
          <tr>
            <td>
              <textarea id="fpostb" name="post" rows="4" class="feed_parea" placeholder="type something..."></textarea>
            </td>
          </tr>
        </table>
        <table class="postbox_tb" id="postbox_tb2">
            <td class="postbox2_td" onclick="more('fd_more')">
              <i id="feed_more" class="fa fa-plus" aria-hidden="true"></i>
            </td>
            <td class="postbox2_td2">
              <input type="submit" value="post" class="postbox_sub">
            </td>
            <td class="postbox2_td">
              <span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true"></i></span>
            </td>
          </tr>
        </table>
      </form>
      <table id="fd_more" style="display: none;">
        <tr>
          <td>
            <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
              <input id="fBrowse" name="img" type="file" style="display: none;">
            </form>
            <i class="fa fa-refresh" aria-hidden="true" onclick="upPosts();refreshP();" id="post_refresh"></i>
          </td>
        </tr>
      </table>
      <br>
    </div>
    <div id="wPst">
      <table onclick="writePost();fpostb.focus();" class="writePost" style="display: visible;">
        <tr>
          <td class="wpost_td">
            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> &nbsp; tap to post
          </td>
        </tr>
      </table>
      <br>
    </div>
    <input id="amount" type="hidden" value="10">
    <div id="ld_posts"><style type="text/css">.comment_Blazin420[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/Blazin420';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/Blazin420" style="text-decoration: none; color: #fff; font-weight: bold;">Blazin420</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('582Oo1Ey8fXdnpKAUV')"></i></td></tr></table></div><div id="582Oo1Ey8fXdnpKAUV" class="post_more" style="display: none;">edited 6h ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8276"></i>&nbsp; <i onclick="window.location='post.php?i=582Oo1Ey8fXdnpKAUV';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">Hi! I didn't realize this site still existed! I'm looking forward to making a bunch of neat friends! :3</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8276">2 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8276">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">3 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8276" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="582Oo1Ey8fXdnpKAUV" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_582Oo1Ey8fXdnpKAUV">comment</span></td><td id="dpost_id_8276" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_582Oo1Ey8fXdnpKAUV" style="display: none;"><div id="infosies_8276" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/jesse2123" class="like_username">jesse2123</a>, <a href="/canvas/Han" class="like_username">Han</a><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="582Oo1Ey8fXdnpKAUV"><div name="body" class="comment_Blazin420" id="comment_582Oo1Ey8fXdnpKAUV" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('582Oo1Ey8fXdnpKAUV')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('582Oo1Ey8fXdnpKAUV');" id="cfPath_582Oo1Ey8fXdnpKAUV" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_582Oo1Ey8fXdnpKAUV"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_582Oo1Ey8fXdnpKAUV" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="582Oo1Ey8fXdnpKAUV"><input id="cfBrowse_582Oo1Ey8fXdnpKAUV" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_582Oo1Ey8fXdnpKAUV"></div></div></center></div><br><style type="text/css">.comment_jesse2123[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #00FF00; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/jesse2123';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/jesse2123" style="text-decoration: none; color: #fff; font-weight: bold;">jesse2123</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('560SYzNJVa0C5sxnyA')"></i></td></tr></table></div><div id="560SYzNJVa0C5sxnyA" class="post_more" style="display: none;">posted 7h ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8275"></i>&nbsp; <i onclick="window.location='post.php?i=560SYzNJVa0C5sxnyA';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">The day before yesterday I spent my time configuring a local server. Yesterday I got login to work.... and today I have posts working!	☆*:.｡.o(≧▽≦)o.｡.<img src="/img/emojis/facebook/kissy.png" alt=":*" style="width: 20px; height: 20px;">☆<br />
<div class="spoiler"><span style="font-weight: bold;">Spoiler</span> <span onclick="showSpoiler(this);" style="float: right;"><i class="fa fa-eye" aria-hidden="true"></i></span><div class="spoiler_hidden" style="display:none;"><a href="https://upl.justa.us/i/560bYe8vawASy2d" style="color: blue; text-decoration: none;">[view image]</a></div></div></div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8275">2 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8275">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">0 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8275" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="560SYzNJVa0C5sxnyA" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_560SYzNJVa0C5sxnyA">comment</span></td><td id="dpost_id_8275" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_560SYzNJVa0C5sxnyA" style="display: none;"><div id="infosies_8275" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/MoonChirp" class="like_username">MoonChirp</a>, <a href="/canvas/Gekko" class="like_username">Gekko</a><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="560SYzNJVa0C5sxnyA"><div name="body" class="comment_jesse2123" id="comment_560SYzNJVa0C5sxnyA" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('560SYzNJVa0C5sxnyA')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('560SYzNJVa0C5sxnyA');" id="cfPath_560SYzNJVa0C5sxnyA" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_560SYzNJVa0C5sxnyA"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_560SYzNJVa0C5sxnyA" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="560SYzNJVa0C5sxnyA"><input id="cfBrowse_560SYzNJVa0C5sxnyA" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_560SYzNJVa0C5sxnyA"></div></div></center></div><br><style type="text/css">.comment_Dreams[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/Dreams';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/Dreams" style="text-decoration: none; color: #fff; font-weight: bold;">Dreams</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('569pfmR3YgDBcJAa4j')"></i></td></tr></table></div><div id="569pfmR3YgDBcJAa4j" class="post_more" style="display: none;">posted 16h ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8274"></i>&nbsp; <i onclick="window.location='post.php?i=569pfmR3YgDBcJAa4j';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">March Break, here I come~! uwu</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8274">2 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8274">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">0 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8274" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="569pfmR3YgDBcJAa4j" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_569pfmR3YgDBcJAa4j">comment</span></td><td id="dpost_id_8274" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_569pfmR3YgDBcJAa4j" style="display: none;"><div id="infosies_8274" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/Ketsueki" class="like_username">Ketsueki</a>, <a href="/canvas/jesse2123" class="like_username">jesse2123</a><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="569pfmR3YgDBcJAa4j"><div name="body" class="comment_Dreams" id="comment_569pfmR3YgDBcJAa4j" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('569pfmR3YgDBcJAa4j')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('569pfmR3YgDBcJAa4j');" id="cfPath_569pfmR3YgDBcJAa4j" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_569pfmR3YgDBcJAa4j"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_569pfmR3YgDBcJAa4j" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="569pfmR3YgDBcJAa4j"><input id="cfBrowse_569pfmR3YgDBcJAa4j" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_569pfmR3YgDBcJAa4j"></div></div></center></div><br><style type="text/css">.comment_ghostface[placeholder]:empty:before {content: attr(placeholder);color: red; }</style><div class="feed_post" id="fp_1" style="background-color: black;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: red; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid black; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/ghostface';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: red;"><a href="/canvas/ghostface" style="text-decoration: none; color: red; font-weight: bold;">ghostface</a></td><td class="ptb1_td2" style="color: red;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('557aOW2w8MfrjTDQuo')"></i></td></tr></table></div><div id="557aOW2w8MfrjTDQuo" class="post_more" style="display: none;">edited 1d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8273"></i>&nbsp; <i onclick="window.location='post.php?i=557aOW2w8MfrjTDQuo';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3"><div class="spoiler"><span style="font-weight: bold;">NSFW rp</span> <span onclick="showSpoiler(this);" style="float: right;"><i class="fa fa-eye" aria-hidden="true"></i></span><div class="spoiler_hidden" style="display:none;">Europe, Asia, Africa, Chris Redfield, an agent of S.T.A.R.S., visited these and all other continents, The world had to offer. And yet he still met only one man worthy of Claire, &ldquo;You want my sister? You can have her! I left everything you need, Together at my place. Now you just have to fuck her! &rdquo; These words called this man to Chris' house, promising dreams greater than he, Ever dared to imagine. This is the man known as the great Leon S. Kennedy! Come aboard and bring along, All your Aryan sperm, Together we will become family, Once you marry her, Leon ! Condoms left behind, They will only slow us down, Your cock will be your guide, Raise the shaft and ease her down, That legendary child, That the end of nine months reveals, Is only legendary, Till you two make it real, Through it all, Through all the intercourse, Through the pleasure, Through Claire's thighs, Know that I, Will be there to stand by you, Just so I know you cum inside, So come aboard and bring along, All your Aryan sperm, Together we will become family, Once you marry her, There is always room for more, If you want to try for twins, Leon, Leon, Just fuck Claire! Leon</div></div></div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8273">3 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8273">2 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">0 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8273" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="557aOW2w8MfrjTDQuo" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_557aOW2w8MfrjTDQuo">comment</span></td><td id="dpost_id_8273" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_557aOW2w8MfrjTDQuo" style="display: none;"><div id="infosies_8273" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/Dreams" class="like_username">Dreams</a>, <a href="/canvas/Han" class="like_username">Han</a>, <a href="/canvas/Ketsueki" class="like_username">Ketsueki</a><br> disliked by <a href="/canvas/Gekko" class="like_username">Gekko</a>, <a href="/canvas/jesse2123" class="like_username">jesse2123</a></div><div style="background-color: black; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="557aOW2w8MfrjTDQuo"><div name="body" class="comment_ghostface" id="comment_557aOW2w8MfrjTDQuo" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: red; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: black; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('557aOW2w8MfrjTDQuo')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: red; color: black; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('557aOW2w8MfrjTDQuo');" id="cfPath_557aOW2w8MfrjTDQuo" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: red; color: black; border-radius: 30px;"><span id="cloader_557aOW2w8MfrjTDQuo"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_557aOW2w8MfrjTDQuo" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="557aOW2w8MfrjTDQuo"><input id="cfBrowse_557aOW2w8MfrjTDQuo" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_557aOW2w8MfrjTDQuo"></div></div></center></div><br><style type="text/css">.comment_Sabastian420[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/Sabastian420';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/Sabastian420" style="text-decoration: none; color: #fff; font-weight: bold;">Sabastian420</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('581sQkhArdzjwKxf9o')"></i></td></tr></table></div><div id="581sQkhArdzjwKxf9o" class="post_more" style="display: none;">posted 1d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8272"></i>&nbsp; <i onclick="window.location='post.php?i=581sQkhArdzjwKxf9o';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3"><a href='/canvas/seledity' style='color:#000;text-decoration:none;font-weight:bold;'>@seledity</a> hi i heard you buy social neko im here to buying social neko back because im richer than yall niggas </div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8272">1 like</span> &nbsp;&nbsp; <span id="dlikecnt_8272">2 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">2 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8272" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="581sQkhArdzjwKxf9o" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_581sQkhArdzjwKxf9o">comment</span></td><td id="dpost_id_8272" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> undislike</td></tr></table><div id="comments_581sQkhArdzjwKxf9o" style="display: none;"><div id="infosies_8272" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/ghostface" class="like_username">ghostface</a><br> disliked by <a href="/canvas/Seledity" class="like_username">Seledity</a>, <a href="/canvas/Gekko" class="like_username">Gekko</a></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="581sQkhArdzjwKxf9o"><div name="body" class="comment_Sabastian420" id="comment_581sQkhArdzjwKxf9o" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('581sQkhArdzjwKxf9o')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('581sQkhArdzjwKxf9o');" id="cfPath_581sQkhArdzjwKxf9o" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_581sQkhArdzjwKxf9o"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_581sQkhArdzjwKxf9o" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="581sQkhArdzjwKxf9o"><input id="cfBrowse_581sQkhArdzjwKxf9o" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_581sQkhArdzjwKxf9o"></div></div></center></div><br><style type="text/css">.comment_Rhonda[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/Rhonda';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/Rhonda" style="text-decoration: none; color: #fff; font-weight: bold;">Rhonda</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('575dt1g4SRxp8a76yD')"></i></td></tr></table></div><div id="575dt1g4SRxp8a76yD" class="post_more" style="display: none;">posted 1d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8271"></i>&nbsp; <i onclick="window.location='post.php?i=575dt1g4SRxp8a76yD';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">Hello my internet friends !!!!</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8271">2 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8271">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">1 comment</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8271" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="575dt1g4SRxp8a76yD" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_575dt1g4SRxp8a76yD">comment</span></td><td id="dpost_id_8271" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_575dt1g4SRxp8a76yD" style="display: none;"><div id="infosies_8271" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/Gekko" class="like_username">Gekko</a>, <a href="/canvas/jesse2123" class="like_username">jesse2123</a><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="575dt1g4SRxp8a76yD"><div name="body" class="comment_Rhonda" id="comment_575dt1g4SRxp8a76yD" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('575dt1g4SRxp8a76yD')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('575dt1g4SRxp8a76yD');" id="cfPath_575dt1g4SRxp8a76yD" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_575dt1g4SRxp8a76yD"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_575dt1g4SRxp8a76yD" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="575dt1g4SRxp8a76yD"><input id="cfBrowse_575dt1g4SRxp8a76yD" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_575dt1g4SRxp8a76yD"></div></div></center></div><br><style type="text/css">.comment_Overhaul[placeholder]:empty:before {content: attr(placeholder);color: black; }</style><div class="feed_post" id="fp_1" style="background-color: grey;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: black; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid grey; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/Overhaul';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: black;"><a href="/canvas/Overhaul" style="text-decoration: none; color: black; font-weight: bold;">Overhaul</a></td><td class="ptb1_td2" style="color: black;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('38Q9GSLI6vRnHtYzX')"></i></td></tr></table></div><div id="38Q9GSLI6vRnHtYzX" class="post_more" style="display: none;">posted 1d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8270"></i>&nbsp; <i onclick="window.location='post.php?i=38Q9GSLI6vRnHtYzX';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">imagine being black OMEGALUL</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8270">1 like</span> &nbsp;&nbsp; <span id="dlikecnt_8270">2 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">2 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8270" class="ptb3_td1"><span><i class='fa fa-thumbs-up'></i></span> unlike</td><td id="38Q9GSLI6vRnHtYzX" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_38Q9GSLI6vRnHtYzX">comment</span></td><td id="dpost_id_8270" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_38Q9GSLI6vRnHtYzX" style="display: none;"><div id="infosies_8270" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/Seledity" class="like_username">Seledity</a><br> disliked by <a href="/canvas/Gekko" class="like_username">Gekko</a>, <a href="/canvas/Rhonda" class="like_username">Rhonda</a></div><div style="background-color: grey; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="38Q9GSLI6vRnHtYzX"><div name="body" class="comment_Overhaul" id="comment_38Q9GSLI6vRnHtYzX" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: black; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: grey; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('38Q9GSLI6vRnHtYzX')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: black; color: grey; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('38Q9GSLI6vRnHtYzX');" id="cfPath_38Q9GSLI6vRnHtYzX" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: black; color: grey; border-radius: 30px;"><span id="cloader_38Q9GSLI6vRnHtYzX"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_38Q9GSLI6vRnHtYzX" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="38Q9GSLI6vRnHtYzX"><input id="cfBrowse_38Q9GSLI6vRnHtYzX" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_38Q9GSLI6vRnHtYzX"></div></div></center></div><br><style type="text/css">.comment_NineTailedFox[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/NineTailedFox';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/NineTailedFox" style="text-decoration: none; color: #fff; font-weight: bold;">NineTailedFox</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('578wEy46UavGRmQ2xB')"></i></td></tr></table></div><div id="578wEy46UavGRmQ2xB" class="post_more" style="display: none;">posted 1d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8269"></i>&nbsp; <i onclick="window.location='post.php?i=578wEy46UavGRmQ2xB';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">How do i block racist bigots?</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8269">0 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8269">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">4 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8269" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="578wEy46UavGRmQ2xB" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_578wEy46UavGRmQ2xB">comment</span></td><td id="dpost_id_8269" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_578wEy46UavGRmQ2xB" style="display: none;"><div id="infosies_8269" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by nobody <i class="fa fa-frown-o" aria-hidden="true"></i><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="578wEy46UavGRmQ2xB"><div name="body" class="comment_NineTailedFox" id="comment_578wEy46UavGRmQ2xB" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('578wEy46UavGRmQ2xB')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('578wEy46UavGRmQ2xB');" id="cfPath_578wEy46UavGRmQ2xB" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_578wEy46UavGRmQ2xB"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_578wEy46UavGRmQ2xB" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="578wEy46UavGRmQ2xB"><input id="cfBrowse_578wEy46UavGRmQ2xB" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_578wEy46UavGRmQ2xB"></div></div></center></div><br><style type="text/css">.comment_Gaara[placeholder]:empty:before {content: attr(placeholder);color: crimson; }</style><div class="feed_post" id="fp_1" style="background-color: #292929;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: crimson; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #FF0000; border: 2px solid #292929; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/Gaara';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: crimson;"><a href="/canvas/Gaara" style="text-decoration: none; color: crimson; font-weight: bold;">Gaara</a></td><td class="ptb1_td2" style="color: crimson;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('51Ppk2DVGOEfHKnca')"></i></td></tr></table></div><div id="51Ppk2DVGOEfHKnca" class="post_more" style="display: none;">posted 2d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8268"></i>&nbsp; <i onclick="window.location='post.php?i=51Ppk2DVGOEfHKnca';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">Swear the people who devolve end up here.</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8268">5 likes</span> &nbsp;&nbsp; <span id="dlikecnt_8268">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">0 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8268" class="ptb3_td1"><span><i class='fa fa-thumbs-up'></i></span> unlike</td><td id="51Ppk2DVGOEfHKnca" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_51Ppk2DVGOEfHKnca">comment</span></td><td id="dpost_id_8268" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_51Ppk2DVGOEfHKnca" style="display: none;"><div id="infosies_8268" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/Seledity" class="like_username">Seledity</a>, <a href="/canvas/Ketsueki" class="like_username">Ketsueki</a>, <a href="/canvas/jesse2123" class="like_username">jesse2123</a>, <a href="/canvas/Rhonda" class="like_username">Rhonda</a>, <a href="/canvas/Sasuke" class="like_username">Sasuke</a><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #292929; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="51Ppk2DVGOEfHKnca"><div name="body" class="comment_Gaara" id="comment_51Ppk2DVGOEfHKnca" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: crimson; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #292929; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('51Ppk2DVGOEfHKnca')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: crimson; color: #292929; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('51Ppk2DVGOEfHKnca');" id="cfPath_51Ppk2DVGOEfHKnca" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: crimson; color: #292929; border-radius: 30px;"><span id="cloader_51Ppk2DVGOEfHKnca"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_51Ppk2DVGOEfHKnca" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="51Ppk2DVGOEfHKnca"><input id="cfBrowse_51Ppk2DVGOEfHKnca" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_51Ppk2DVGOEfHKnca"></div></div></center></div><br><style type="text/css">.comment_jesse2123[placeholder]:empty:before {content: attr(placeholder);color: #fff; }</style><div class="feed_post" id="fp_1" style="background-color: #0000FF;"><table class="post_table1"><tr><td class="ptb1_td1" style="color: #fff; width: 0%;"><div style="position: relative; width: 36px; height: 36px; border-radius: 50px;"><div style="background-color: #00FF00; border: 2px solid #0000FF; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;"></div><img onclick="window.location='/canvas/jesse2123';" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC" class="list_picture"></div></td><td class="ptb1_td1" style="text-align: left; color: #fff;"><a href="/canvas/jesse2123" style="text-decoration: none; color: #fff; font-weight: bold;">jesse2123</a></td><td class="ptb1_td2" style="color: #fff;"><i class="fa fa-angle-down" aria-hidden="true" onclick="expand('560StCfUVMq3zLX7Nx')"></i></td></tr></table></div><div id="560StCfUVMq3zLX7Nx" class="post_more" style="display: none;">posted 2d ago&nbsp; &nbsp; <i class="fa fa-trash" aria-hidden="true" id="pdel_8267"></i>&nbsp; <i onclick="window.location='post.php?i=560StCfUVMq3zLX7Nx';" class="fa fa-expand" aria-hidden="true"></i></div><div class="feed_post" id="fp_2"><div class="fp_3">(　ﾟДﾟ)＜Nooooo!!!<br />
I've been assigned more UML diagrams in a report for database class!<br />
<br />
Why is this much more boring and tedious than it has to be (눈_눈)</div><table class="post_table2"><tr><td class="ptb2_td1"><span id="likecnt_8267">1 like</span> &nbsp;&nbsp; <span id="dlikecnt_8267">0 dislikes</span></td><td id="ccmt_cnt" class="ptb2_td2"><span id="mpcomment_count">0 comments</span></td></tr></table><center><table class="post_table3"><tr><td id="post_id_8267" class="ptb3_td1"><i class='fa fa-thumbs-up'></i> like</td><td id="560StCfUVMq3zLX7Nx" class="ptb3_td2" onclick="showComments(this);"><i class="fa fa-comment" aria-hidden="true"></i> <span id="cmtbtn_560StCfUVMq3zLX7Nx">comment</span></td><td id="dpost_id_8267" class="ptb3_td3"><i class="fa fa-thumbs-down" aria-hidden="true"></i> dislike</td></tr></table><div id="comments_560StCfUVMq3zLX7Nx" style="display: none;"><div id="infosies_8267" style="font-family: 'Dosis', sans-serif; text-align: left; padding-bottom: 8px; padding-right: 8px; padding-left: 8px; font-size: 13px; color: #808080;">liked by <a href="/canvas/Rhonda" class="like_username">Rhonda</a><br> disliked by nobody <i class="fa fa-smile-o" aria-hidden="true"></i></div><div style="background-color: #0000FF; width: 99%; padding: 5px;"><table style="width: 95%; text-align: center;"><tr><td style="width: 100%;word-break:break-word;"><input type="hidden" name="feedc_id" value="560StCfUVMq3zLX7Nx"><div name="body" class="comment_jesse2123" id="comment_560StCfUVMq3zLX7Nx" placeholder="Write a comment..." style="font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #0000FF; width: 98%; outline: none; text-align: left;" contenteditable></div></td><td><button onclick="pComment('560StCfUVMq3zLX7Nx')" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></button></td><td><button onclick="cselectFile('560StCfUVMq3zLX7Nx');" id="cfPath_560StCfUVMq3zLX7Nx" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; width: 28px; height: 28px; padding: 2px; font-family: 'Dosis', sans-serif; text-align: center; background-color: #fff; color: #0000FF; border-radius: 30px;"><span id="cloader_560StCfUVMq3zLX7Nx"><i class="fa fa-paperclip" aria-hidden="true"></i></span></button></td></tr></table><form id="cimgUpl_560StCfUVMq3zLX7Nx" action="img_upload.php" enctype="multipart/form-data" method="post"><input type="hidden" id="cfeedc_id" value="560StCfUVMq3zLX7Nx"><input id="cfBrowse_560StCfUVMq3zLX7Nx" name="img" type="file" style="display: none;"></form></div><div id="comments_inner_560StCfUVMq3zLX7Nx"></div></div></center></div><br><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
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
        alert("error");
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
        alert("error");
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
      alert("error");
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
      alert("error");
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
        alert("error");
        mainPC.innerHTML = "error";
      }
    };
  xhr.send();
  mainPC.innerHTML = "...";
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
      alert("error");
      document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
    }
  };
  getcount.send();
  return false;
}
</script>
</div><div id="more_div"><table onclick="loadmore();" class="writePost"><tr><td class="wpost_td" style="text-align: center;"><i class="fa fa-chevron-circle-down fa-lg" aria-hidden="true"></i></td></tr></table></div><br>
<div class="footer">&copy; Copyright Misdew</span>
  </center>
  <script>
  function updInfosies(i) {
    $.get("dis_like_infosies.php?i=" + i, function(d) {
      $("#infosies_" + i).html(d);
    });
  }
  function resetPosts() {
    document.getElementById("amount").value = "10";
  }
  function getAjax() {
    $.get("ajextra.php", function(d) {
      $("#scriptie").html(d);
    });
  }
  setInterval('getAjax()', 1000);
  function upPosts() {
    $.get("posts.php", function(d) {
      $("#ld_posts").html(d);
    });
    getAjax();
  }
  function refreshP() {
    document.getElementById("amount").value = Number(10);
    document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
  }
  function more(id) {
    var e = document.getElementById(id);
    if(e.style.display == '') {
      e.style.display = 'none';
      document.getElementById('feed_more').className = "fa fa-plus";
    }
    else {
      e.style.display = '';
      document.getElementById('feed_more').className = "fa fa-times";
    }
  }
  function writePost() {
    expand('wPst');
    expand('postIt');
  }
  function selectFile() {
    document.getElementById('fBrowse').click();
    document.getElementById('fPath').value = document.getElementById('fBrowse').value;
  }
  var form = document.forms.namedItem("imgUpl");
  form.addEventListener('change', function(ev) {
    var oOutput = document.querySelector("div"),
    oData = new FormData(form);
    var oReq = new XMLHttpRequest();
    document.getElementById('loader').innerHTML = "<img src='https://i.imgur.com/pvQ0NaJ.gif' height='12' width='12' alt='' style='border:0;'>";
    oReq.open("POST", "img_upload.php", true);
    oReq.onload = function(oEvent) {
      if(oReq.status == 200) {
        var img_url = oReq.responseText;
        if(img_url != '') {
          document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-paperclip fa-lg' aria-hidden='true'></i>";
          var atoinp = "[img]" + img_url + "[/img]";
          document.getElementById("fpostb").value = document.getElementById("fpostb").value + atoinp;
          document.getElementById("fpostb").focus();
        }
        else {
          document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-exclamation' aria-hidden='true'></i>";
        }
        upPosts();
        form.reset();
      }
    };
    oReq.send(oData);
    ev.preventDefault();
  }, false);
  $("#feed_form").submit(function(e){
    e.preventDefault();
    if($("textarea[name=post]").val().trim() == "")
    return;
    $.post("ppost.php", {body: $("textarea[name=post]").val(), submit: "send"}, function(data) {
      if(data != '') {
        upPosts();
        writePost();
        refreshP();
      }
      else {
        upPosts();
      }
    });
    $("textarea[name=post]").val("");
  });
  </script>
  <div id="scriptie">
    <script>
    // THE FOLLOWING SCRIPT WAS
    // MADE BY MARIOERMANDO
    // GIVEN BY ANGEL
    // PERFECTED BY JUSTIN
    var likeBtns = document.querySelectorAll("td[id^=post_id_]");
    [].forEach.call(likeBtns, function(btn) {
      btn.onclick = function(e){
        var xhr = new XMLHttpRequest();
        var a = new XMLHttpRequest();
        var likes = btn.id.match(/([0-9]*)$/)[0];
        var count = document.getElementById("likecnt_" + likes);
        xhr.open("GET", "like.php?id=" + btn.id.match(/([0-9]*)$/)[0] + "&_t=" + Math.random() + "&token=okgKxfURmH", true);
        xhr.onreadystatechange = function(){
          if (xhr.readyState == 4)
          if(xhr.status == 200) {
            btn.innerHTML = xhr.responseText;
          }
          a.open("GET", "count.php?id=" + btn.id.match(/([0-9]*)$/)[0], true);
          a.onreadystatechange = function(){
            if (a.readyState == 4)
            if(a.status == 200) {
              count.innerHTML = a.responseText;
              updInfosies(btn.id.match(/([0-9]*)$/)[0]);
            }
            else{
              alert("error");
              count.innerHTML = "error";
            }
          };
          a.send();
        };
        xhr.send();
        count.innerHTML = "...";
        return false;
      };
    });
    var dlikeBtns = document.querySelectorAll("td[id^=dpost_id_]");
    [].forEach.call(dlikeBtns, function(btn) {
      btn.onclick = function(e){
        var xhr = new XMLHttpRequest();
        var a = new XMLHttpRequest();
        var likes = btn.id.match(/([0-9]*)$/)[0];
        var count = document.getElementById("dlikecnt_" + likes);
        xhr.open("GET", "dislike.php?id=" + btn.id.match(/([0-9]*)$/)[0] + "&_t=" + Math.random() + "&token=okgKxfURmH", true);
        xhr.onreadystatechange = function(){
          if (xhr.readyState == 4)
          if(xhr.status == 200) {
            btn.innerHTML = xhr.responseText;
          }
          a.open("GET", "dcount.php?id=" + btn.id.match(/([0-9]*)$/)[0], true);
          a.onreadystatechange = function(){
            if (a.readyState == 4)
            if(a.status == 200) {
              count.innerHTML = a.responseText;
              updInfosies(btn.id.match(/([0-9]*)$/)[0]);
            }
            else{
              alert("error");
              count.innerHTML = "error";
            }
          };
          a.send();
        };
        xhr.send();
        count.innerHTML = "...";
        return false;
      };
    });
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
                UpMPcmts();
                refreshP();
              }
              else {
                alert("error");
              }
          };
          dto.send();
          return false;
        }
      };
    });
    </script>
  </div>
</body>
</html>
