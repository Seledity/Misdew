<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/wallet') {
  $loc_desc = "usin\' Wallet";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/wallet' WHERE uid='$u_uid'");
}
$funds_bal = number_format((float)$u_funds, 2, '.', '');
$mdf_bal = number_format($funds_bal, 2, '.', ',');

$site_requested_from = "https://misdew.com";
$url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=pancakeswap-token';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
$body = curl_exec($ch);
curl_close($ch);
$json_output = json_decode($body,true);
$cake_usdp_raw = $json_output['0']['current_price'];
$cake_usdp = $json_output['0']['current_price'];
$mdf_bal_value = $cake_usdp/515;
$mdf_bal_val = $u_funds * $mdf_bal_value;
$mdf_bal_val = number_format((float)$mdf_bal_val, 2, '.', '');
$mdf_bal_val = number_format($mdf_bal_val, 2, '.', ',');

$mdf_bal_value_display = number_format((float)$mdf_bal_value, 2, '.', '');
$mdf_bal_value_display = number_format($mdf_bal_value_display, 2, '.', ',');

$tru_bal = number_format((float)$u_funds_tru, 2, '.', '');
$tru_bal = number_format($tru_bal, 2, '.', ',');

$tru_bal_val = $u_funds_tru * 1;
$tru_bal_val = number_format((float)$tru_bal_val, 2, '.', '');
$tru_bal_val = number_format($tru_bal_val, 2, '.', ',');

//$btc_bal = number_format((float)$u_funds_btc, 8, '.', '');
$btc_bal = number_format($u_funds_btc, 10, '.', ',');

//$cake_bal = number_format((float)$u_funds_cake, 2, '.', '');
$cake_bal = number_format($u_funds_cake, 10, '.', ',');

//$btc_bal = number_format((float)$u_funds_btc, 8, '.', '');
$dot_bal = number_format($u_funds_dot, 10, '.', ',');
//  Price
//  Price
//  Price
$site_requested_from = "https://misdew.com";
$url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
$body = curl_exec($ch);
curl_close($ch);
$json_output = json_decode($body,true);
$btc_usdp_raw = $json_output['0']['current_price'];
$btc_usdp = $json_output['0']['current_price'];
$btc_usdp = number_format((float)$btc_usdp, 2, '.', '');
$btc_usdp = number_format($btc_usdp, 2, '.', ',');
//  Price
//  Price
//  Price
//  Price
//  Price
//  Price
$site_requested_from = "https://misdew.com";
$url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=pancakeswap-token';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
$body = curl_exec($ch);
curl_close($ch);
$json_output = json_decode($body,true);
$cake_usdp_raw = $json_output['0']['current_price'];
$cake_usdp = $json_output['0']['current_price'];
$cake_usdp = number_format((float)$cake_usdp, 2, '.', '');
$cake_usdp = number_format($cake_usdp, 2, '.', ',');
//  Price
//  Price
//  Price
//  Price
//  Price
//  Price
$site_requested_from = "https://misdew.com";
$url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=polkadot';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
$body = curl_exec($ch);
curl_close($ch);
$json_output = json_decode($body,true);
$dot_usdp_raw = $json_output['0']['current_price'];
$dot_usdp = $json_output['0']['current_price'];
$dot_usdp = number_format((float)$dot_usdp, 2, '.', '');
$dot_usdp = number_format($dot_usdp, 2, '.', ',');
//  Price
//  Price
//  Price
$btc_bal_val = $u_funds_btc * $btc_usdp_raw;
$btc_bal_val = number_format((float)$btc_bal_val, 2, '.', '');
$btc_bal_val = number_format($btc_bal_val, 2, '.', ',');


$cake_bal_val = $u_funds_cake * $cake_usdp_raw;
$cake_bal_val = number_format((float)$cake_bal_val, 2, '.', '');
$cake_bal_val = number_format($cake_bal_val, 2, '.', ',');

$dot_bal_val = $u_funds_dot * $dot_usdp_raw;
$dot_bal_val = number_format((float)$dot_bal_val, 2, '.', '');
$dot_bal_val = number_format($dot_bal_val, 2, '.', ',');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Wallet+ | Misdew.com</title>
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
  .header {
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 4px 4px rgba(0,0,0,0.23);
  }
  .wallet_btns {
    box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23);
    border-radius: 20px;
    font-size: 16px;
    padding: 8px;
    font-family: 'Dosis', sans-serif;
    border: 1px solid #fff;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }
  </style>
