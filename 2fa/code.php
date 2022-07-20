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
    $back_button = yes;
    $linebreak = true;
    require_once("../inc/header.php");
    // possible session messages
    if (isset($_SESSION['m']) == 'all_req') {
      echo "<div class=\"error_msg\">All fields are required.</div> <br>";
      unset($_SESSION['m']);
    }
    elseif (isset($_SESSION['m4']) == 'user_leng') {
      echo "<div class=\"error_msg\">Your username must not be greater than 13 characters.</div> <br>";
      unset($_SESSION['m4']);
    }
    elseif (isset($_SESSION['m5']) == 'user_exi') {
      echo "<div class=\"error_msg\">That username already exists.</div> <br>";
      unset($_SESSION['m5']);
    }
    elseif (isset($_SESSION['m3']) == 'pdnm_aumna') {
      echo "<div class=\"error_msg\">Your username must be alphanumeric and the passwords you entered did not match.</div> <br>";
      unset($_SESSION['m3']);
    }
    elseif (isset($_SESSION['m2']) == 'user_alnum') {
      echo "<div class=\"error_msg\">Your username must be alphanumeric.</div> <br>";
      unset($_SESSION['m2']);
    }
    elseif (isset($_SESSION['m1']) == 'chec_yapass') {
      echo "<div class=\"error_msg\">The passwords you entered did not match.</div> <br>";
      unset($_SESSION['m1']);
    }
    elseif (isset($_SESSION['m6']) == 'gen_error') {
      echo "<div class=\"error_msg\">There was an error.</div> <br>";
      unset($_SESSION['m6']);
    }
    session_destroy();
    ?>
    <span style="color: #888; font-weight: bold; font-family: 'Dosis', sans-serif;">Enter your login details one last time. <br> Enter the 2FA code that was sent to your linked email. <br> You will be redirected to the Hub if it is correct.</span> <br><br>
    <form action="verifycode.php" method="post" autocomplete="off">
      <table class="form_tble">
        <tr>
          <td>
            <input name="username" type="text" placeholder="username" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input name="password" type="password" placeholder="password" class="form_input">
          </td>
        </tr>
        <tr>
          <td>
            <input name="2facode" type="text" placeholder="enter 2FA code" class="form_input">
          </td>
        </tr>
        <tr>
          <td class="form_tdpad">
            <input type="submit" value="verify & login" class="form_submit" onclick="this.disabled=true;this.value='verifying...';this.form.submit();">
          </td>
        </tr>
      </table>
    </form>
    <?php

    require_once("../inc/footer.php");
    ?>
  </center>
</body>
</html>
