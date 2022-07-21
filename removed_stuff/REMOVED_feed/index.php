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
if($u_siteloc != '/feed') {
  $loc_desc = "browsin\' feed";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/feed' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Feed - Misdew</title>
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
  </style>
</head>
<body onload="resetPosts();">
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
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
        <div id="pollForm" style="display: none;">
          <table class="postbox_tb" style="padding-top: 0px; text-align: left; color: #000; font-family: 'Dosis', sans-serif; background-color: #e5e5e5;">
            <tr>
              <td>
                <span style="font-size: 12px;">Make sure to put something in the textbox above. You can add up to five options; leave the other fields blank if you don't want to use all five [2 required]. Once done, post like normal.</span>
              </td>
            </tr>
          </table>
          <table class="postbox_tb" style="padding-top: 0px; padding-bottom: 0px; text-align: left; color: #fff; font-family: 'Dosis', sans-serif;">
            <tr>
              <td style="border-bottom: 1px solid #fff;">
                <textarea id="pollquest" name="pollquest" rows="3" class="feed_parea" placeholder="type poll question..." style="padding-bottom: 0px;"></textarea>
              </td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #fff;">
                <textarea id="pollopt1" name="pollopt1" rows="1" class="feed_parea" placeholder="* type poll option [1]..." style="padding-bottom: 0px;"></textarea>
              </td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #fff;">
                <textarea id="pollopt2" name="pollopt2" rows="1" class="feed_parea" placeholder="* type poll option [2]..." style="padding-bottom: 0px;"></textarea>
              </td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #fff;">
                <textarea id="pollopt3" name="pollopt3" rows="1" class="feed_parea" placeholder="type poll option [3]..." style="padding-bottom: 0px;"></textarea>
              </td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #fff;">
                <textarea id="pollopt4" name="pollopt4" rows="1" class="feed_parea" placeholder="type poll option [4]..." style="padding-bottom: 0px;"></textarea>
              </td>
            </tr>
            <tr>
              <td>
                <textarea id="pollopt5" name="pollopt5" rows="1" class="feed_parea" placeholder="type poll option [5]..." style="padding-bottom: 0px;"></textarea>
              </td>
            </tr>
          </table>
        </div>
      </form>
      <table id="fd_more" style="display: none;">
        <tr>
          <td style="width: 33.333%;">
            <i class="fa fa-bar-chart" aria-hidden="true" onclick="attachPoll();"></i>
          </td>
          <td style="width: 33.333%;">
            <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
              <input id="fBrowse" name="img" type="file" style="display: none;">
            </form>
            <form id="vidUpl" action="vid_upload.php" enctype="multipart/form-data" method="post">
              <input id="vBrowse" name="vid" type="file" style="display: none;">
            </form>
            <i class="fa fa-refresh" aria-hidden="true" onclick="upPosts();refreshP();" id="post_refresh"></i>
          </td>
          <td class="postbox2_td" style="width: 33.333%;">
            <span id="vloader"><i onclick="var log_conf=confirm('Upload a video? \n MP4 Files Only');if(log_conf == true){selectVid();};" id="vPath" class="fa fa-film" aria-hidden="true"></i></span>
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
    <?php
    echo "<div id=\"ld_posts\">";
    require_once("posts.php");
    echo "</div>";
    $cntq = mysqli_query($conx, "SELECT * FROM feed");
    $count = mysqli_num_rows($cntq);
    if($count > 10) {
      echo "<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>";
    }
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function attachPoll() {
    if(confirm('Would you like to create a poll for this post? \n Polls are currently in beta. \n Time limits cannot be set yet.')) {
      expand('pollForm');
    }
  }
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







  function selectVid() {
    document.getElementById('vBrowse').click();
    document.getElementById('vPath').value = document.getElementById('vBrowse').value;
  }
  var vform = document.forms.namedItem("vidUpl");
  vform.addEventListener('change', function(ev) {
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
          document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='vPath' class='fa fa-film' aria-hidden='true'></i>";
          var atoinp = "[video]" + vid_url + "[/video]";
          document.getElementById("fpostb").value = document.getElementById("fpostb").value + atoinp;
          document.getElementById("fpostb").focus();
        }
        else {
          document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='vPath' class='fa fa-exclamation' aria-hidden='true'></i>";
        }
        upPosts();
        vform.reset();
      }
    };
    oReq.send(oData);
    ev.preventDefault();
  }, false);












  $("#feed_form").submit(function(e){
    e.preventDefault();
    if($("textarea[name=post]").val().trim() == "")
    return;
    $.post("ppost.php", {
      body: $("textarea[name=post]").val(),
      pollquest: $("textarea[name=pollquest]").val(),
      pollopt1: $("textarea[name=pollopt1]").val(),
      pollopt2: $("textarea[name=pollopt2]").val(),
      pollopt3: $("textarea[name=pollopt3]").val(),
      pollopt4: $("textarea[name=pollopt4]").val(),
      pollopt5: $("textarea[name=pollopt5]").val(),
      submit: "send"}, function(data) {
      if(data != '') {
        upPosts();
        writePost();
        refreshP();
      }
      else {
        upPosts();
        writePost();
        refreshP();
      }
    });
    refreshP();
    upPosts();
    $("textarea[name=post]").val("");
    upPosts();
    writePost();
    refreshP();
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
        xhr.open("GET", "like.php?id=" + btn.id.match(/([0-9]*)$/)[0] + "&_t=" + Math.random() + "&token=<?php echo $u_token; ?>", true);
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
              count.innerHTML = a.responseText;
              updInfosies(btn.id.match(/([0-9]*)$/)[0]);
              //alert("error");
              //count.innerHTML = "error";
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
        xhr.open("GET", "dislike.php?id=" + btn.id.match(/([0-9]*)$/)[0] + "&_t=" + Math.random() + "&token=<?php echo $u_token; ?>", true);
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
              count.innerHTML = a.responseText;
              updInfosies(btn.id.match(/([0-9]*)$/)[0]);
              //alert("error");
              //count.innerHTML = "error";
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
                upPosts();
                UpMPcmts();
                refreshP();
              }
          };
          dto.send();
          upPosts();
          UpMPcmts();
          refreshP();
          return false;
        }
      };
    });
    </script>
  </div>
</body>
</html>
