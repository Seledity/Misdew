<?php
require_once("../inc/conx.php");
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows($cvo_slc = mysqli_query($conx, "SELECT id,rank FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  echo "<div class=\"mail_cont\"><br><span class=\"no_mail\">You do not belong to this conversation.</span><br><br></div>";
  exit();
}
$cvo_rw = mysqli_fetch_array($cvo_slc);
$cvo_rank = $cvo_rw['rank'];
$cv_sel = mysqli_query($conx, "SELECT name,picture,main_color,main_color,can_add FROM mail_convo WHERE uqid='$cv_uqid'");
$cv_row = mysqli_fetch_assoc($cv_sel);
$string = $cv_row['name'];
$cv_name = $cv_row['name'];
$cv_pic = $cv_row['picture'];
$cv_color = $cv_row['main_color'];
$can_add = $cv_row['can_add'];
include("../inc/replace.php");
if($can_add == 'yes') {
  $yes_add = " selected";
}
else {
  $no_add = " selected";
}
echo "<div id=\"changes_update\" class=\"convo_settings\">no changes detected</div>";
echo "<div class=\"mail_cont\"><span id=\"convo_nameu\" style=\"font-weight: bold; color: $cv_color;\">$string</span> <br> <img id=\"convo_imgu\" src=\"$cv_pic\" alt=\"\" class=\"mail_picture\" style=\"display: block; height: 80px; width: 80px; border: 2px solid transparent;\"></div>";
if($cvo_rank == 'admin') {
  echo "<div class=\"mail_cont\" style=\"text-align: left;\">
  <table style=\"width: 100%; text-align: left;\"><tr><td id=\"sub_settings_admin\" style=\"color: $cv_color; font-weight: bold; font-size: 14px;\">Admin</td></tr></table>
  <table><tr>
  <td>
  <select id=\"memberAdd\" onchange=\"memberAdd();\">
  <option value=\"yes\"$yes_add>\"Add member\" on</option>
  <option value=\"no\"$no_add>\"Add member\" off</option>
  </select>
  </td>
  </tr></table>
  </div>";
}
echo "<div class=\"mail_cont\" style=\"text-align: left;\">
<table style=\"width: 100%; text-align: left;\"><tr><td id=\"sub_settings_pref\" style=\"color: $cv_color; font-weight: bold; font-size: 14px;\">Preferences</td></tr></table>
<span class=\"convo_settings\">Name</span> <br>
<input onkeyup=\"saveName()\" onkeypress=\"saveName()\" id=\"cv_name\" type=\"text\" value=\"$cv_name\" placeholder=\"Convo Name\" class=\"mail_convo_settings\">
<span class=\"convo_settings\">Picture</span> <br>
&nbsp; <span onclick=\"selectFile();\" id=\"pPath\"><i class=\"fa fa-paperclip\" aria-hidden=\"true\"></i> Select a Photo</span> <br>
<form id=\"imgUpl\" action=\"picture_upl.php\" enctype=\"multipart/form-data\" method=\"post\">
<input id=\"fBrowse\" name=\"img\" type=\"file\" style=\"display: none;\">
</form>
<span class=\"convo_settings\">Color</span> <br>
<input onkeyup=\"saveColor()\" onkeypress=\"saveColor()\" id=\"cv_color\" type=\"text\" value=\"$cv_color\" placeholder=\"Convo Color\" class=\"mail_convo_settings\">
</div>";
echo "<div class=\"convo_settings\" style=\"font-size: 10px;\">hit enter to ensure save <br> all fields required to function <br> emoji in name &rarr; tap settings to see</div>";
?>
<script>
function memberAdd() {
  var selectBox = document.getElementById("memberAdd");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "convo_settings_save.php?i=<?php echo $cv_uqid; ?>&&memb_add=" + selectedValue, true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        document.getElementById('changes_update').innerHTML = "changes saved";
      }
      else {
        alert("error");
      }
    };
  xhr.send();
  document.getElementById('changes_update').innerHTML = "saving changes..";
  return false;
}
function saveName() {
  var cv_name = $("#cv_name").val();
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "convo_settings_save.php?i=<?php echo $cv_uqid; ?>&&cv_name=" + encodeURIComponent(cv_name), true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        document.getElementById('changes_update').innerHTML = "changes saved";
        document.getElementById("convo_nameu").innerHTML = cv_name;
      }
      else {
        alert("error");
      }
    };
  xhr.send();
  document.getElementById('changes_update').innerHTML = "saving changes..";
  return false;
}
function selectFile() {
  document.getElementById('fBrowse').click();
  document.getElementById('pPath').value = document.getElementById('fBrowse').value;
}
var form = document.forms.namedItem("imgUpl");
form.addEventListener('change', function(ev) {
  var oOutput = document.querySelector("div"),
  oData = new FormData(form);
  var oReq = new XMLHttpRequest();
  document.getElementById('changes_update').innerHTML = "saving changes..";
  oReq.open("POST", "picture_upl.php?i=<?php echo $cv_uqid; ?>", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      var cnv_pic = oReq.responseText;
      if(cnv_pic != '') {
        document.getElementById("convo_imgu").src = cnv_pic;
        document.getElementById('changes_update').innerHTML = "changes saved";
      }
      else {
        document.getElementById('changes_update').innerHTML = "save failed";
        form.reset();
      }
    }
  };
  oReq.send(oData);
  ev.preventDefault();
}, false);
function saveColor() {
  var cv_color = $("#cv_color").val();
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "convo_settings_save.php?i=<?php echo $cv_uqid; ?>&&cv_color=" + encodeURIComponent(cv_color), true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        document.getElementById('changes_update').innerHTML = "changes saved";
        document.getElementById('sub_settings_admin').style.color = cv_color;
        document.getElementById('sub_settings_pref').style.color = cv_color;
        document.getElementById("convo_nameu").style.color = cv_color;
      }
      else {
        alert("error");
      }
    };
  xhr.send();
  document.getElementById('changes_update').innerHTML = "saving changes..";
  return false;
}
</script>
