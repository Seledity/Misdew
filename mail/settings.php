<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
# WHO CAN MAIL
if($u_can_mail == 'friends') {
  $friends_can = "selected";
}
if($u_can_mail == 'anyone') {
  $anyone_can = "selected";
}
if($u_can_mail == 'nobody') {
  $nobody_can = "selected";
}
# CONVO DETAIL GENERATION
if($u_mail_rand == 'on') {
  $random_det = "selected";
}
if($u_mail_rand == 'off') {
  $default_det = "selected";
}
?>
<div id="changes_update" class="convo_settings">no changes detected</div>
<div class="mail_cont" style="text-align: left;">
  <table style="width: 100%; text-align: left;">
    <tr>
      <td id="sub_settings_admin" style="color: #a64ca6; font-weight: bold; font-size: 14px;">
        Preferences
      </td>
    </tr>
  </table>
  <table>
    <tr>
      <td>
        <span class="convo_settings">Availability</span> <br>
        <select id="can_mail" onchange="canMail();">
          <option value="friends" <?php echo $friends_can; ?>>Friends can mail me</option>
          <option value="anyone" <?php echo $anyone_can; ?>>Anyone can mail me</option>
          <option value="nobody" <?php echo $nobody_can; ?>>Nobody can mail me</option>
        </select>
      </td>
    </tr>
  </table>
  <table>
    <tr>
      <td>
        <span class="convo_settings">New Conversations</span> <br>
        <select id="new_convos" onchange="newConvos();">
          <option value="on" <?php echo $random_det; ?>>Generate random details</option>
          <option value="off" <?php echo $default_det; ?>>Don't generate random details</option>
        </select>
      </td>
    </tr>
  </table>
</div>
<!-- UNCOMMENT THIS ONCE YOU HAVE MORE SETTINGS <div class="convo_settings" style="font-size: 10px;">hit enter to ensure save <br> all fields required to function</div> -->
<script>
function canMail() {
  var selectBox = document.getElementById("can_mail");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "settings_save.php?canmail=" + selectedValue, true);
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
function newConvos() {
  var selectBox = document.getElementById("new_convos");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "settings_save.php?newcvs=" + selectedValue, true);
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
</script>
