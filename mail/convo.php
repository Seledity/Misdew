<?php
$this_page = "mail";
$this_sub_page = "mail_convo";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  header("location: /mail");
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
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81238250-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-81238250-2');
</script>

</head>
<body onload="goOnline()">
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
          <td id="membersTab" onclick="toMembers()" class="action_bar_tab">
            Members
          </td>
          <td id="settingsTab" onclick="toSettings()" class="action_bar_tab">
            Settings
          </td>
        </tr>
      </table>
    </div> <br>
    <?php //require_once("../inc/load_alerts.php"); ?>
    <div id="action_bar_page">
      <?php require_once("convo_messages.php"); ?>
    </div>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function goOnline() {
    $.get("online_upd.php?i=<?php echo $cv_uqid; ?>", function(d) {
      $("#onlupd").html(d);
    });
  };
  function toMessages() {
    goOnline();
    document.getElementById('messagesTab').innerHTML = "Messages..";
    $.get("convo_messages.php?i=<?php echo $cv_uqid; ?>", function(d) {
      document.getElementById('messagesTab').innerHTML = "Messages";
      document.getElementById("messagesTab").style.borderBottom = '1px solid #fff';
      document.getElementById("membersTab").style.borderBottom = 'none';
      document.getElementById("settingsTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toMembers() {
    goOnline();
    document.getElementById('membersTab').innerHTML = "Members..";
    $.get("convo_members.php?i=<?php echo $cv_uqid; ?>", function(d) {
      document.getElementById('membersTab').innerHTML = "Members";
      document.getElementById("messagesTab").style.borderBottom = 'none';
      document.getElementById("membersTab").style.borderBottom = '1px solid #fff';
      document.getElementById("settingsTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toSettings() {
    goOnline();
    document.getElementById('settingsTab').innerHTML = "Settings..";
    $.get("convo_settings.php?i=<?php echo $cv_uqid; ?>", function(d) {
      document.getElementById('settingsTab').innerHTML = "Settings";
      document.getElementById("messagesTab").style.borderBottom = 'none';
      document.getElementById("membersTab").style.borderBottom = 'none';
      document.getElementById("settingsTab").style.borderBottom = '1px solid #fff';
      $("#action_bar_page").html(d);
    });
  }
  </script>
</body>
</html>