</head>
  <body>
    <center>
      <?php
      $back_button = true;
      $linebreak = true;
      $alerts = false;
      require_once("../inc/header.php");
      ?>

      <div class="settings_cont" style="color: #808080; width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <div style="padding:8px;">
          <span style="font-weight: bold;"><i class="fa fa-exclamation-triangle"></i> Disclaimer:</span>
          <span style="font-size: 12px;">
            This app is only a simulation game. You do not actually own any of these investments in the real world. They do not have any monetary value. Have fun!
          </span>
        </div>
      </div> <br>
      <div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #72ab72; font-weight: bold; font-size: 40px;">
              $TRU
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #72ab72; font-weight: bold; font-size: 18px;">
              True Value; play money pegged to USD.
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px;">
          <tr>
            <td style="width: 20%; color: #808080; font-weight: bold; font-size: 18px;">
              Price: <span style="font-weight: normal;">$1.00</span> <br>
              Wallet: <span id="tru_wallet" style="font-weight: normal;"><?php echo $tru_bal; ?></span> <br>
              $TRU Value: <span id="tru_liveval" style="font-weight: normal;">$<?php echo $tru_bal_val; ?></span> <br>
            </td>
          </tr>
        </table>
      </div> <br>


      <div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #a64ca6; font-weight: bold; font-size: 40px;">
              $MDF
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #a64ca6; font-weight: bold; font-size: 18px;">
              Misdew Funds; our native currency.
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #808080; font-weight: bold; font-size: 18px;">
              Price: <span id="mdf_liveprice" style="font-weight: normal;">$<?php echo $mdf_bal_value_display; ?></span> <br>
              Wallet: <span id="mdf_wallet" style="font-weight: normal;"><?php echo $mdf_bal; ?></span> <br>
              $TRU Value: <span id="mdf_liveval" style="font-weight: normal;">$<?php echo $mdf_bal_val; ?></span> <br>
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; text-align: center;">
          <tr>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='buy/mdf.php';" type="button" class="wallet_btns" style="background-color: #a64ca6; color: #fff; width: 100%;">
                <i class="fa fa-plus-circle"></i> buy
              </button>
            </td>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='sell/mdf.php';" type="button" class="wallet_btns" style="background-color: #a64ca6; color: #fff; width: 100%;">
                <i class="fa fa-minus-circle"></i> sell
              </button>
            </td>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="alert('You will be able to send $MDF to other users soon.');" type="button" class="wallet_btns" style="background-color: #a64ca6; color: #fff; width: 100%;">
                <i class="fa fa-paper-plane"></i> send
              </button>
            </td>
          </tr>
        </table>
      </div> <br>


      <div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td style="color: #F7931A; font-weight: bold; font-size: 40px;">
              $BTC
            </td>
          </tr>
          <tr>
            <td style="color: #F7931A; font-weight: bold; font-size: 18px;">
              Bitcoin; the cryptocurrency that started it all.
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #808080; font-weight: bold; font-size: 18px;">
              Price: <span id="btc_liveprice" style="font-weight: normal;">
                $<?php echo $btc_usdp; ?>
              </span> <br>
              Wallet: <span id="btc_wallet" style="font-weight: normal;"><?php echo $btc_bal; ?></span> <br>
              $TRU Value: <span id="btc_liveval" style="font-weight: normal;">$<?php echo $btc_bal_val; ?></span> <br>
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; text-align: center;">
          <tr>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='buy/btc.php';" type="button" class="wallet_btns" style="background-color: #F7931A; color: #fff; width: 100%;">
                <i class="fa fa-plus-circle"></i> buy
              </button>
            </td>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='sell/btc.php';" type="button" class="wallet_btns" style="background-color: #F7931A; color: #fff; width: 100%;">
                <i class="fa fa-minus-circle"></i> sell
              </button>
            </td>
          </tr>
        </table>
      </div> <br>



      <!--<div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td style="color: #3c3c3d; font-weight: bold; font-size: 40px;">
              $ETH
            </td>
          </tr>
          <tr>
            <td style="color: #3c3c3d; font-weight: bold; font-size: 18px;">
              Ethereum allows you to move money, or make agreements, directly with someone else. You don't need to go through intermediary companies.
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #808080; font-weight: bold; font-size: 18px;">
              Price: <span id="eth_liveprice" style="font-weight: normal;">
                $<?php echo $eth_usdp; ?>
              </span> <br>
              Wallet: <span id="eth_wallet" style="font-weight: normal;"><?php echo $eth_bal; ?></span> <br>
              $TRU Value: <span id="eth_liveval" style="font-weight: normal;">$<?php echo $eth_bal_val; ?></span> <br>
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; text-align: center;">
          <tr>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='buy/eth.php';" type="button" class="wallet_btns" style="background-color: #3c3c3d; color: #fff; width: 100%;">
                <i class="fa fa-plus-circle"></i> buy
              </button>
            </td>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='sell/eth.php';" type="button" class="wallet_btns" style="background-color: #3c3c3d; color: #fff; width: 100%;">
                <i class="fa fa-minus-circle"></i> sell
              </button>
            </td>
          </tr>
        </table>
      </div> <br>-->


      <div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td style="color: #7645D9; font-weight: bold; font-size: 40px;">
              $CAKE
            </td>
          </tr>
          <tr>
            <td style="color: #7645D9; font-weight: bold; font-size: 18px;">
              The native token of PancakeSwap.
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #808080; font-weight: bold; font-size: 18px;">
              Price: <span id="cake_liveprice" style="font-weight: normal;">
                $<?php echo $cake_usdp; ?>
              </span> <br>
              Wallet: <span id="cake_wallet" style="font-weight: normal;"><?php echo $cake_bal; ?></span> <br>
              $TRU Value: <span id="cake_liveval" style="font-weight: normal;">$<?php echo $cake_bal_val; ?></span> <br>
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; text-align: center;">
          <tr>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='buy/cake.php';" type="button" class="wallet_btns" style="background-color: #7645D9; color: #fff; width: 100%;">
                <i class="fa fa-plus-circle"></i> buy
              </button>
            </td>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='sell/cake.php';" type="button" class="wallet_btns" style="background-color: #7645D9; color: #fff; width: 100%;">
                <i class="fa fa-minus-circle"></i> sell
              </button>
            </td>
          </tr>
        </table>
      </div> <br>



      <div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td style="color: #e6007a; font-weight: bold; font-size: 40px;">
              $DOT
            </td>
          </tr>
          <tr>
            <td style="color: #e6007a; font-weight: bold; font-size: 18px;">
              Polkadot enables cross-blockchain transfers of any type of data or asset.
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; padding-bottom: 0px;">
          <tr>
            <td style="width: 20%; color: #808080; font-weight: bold; font-size: 18px;">
              Price: <span id="dot_liveprice" style="font-weight: normal;">
                $<?php echo $dot_usdp; ?>
              </span> <br>
              Wallet: <span id="dot_wallet" style="font-weight: normal;"><?php echo $dot_bal; ?></span> <br>
              $TRU Value: <span id="dot_liveval" style="font-weight: normal;">$<?php echo $dot_bal_val; ?></span> <br>
            </td>
          </tr>
        </table>
        <table style="width: 100%; padding: 8px; padding-top: 0px; text-align: center;">
          <tr>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='buy/dot.php';" type="button" class="wallet_btns" style="background-color: #e6007a; color: #fff; width: 100%;">
                <i class="fa fa-plus-circle"></i> buy
              </button>
            </td>
            <td style="color: #808080; font-weight: bold; font-size: 18px;">
              <button onclick="window.location='sell/dot.php';" type="button" class="wallet_btns" style="background-color: #e6007a; color: #fff; width: 100%;">
                <i class="fa fa-minus-circle"></i> sell
              </button>
            </td>
          </tr>
        </table>
      </div> <br>



      <?php
      require_once("../inc/footer.php");
      ?>
    </center>
    <script>
    // wallets
    function walDOT() {
      $.get("live-wallet.php?i=dot", function(d) {
        $("#dot_wallet").html(d);
      });
    }
    setInterval('walDOT()', 3000);
    function upDOT() {
      $.get("live-price.php?i=dot", function(d) {
        $("#dot_liveprice").html(d);
      });
    }
    setInterval('upDOT()', 3000);
    function valDOT() {
      $.get("live-value.php?i=dot", function(d) {
        $("#dot_liveval").html(d);
      });
    }
    setInterval('valDOT()', 3000);




    function walTRU() {
      $.get("live-wallet.php?i=tru", function(d) {
        $("#tru_wallet").html(d);
      });
    }
    setInterval('walTRU()', 3000);
    function walMDF() {
      $.get("live-wallet.php?i=mdf", function(d) {
        $("#mdf_wallet").html(d);
      });
    }
    setInterval('walMDF()', 3000);
    function walBTC() {
      $.get("live-wallet.php?i=btc", function(d) {
        $("#btc_wallet").html(d);
      });
    }
    setInterval('walBTC()', 3000);
    function walCAKE() {
      $.get("live-wallet.php?i=cake", function(d) {
        $("#cake_wallet").html(d);
      });
    }
    setInterval('walCAKE()', 3000);
    // wallets
    function upMDF() {
      $.get("live-price.php?i=mdf", function(d) {
        $("#mdf_liveprice").html(d);
      });
    }
    setInterval('upMDF()', 3000);
    function upBTC() {
      $.get("live-price.php?i=btc", function(d) {
        $("#btc_liveprice").html(d);
      });
    }
    setInterval('upBTC()', 3000);
    function valBTC() {
      $.get("live-value.php?i=btc", function(d) {
        $("#btc_liveval").html(d);
      });
    }
    setInterval('valBTC()', 3000);
    function upCAKE() {
      $.get("live-price.php?i=cake", function(d) {
        $("#cake_liveprice").html(d);
      });
    }
    setInterval('upCAKE()', 3000);
    function valCAKE() {
      $.get("live-value.php?i=cake", function(d) {
        $("#cake_liveval").html(d);
      });
    }
    setInterval('valCAKE()', 3000);


    function valMDF() {
      $.get("live-value.php?i=mdf", function(d) {
        $("#mdf_liveval").html(d);
      });
    }
    setInterval('valMDF()', 3000);
    function valTRU() {
      $.get("live-value.php?i=tru", function(d) {
        $("#tru_liveval").html(d);
      });
    }
    setInterval('valTRU()', 3000);
    </script>
  </body>
  </html>
