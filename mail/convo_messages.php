<?php
$this_page = "mail";
require_once("../inc/conx.php");
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  echo "<div class=\"mail_cont\"><br><span class=\"no_mail\">You do not belong to this conversation.</span><br><br></div>";
  exit();
}
?>
<div class="maild_send">
  <form id="chats_form" autocomplete="off">
    <span class="noselect"><i onclick="more('show');goOnline();" class="fa fa-plus" aria-hidden="true" id="chat_more"></i></span>
    <input name="msg" id="result" class="mail_input" type="text" placeholder="type something...">
    <span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true"></i></span>
    <input class="mail_btn" type="submit" value="send">
  </form>
</div>
<div id="show" class="mail_dismore" style="display: none;">
  <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
    <input id="fBrowse" name="img" type="file" style="display: none;">
    <div id="online">
      <?php require_once("online.php"); ?>
    </div>
  </form>
</div>
<div id="chat">
  <?php require_once("convo_msgs.php"); ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
window.onfocus = function() {
  $.get("online_upd.php?i=<?php echo $cv_uqid; ?>", function(d) {
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
function upChat() {
  $.get("convo_msgs.php?i=<?php echo $cv_uqid; ?>", function(d) {
    $("#chat").html(d);
  });
}
setInterval('upChat()', 1000);
function upOnline() {
  $.get("online.php?i=<?php echo $cv_uqid; ?>", function(d) {
    $("#online").html(d);
  });
}
setInterval('upOnline()', 1000);
$("#chats_form").submit(function(e){
  e.preventDefault();
  if($("input[name=msg]").val().trim() == "")
  return;
  $.post("send.php?i=<?php echo $cv_uqid; ?>", {body: $("input[name=msg]").val(), submit: "send"}, function(data) {
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
  oReq.open("POST", "img_upload.php?i=<?php echo $cv_uqid; ?>", true);
}
else {
  form.reset();
}
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      upChat();
      document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-paperclip fa-lg' aria-hidden='true'></i>";
      form.reset();
    }
  };
  oReq.send(oData);
  ev.preventDefault();
}, false);
</script>
