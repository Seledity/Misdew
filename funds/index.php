<?php
$this_page = "zones";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/funds') {
  $loc_desc = "reviewin\' their funds";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/funds' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Funds - Misdew</title>
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
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
    <?php
    // funds
    echo "<table class=\"funds_cont\">";
    echo "<tr>";
    echo "<td class=\"funds_td1\" onclick=\"window.location='/funds';\">";
    echo "<i class=\"fa fa-university\" aria-hidden=\"true\"></i> ";
    echo "Funds";
    echo "</td>";
    echo "<td class=\"funds_td2\">";
    echo "$";
    echo number_format((float)$u_funds, 2, '.', '');
    echo "<span style=\"font-size: 14px;\"> available</span>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    ?>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
