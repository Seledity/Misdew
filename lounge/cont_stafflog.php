<?php
$this_page = "lounge";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_cont_mang == 'yes') { }
else { header("location: /"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Lounge - Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="<?php echo $g_mainmeta; ?>">
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

    echo "<div class=\"lounge_cont\">";
    echo "Staff Log: <br><br>";




    $chat_q = mysqli_query($conx, "SELECT * FROM lounge_log ORDER BY id DESC");
    while($chat_r = mysqli_fetch_assoc($chat_q)) {
      $lounge_uid = $chat_r['uid'];
      $lounge_uidaff = $chat_r['uid_affected'];
      $lounge_action = $chat_r['action'];
      $lounge_comments = $chat_r['comments'];
      $lounge_tstamp = $chat_r['tstamp'];
      $usr_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$lounge_uidaff'");
      while($usr_r = mysqli_fetch_assoc($usr_q)) {
        $aff_username = $usr_r['username'];
      }
      $usr_qq = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$lounge_uid'");
      while($usr_rr = mysqli_fetch_assoc($usr_qq)) {
        $staff_username = $usr_rr['username'];
      }
      echo "<b>$staff_username</b> $lounge_action <b>$aff_username</b> <span style=\"font-size: 12px;\">";
      echo timeago($lounge_tstamp);
      echo " ago</span><br>";
      echo "$lounge_comments <br><br>";
    }



    echo "</div><br>";
    ?>
  </center>
</body>
</html>
