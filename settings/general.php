<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// User theme colors
$usri_q2 = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$u_uid' && theme_id='$g_themeid'");
$usri_r2 = mysqli_fetch_assoc($usri_q2);
$username_color = $usri_r2['username_color'];
$username_tcolor = $usri_r2['text_color'];
// Have they changed their username?
$u_namechange = $y['uname_change'];
?>
<div id="settings_upd">
  no changes detected
</div>
<div class="settings_cont">
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Change Username
        </span>
      </td>
    </tr>
    <?php
    if($u_namechange == 'no') {
      echo "<tr>
        <td>
          <span class=\"settings_desc\">
            You can change your username here. You can only do this once.
          </span>
        </td>
      </tr>
      <tr>
        <td>
          <form autocomplete=\"off\">
          <input autocomplete=\"off\" type=\"text\" id=\"new_uname\" name=\"new_uname\" class=\"settings_input\" placeholder=\"New Username\"> <br>
          <input autocomplete=\"new-password\" type=\"password\" id=\"curr_passwd\" name=\"curr_passwd\" class=\"settings_input\" placeholder=\"Current Password\">
          </form>
        </td>
      </tr>
      <tr>
        <td onclick=\"changeUsername();\">
          <center><div class=\"change_uname_btn\">change</div></center>
        </td>
      </tr>";
    }
    else {
      echo "<tr>
      <td class=\"uname_changed\">You have already changed your username once.</td>
      </tr>";
    }
    ?>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Change Email
        </span>
      </td>
    </tr>
    <?php
      echo "<tr>
        <td>
          <span class=\"settings_desc\">
            You can remove the email address linked to your account here. You will be taken to a page to enter and verify a new email address.
          </span>
        </td>
      </tr>
      <tr>
        <td onclick=\"changeEmail();\">
          <center><div class=\"change_uname_btn\">unlink email</div></center>
        </td>
      </tr>";
    ?>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Telegram Bot / ID Link
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          You can link your Telegram ID to your Misdew account here. This will allow you to enable special features from @Misdew_Bot on Telegram. To get started, send the /link command to the bot on Telegram.
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <input autocomplete="off" type="text" id="telegramid" name="telegramid" class="settings_input" placeholder="Enter Telegram ID"> <br>
      </td>
    </tr>
    <tr>
      <td onclick="linkTelegramID();">
        <center><div class="change_uname_btn">link</div></center>
      </td>
    </tr>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Data Saver
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          This option will prevent most images and videos from being loaded automatically. Instead, a link to the content will be displayed.
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updDataSaver('on');" name="datasaver" value="on" type="radio"<?php if($u_datasaver == 'on') { echo " checked"; } ?>> on
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updDataSaver('off');" name="datasaver" value="off" type="radio"<?php if($u_datasaver == 'off') { echo " checked"; } ?>> off
      </td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Straight to Hub
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          This will automatically redirect you to the Hub from the main page [misdew.com].
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updHubMain('on');" name="hubmain" value="on" type="radio"<?php if($u_hubmain == 'on') { echo " checked"; } ?>> on
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updHubMain('off');" name="hubmain" value="off" type="radio"<?php if($u_hubmain == 'off') { echo " checked"; } ?>> off
      </td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          iSE-MD Link [coming never]
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          This will link your Misdew.com account and data with iSEclipse.com <br>
          Your username and all account information will be linked. <br>
          This process cannot be undone and costs 100 MDF.
        </span>
      </td>
    </tr>
    <tr>
      <td>

      </td>
    </tr>
  </table>
</div>
<script>
function linkTelegramID() {
  if(confirm('Link this Telegram ID to your Misdew account? You can change it at any time.')) {
    var telegramid = document.getElementById('telegramid').value;
    var token = "<?php echo $u_token; ?>";
    $.ajax({
    url: 'telegram_link.php',
    type: 'POST',
    data: { token: token, telegramid: telegramid },
    success: function(data){
      if(data == '') {
        var telegramid = document.getElementById('telegramid').value = '';
        alert('If all went well, you should have gotten a message from @Misdew_Bot on Telegram asking for confirmation.');
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function changeUsername() {
  var new_uname = document.getElementById('new_uname').value;
  var curr_uname = "<?php echo $u_username; ?>";
  if(confirm('Your username will change from\n--> ' + curr_uname + '\nto\n--> ' + new_uname + '\nYOU CAN ONLY CHANGE YOUR USERNAME ONCE.\nAre you sure?')) {
    var token = "<?php echo $u_token; ?>";
    var curr_passwd = document.getElementById('curr_passwd').value;
    $.ajax({
    url: 'change_username.php',
    type: 'POST',
    data: { token: token, curr_passwd: curr_passwd, new_uname: new_uname },
    success: function(data){
      if(data == '') {
        document.getElementById('new_uname').value = '';
        document.getElementById('curr_passwd').value = '';
        alert('Your username has been changed.');
        window.location.replace("/settings");
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function changeEmail() {
  if(confirm('Are you sure? \n This will unlink your current email address. You will be taken to a page to verify your new email address.')) {
    var token = "<?php echo $u_token; ?>";
    $.ajax({
    url: 'change_email.php',
    type: 'POST',
    data: { token: token },
    success: function(data){
      if(data == '') {
        alert('Unlinked. Redirecting you to the checkpoint page..');
        window.location.replace("/checkpoint/2-23-21");
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function updDataSaver(datasaver) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'gen_update.php',
  type: 'POST',
  data: { datasaver: datasaver },
  success: function(data){
    if(data == '') {
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function updHubMain(hubmain) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'gen_update.php',
  type: 'POST',
  data: { hubmain: hubmain },
  success: function(data){
    if(data == '') {
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
</script>
