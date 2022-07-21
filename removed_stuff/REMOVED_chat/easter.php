<?php
$this_page = "chat";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// update online time
mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp' WHERE uid='$u_uid'");
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/chat') {
  $loc_desc = "stalkin\' the chat";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/chat' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chat - Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="#FFC4FE">
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
  ::-webkit-input-placeholder {
  color: #51996b;
}
:-moz-placeholder {
  color: #51996b;
  opacity: 1;
}
::-moz-placeholder {
  color: #51996b;
  opacity: 1;
}
:-ms-input-placeholder {
  color: #51996b;
}
#mdLink {
  color: #827a99 !important;
}
  body {
    background-color: #fff !important;
  }
  #vPath {
    color: #51996b;
  }
  #fPath {
    color: #51996b;
  }
  #color_go {
    color: #6d667f;
  }
  #color_slow {
    color: #6d667f;
  }
  #color_dead {
    color: #6d667f;
  }
  .header {
    background-color: #FFC4FE !important;
    border-bottom: 1px solid #b289b1;
  }
  #header_tds {
    color: #b289b1 !important;
  }
  .chatd_send {
    background-color: #87FFB3 !important;
    border: 1px solid #51996b;
  }
  .chat_input {
    background-color: #87FFB3 !important;
    color: #51996b !important;
  }
  .chat_btn {
    background-color: #87FFB3 !important;
    color: #51996b !important;
    border: 1px solid #51996b !important;
  }
  #chat {
    background-color: #DACCFF !important;
    border: 1px solid #827a99;
  }
  #show {
    background-color: #DACCFF !important;
    border: 1px solid #827a99;
  }
  .online_list {
    color: #6d667f !important;
  }
  .onl_username {
    color: #6d667f !important;
  }
  .darkmd {
    color: #6d667f !important;
  }
  </style>
