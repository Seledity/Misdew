<?php
$this_page = "draw";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/draw') {
  $loc_desc = "craftin\' in draw";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/draw' WHERE uid='$u_uid'");
}
$draw_viewing = safe($_GET['i']);
if($draw_viewing != '') {
  $drw_q = mysqli_query($conx, "SELECT uid,collections FROM draw WHERE id='$draw_viewing'");
  $drw_r = mysqli_fetch_assoc($drw_q);
  $drw_uid = $drw_r['uid'];
  $drw_collections = $drw_r['collections'];
  if($drw_collections == 'no' && $u_uid != $drw_uid) {
    header("location: /draw");
    exit();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Draw - Misdew</title>
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
    <div id="action_bar" class="draw_actbar">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td id="createTab" onclick="toCreate()" class="action_bar_tab" style="border-bottom: 1px solid #fff;">
            Create
          </td>
          <!--<td id="dewmojiTab" onclick="toDewmoji()" class="action_bar_tab">
            Dewmoji
          </td>-->
          <td id="collectionTab" onclick="toCollections()" class="action_bar_tab">
            Collections
          </td>
          <td id="galleryTab" onclick="toGallery()" class="action_bar_tab">
            My Art
          </td>
        </tr>
      </table>
    </div> <br>
    <?php //require_once("../inc/load_alerts.php"); ?>
    <div id="action_bar_page">
      <?php
      if($draw_viewing == '') {
        require_once("create.php");
      }
      else {
        $draw_id = $draw_viewing;
        require_once("masterpiece.php");
      }
      ?>
    </div>
    <?php
    echo "<br>";
    echo "<span style=\"font-family: 'Dosis', sans-serif; color: #808080; font-size: 12px;\">Draw is not private or secure. Your drawings can/may be viewed at any time. <br></span>";
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function toCreate() {
    document.getElementById('createTab').innerHTML = "Create..";
    $.get("create.php", function(d) {
      document.getElementById('createTab').innerHTML = "Create";
      document.getElementById("createTab").style.borderBottom = '1px solid #fff';
      /*document.getElementById("dewmojiTab").style.borderBottom = 'none';*/
      document.getElementById("collectionTab").style.borderBottom = 'none';
      document.getElementById("galleryTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  /*function toDewmoji() {
    document.getElementById('dewmojiTab').innerHTML = "Dewmoji..";
    $.get("dewmoji.php", function(d) {
      document.getElementById('dewmojiTab').innerHTML = "Dewmoji";
      document.getElementById("dewmojiTab").style.borderBottom = '1px solid #fff';
      document.getElementById("createTab").style.borderBottom = 'none';
      document.getElementById("collectionTab").style.borderBottom = 'none';
      document.getElementById("galleryTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }*/
  function toCollections() {
    document.getElementById('collectionTab').innerHTML = "Collections..";
    $.get("collections.php", function(d) {
      document.getElementById('collectionTab').innerHTML = "Collections";
      document.getElementById("createTab").style.borderBottom = 'none';
      /*document.getElementById("dewmojiTab").style.borderBottom = 'none';*/
      document.getElementById("collectionTab").style.borderBottom = '1px solid #fff';
      document.getElementById("galleryTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toGallery() {
    document.getElementById('galleryTab').innerHTML = "My Art..";
    $.get("gallery.php", function(d) {
      document.getElementById('galleryTab').innerHTML = "My Art";
      document.getElementById("createTab").style.borderBottom = 'none';
      /*document.getElementById("dewmojiTab").style.borderBottom = 'none';*/
      document.getElementById("collectionTab").style.borderBottom = 'none';
      document.getElementById("galleryTab").style.borderBottom = '1px solid #fff';
      $("#action_bar_page").html(d);
    });
  }
  </script>
</body>
</html>
