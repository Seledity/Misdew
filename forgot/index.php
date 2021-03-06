<?php
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
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
    session_start();
    $back_button = true;
    $linebreak = true;
    require_once("../inc/header.php");
    // possible session messages
    if (isset($_SESSION['m3']) == 'all_req') {
      echo "<div class=\"error_msg\">You must enter an email.</div> <br>";
      unset($_SESSION['m3']);
    }
    elseif (isset($_SESSION['m']) == 'generr') {
      echo "<div class=\"error_msg\">There was an error.</div> <br>";
      unset($_SESSION['m']);
    }
    elseif (isset($_SESSION['m2']) == 'e_inv') {
      echo "<div class=\"error_msg\">The email you entered is not in a valid format.</div> <br>";
      unset($_SESSION['m2']);
    }
    elseif (isset($_SESSION['m4']) == 'em_ss') {
      echo "<div class=\"error_msg\">We sent you an email.</div> <br>";
      unset($_SESSION['m4']);
    }
    elseif (isset($_SESSION['m5']) == 'ef_hef') {
      echo "<div class=\"error_msg\">That reset link is invalid. Request a new one.</div> <br>";
      unset($_SESSION['m5']);
    }
    else {
      echo "<div class=\"error_msg\">Enter the credentials associated with your account.
      <br> We will send you an email.</div> <br>";
    }
    ?>
    <form action="forgot.php" method="post" autocomplete="off">
      <table class="form_tble">
        <tr>
          <td>
            <input id="access" name="username" type="text" placeholder="username" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input id="access" name="email" type="text" placeholder="email" class="form_input">
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
    <span style="font-family: 'Dosis', sans-serif; color: #808080; font-size: 12px;">Still need help? Send an email to <b>me@justa.us</b></span> <br>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
