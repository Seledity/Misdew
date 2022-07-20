<?php
$this_page = "feed";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$get_rstr = safe($_GET['i']);
if(mysqli_num_rows($gpostq = mysqli_query($conx, "SELECT post FROM feed WHERE random_str='$get_rstr' && uid='$u_uid' && img=''")) != 1) {
  header("location: /feed");
  exit();
}
$gpostr = mysqli_fetch_assoc($gpostq);
$post_text = $gpostr['post'];
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
    <div id="postIt">
      <form id="feed_form" method="post" action="ppost.php?i=<?php echo $get_rstr; ?>">
        <table class="postbox_tb">
          <tr>
            <td>
              <textarea id="fpostb" name="edit" rows="4" class="feed_parea" placeholder="type something..."><?php echo $post_text; ?></textarea>
            </td>
          </tr>
        </table>
        <table class="postbox_tb" id="postbox_tb2">
            <td class="postbox2_td2">
              <input type="submit" value="edit" class="postbox_sub" style="width: 90%;">
            </td>
          </tr>
        </table>
      </form>
    </div>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
