<?php
$this_page = "themes";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/themes') {
  $loc_desc = "designin\' in themes";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/themes' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Themes - Misdew</title>
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
<script async src="https://www.googletagmanager.com/gtag/js?id="></script>
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
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
    <div class="theme_info">
      Change your theme by selecting one below.
    </div> <br>
    <table style="width: 95%; max-width: 500px;">
      <tr>
        <td onclick="changeTheme('1');" style="width: 25%;">
          <img src="/img/themes/consistent.png" alt="" style="width: 100%; height: auto; display: block;"> <br>
        </td>
        <td onclick="changeTheme('2');" style="width: 25%;">
          <img src="/img/themes/colorful.png" alt="" style="width: 100%; height: auto; display: block;"> <br>
        </td>
      </tr>
      <tr>
        <td onclick="changeTheme('3');" style="width: 25%;">
          <img src="/img/themes/dark.png" alt="" style="width: 100%; height: auto; display: block;"> <br>
        </td>
      </tr>
    </table>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function changeTheme(i) {
    var token = "<?php echo $u_token; ?>";
    $.ajax({
    url: 'change_theme.php',
    type: 'POST',
    data: { token: token, theme: i },
    success: function(data){
      if(data == '') {
        window.location.replace("/hub");
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
  </script>
</body>
</html>
