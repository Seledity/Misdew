<?php
$this_page = "settings";
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
?>
<div class="settings_cont">
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Wallet
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          here you will be able to: <br><br>
          check balances of your currencies
        </span>
      </td>
    </tr>
  </table>
</div> <br>

<div class="settings_cont">
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          What Are JustaCurrencies?
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          Digital currencies used on websites created by <a href="/canvas/seledity" style="color: #000; font-weight: bold; text-decoration: none;">@Seledity.</a> They have no true value in the real financial world.
          They are not actually worth anything, despite what you may see or hear. They are fake/play currency. They exist only to give additional meaning to your experience on those websites. JustaCurrencies cannot be bought or sold using real currency.
        </span>
      </td>
    </tr>
  </table>


  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          What is MDF?
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          MDF is the currency used on Misdew.com <br>
          MDF is an abbreviation of Misdew Funds
        </span>
      </td>
    </tr>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          What is iSEc?
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          iSEc is the currency used on iSEclipse.com <br>
          iSEc is an abbreviation of iSEclipse Coins
        </span>
      </td>
    </tr>
  </table>
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          What is TRU?
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          TRU is a stable currency used to determine the worth of other currencies <br>
          TRU stands for "true value" <br>
          To keep things simple, TRU is tied to the US Dollar <br>
          TRU has nothing to do with real money and is not truly worth anything. <br>
        </span>
      </td>
    </tr>
  </table>
</div>
