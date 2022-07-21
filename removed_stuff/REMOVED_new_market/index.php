<?php
$this_page = "market";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/market') {
  $loc_desc = "shoppin\' in market";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/market' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Market - Misdew</title>
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
    <div id="action_bar" class="market_actbar">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td id="appsTab" onclick="toApps();" class="action_bar_tab" style="border-bottom: 1px solid <?php echo $cnv_actbar_fc; ?>;">
            Apps
          </td>
          <td id="servicesTab" onclick="toServices();" class="action_bar_tab">
            Services
          </td>
          <td id="merchTab" onclick="toMerch();" class="action_bar_tab">
            Merch
          </td>
          <td id="searchTab" onclick="toSearch()" class="action_bar_tab">

          </td>
        </tr>
      </table>
    </div> <br>
    <?php
    require_once("../inc/load_alerts.php");
    ?>
    <div id="action_bar_page">
      <?php require_once("apps.php"); ?>
    </div>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function toApp(app_id, app_name) {
    var app_name_id = "mapp_nm_" + app_id;
    document.getElementById(app_name_id).innerHTML = app_name + '..';
    $.get("content.php?i=" + app_id, function(d) {
      $("#action_bar_page").html(d);
    });
  }
  function toCat(cat_name) {
    document.getElementById(cat_name).innerHTML = "&nbsp; view more.. &nbsp;";
    $.get("categories.php?c=" + cat_name, function(d) {
      $("#action_bar_page").html(d);
    });
  }
  function toApps() {
    document.getElementById('appsTab').innerHTML = "Apps..";
    $.get("apps.php", function(d) {
      document.getElementById('appsTab').innerHTML = "Apps";
      document.getElementById("appsTab").style.borderBottom = '1px solid #fff';
      document.getElementById("merchTab").style.borderBottom = 'none';
      document.getElementById("servicesTab").style.borderBottom = 'none';
      document.getElementById("searchTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toServices() {
    document.getElementById('servicesTab').innerHTML = "Services..";
    $.get("services.php", function(d) {
      document.getElementById('servicesTab').innerHTML = "Services";
      document.getElementById("appsTab").style.borderBottom = 'none';
      document.getElementById("servicesTab").style.borderBottom = '1px solid #fff';
      document.getElementById("merchTab").style.borderBottom = 'none';
      document.getElementById("searchTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toMerch() {
    document.getElementById('merchTab').innerHTML = "Merch..";
    $.get("merch.php", function(d) {
      document.getElementById('merchTab').innerHTML = "Merch";
      document.getElementById("appsTab").style.borderBottom = 'none';
      document.getElementById("merchTab").style.borderBottom = '1px solid #fff';
      document.getElementById("servicesTab").style.borderBottom = 'none';
      document.getElementById("searchTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toSearch() {
    document.getElementById('searchTab').innerHTML = "Search..";
    $.get("search.php", function(d) {
      document.getElementById('searchTab').innerHTML = "Search";
      document.getElementById("appsTab").style.borderBottom = 'none';
      document.getElementById("merchTab").style.borderBottom = 'none';
      document.getElementById("servicesTab").style.borderBottom = 'none';
      document.getElementById("searchTab").style.borderBottom = '1px solid #fff';
      $("#action_bar_page").html(d);
    });
  }
  function search() {
    var searchQ = document.getElementById("search_query");
    var q = searchQ.value;
    var q = q.trim();
    var sb = document.getElementById("s_results");
    if(q == '') {
      sb.style.display = 'none';
    }
    else {
      sb.style.display = '';
    }
    document.getElementById("search_results").innerHTML = '<div class="market_table"><div style="padding: 8px;"><span class="no_results">searching...</span></div></div>';
    $.get("search_results.php?q=" + q, function(d) {
      $("#search_results").html(d);
    });
  }
  </script>
  </body>
</html>
