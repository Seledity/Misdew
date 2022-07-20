<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
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
  .sell_input {
    border: none;
    font-size: 18px;
    width: 55%;
    font-family: 'Dosis', sans-serif;
    color: #000;
    background-color: #fff;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-bottom: 3px solid #a64ca6;
}
input:-webkit-autofill {
  -webkit-text-fill-color: #808080;
}
::-webkit-input-placeholder {
  color: #808080;
}
:-moz-placeholder {
  color: #808080;
  opacity: 1;
}
::-moz-placeholder {
  color: #808080;
  opacity: 1;
}
:-ms-input-placeholder {
  color: #808080;
}
  </style>
</head>
  <body>
    <center>
      <?php
      $back_button = true;
      $linebreak = true;
      $alerts = false;
      require_once("../../inc/header.php");
      ?>

      <div class="settings_cont" style="width: 95% !important; max-width: 450px !important; border-top-left-radius: 1em;border-top-right-radius: 1em;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td style="width: 20%; color: #a64ca6; font-weight: bold; font-size: 40px;">
              $MDF
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #a64ca6; font-weight: bold; font-size: 18px;">
              Sell your $MDF for $TRU. <br>
              You can use $TRU to buy other currencies.
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #808080; font-weight: bold; font-size: 16px;">
              Price: <span id="mdf_liveprice" style="font-weight: normal;">loading...</span> <br>
              Wallet: <span id="mdf_wallet" style="font-weight: normal;">loading...</span> <br>
              $TRU Value: <span id="mdf_liveval" style="font-weight: normal;">loading...</span> <br>
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #a64ca6; font-weight: bold; font-size: 30px;">
              Amount
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #a64ca6; font-weight: bold;">
              <span style="font-size: 12px; font-weight: normal;">how much $MDF do you want to sell?</span> <br>
              <span style="font-size: 12px; font-weight: normal;">press enter to ensure calculations</span> <br>
              <input id="sell_input" max="<?php echo $u_funds; ?>" onkeypress="amntSellVal()" onkeyup="amntSellVal()" class="sell_input" type="number" placeholder="enter $MDF amount...">
            </td>
          </tr>
          <tr>
            <td style="width: 100%; color: #808080; font-weight: bold; font-size: 16px;">
              $MDF to Sell: <span id="mdf_sell_amnt" style="font-weight: normal;">0</span> <br>
              $TRU Received: <span id="mdf_sell_val" style="font-weight: normal;">$0.00</span> <span style="font-weight: normal;font-size: 12px;">[estimated]</span> <br>
              Tx Fee: <span id="mdf_sell_amnt" style="font-weight: normal;">currently free</span> <br>
            </td>
          </tr>
        </table>
      </div>
      <button onclick="beginSale();" type="button" class="wallet_btns" style="border: none; border-top-left-radius: 0px;border-top-right-radius: 0px; background-color: #a64ca6; color: #fff; width: 95% !important; max-width: 450px !important; ">
        <i class="fa fa-minus-circle"></i> tap to sell $MDF
      </button> <br>



      <?php
      require_once("../../inc/footer.php");
      ?>
    </center>
    <script>
    function beginSale() {
      amntSellVal();
      var sell_amount = $("#sell_input").val();
      var msg = "Are you sure that you want to sell " + sell_amount + " $MDF?";
      if(confirm(msg)) {
        var token = "<?php echo $u_token;?>";
        $.ajax({
          url: 'mdf-sale.php',
          type: 'POST',
          data: { sell_amount: sell_amount, token: token },
          success: function(){
            document.getElementById("mdf_sell_amnt").innerHTML = "0";
            document.getElementById("mdf_sell_val").innerHTML = "$0.00";
            var sold_msg = "Sale attempted of " + sell_amount + " $MDF. \n You can check your balances on the main page of the Wallet app.";
            alert(sold_msg);
          },
          error: function() {
            alert('Something went wrong. Please try again.');
          }
        });

        $("#sell_input").val('');
        document.getElementById("mdf_sell_amnt").innerHTML = "0";
        document.getElementById("mdf_sell_val").innerHTML = "$0.00";
      }
    }
    function amntSellVal(a) {
      var sell_amount = $("#sell_input").val();
      document.getElementById("mdf_sell_amnt").innerHTML = sell_amount;
      $.get("mdf-selvue.php?a=" + sell_amount, function(d) {
        $("#mdf_sell_val").html(d);
      });
    }
    function walMDF() {
      $.get("https://misdew.com/wallet/live-wallet.php?i=mdf", function(d) {
        $("#mdf_wallet").html(d);
      });
    }
    setInterval('walMDF()', 1000);
    // wallets
    function upMDF() {
      $.get("https://misdew.com/wallet/live-price.php?i=mdf", function(d) {
        $("#mdf_liveprice").html(d);
      });
    }
    setInterval('upMDF()', 1000);
    function valMDF() {
      $.get("https://misdew.com/wallet/live-value.php?i=mdf", function(d) {
        $("#mdf_liveval").html(d);
      });
    }
    setInterval('valMDF()', 1000);
    </script>
  </body>
  </html>
