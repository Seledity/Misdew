<?php
$this_page = "feed";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/feed-plus') {
  $loc_desc = "browsin\' feed+ beta";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/feed-plus' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Feed+ | Misdew.com</title>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="<?php echo $meta_theme_color; ?>">
  <?php
  if($css_type == "sheet") {
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$g_sheet\">";
  }
  if($css_type == "raw") {
    echo "<style type=\"text/css\">$g_raw</style>";
  }
  ?>
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="apple-touch-icon" href="/img/logo.png">
  <style type="text/css">
  body {
    background-color: <?php echo $bgcolor; ?>;
  }
  #header_tds {
    color: <?php echo $tdcolor; ?> !important;
  }
  .header {
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 4px 4px rgba(0,0,0,0.23);
  }
  .feed_new_tds {
    padding: 10px;
    border-radius: 5em;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  }
  .feedp_div_contain {
  position: relative;
  width: 95%;
  max-width: 500px;
  margin: auto;
  border-radius: 50px;
  }
  .feedp_dislike {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  padding: 10px;
  position: absolute;
  width: 25px;
  height: 25px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -90%;
  right: 0%;
  z-index: 3;
  }
  .feedp_like {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  padding: 10px;
  position: absolute;
  width: 25px;
  height: 25px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -90%;
  left: 0%;
  z-index: 3;
  }
  .feed_cmt_btn {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  position: absolute;
  padding: 10px;
  width: 25px;
  height: 25px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -90%;
  left:0%;
  right:0%;
  margin-left:auto;
  margin-right:auto;
  z-index: 3;
  }
  #fp_2 {
  background-color: #f7f7f7;
  }
  .feed_post, .ptb3_td1, .ptb3_td2, .ptb3_td3 {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  }
  .feed_parea {
  background-color: #f7f7f7;
  color: #000;
  }
  ::-webkit-input-placeholder {
  color: #808080;
  }
  :-moz-placeholder {
  color: #808080;
  opacity: 1;
  }
  ::-moz-placeholder {
  color: #808080;
  opacity: 1;
  }
  :-ms-input-placeholder {
  color: #808080;
  }
  .feed_search {
    border: none;
    font-size: 18px;
    width: 90%;
    font-family: 'Dosis', sans-serif;
    color: #000;
    background-color: #fff;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 3px;
  }
  </style>
</head>
<body>
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
    <div id="feed_search_bar" style="display: none; padding-bottom: 10px;">
      <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; border-radius: 20px; color: #808080; padding: 3px; padding-left: 8px;padding-right: 8px;background-color: #fff;text-align: center;width: 90%; max-width: 300px;">
    <table style="border-radius: 20px; color: #808080; border-spacing: 0px; padding: 3px; padding-left: 8px;padding-right: 8px;background-color: #fff;text-align: center;width: 90%; max-width: 300px;">
      <tr>
        <td style="border-radius: 20px;text-align: center; background-color: #fff;">
          <i class="fa fa-search"></i>
        </td>
        <td style="border-radius: 20px;width: 100%; text-align: center; background-color: #fff;">
          <input name="search_input" id="search_input" class="feed_search" type="text" placeholder="search for posts, tags, users">
        </td>
      </tr>
    </table>
    <div id="feed_sresults" style="display: none;">
    <table style="border-top: 1px solid #e7e7e7; border-spacing: 0px; padding-top: 0px; padding-left: 8px;padding-right: 8px;text-align: center;width: 100%;">
      <tr>
        <td style="font-size: 12px; width: 100%; text-align: left; background-color: #fff;">
          coming soon
        </td>
      </tr>
    </table>
  </div>
