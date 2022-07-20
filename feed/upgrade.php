<?php
$this_page = "feed";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/feed') {
  $loc_desc = "browsin\' feed";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/feed' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Feed - Misdew</title>
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
  .header {
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 4px 4px rgba(0,0,0,0.23);
  }
  </style>
</head>
<body onload="resetPosts();">
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
    <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); color: #808080; padding-top: 5px; padding-bottom: 5px; text-align: left; font-family: 'Dosis', sans-serif; background-color: #f2f2f2;width: 80%; max-width: 500px; border-radius: 1em;">
      <table style="width: 100%; padding-left: 20px;">
        <tr>
          <td>
            <span style="color: #8c66b2; font-weight: bold; font-size: 50px;">Feed</span> <br> is undergoing an upgrade.
          </td>
        </tr>
      </table>
    </div> <br>
    <div style="width: 80%; max-width: 500px;">
      <table style="border-spacing: 10px;width: 100%; font-family: 'Dosis', sans-serif;">
        <tr>
          <td style="color: #808080;padding: 8px; border-radius: 1em; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);width: 50%; background-color: #f2f2f2;">
            <span style="color: #8c66b2;font-weight: bold; font-size: 30px;">Hey,</span> <br> check back later.
          </td>
          <td style="color: #808080;padding: 8px; border-radius: 1em; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);width: 50%; background-color: #f2f2f2;">
            <span style="color: #8c66b2;font-weight: bold; font-size: 30px;">It's ok,</span> <br> don't worry.
          </td>
        </tr>
      </table>
    </div> <br>
    <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); color: #808080; padding-top: 5px; padding-bottom: 5px; text-align: left; font-family: 'Dosis', sans-serif; background-color: #f2f2f2;width: 80%; max-width: 500px; border-radius: 1em;">
      <table style="width: 100%; padding-left: 20px; padding-right:20px;">
        <tr>
          <td>
            <span style="color: #8c66b2; font-weight: bold; font-size: 50px;">Brb.</span>
          </td>
        </tr>
      </table>
    </div>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  </div>
</body>
</html>
