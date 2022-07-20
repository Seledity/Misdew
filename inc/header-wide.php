<?php
if($u_header_float == "on") {
  $header_div_xtra = " style=\"position: fixed;left: 50%; transform: translate(-50%, 0); z-index: 100; max-width: none !important;\"";
}
?><div class="header"<?php echo $header_div_xtra; ?>>
  <table style="width: 100%; text-align: center;">
    <tr>
      <?php
      if($back_button == true) {
        echo '<td style="padding-left: 15px;" onclick="window.window.history.go(-1); return false;"><i id="header_tds" class="fa fa-arrow-left" aria-hidden="true"></i></td>';
      }
      else {
        echo '<td style="padding-left: 15px;"><i id="header_tds" class="fa fa-arrow-left" aria-hidden="true" style="color: transparent !important;"></i></td>';
      }
      ?>
      <td style="width: 100%;" onclick="window.location='/hub';"><img class="mdv5_header" src="/img/header.png" alt="" style="width: 15%; padding-top: 5px;"></td>
      <td style="padding-right: 15px;" onclick="var log_conf=confirm('Are you sure you really want to logout? \nWhy not stay logged in? \nFine, go ahead. \nLogout?');if(log_conf == true){window.location='/logout?t=<?php echo $u_token; ?>';}"><i id="header_tds" class="fa fa-sign-out" aria-hidden="true"></i></td>
    </tr>
  </table>
</div>
<?php
if($u_header_float == "on") {
  echo "

  <div class=\"header\" style=\"width: 100%; max-width: none !important;\">
    <table style=\"width: 100%; text-align: center;\">
      <tr>";

        if($back_button == true) {
          echo '<td style="padding-left: 15px;" onclick="window.window.history.go(-1); return false;"><i id="header_tds" class="fa fa-arrow-left" aria-hidden="true"></i></td>';
        }
        else {
          echo '<td style="padding-left: 15px;"><i id="header_tds" class="fa fa-arrow-left" aria-hidden="true" style="color: transparent !important;"></i></td>';
        }
        echo "
        <td style=\"width: 100%;\" onclick=\"window.location='/hub';\"><img class=\"mdv5_header\" src=\"/img/header.png\" alt=\"\" style=\"width: 15%; padding-top: 5px;\"></td>
        <td style=\"padding-right: 15px;\" onclick=\"var log_conf=confirm('Are you sure you really want to logout? \nWhy not stay logged in? \nFine, go ahead. \nLogout?');if(log_conf == true){window.location='/logout?t=$u_token';}\"><i id=\"header_tds\" class=\"fa fa-sign-out\" aria-hidden=\"true\"></i></td>
      </tr>
    </table>
  </div>

  ";
}
 ?>

<?php
if($linebreak == true) {
  echo "<br>";
}
if($logged_in == true) {
  if($alerts == true) {
    if($this_page != 'alerts' && $this_page != 'home') {
      echo "<div id=\"ld_alerts\">";
      include_once("../inc/alerts.php");
      echo "</div>";
      echo "<script>setInterval('upAlerts()', 10000);</script>";
    }
}
  if($this_page != 'chat' && $this_page != 'mail') {
    echo "<script>function expand(id) {
      var e = document.getElementById(id);
      if(e.style.display == 'block')
      e.style.display = 'none';
      else
      e.style.display = 'block';
    }</script>";
  }
}
?>
<script>
function showSpoiler(obj) {
  var spoiler_hidden = obj.parentNode.getElementsByTagName("div")[0];
  if(spoiler_hidden.style.display == "none") {
    spoiler_hidden.style.display = "";
    obj.innerHTML = "<i class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i>";
  }
  else {
    spoiler_hidden.style.display = "none";
    obj.innerHTML = "<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>";
  }
}
</script>
