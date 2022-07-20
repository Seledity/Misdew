<?php
session_start();
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
  exit();
}
# POST DATA
$resetid_p = safe($_GET['k']);
if($resetid_p) {
  $cs = mysqli_query($conx, "SELECT tstamp,uqid,username,email_secure FROM forgot_password WHERE uqid='$resetid_p'");
  $ccnt = mysqli_num_rows($cs);
  if($ccnt == '0') {
    $_SESSION['m5'] = "ef_hef";
    header("location: /forgot");
    exit();
  }
  $crs = mysqli_fetch_assoc($cs);
  $rs_tstamp = $crs['tstamp'];
  $rs_uqid = $crs['uqid'];
  $rs_username = $crs['username'];
  $rs_email = $crs['email_secure'];
  # MAKE SURE LINK HASN'T REACHED ONE HOUR EXPIRE LIMIT
  $tttstamp = $rs_tstamp + 3600;
  if($tstamp >= $tttstamp) {
    $dp = mysqli_query($conx, "DELETE FROM forgot_password WHERE email_secure='$rs_email'");
    $_SESSION['m5'] = "ef_hef";
    header("location: /forgot");
    exit();
  }
}
else {
  header("location: /forgot");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="#a64ca6">
  <link rel="stylesheet" type="text/css" href="/css/consistent.css">
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="apple-touch-icon" href="/img/logo.png">
</head>
<body>
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    require_once("../inc/header.php");
    // possible session messages
    if (isset($_SESSION['m3']) == 'all_req') {
      echo "<div class=\"error_msg\">All fields are required.</div> <br>";
      unset($_SESSION['m3']);
    }
    elseif (isset($_SESSION['m']) == 'p_dnm') {
      echo "<div class=\"error_msg\">The passwords you entered did not match.</div> <br>";
      unset($_SESSION['m']);
    }
    else {
      echo "<div class=\"error_msg\">Enter a new password for your account.</div> <br>";
    }
    session_destroy();
    ?>
    <form action="r.php?k=<?php echo $resetid_p; ?>" method="post" autocomplete="off">
      <table class="form_tble">
        <tr>
          <td>
            <input name="newpass" type="password" placeholder="password" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input name="confnewpass" type="password" placeholder="confirm password" class="form_input">
          </td>
        </tr>
        <tr>
          <td class="form_tdpad">
            <input type="submit" value="reset" class="form_submit">
          </td>
        </tr>
      </table>
    </form>
    <table class="form_btap" onclick="window.location='/';">
      <tr>
        <td>
          tap to login
        </td>
      </tr>
    </table> <br>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
