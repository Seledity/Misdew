<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_csplown == 'yes' && $u_csplit == 'on') {
  echo "<div id=\"cspl_upd\" style=\"width: 80%; max-width: 350px;\">
    no changes detected
  </div>
  <table class=\"cspl_table\">
    <tr>
      <td class=\"cspl_title\">
        cSplit Configuration
      </td>
    </tr>
    <tr>
      <td>
        <span class=\"cspl_desc\">The splitting of your username must be exactly the same as your username. It is case sensitive.</span>
      </td>
    </tr>
    <tr>
      <td style=\"padding: 4px; padding-bottom: 0px;\">
        <span id=\"1cspl_nchange1\" style=\"color: $u_cspcolor1 !important; font-weight: bold;\">$u_cspname1</span><span id=\"1cspl_nchange2\" style=\"color: $u_cspcolor2 !important; font-weight: bold;\">$u_cspname2</span><span id=\"1cspl_nchange3\" style=\"color: $u_cspcolor3 !important; font-weight: bold;\">$u_cspname3</span>
        to
        <span id=\"cspl_nchange1\" style=\"color: $u_cspcolor1 !important; font-weight: bold;\">$u_cspname1</span><span id=\"cspl_nchange2\" style=\"color: $u_cspcolor2 !important; font-weight: bold;\">$u_cspname2</span><span id=\"cspl_nchange3\" style=\"color: $u_cspcolor3 !important; font-weight: bold;\">$u_cspname3</span>
      </td>
    </tr>
    <tr>
      <td>
        <span class=\"cspl_desc\">Username Coloration</span>
        <input onkeypress=\"saveColor('1')\" onkeyup=\"saveColor('1')\" autocomplete=\"off\" type=\"text\" id=\"csplitc_1\" name=\"csplitc_1\" class=\"cspl_input\" placeholder=\"First Color [color/hex/rgb]\" value=\"$u_cspcolor1\"> <br>
        <input onkeypress=\"saveColor('2')\" onkeyup=\"saveColor('2')\" autocomplete=\"off\" type=\"text\" id=\"csplitc_2\" name=\"csplitc_2\" class=\"cspl_input\" placeholder=\"Second Color [color/hex/rgb]\" value=\"$u_cspcolor2\"> <br>
        <input onkeypress=\"saveColor('3')\" onkeyup=\"saveColor('3')\" autocomplete=\"off\" type=\"text\" id=\"csplitc_3\" name=\"csplitc_3\" class=\"cspl_input\" placeholder=\"Third Color [color/hex/rgb]\" value=\"$u_cspcolor3\"> <br>
        <span class=\"cspl_desc\">Username Splitting</span>
        <input onkeypress=\"saveName('1')\" onkeyup=\"saveName('1')\" autocomplete=\"off\" type=\"text\" id=\"csplitn_1\" name=\"csplitn_1\" class=\"cspl_input\" placeholder=\"First Split\" value=\"$u_cspname1\"> <br>
        <input onkeypress=\"saveName('2')\" onkeyup=\"saveName('2')\" autocomplete=\"off\" type=\"text\" id=\"csplitn_2\" name=\"csplitn_2\" class=\"cspl_input\" placeholder=\"Second Split\" value=\"$u_cspname2\"> <br>
        <input onkeypress=\"saveName('3')\" onkeyup=\"saveName('3')\" autocomplete=\"off\" type=\"text\" id=\"csplitn_3\" name=\"csplitn_3\" class=\"cspl_input\" placeholder=\"Third Split\" value=\"$u_cspname3\"> <br>
      </td>
    </tr>
  </table>
  <table class=\"cspl_table\" style=\"padding-bottom: 4px;\">
    <tr>
      <td onclick=\"updcSpl();\">
        <div class=\"cspl_upd\">Update</div>
      </td>
      <td onclick=\"disablecSpl();\">
        <div class=\"cspl_disable\">Disable</div>
      </td>
    </tr>
  </table> <br>";
}
elseif($u_csplown == 'yes' && $u_csplit == 'off') {
  echo "<table class=\"cspl_table\">
    <tr>
      <td class=\"cspl_title\">
        cSplit
      </td>
      </tr>
      <td>
        <span class=\"cspl_desc\">You own cSplit, but it is currently disabled for your account. You can enable it below.</span>
      </td>
      </tr>
    </table>
    <table class=\"cspl_table\" style=\"padding-bottom: 4px;\">
      <tr>
        <td onclick=\"enablecSpl();\">
          <center><div class=\"cspl_enable\">Enable</div></center>
        </td>
      </tr>
    </table> <br>";
}
elseif($u_csplown == 'no') {
  $u_totalc = number_format($u_cmsgs);
  echo "<table class=\"cspl_table\">
    <tr>
      <td class=\"cspl_title\">
        cSplit
      </td>
      </tr>
      <td>
        <span class=\"cspl_desc\">This feature is available only to users who have sent a total of 1,000 chat messages. So far, you have sent $u_totalc. Once you have reached that limit, you will be able to purchase cSplit for $5.00 using the command below. Remember, spamming or flooding to meet this limit is against the rules.</span>
      </td>
      </tr>
    </table>
    <table class=\"cspl_table\" style=\"padding-bottom: 4px;\">
      <tr>
        <td class=\"cspl_cmd\">
          <center>/cspl buy $u_username</center>
        </td>
      </tr>
    </table> <br>";
}
?>
