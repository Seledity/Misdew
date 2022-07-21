<?php
$this_page = "chat";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_chatdark_def == 'yes'){
  header("location: /chat/dark.php");
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
if($chat_dark == 'yes') {
  $darkdidbuy = "switch to";
}
else {
  $darkdidbuy = "buy";
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
  #mdLink {
    color: #fff !important;
  }
  body {
    background-color: <?php echo $bgcolor; ?>;
  }
  #header_tds {
    color: <?php echo $tdcolor; ?> !important;
  }
  #vPath {
    color: #fff !important;
  }
  </style>
</head>
<body onload="goOnline()">
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header-v6.php");
    ?>
    <?php
    echo "<div id=\"csplit_hidden\" style=\"display: none;\"><div id=\"cspl_update\">";
    if($u_csplown == 'yes' && $u_csplit == 'on') {
      echo "<div id=\"cspl_upd\" style=\"width: 80%; max-width: 350px;\">
        no changes detected
      </div>
      <table class=\"cspl_table\">
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
      <table class=\"cspl_table\" style=\"padding-bottom: 4px;\">
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
    <div class="chatd_send" style="box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
      <form id="chats_form" autocomplete="off">
        <span class="noselect"><i onclick="more('show');goOnline();" class="fa fa-plus" aria-hidden="true" id="chat_more"></i></span>
        <input name="msg" id="result" class="chat_input" type="text" placeholder="type something...">
        <span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true"></i></span> &nbsp;
        <span id="vloader"><i onclick="var log_conf=confirm('Upload a video? \n MP4 Files Only');if(log_conf == true){selectVid();};" id="vPath" class="fa fa-film" aria-hidden="true" style="color: #fff;"></i></span>
        <input class="chat_btn" type="submit" value="send" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
      </form>
    </div>
    <div id="show" class="chat_dismore" style="display: none;">
      <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
        <input id="fBrowse" name="img" type="file" style="display: none;">
        <div id="online">
        <span class="online_list">
          <?php require("online.php"); ?>
      </div>
        </span>
      </form>
      <form id="vidUpl" action="vid_upload.php" enctype="multipart/form-data" method="post">
        <input id="vBrowse" name="vid" type="file" style="display: none;">
      </form>
      <center onclick="window.location='dark.php';" style="font-size: 12px; font-weight: bold;">Tap here to <?php echo $darkdidbuy; ?> Dark Mode.</center>
      <br><center onclick="fullscmode();" style="font-size: 12px; font-weight: bold;">Tap here to enter Full Screen.</center>
    </div>
    <div style="font-size: 8px; max-width: 500px;width: 95%; background-color: #e5365a; padding: 0px; padding-top: 0px; padding-bottom: 0px;">
    &nbsp;
    </div>
    <div id="chat" style="box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);">
      <?php require("v6-messages.php"); ?>
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
        $.get("v6-messages.php", function(d) {
          $("#chat").html(d);
        });
      }
      setInterval('upChat()', 1000);
      function upOnline() {
        $.get("online.php", function(d) {
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