</div>
    </div>







    <div id="postIt" style="display: none; padding-bottom: 10px;">
      <form id="feed_form" method="post" action="submit_post.php">
        <table class="postbox_tb" style="border-top-left-radius: 1em; border-top-right-radius: 1em; background-color: #f7f7f7; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
          <tr>
            <td>
              <textarea id="fpostb" name="post" rows="4" class="feed_parea" placeholder="type something..."></textarea>
            </td>
          </tr>
        </table>
        <table class="postbox_tb" id="postbox_tb2" style="background-color: <?php echo $u_ucolor; ?> !important; color: <?php echo $u_tcolor; ?> !important; border-bottom-left-radius: 1em; border-bottom-right-radius: 1em; padding-top: 5px; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
            <td class="postbox2_td">
              <span id="vloader"><i onclick="selectVid();" id="vPath" class="fa fa-film" aria-hidden="true" style="color: <?php echo $u_tcolor; ?> !important;"></i></span>
            </td>
            <td class="postbox2_td2">
              <input type="submit" value="post" class="postbox_sub" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: <?php echo $u_ucolor; ?> !important; color: <?php echo $u_tcolor; ?> !important; border: 1px solid <?php echo $u_tcolor; ?> !important;">
            </td>
            <td class="postbox2_td">
              <span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-image" aria-hidden="true" style="color: <?php echo $u_tcolor; ?> !important;"></i></span>
            </td>
          </tr>
        </table>
      </form>
      <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
        <input id="fBrowse" name="img" type="file" style="display: none;">
      </form>
      <form id="vidUpl" action="vid_upload.php" enctype="multipart/form-data" method="post">
        <input id="vBrowse" name="vid" type="file" style="display: none;">
      </form>
    </div>


    <div id="newPstBar" style="display: visible;">
      <table style="width: 80%; max-width: 400px; border-spacing: 10px; font-family: 'Dosis', sans-serif; text-align: center;">
        <tr>
          <td onclick="XpandPosting('postIt');" class="feed_new_tds" style="background-color: #ff3c64;">
            <i class="fa fa-align-left"></i> Post
          </td>
          <td onclick="alert('Polls are being upgraded.');" class="feed_new_tds" style="background-color: #ff3c64;">
            <i class="fa fa-bar-chart"></i> Poll
          </td>
          <td onclick="XpandSearch('feed_search_bar');" class="feed_new_tds" style="background-color: #ff3c64;">
            <i class="fa fa-search"></i> Search
          </td>
        </tr>
      </table>
    </div>

    <div onclick="toggleSort();" style="font-size: 12px; font-family: 'Dosis', sans-serif; color: #808080; padding-top: 8px; width: 95%; max-width: 500px;">
      <span id="feedp_sort_toggled">
        <i class="fa fa-rss"></i> sorted by newest <br>
      </span>
      <input type="text" value="newest" name="feedp_sort" id="feedp_sort" style="display: none;">
    </div>
    <br>

<?php
echo "<div id=\"contained_posts\">";
$asc_or_dsc = "ASC";
require_once("posts.php");
echo "</div>";
?>

<input id="amount" type="hidden" value="15">
  <div id="load_more">
    <table onclick="morePosts();" style="width: 60%; max-width: 300px; border-spacing: 10px; font-family: 'Dosis', sans-serif; text-align: center;">
      <tr>
        <td class="feed_new_tds" style="background-color: #ff3c64; font-size: 20px;">
          <i class="fa fa-chevron-circle-down fa-lg"></i>
        </td>
      </tr>
    </table>
  </div>

    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  </div>
  <script>
  // THE FOLLOWING SCRIPT WAS
  // MADE BY MARIOERMANDO
  // GIVEN BY ANGEL
  // PERFECTED BY JUSTIN
