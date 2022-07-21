<?php
$this_page = "feed";
require_once("../../inc/conx.php");
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
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81238250-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-81238250-2');
</script>

</head>
<center>
    <?php

    require_once("posts.php");

    /*$cntq = mysqli_query($conx, "SELECT * FROM feed");
    $count = mysqli_num_rows($cntq);
    if($count > 10) {
      echo "<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>";
    }*/
    //require_once("../../inc/footer.php");
    ?>
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
    if(confirm('Upload this video? \n MP4 Files Only')) {
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
          document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='fPath' class='fa fa-paperclip fa-lg' aria-hidden='true'></i>";
          var atoinp = "[video]" + vid_url + "[/video]";
          document.getElementById("fpostb").value = document.getElementById("fpostb").value + atoinp;
          document.getElementById("fpostb").focus();
        }
        else {
          document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='fPath' class='fa fa-exclamation' aria-hidden='true'></i>";
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
    $.post("ppost.php", {body: $("textarea[name=post]").val(), submit: "send"}, function(data) {
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