</head>
<body onload="goOnline()">
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
    <div class="chatd_send">
      <form id="chats_form" autocomplete="off">
        <span class="noselect"><i onclick="more('show');goOnline();" class="fa fa-plus" aria-hidden="true" id="chat_more" style="color: #51996b !important;"></i></span>
        <input name="msg" id="result" class="chat_input" type="text" placeholder="type something...">
        <span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true" style="color: #51996b !important;"></i></span> &nbsp;
        <span id="vloader"><i onclick="var log_conf=confirm('Upload a video? \n MP4 Files Only');if(log_conf == true){selectVid();};" id="vPath" class="fa fa-film" aria-hidden="true" style="color: #51996b;"></i></span>
        <input class="chat_btn" type="submit" value="send">
      </form>
    </div>
    <div id="show" class="chat_dismore" style="display: none;">
      <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
        <input id="fBrowse" name="img" type="file" style="display: none;">
        <div id="online">
        <span class="online_list">
          <?php require("online-easter.php"); ?>
      </div>
        </span>
      </form>
      <form id="vidUpl" action="vid_upload.php" enctype="multipart/form-data" method="post">
        <input id="vBrowse" name="vid" type="file" style="display: none;">
      </form>
      <?php
      if($u_chatdark_def == 'no') {
        echo "<center onclick=\"window.location='/chat';\" style=\"color: #7f7f7f;font-size: 12px; font-weight: bold;\">Tap here to switch to Classic Mode.</center>";
      }
      else {
        echo "<center onclick=\"window.location='/settings';\" style=\"color: #7f7f7f;font-size: 12px; font-weight: bold;\">Disable Forced Dark Mode to switch to Classic Mode.</center>";
      }
      echo "<br><center onclick=\"fullscmode();\" style=\"color: #7f7f7f;font-size: 12px; font-weight: bold;\">Tap here to enter Full Screen.</center>";
      ?>
    </div>
    <div style="font-size: 8px; max-width: 500px;width: 95%; background-color: #51996b; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
    &nbsp;
    </div>
    <div id="chat">
      <?php require("messages-easter.php"); ?>
    </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script>
      function fullscmode() {
      addEventListener("click", function() {
          var
                el = document.documentElement
              , rfs =
                     el.requestFullScreen
                  || el.webkitRequestFullScreen
                  || el.mozRequestFullScreen
          ;
          rfs.call(el);
      });
    }
      function enablecSpl() {
        var enable_cspl = "yes";
        $.ajax({
        url: 'toggle_cspl.php',
        type: 'POST',
        data: { enable_cspl: enable_cspl },
        });
        csplBox();
      }
      function disablecSpl() {
        var enable_cspl = "no";
        $.ajax({
        url: 'toggle_cspl.php',
        type: 'POST',
        data: { enable_cspl: enable_cspl },
        });
        csplBox();
      }
      function purchcSpl() {

      }
      function csplBox() {
        $.get("csplit_box.php", function(d) {
          $("#cspl_update").html(d);
        });
      }
      function updcSpl() {
        var split_color1 = $("#csplitc_1").val();
        var split_color2 = $("#csplitc_2").val();
        var split_color3 = $("#csplitc_3").val();
        var split_name1 = $("#csplitn_1").val();
        var split_name2 = $("#csplitn_2").val();
        var split_name3 = $("#csplitn_3").val();
        document.getElementById('cspl_upd').innerHTML = "saving changes..";
        $.ajax({
        url: 'save.php',
        type: 'POST',
        data: { split_color1: split_color1, split_color2: split_color2, split_color3: split_color3, split_name1: split_name1, split_name2: split_name2, split_name3: split_name3 },
        success: function(data){
          if(data == '') {
            document.getElementById('cspl_upd').innerHTML = "changes saved";
            document.getElementById("1cspl_nchange1").style.color = split_color1;
            document.getElementById("1cspl_nchange2").style.color = split_color2;
            document.getElementById("1cspl_nchange3").style.color = split_color3;
            document.getElementById("1cspl_nchange1").style.color = split_name1;
            document.getElementById("1cspl_nchange2").style.color = split_name2;
            document.getElementById("1cspl_nchange3").style.color = split_name3;
          }
        },
        error: function(data) {
          document.getElementById('cspl_upd').innerHTML = "save failed <br> make sure username split is exact match";
        }
      });
      }
      function saveColor(i) {
        var split_id = "#csplitc_" + i;
        var split_color = $(split_id).val();
        var split_namei = "cspl_nchange" + i;
        document.getElementById(split_namei).style.color = split_color;
      }
      function saveName(i) {
        var split_id = "#csplitn_" + i;
        var split_name = $(split_id).val();
        var split_namei = "cspl_nchange" + i;
        document.getElementById(split_namei).innerHTML = split_name;
      }
      window.onfocus = function() {
        $.get("online_upd.php", function(d) {
          $("#onlupd").html(d);
        });
      };
      function goOnline() {
        $.get("online_upd.php", function(d) {
          $("#onlupd").html(d);
        });
      };
      function more(id) {
        var e = document.getElementById(id);
        if(e.style.display == '') {
          e.style.display = 'none';
          document.getElementById('chat_more').className = "fa fa-plus";
        }
        else {
          e.style.display = '';
          document.getElementById('chat_more').className = "fa fa-times";
        }
      }
      function sendBox(num) {
        var txt=document.getElementById("result").value;
        txt=txt + num;
        document.getElementById("result").value=txt;
        document.getElementById("result").focus();
      }
      function selectFile() {
        document.getElementById('fBrowse').click();
        document.getElementById('fPath').value = document.getElementById('fBrowse').value;
      }
      function selectVid() {
        document.getElementById('vBrowse').click();
        document.getElementById('vPath').value = document.getElementById('vBrowse').value;
      }
      function upChat() {
        $.get("messages-easter.php", function(d) {
          $("#chat").html(d);
        });
      }
      setInterval('upChat()', 1000);
      function upOnline() {
        $.get("online-easter.php", function(d) {
          $("#online").html(d);
        });
      }
      setInterval('upOnline()', 1000);
      $("#chats_form").submit(function(e){
        e.preventDefault();
        if($("input[name=msg]").val().trim() == "")
        return;
        $.post("send.php", {body: $("input[name=msg]").val(), submit: "send"}, function(data) {
          if(data != '') {
            upChat();
          }
          else {
            upChat();
          }
        });
        $("input[name=msg]").val("");
      });
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
          if (oReq.status == 200) {
            var cht_pic = oReq.responseText;
            upChat();
            if (cht_pic != '')
              document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-paperclip fa-lg' aria-hidden='true'></i>";
            else
              document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-exclamation fa-lg' aria-hidden='true'></i>";
            form.reset();
          }
        };
        oReq.send(oData);
        ev.preventDefault();
      }, false);
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
          if (oReq.status == 200) {
            var cht_pic = oReq.responseText;
            upChat();
            if (cht_pic != '')
              document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='vPath' class='fa fa-film' aria-hidden='true'></i>";
            else
              document.getElementById('vloader').innerHTML = "<i onclick='selectVid();' id='vPath' class='fa fa-exclamation fa-lg' aria-hidden='true'></i>";
            vform.reset();
          }
        };
        oReq.send(oData);
        ev.preventDefault();
      }, false);
    </script>
    <div id="onlupd"></div>
    <?php
    echo "<br>";
    echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-size: 12px;\">Chat is not private or secure. Your messages and PMs can/may be read at any time. <br> They are stored in plaintext on our server. <br></span>";
    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
