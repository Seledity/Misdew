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
          Transfer
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          here you will be able to: <br><br>
          send/receive currencies <br>
          convert currencies to other JustaCurrencies
        </span>
      </td>
    </tr>
  </table>
</div>