function postLike(id,poster_bgcolor,poster_txtcolor) {
      var xhr = new XMLHttpRequest();
      var a = new XMLHttpRequest();
      var btnbar = new XMLHttpRequest();
      var likes = id;
      var count = document.getElementById("likecnt_" + likes);
      var buttnbar = document.getElementById("pbutton_bar_" + likes);
      xhr.open("GET", "like.php?id=" + likes + "&_t=" + Math.random() + "&token=<?php echo $u_token; ?>", true);
      xhr.onreadystatechange = function(){
        if (xhr.readyState == 4)
        if(xhr.status == 200) {
          //btn.innerHTML = xhr.responseText;
        }
        a.open("GET", "count.php?id=" + likes, true);
        a.onreadystatechange = function(){
          if (a.readyState == 4)
          if(a.status == 200) {
            var post_cmt_id = "show_comments_" + likes;
            closeComments(post_cmt_id, likes, poster_bgcolor, poster_txtcolor);
            count.innerHTML = a.responseText;
            updLiked(likes);
            //updInfosies(btn.id.match(/([0-9]*)$/)[0]);
          }
          else{
            count.innerHTML = a.responseText;
            updLiked(likes);
            //updInfosies(btn.id.match(/([0-9]*)$/)[0]);
            //alert("error");
            //count.innerHTML = "error";
          }
        };
        a.send();
        // button bar color changing vvv
        btnbar.open("GET", "button_bar.php?i=" + likes, true);
        btnbar.onreadystatechange = function(){
          if (btnbar.readyState == 4)
          if(btnbar.status == 200) {
            buttnbar.innerHTML = btnbar.responseText;
            //
          }
          else{
            //count.innerHTML = btnbar.responseText;
            alert('Feed request failed. Please check your connection and try again.');
            //count.innerHTML = "error";
          }
        };
        btnbar.send();
        // button bar color changing ^^^
      };
      xhr.send();
      count.innerHTML = "...";
      return false;
    }
