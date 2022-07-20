<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$app_uqid = "mdf-wallet";
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM user_apps WHERE uid='$u_uid' && app_uqid='$app_uqid'")) == '0') {
	header("location: /hub");
	exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/app/mdf-wallet') {
  $loc_desc = "usin\' MDF Wallet";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/app/mdf-wallet' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>MDF Wallet - Misdew</title>
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
      $linebreak = false;
      $alerts = false;
      require_once("../../inc/header.php");
      ?>
      <div id="action_bar" class="settings_actbar">
        <table style="width: 100%; text-align: center;">
          <tr>
            <td id="walletTab" onclick="toWallet()" class="action_bar_tab" style="border-bottom: 1px solid #fff;">
              Wallet
            </td>
            <td id="transferTab" onclick="toTransfer()" class="action_bar_tab">
              Transfer
            </td>
            <td id="investTab" onclick="toInvest()" class="action_bar_tab">
              Invest
            </td>
          </tr>
        </table>
      </div> <br>
      <div id="action_bar_page">
        <?php require_once("wallet.php"); ?>
      </div>
      <?php
      require_once("../../inc/footer.php");
      ?>
    </center>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    function toWallet() {
      document.getElementById('walletTab').innerHTML = "Wallet..";
      $.get("wallet.php", function(d) {
        document.getElementById('walletTab').innerHTML = "Wallet";
        document.getElementById("walletTab").style.borderBottom = '1px solid #fff';
        document.getElementById("transferTab").style.borderBottom = 'none';
        document.getElementById("investTab").style.borderBottom = 'none';
        $("#action_bar_page").html(d);
      });
    }
    function toTransfer() {
      document.getElementById('transferTab').innerHTML = "Transfer..";
      $.get("transfer.php", function(d) {
        document.getElementById('transferTab').innerHTML = "Transfer";
        document.getElementById("walletTab").style.borderBottom = 'none';
        document.getElementById("transferTab").style.borderBottom = '1px solid #fff';
        document.getElementById("investTab").style.borderBottom = 'none';
        $("#action_bar_page").html(d);
      });
    }
    function toInvest() {
      document.getElementById('investTab').innerHTML = "Invest..";
      $.get("invest.php", function(d) {
        document.getElementById('investTab').innerHTML = "Invest";
        document.getElementById("walletTab").style.borderBottom = 'none';
        document.getElementById("transferTab").style.borderBottom = 'none';
        document.getElementById("investTab").style.borderBottom = '1px solid #fff';
        $("#action_bar_page").html(d);
      });
    }
    </script>
  </body>
  </html>
