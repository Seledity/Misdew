<?php
$this_page = "chat";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
/*
if($u_vplus == 'no'){
  header("location: /");
  exit();
}
*/
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
  <title>Chat+ | Misdew.com</title>
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
  .header {
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 4px 4px rgba(0,0,0,0.23);
  }
  form {
    display: inline;
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
    <?php
    echo "<div id=\"csplit_hidden\" style=\"display: none;\"><div id=\"cspl_update\">";
    if($u_csplown == 'yes' && $u_csplit == 'on') {
      echo "<div id=\"cspl_upd\" style=\"width: 95%; max-width: 500px;\">
        no changes detected
      </div>
      <table class=\"cspl_table\" style=\"width: 95%; max-width: 500px;\">
        <tr>
          <td class=\"cspl_title\">
            cSplit Configuration
          </td>
        </tr>
        <tr>
          <td>
            <span class=\"cspl_desc\">The splitting of your username must be exactly the same as your username. It is case sensitive.</span>
          </td>
        </tr>
        <tr>
          <td style=\"padding: 4px; padding-bottom: 0px;\">
            <span id=\"1cspl_nchange1\" style=\"color: $u_cspcolor1 !important; font-weight: bold;\">$u_cspname1</span><span id=\"1cspl_nchange2\" style=\"color: $u_cspcolor2 !important; font-weight: bold;\">$u_cspname2</span><span id=\"1cspl_nchange3\" style=\"color: $u_cspcolor3 !important; font-weight: bold;\">$u_cspname3</span>
            to
            <span id=\"cspl_nchange1\" style=\"color: $u_cspcolor1 !important; font-weight: bold;\">$u_cspname1</span><span id=\"cspl_nchange2\" style=\"color: $u_cspcolor2 !important; font-weight: bold;\">$u_cspname2</span><span id=\"cspl_nchange3\" style=\"color: $u_cspcolor3 !important; font-weight: bold;\">$u_cspname3</span>
          </td>
        </tr>
        <tr>
          <td>
            <span class=\"cspl_desc\">Username Coloration</span>
            <input onkeypress=\"saveColor('1')\" onkeyup=\"saveColor('1')\" autocomplete=\"off\" type=\"text\" id=\"csplitc_1\" name=\"csplitc_1\" class=\"cspl_input\" placeholder=\"First Color [color/hex/rgb]\" value=\"$u_cspcolor1\"> <br>
            <input onkeypress=\"saveColor('2')\" onkeyup=\"saveColor('2')\" autocomplete=\"off\" type=\"text\" id=\"csplitc_2\" name=\"csplitc_2\" class=\"cspl_input\" placeholder=\"Second Color [color/hex/rgb]\" value=\"$u_cspcolor2\"> <br>
            <input onkeypress=\"saveColor('3')\" onkeyup=\"saveColor('3')\" autocomplete=\"off\" type=\"text\" id=\"csplitc_3\" name=\"csplitc_3\" class=\"cspl_input\" placeholder=\"Third Color [color/hex/rgb]\" value=\"$u_cspcolor3\"> <br>
            <span class=\"cspl_desc\">Username Splitting</span>
            <input onkeypress=\"saveName('1')\" onkeyup=\"saveName('1')\" autocomplete=\"off\" type=\"text\" id=\"csplitn_1\" name=\"csplitn_1\" class=\"cspl_input\" placeholder=\"First Split\" value=\"$u_cspname1\"> <br>
            <input onkeypress=\"saveName('2')\" onkeyup=\"saveName('2')\" autocomplete=\"off\" type=\"text\" id=\"csplitn_2\" name=\"csplitn_2\" class=\"cspl_input\" placeholder=\"Second Split\" value=\"$u_cspname2\"> <br>
            <input onkeypress=\"saveName('3')\" onkeyup=\"saveName('3')\" autocomplete=\"off\" type=\"text\" id=\"csplitn_3\" name=\"csplitn_3\" class=\"cspl_input\" placeholder=\"Third Split\" value=\"$u_cspname3\"> <br>
          </td>
        </tr>
      </table>
      <table class=\"cspl_table\" style=\"padding-bottom: 4px; width: 95%; max-width: 500px;\">
        <tr>
          <td onclick=\"updcSpl();\">
            <div class=\"cspl_upd\">Update</div>
          </td>
          <td onclick=\"disablecSpl();\">
            <div class=\"cspl_disable\">Disable</div>
          </td>
        </tr>
      </table> <br>";
    }
    elseif($u_csplown == 'yes' && $u_csplit == 'off') {
      echo "<table class=\"cspl_table\">
        <tr>
          <td class=\"cspl_title\">
            cSplit
          </td>
          </tr>
          <td>
            <span class=\"cspl_desc\">You own cSplit, but it is currently disabled for your account. You can enable it below.</span>
          </td>
          </tr>
        </table>
        <table class=\"cspl_table\" style=\"padding-bottom: 4px;\">
          <tr>
            <td onclick=\"enablecSpl();\">
              <center><div class=\"cspl_enable\">Enable</div></center>
            </td>
          </tr>
        </table> <br>";
    }
    elseif($u_csplown == 'no') {
      $u_totalc = number_format($u_cmsgs);
      echo "<table class=\"cspl_table\">
        <tr>
          <td class=\"cspl_title\">
            cSplit
          </td>
          </tr>
          <td>
            <span class=\"cspl_desc\">This feature is available only to users who have sent a total of 1,000 chat messages. So far, you have sent $u_totalc. Once you have reached that limit, you will be able to purchase cSplit for $5.00 using the command below. Remember, spamming or flooding to meet this limit is against the rules.</span>
          </td>
          </tr>
        </table>
        <table class=\"cspl_table\" style=\"padding-bottom: 4px;\">
          <tr>
            <td class=\"cspl_cmd\">
              <center>/cspl buy $u_username</center>
            </td>
          </tr>
        </table> <br>";
    }
    echo "</div></div>";
    ?>
    <div id="regchat" class="chatd_send" style="display: visible; border-top-right-radius: 1em; border-top-left-radius: 1em;">
      <form id="chats_form" name="chats_form" autocomplete="off">
        <span class="noselect"><i onclick="stopTyping();moreOnlineL('show');goOnline();" class="fa fa-plus" aria-hidden="true" id="chat_more" style="color: #4c4c4c;"></i></span>
        <input onkeypress="isTyping();" onkeyup="isTyping();" name="msg" id="result" class="chat_input" type="text" placeholder="type something..." style="width: 65%;">
        <!--<span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true"></i></span> &nbsp;
        <span id="vloader"><i onclick="var log_conf=confirm('Upload a video? \n MP4 Files Only');if(log_conf == true){selectVid();};" id="vPath" class="fa fa-film" aria-hidden="true" style="color: #fff;"></i></span>-->
        <button class="chat_btn" type="submit" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
        </button>
      </form>
    </div>
    <div id="pmchat" class="chatd_send" style="display: none;">
      <div style="font-family: 'Dosis', sans-serif; text-align: left; color: #4c4c4c; font-size: 12px; font-weight: bold;">
        <?php echo $u_username; ?> <i class="fa fa-arrow-right"></i> <span id="pmuser"></span>
      </div>
      <form id="pmchats_form" name="pmchats_form" autocomplete="off">
        <span onclick="backRegChat();"><i class="fa fa-envelope" aria-hidden="true" style="color: #4c4c4c;"></i></span>
        <input name="pmmsg" id="pmresult" class="chat_input" type="text" placeholder="write a pm..." style="width: 60%;">
        <input type="text" name="pmu" id="pmu" value="" style="display: none;">
        <button class="chat_btn" type="submit" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);">
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
        </button>
      </form>
    </div>
    <div id="show" class="chat_dismore" style="display: none;">
        <center style="padding-bottom: 10px;">
          <button onclick="window.location='/chat';" class="chat_btn" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);border: none;">
            <i class="fa fa-paint-brush" aria-hidden="true"></i>
          </button>
          <button onclick="alert('Attach files from your cloud soon.');" class="chat_btn" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);border: none;">
            <i class="fa fa-cloud" aria-hidden="true"></i>
          </button>
          <form id="imgUpl" name="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
            <input id="fBrowse" name="img" type="file" style="display: none;">
            <button type="button" onclick="selectFile();" id="fPath" class="chat_btn" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);border: none;">
              <span id="loader"><i class="fa fa-image" aria-hidden="true"></i></span>
            </button>
          </form>
          <button onclick="var log_conf=confirm('Upload a video? \n MP4 Files Only');if(log_conf == true){selectVid();};" class="chat_btn" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);border: none;">
            <span id="vloader"><i class="fa fa-film" aria-hidden="true"></i></span>
          </button>
          <button onclick="moreOnlineL('show');moreX('sticker_bar');moreX('sticker_bar_xtra');" class="chat_btn" style="box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);border: none;">
            <i class="fa fa-sticky-note" aria-hidden="true"></i>
          </button> <br>
        </center>
        <div id="online">
        <span class="online_list">
          <?php require("online-dark.php"); ?>
      </div>
        </span>
      <form id="vidUpl" action="vid_upload.php" enctype="multipart/form-data" method="post">
        <input id="vBrowse" name="vid" type="file" style="display: none;">
      </form>
    </div>
    <div style="font-size: 8px; max-width: 500px;width: 95%; background-color: #333333; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
    &nbsp;
    </div>

    <div id="sticker_bar" style="display: none; overflow: scroll; font-size: 12px; max-width: 500px;width: 95%; background-color: #000; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
      <nobr>
        <img onclick="sendSticky('pepe');" src="/img/stickers/pepe.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-punch');" src="/img/stickers/pepe-punch.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-gun1');" src="/img/stickers/pepe-gun1.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-mk');" src="/img/stickers/pepe-mk.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-sad1');" src="/img/stickers/pepe-sad1.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-weetawd');" src="/img/stickers/pepe-weetawd.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-HAHA');" src="/img/stickers/pepe-HAHA.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-eyes');" src="/img/stickers/pepe-eyes.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-k');" src="/img/stickers/pepe-k.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('pepe-grog');" src="/img/stickers/pepe-grog.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('withered');" src="/img/stickers/withered.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('wojak');" src="/img/stickers/wojak.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('lock');" src="/img/stickers/lock.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('roblock');" src="/img/stickers/roblock.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('easter-pepe');" src="/img/stickers/easter-pepe.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('ricardo-smile');" src="/img/stickers/ricardo-smile.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('ricardo');" src="/img/stickers/ricardo.png" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('cow-gif');" src="/img/stickers/yak.gif" alt="" style="height: 40px; width: auto;">
        <img onclick="sendSticky('easter-gif');" src="/img/stickers/easter-gif.gif" alt="" style="height: 40px; width: auto;">
      </nobr>
    </div>
    <div id="sticker_bar_xtra" style="display: none; font-size: 8px; max-width: 500px;width: 95%; background-color: #333333; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
    &nbsp;
    </div>
    <div id="chat" style="box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); border-bottom-left-radius: 1em; border-bottom-right-radius: 1em;">
      <?php require("messages-dark.php"); ?>
    </div>
    <div id="typingstop" style="display: none"></div>
      <script src="https://misdew.com/jquery.min.js"></script>
      <script>
      function attack(u,a,c) {
        var username = u;
        var attack_type = a;
        var mdf_cost = c;
        var token = "<?php echo $u_token; ?>";
        var msg = attack_type + " " + username + "? [-" + mdf_cost + " MDF]";
        if(confirm(msg)) {
          $.ajax({
          url: 'attack.php',
          type: 'POST',
          data: { u: u, token: token, a: a },
          });
        }
      }
      function writePM(u) {
        var msg = "Write PMs with " + u + "?";
        //if(confirm(msg)) {
          $("#pmu").val(u);
          document.getElementById("pmresult").placeholder = "write a pm to " + u + "...";
          document.getElementById('pmuser').innerHTML = u;
          $("#regchat").slideUp(500);
          $("#pmchat").slideDown(500);
          window.scrollTo(0, 0);
        //}
      }
      function backRegChat(u) {
        //var msg = "Return to regular Chat?";
        //if(confirm(msg)) {
          $("#pmchat").slideUp(500);
          $("#regchat").slideDown(500);
          document.getElementById('pmuser').innerHTML = "";
          document.getElementById("pmresult").placeholder = "write a pm...";
        //}
      }
      function moreOnlineL(id) {
        var e = document.getElementById(id);
        if(e.style.display == '') {
          $("#show").slideUp(500);
          document.getElementById('chat_more').className = "fa fa-plus";
        }
        else {
          $("#show").slideDown(500);
          e.style.display = '';
          document.getElementById('chat_more').className = "fa fa-times";
        }
      }
      function chatSubmit() {
        document.getElementsByName("chats_form")[0].submit();
      }
      function isTyping() {
        //var token = "<?php echo $u_token; ?>";
        //var typing = "yes";
          //$.ajax({
          //url: 'typing.php',
          //type: 'POST',
          //data: { token: token, typing: typing },
          //});
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
        upChat();
      }
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
        csplBox();
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
      function stopTyping() {
        //$.get("typing_stop.php", function(d) {
          //$("#typingstop").html(d);
        //});
      };
      //setInterval('stopTyping()', 10000);
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
        $.get("messages-dark.php", function(d) {
          $("#chat").html(d);
        });
      }
      setInterval('upChat()', 3000);
      function upOnline() {
        $.get("online-dark.php", function(d) {
          $("#online").html(d);
        });
      }
      setInterval('upOnline()', 3000);
      $("#chats_form").submit(function(e){
        e.preventDefault();
        if($("input[name=msg]").val().trim() == "")
        return;
        $.post("send.php", {body: $("input[name=msg]").val(), submit: "send"}, function(data) {
          if(data != '') {
            upChat();
            //stopTyping();
          }
          else {
            upChat();
            //stopTyping();
          }
        });
        $("input[name=msg]").val("");
      });


      $("#pmchats_form").submit(function(e){
        e.preventDefault();
        if($("input[name=pmmsg]").val().trim() == "")
        return;
        $.post("pm_send.php", {pmbody: $("input[name=pmmsg]").val(), pmu: $("input[name=pmu]").val(), submit: "send"}, function(data) {
          if(data != '') {
            upChat();
          }
          else {
            upChat();
          }
        });
        $("input[name=pmmsg]").val("");
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
              document.getElementById('loader').innerHTML = "<i class='fa fa-image' aria-hidden='true'></i>";
            else
              document.getElementById('loader').innerHTML = "<i class='fa fa-exclamation fa-lg' aria-hidden='true'></i>";
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
              document.getElementById('vloader').innerHTML = "<i class='fa fa-film' aria-hidden='true'></i>";
            else
              document.getElementById('vloader').innerHTML = "<i class='fa fa-exclamation fa-lg' aria-hidden='true'></i>";
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