function postDislike(id,poster_bgcolor,poster_txtcolor) {
      var xhr = new XMLHttpRequest();
      var a = new XMLHttpRequest();
      var btnbar = new XMLHttpRequest();
      var likes = id;
      var count = document.getElementById("dlikecnt_" + likes);
      var buttnbar = document.getElementById("pbutton_bar_" + likes);
      xhr.open("GET", "dislike.php?id=" + likes + "&_t=" + Math.random() + "&token=<?php echo $u_token; ?>", true);
      xhr.onreadystatechange = function(){
        if (xhr.readyState == 4)
        if(xhr.status == 200) {
          //btn.innerHTML = xhr.responseText;
        }
        a.open("GET", "dcount.php?id=" + likes, true);
        a.onreadystatechange = function(){
          if (a.readyState == 4)
          if(a.status == 200) {
            var post_cmt_id = "show_comments_" + likes;
            closeComments(post_cmt_id, likes, poster_bgcolor, poster_txtcolor);
            count.innerHTML = a.responseText;
            updDisliked(likes);
            //updInfosies(btn.id.match(/([0-9]*)$/)[0]);
          }
          else{
            count.innerHTML = a.responseText;
            updDisliked(likes);
            //updInfosies(btn.id.match(/([0-9]*)$/)[0]);
            //alert("error");
            //count.innerHTML = "error";
          }
        };
        a.send();
        // button bar color changing vvv
        btnbar.open("GET", "button_bar.php?i=" + likes, true);
        btnbar.onreadystatechange = function(){
          if (btnbar.readyState == 4)
          if(btnbar.status == 200) {
            buttnbar.innerHTML = btnbar.responseText;
            //
          }
          else{
            //count.innerHTML = btnbar.responseText;
            alert('Feed request failed. Please check your connection and try again.');
            //count.innerHTML = "error";
          }
        };
        btnbar.send();
        // button bar color changing ^^^
      };
      xhr.send();
      count.innerHTML = "...";
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
  function toggleSort() {
    var sort_view = document.getElementById("feedp_sort").value;
    if(sort_view === "newest") {
      document.getElementById("amount").value = Number(15);
      document.getElementById("feedp_sort").value = "oldest";
      document.getElementById('feedp_sort_toggled').innerHTML = "<i class=\"fa fa-clock-o\"></i> sorted by oldest <br>";
      $.get("posts.php?s=ASC", function(d) {
        $("#contained_posts").html(d);
      });
    }
    if(sort_view === "oldest") {
      document.getElementById("amount").value = Number(15);
      document.getElementById("feedp_sort").value = "newest";
      document.getElementById('feedp_sort_toggled').innerHTML = "<i class=\"fa fa-rss\"></i> sorted by newest <br>";
      $.get("posts.php?s=DESC", function(d) {
        $("#contained_posts").html(d);
      });
    }
  }
  $("#feed_form").submit(function(e){
    e.preventDefault();
    if($("textarea[name=post]").val().trim() == "")
    return;
    $.post("submit_post.php", {
      body: $("textarea[name=post]").val(),
      submit: "send"}, function(data) {
      if(data != '') {
        upPosts();
        $("textarea[name=post]").val("");
        XpandPosting('postIt');
      }
      else {
        alert('Feed request failed. Please check your connection and try again.');
      }
    });
  });
  function upPosts() {
    $.get("posts.php?s=DESC", function(d) {
      document.getElementById("amount").value = Number(15);
      $("#contained_posts").html(d);
    });
  }
  function XpandPosting(id) {
    var e = document.getElementById(id);
    var hidden_id = "#" + id;
    if(e.style.display == '') {
      $(hidden_id).slideUp(100);
    }
    else {
      $(hidden_id).slideDown(100);
      document.getElementById("fpostb").focus();
      e.style.display = '';
    }
  }
  function showComments(id, post_id, bgcolor, txtcolor, rstr) {
    var e = document.getElementById(id);
    var did = "#" + id;
    var cmt_btn_did = "cmtbtn_" + post_id;
    var cmt_btn_txt_did = "cmtbtxt_" + post_id;
    if(e.style.display == '') {
      $(did).slideUp(500);
      document.getElementById(cmt_btn_did).style.backgroundColor = bgcolor;
      document.getElementById(cmt_btn_txt_did).style.color = txtcolor;
    }
    else {
      $(did).slideDown(500);
      document.getElementById(cmt_btn_did).style.backgroundColor = txtcolor;
      document.getElementById(cmt_btn_txt_did).style.color = bgcolor;
      e.style.display = '';
    }
  }
  function loadComments(cmnt_id, feedid) {
    updLiked(feedid);
    updDisliked(feedid);
    // Fetch comments for the post
    var getcmts = new XMLHttpRequest();
    getcmts.open("GET", "feed_comments.php?i=" + cmnt_id, true);
    getcmts.onreadystatechange = function(){
      if(getcmts.readyState == 4)
      if(getcmts.status == 200) {
        var inn_comments = getcmts.responseText;
        document.getElementById("load_comments_" + feedid).innerHTML = inn_comments;
      }
      else {
        alert('Feed request failed. Please check your connection and try again.');
      }
    };
    getcmts.send();
    return false;
  }
  function updDisliked(feedid) {
    // Fetch comments for the post
    var getcmts = new XMLHttpRequest();
    getcmts.open("GET", "who_disliked.php?i=" + feedid, true);
    getcmts.onreadystatechange = function(){
      if(getcmts.readyState == 4)
      if(getcmts.status == 200) {
        var inn_comments = getcmts.responseText;
        document.getElementById("dislikedby_" + feedid).innerHTML = inn_comments;
      }
      else {
        alert('Feed request failed. Please check your connection and try again.');
      }
    };
    getcmts.send();
    return false;
  }
  function updLiked(feedid) {
    // Fetch comments for the post
    var getcmts = new XMLHttpRequest();
    getcmts.open("GET", "who_liked.php?i=" + feedid, true);
    getcmts.onreadystatechange = function(){
      if(getcmts.readyState == 4)
      if(getcmts.status == 200) {
        var inn_comments = getcmts.responseText;
        document.getElementById("likedby_" + feedid).innerHTML = inn_comments;
      }
      else {
        alert('Feed request failed. Please check your connection and try again.');
      }
    };
    getcmts.send();
    return false;
  }
  function closeComments(id, post_id, bgcolor, txtcolor) {
    var e = document.getElementById(id);
    var did = "#" + id;
    var cmt_btn_did = "cmtbtn_" + post_id;
    var cmt_btn_txt_did = "cmtbtxt_" + post_id;
      $(did).slideUp(500);
      document.getElementById(cmt_btn_did).style.backgroundColor = bgcolor;
      document.getElementById(cmt_btn_txt_did).style.color = txtcolor;
  }
  function Xpand(id) {
    var e = document.getElementById(id);
    var slid = "#" + id;
    if(e.style.display == '') {
      $(slid).slideUp(100);
    }
    else {
      $(slid).slideDown(100);
      e.style.display = '';
    }
  }
  function XpandSearch(id) {
    var e = document.getElementById(id);
    var hidden_id = "#" + id;
    if(e.style.display == '') {
      $(hidden_id).slideUp(100);
    }
    else {
      $(hidden_id).slideDown(100);
      document.getElementById("search_input").focus();
      e.style.display = '';
    }
  }
  function selectFile() {
    document.getElementById('fBrowse').click();
    document.getElementById('fPath').value = document.getElementById('fBrowse').value;
  }
  var form = document.forms.namedItem("imgUpl");
  form.addEventListener('change', function(ev) {
    var username_color = "<?php echo $u_tcolor; ?>";
    var oOutput = document.querySelector("div"),
    oData = new FormData(form);
    var oReq = new XMLHttpRequest();
    if(confirm('Upload this image?')) {
    document.getElementById('loader').innerHTML = "<img src='https://i.imgur.com/pvQ0NaJ.gif' height='12' width='12' alt='' style='border:0;'>";
    oReq.open("POST", "img_upload.php", true);
  }
  else {
    form.reset();
  }
    oReq.onload = function(oEvent) {
      if(oReq.status == 200) {
        var img_url = oReq.responseText;
        if(img_url != '') {
          document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-image' aria-hidden='true' style='color: " + username_color + ";'></i>";
          var atoinp = "[img]" + img_url + "[/img]";
          document.getElementById("fpostb").value = document.getElementById("fpostb").value + atoinp;
          document.getElementById("fpostb").focus();
        }
        else {
          document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-exclamation' aria-hidden='true' style='color: " + username_color + ";'></i>";
        }
        upPosts();
        form.reset();
      }
    };
    oReq.send(oData);
    ev.preventDefault();
  }, false);







  function selectVid() {
    document.getElementById('vBrowse').click();
    document.getElementById('vPath').value = document.getElementById('vBrowse').value;
  }
  var vform = document.forms.namedItem("vidUpl");
  vform.addEventListener('change', function(ev) {
    var username_color = "<?php echo $u_tcolor; ?>";
    var oOutput = document.querySelector("div"),
    oData = new FormData(vform);
    var oReq = new XMLHttpRequest();
    if(confirm('Upload this video?')) {
    document.getElementById('vloader').innerHTML = "<img src='https://i.imgur.com/pvQ0NaJ.gif' height='12' width='12' alt='' style='border:0;'>";
    oReq.open("POST", "vid_upload.php", true);
  }
  else {
    vform.reset();
  }
    oReq.onload = function(oEvent) {
      if(oReq.status == 200) {
        var vid_url = oReq.responseText;
        if(vid_url != '') {
          document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='vPath' class='fa fa-film' aria-hidden='true' style='color: " + username_color + ";'></i>";
          var atoinp = "[video]" + vid_url + "[/video]";
          document.getElementById("fpostb").value = document.getElementById("fpostb").value + atoinp;
          document.getElementById("fpostb").focus();
        }
        else {
          document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='vPath' class='fa fa-exclamation' aria-hidden='true' style='color: " + username_color + ";'></i>";
        }
        upPosts();
        vform.reset();
      }
    };
    oReq.send(oData);
    ev.preventDefault();
  }, false);
  </script>
</body>
</html>
