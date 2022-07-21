<?php
$this_page = "chat";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($chat_dark == "no") {
  echo "You do not own Dark Mode for Chat. <br> You can purchase it here. <br> Cost: 50.00 MDF <br><br>";
  if($u_funds >= 50) {
    echo "<a onclick=\"return confirm('Are you sure?');\" href=\"buy-dark.php?t=$u_token\">BUY NOW</a>";
  }
  else {
    echo "<a href=\"/chat\">YOU DO NOT HAVE ENOUGH MDF <br><br> TAP TO GO BACK</a>";
  }
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
  <meta name="theme-color" content="#000">
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
  color: #333333;
}
:-moz-placeholder {
  color: #333333;
  opacity: 1;
}
::-moz-placeholder {
  color: #333333;
  opacity: 1;
}
:-ms-input-placeholder {
  color: #333333;
}
#mdLink {
  color: #333 !important;
}
  body {
    background-color: #000 !important;
  }
  #vPath {
    color: #333;
  }
  #fPath {
    color: #333;
  }
  #color_go {
    color: #b2b2b2;
  }
  #color_slow {
    color: #7f7f7f;
  }
  #color_dead {
    color: #4c4c4c;
  }
  .header {
    background-color: #000 !important;
    border-bottom: 1px solid #333333;
  }
  #header_tds {
    color: #333333 !important;
  }
  .chatd_send {
    background-color: #000 !important;
    border: 1px solid #333333;
  }
  .chat_input {
    background-color: #000 !important;
    color: #7f7f7f !important;
  }
  .chat_btn {
    background-color: #000 !important;
    color: #4c4c4c !important;
    border: 1px solid #4c4c4c !important;
  }
  #chat {
    background-color: #000 !important;
    border: 1px solid #333333;
  }
  #show {
    background-color: #000 !important;
    border: 1px solid #333333;
  }
  .online_list {
    color: #7f7f7f !important;
  }
  .onl_username {
    color: #7f7f7f !important;
  }
  .darkmd {
    color: #7f7f7f !important;
  }
  </style>
</head>
<body onload="goOnline()">
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header-dark.php");
    ?>
    <div class="chatd_send">
      <form id="chats_form" autocomplete="off">
        <span class="noselect"><i onclick="stopTyping();more('show');goOnline();" class="fa fa-plus" aria-hidden="true" id="chat_more" style="color: #333333 !important;"></i></span>
        <input onkeypress="isTyping();" onkeyup="isTyping();" name="msg" id="result" class="chat_input" type="text" placeholder="type something..." style="width: 50%;">
        <span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true" style="color: #333333 !important;"></i></span> &nbsp;
        <span id="vloader"><i onclick="var log_conf=confirm('Upload a video? \n MP4 Files Only');if(log_conf == true){selectVid();};" id="vPath" class="fa fa-film" aria-hidden="true" style="color: #333;"></i></span>
        <input class="chat_btn" type="submit" value="send">
      </form>
    </div>
    <div id="show" class="chat_dismore" style="display: none;">
      <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
        <input id="fBrowse" name="img" type="file" style="display: none;">
        <div id="online">
        <span class="online_list">
          <?php require("online-dark.php"); ?>
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
    <div style="font-size: 8px; max-width: 500px;width: 95%; background-color: #333333; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
    &nbsp;
    </div>
    <div id="sticker_bar" style="display: none; overflow: scroll; font-size: 12px; max-width: 500px;width: 95%; background-color: #000; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
      <nobr>
        <img onclick="sendSticky('pepe');" src="/img/stickers/pepe.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-punch');" src="/img/stickers/pepe-punch.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-gun1');" src="/img/stickers/pepe-gun1.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-mk');" src="/img/stickers/pepe-mk.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-sad1');" src="/img/stickers/pepe-sad1.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-weetawd');" src="/img/stickers/pepe-weetawd.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-HAHA');" src="/img/stickers/pepe-HAHA.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-eyes');" src="/img/stickers/pepe-eyes.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-k');" src="/img/stickers/pepe-k.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('pepe-grog');" src="/img/stickers/pepe-grog.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('withered');" src="/img/stickers/withered.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('wojak');" src="/img/stickers/wojak.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('lock');" src="/img/stickers/lock.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('easter-pepe');" src="/img/stickers/easter-pepe.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('ricardo-smile');" src="/img/stickers/ricardo-smile.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('ricardo');" src="/img/stickers/ricardo.png" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('cow-gif');" src="/img/stickers/yak.gif" alt="" style="height: 50px; width: auto;">
        <img onclick="sendSticky('easter-gif');" src="/img/stickers/easter-gif.gif" alt="" style="height: 50px; width: auto;">
      </nobr>
    </div>
    <div id="sticker_bar_xtra" style="display: none; font-size: 8px; max-width: 500px;width: 95%; background-color: #333333; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
    &nbsp;
    </div>
    <div id="chat">
      <?php require("dark-messages.php"); ?>
    </div>
    <div id="typingstop" style="display: none"></div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script>
      function isTyping() {
        var token = "<?php echo $u_token; ?>";
        var typing = "yes";
          $.ajax({
          url: 'typing.php',
          type: 'POST',
          data: { token: token, typing: typing },
          });
      }
      function stopTyping() {
        $.get("typing_stop.php", function(d) {
          $("#typingstop").html(d);
        });
      };
      setInterval('stopTyping()', 10000);
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
      function sendSticky(i) {
        var token = "<?php echo $u_token; ?>";
        var msg = "Send the " + i + " sticker?";
        if(confirm(msg)) {
          $.ajax({
          url: 'send_sticky.php',
          type: 'POST',
          data: { stickyid: i, token: token },
          });
        }

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
      function moreX(id) {
        var e = document.getElementById(id);
        if(e.style.display == '') {
          e.style.display = 'none';
          document.getElementById('chat_more').className = "fa fa-plus";
        }
        else {
          e.style.display = '';
          document.getElementById('chat_more').className = "fa fa-plus";
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
        $.get("dark-messages.php", function(d) {
          $("#chat").html(d);
        });
      }
      setInterval('upChat()', 3000);
      function upOnline() {
        $.get("online-dark.php", function(d) {
          $("#online").html(d);
        });
      }
      setInterval('upOnline()', 5000);
      $("#chats_form").submit(function(e){
        e.preventDefault();
        if($("input[name=msg]").val().trim() == "")
        return;
        $.post("send.php", {body: $("input[name=msg]").val(), submit: "send"}, function(data) {
          if(data != '') {
            upChat();
            stopTyping();
          }
          else {
            upChat();
            stopTyping();
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
