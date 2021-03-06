<?php
$this_page = "mail";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/mail') {
  $loc_desc = "conversatin\' in mail";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/mail' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mail - Misdew</title>
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
<body>
  <center>
    <?php
    $back_button = true;
    $linebreak = false;
    $alerts = false;
    require_once("../inc/header.php");
    ?>
    <div id="action_bar" class="mail_actbar">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td id="messagesTab" onclick="toMessages()" class="action_bar_tab" style="border-bottom: 1px solid #fff;">
            Messages
          </td>
          <td id="friendsTab" onclick="toFriends()" class="action_bar_tab">
            Friends
          </td>
          <td id="settingsTab" onclick="toSettings()" class="action_bar_tab">
            Settings
          </td>
        </tr>
      </table>
    </div> <br>
    <?php //require_once("../inc/load_alerts.php"); ?>
    <div id="action_bar_page">
      <?php require_once("messages.php"); ?>
    </div>
    <?php
    echo "<br>";
    echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-size: 12px;\">Mail is not private or secure. Your messages can/may be read at any time. <br> They are stored in plaintext on our server. <br></span>";
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function toMessages() {
    document.getElementById('messagesTab').innerHTML = "Messages..";
    $.get("messages.php", function(d) {
      document.getElementById('messagesTab').innerHTML = "Messages";
      document.getElementById("messagesTab").style.borderBottom = '1px solid #fff';
      document.getElementById("friendsTab").style.borderBottom = 'none';
      document.getElementById("settingsTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toFriends() {
    document.getElementById('friendsTab').innerHTML = "Friends..";
    $.get("friends.php", function(d) {
      document.getElementById('friendsTab').innerHTML = "Friends";
      document.getElementById("messagesTab").style.borderBottom = 'none';
      document.getElementById("friendsTab").style.borderBottom = '1px solid #fff';
      document.getElementById("settingsTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toSettings() {
    document.getElementById('settingsTab').innerHTML = "Settings..";
    $.get("settings.php", function(d) {
      document.getElementById('settingsTab').innerHTML = "Settings";
      document.getElementById("messagesTab").style.borderBottom = 'none';
      document.getElementById("friendsTab").style.borderBottom = 'none';
      document.getElementById("settingsTab").style.borderBottom = '1px solid #fff';
      $("#action_bar_page").html(d);
    });
  }
  </script>
  <script>function expand(id) {
    var e = document.getElementById(id);
    if(e.style.display == 'block')
    e.style.display = 'none';
    else
    e.style.display = 'block';
  }</script>
</body>
</html>
