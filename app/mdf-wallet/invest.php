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
          Invest
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          here you will be able to: <br><br>
          invest your TRU in a simulation of real world stocks, etc <br>
          play the market right, earn more TRU to convert back into MDF, etc
        </span>
      </td>
    </tr>
  </table>
</div>
