<?php
$this_page = "forums";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/forums') {
  $loc_desc = "browsin\' forums";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/forums' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Forums - Misdew</title>
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
  /* CONTENT HERE FOR THIS PAGE */
  /* MAKE SURE TO ADD TO THEMES */
  /* CONTENT HERE FOR THIS PAGE */
  .forums_actbar {
    color: #fff;
    background-color: #954495;
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
<body>
  <center>
    <?php
    $back_button = true;
    $linebreak = false;
    $alerts = false;
    require_once("../inc/header.php");
    ?>
    <div id="action_bar" class="forums_actbar">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td id="spindlesTab" onclick="toSpindles();" class="action_bar_tab" style="border-bottom: 1px solid #fff;">
            Spindles
          </td>
          <td id="weavesTab" onclick="toWeaves();" class="action_bar_tab">
            Weaves
          </td>
          <td id="settingsTab" onclick="toSettings();" class="action_bar_tab">
            Settings
          </td>
        </tr>
      </table>
    </div> <br>
    <?php
    require_once("../inc/load_alerts.php");
    ?>
    <div id="action_bar_page">
      <?php require_once("spindles.php"); ?>
    </div>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function toSpindles() {
    document.getElementById('spindlesTab').innerHTML = "Spindles..";
    $.get("spindles.php", function(d) {
      document.getElementById('spindlesTab').innerHTML = "Spindles";
      document.getElementById("spindlesTab").style.borderBottom = '1px solid #fff';
      document.getElementById("weavesTab").style.borderBottom = 'none';
      document.getElementById("settingsTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toWeaves() {
    document.getElementById('weavesTab').innerHTML = "Weaves..";
    $.get("weaves.php", function(d) {
      document.getElementById('weavesTab').innerHTML = "Weaves";
      document.getElementById("spindlesTab").style.borderBottom = 'none';
      document.getElementById("weavesTab").style.borderBottom = '1px solid #fff';
      document.getElementById("settingsTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toSettings() {
    document.getElementById('settingsTab').innerHTML = "Settings..";
    $.get("settings.php", function(d) {
      document.getElementById('settingsTab').innerHTML = "Settings";
      document.getElementById("spindlesTab").style.borderBottom = 'none';
      document.getElementById("settingsTab").style.borderBottom = '1px solid #fff';
      document.getElementById("weavesTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  </script>
</body>
</html>
