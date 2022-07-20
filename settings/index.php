<?php
$this_page = "settings";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/settings') {
  $loc_desc = "updatin\' some settings";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/settings' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Settings - Misdew</title>
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
    <div id="action_bar" class="settings_actbar">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td id="generalTab" onclick="toGeneral()" class="action_bar_tab" style="border-bottom: 1px solid #fff;">
            General
          </td>
          <td id="customizeTab" onclick="toCustomize()" class="action_bar_tab">
            Customize
          </td>
          <td id="securityTab" onclick="toSecurity()" class="action_bar_tab">
            Security
          </td>
        </tr>
      </table>
    </div> <br>
    <?php //require_once("../inc/load_alerts.php"); ?>
    <div id="action_bar_page">
      <?php require_once("general.php"); ?>
    </div>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function toGeneral() {
    document.getElementById('generalTab').innerHTML = "General..";
    $.get("general.php", function(d) {
      document.getElementById('generalTab').innerHTML = "General";
      document.getElementById("generalTab").style.borderBottom = '1px solid #fff';
      document.getElementById("customizeTab").style.borderBottom = 'none';
      document.getElementById("securityTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toCustomize() {
    document.getElementById('customizeTab').innerHTML = "Customize..";
    $.get("customize.php", function(d) {
      document.getElementById('customizeTab').innerHTML = "Customize";
      document.getElementById("generalTab").style.borderBottom = 'none';
      document.getElementById("customizeTab").style.borderBottom = '1px solid #fff';
      document.getElementById("securityTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toSecurity() {
    document.getElementById('securityTab').innerHTML = "Security..";
    $.get("security.php", function(d) {
      document.getElementById('securityTab').innerHTML = "Security";
      document.getElementById("generalTab").style.borderBottom = 'none';
      document.getElementById("customizeTab").style.borderBottom = 'none';
      document.getElementById("securityTab").style.borderBottom = '1px solid #fff';
      $("#action_bar_page").html(d);
    });
  }
  </script>
</body>
</html>
