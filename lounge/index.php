<?php
$this_page = "lounge";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_cont_mang == 'yes' || $u_comm_mang == 'yes' || $u_design_pol == 'yes' || $u_peacekpr == 'yes') { }
else { header("location: /"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Lounge - Misdew</title>
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
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    # BEGIN THE LOUNGE
    echo "<div id=\"lounge_succ\" style=\"display: none;\"></div>";
    echo "<div id=\"lounge_err\" style=\"display: none;\"></div>";
    echo "<div id=\"lounge_sniff\" style=\"display: none;\"></div>";
    if($u_comm_mang == 'yes') {
    echo "<div class=\"lounge_cont\">";
    echo "<div style=\"font-size: 13px; text-align: center;\"><i class=\"fa fa-users\" aria-hidden=\"true\"></i> Community Manager</div>";
    # PROMOTION
    echo "<span class=\"lounge_title\">Promotion</span> <br>";
    echo "<span>You can grant access to badges here.</span>";
    echo "<center><table style=\"width: 100%; max-width: 450px;\"><tr>
    <td style=\"width: 100%; padding: 5px;\"><input id=\"input_1\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>
    <td onclick=\"promote('comm','1');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-users\" aria-hidden=\"true\"></i>
    </button>
    </td>
    <td onclick=\"promote('cont','1');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-shield\" aria-hidden=\"true\"></i>
    </button>
    </td>
    <td onclick=\"promote('des','1');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i>
    </button>
    </td>
    <td onclick=\"promote('pea','1');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-hand-peace-o\" aria-hidden=\"true\"></i>
    </button>
    </td>
    </tr></table></center>";
    # DEMOTION
    echo "<span class=\"lounge_title\">Demotion</span> <br>";
    echo "<span>You can revoke access to badges here.</span>";
    echo "<center><table style=\"width: 100%; max-width: 450px;\"><tr>
    <td style=\"width: 100%; padding: 5px;\"><input id=\"input_2\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>
    <td onclick=\"demote('comm','2');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-users\" aria-hidden=\"true\"></i>
    </button>
    </td>
    <td onclick=\"demote('cont','2');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-shield\" aria-hidden=\"true\"></i>
    </button>
    </td>
    <td onclick=\"demote('des','2');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i>
    </button>
    </td>
    <td onclick=\"demote('pea','2');\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-hand-peace-o\" aria-hidden=\"true\"></i>
    </button>
    </td>
    </tr></table></center>";
    # NOTIFICATION
    echo "<span class=\"lounge_title\">Notification</span> <br>";
    echo "<span>You can notify users here.</span>";
    echo "<center><table style=\"width: 100%; max-width: 450px;\"><tr>
    <td style=\"width: 100%; padding: 5px;\"><input id=\"input_notif\" type=\"text\" placeholder=\"Enter Text\" class=\"lounge_input\"></td>
    <td onclick=\"sendNotif();\">
    <button class=\"lounge_buttons\">
      <i class=\"fa fa-paper-plane\" aria-hidden=\"true\"></i>
    </button>
    </td>
    </tr></table></center>";
    echo "<span class=\"lounge_title\">Staff Log</span> <br>";
    echo "<span>Check what the staff have been up to by tapping <span onclick=\"window.location='cont_stafflog.php';\" style=\"text-decoration: underline;\">here.</a></span>";
    }
    if($u_cont_mang == 'yes') {
      echo "<div class=\"lounge_cont\">";
      echo "<div style=\"font-size: 13px; text-align: center;\"><i class=\"fa fa-shield\" aria-hidden=\"true\"></i> Content Manager</div>";
      echo "<span class=\"lounge_title\">Cleanup</span> <br>";
      echo "You can remove spam from the site here. <br> This will pretty much erase their existence from the site.";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_1011\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"> <br>";
      echo "</td>";
      echo "<td onclick=\"cleanup('1011')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center>";
      echo "<span class=\"lounge_title\">Striking</span> <br>";
      echo "You can issue strikes here. <br> Each violation automatically adds up. <br> Jailing occurs after 2 strikes. <br>";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_3\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"> <br>";
      echo "<select id=\"codes\" style=\"width: 95%;\">
        <option value=\"0\">--Select Code Violated --</option>";
        $codeq = mysqli_query($conx, "SELECT num,weight,content FROM codes ORDER BY num ASC");
        while($coder = mysqli_fetch_assoc($codeq)) {
          $code_num = $coder['num'];
          $code_weight = $coder['weight'];
          $code_content = $coder['content'];
          echo "<option value=\"$code_num\">#$code_num: $code_content [$code_weight]</option>";
        }
      echo "</select></td>";
      echo "<td onclick=\"strike('3')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center>";
      echo "<span class=\"lounge_title\">Exiling</span> <br>";
      echo "Sentence a user to jail for life here.<br>";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_4\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>";
      echo "<td onclick=\"perma('4')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center>";
      echo "<span class=\"lounge_title\">Pardoning</span> <br>";
      echo "Release a user from jail here.<br>";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_5\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>";
      echo "<td onclick=\"pardon('5')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center>";
      echo "<span class=\"lounge_title\">Alternate Account Check</span> <br>";
      echo "Check for those evading jailing here.<br> Tap the clock to auto-strike the user for evading.";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_6\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>";
      echo "<td onclick=\"evade('6')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "<td onclick=\"sniff('6')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center></div></div>";
    }
    if($u_design_pol == 'yes') {
      echo "<div class=\"lounge_cont\">";
      echo "<div style=\"font-size: 13px; text-align: center;\"><i class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> Design Police</div>";
      echo "<span class=\"lounge_title\">Disabling</span> <br>";
      echo "Kill the designing of a user here. <br> Their CSS will be erased permanently. <br> Their Design Editor will be temporarily disabled.<br>";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_7\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>";
      echo "<td onclick=\"disable('7')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center>";
      echo "<span class=\"lounge_title\">Enabling</span> <br>";
      echo "Revive the designing of a user here.<br>";
      echo "<center><table style=\"width: 95%; max-width: 450px;\"><tr>";
      echo "<td style=\"width: 100%; text-align: left;\"><input id=\"input_8\" type=\"text\" placeholder=\"Enter Username\" class=\"lounge_input\"></td>";
      echo "<td onclick=\"enable('8')\" style=\"width: 33.33%; text-align: right;\">
      <button class=\"lounge_buttons\">
        <i class=\"fa fa-check\" aria-hidden=\"true\"></i>
      </button></td>";
      echo "</tr></table></center>";
      echo "</div>";
    }
    if($u_peacekpr == 'yes') {
      echo "<div class=\"lounge_cont\">";
      echo "<div style=\"font-size: 13px; text-align: center;\"><i class=\"fa fa-hand-peace-o\" aria-hidden=\"true\"></i> Peacekeeper</div>";
      echo "Your task is to stay calm in hostile situations. Do your best to help resolve issues amongst other users peacefully.";
      echo "</div>";
    }
    // Footer
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function sendNotif() {
    if(confirm('Send this notification?')) {
      var notif_inp = $(input_notif).val();
      var a = "notify";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, notif_inp: notif_inp },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Notification sent';
          document.getElementById('lounge_succ').style.display='block';
        }
      }
      });
    }
  }
  function disable(i) {
    if(confirm('Are you sure?')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var a = "disable";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, username: username },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Disabled design of ' + username;
          document.getElementById('lounge_succ').style.display='block';
        }
      },
      error: function(data) {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
    });
    }
  }
  function enable(i) {
    if(confirm('Are you sure?')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var a = "enable";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, username: username },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Enabled design of ' + username;
          document.getElementById('lounge_succ').style.display='block';
        }
      },
      error: function(data) {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
    });
    }
  }
  function evade(i) {
    if(confirm('This will add an additional week of jail time and a strike to a user.\nDo this only if you are sure of evasion.\nProceed?')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var selectedValue = "13";
      var a = "str";
      var e = "evade";
      var p = "10";
      $.ajax({
        url: 'work.php',
        type: 'POST',
        data: { a: a, p: p, e: e, username: username },
        success: function(data){
          if(data == '') {
            document.getElementById('lounge_sniff').style.display = 'none';
            document.getElementById('lounge_err').style.display='none';
            document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Prolonged jailing of ' + username + ' [Code #10]';
            document.getElementById('lounge_succ').style.display='block';
          }
        },
        error: function(data) {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_succ').style.display='none';
          document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
          document.getElementById('lounge_err').style.display='block';
          document.getElementById('lounge_err').style.display='block';
        }
      });
    }
  }
  function sniff(i) {
    var input_name = "#input_" + i;
    var username = $(input_name).val();
    var username = username.trim();
    if(username != '') {
      var sniff = new XMLHttpRequest();
      sniff.open("GET", "sniffer.php?i=" + username, true);
      sniff.onreadystatechange = function(){
        if (sniff.readyState == 4)
          if(sniff.status == 200) {
            document.getElementById('lounge_err').style.display = 'none';
            document.getElementById('lounge_succ').style.display = 'none';
            document.getElementById('lounge_sniff').innerHTML = sniff.responseText;;
            document.getElementById('lounge_sniff').style.display = '';
            window.scrollTo(0, 0);
          }
          else {
            alert("error");
          }
      };
      sniff.send();
      return false;
    }
  }
  function perma(i) {
    if(confirm('Are you sure? This will give them a Code #0. Use this only for serious offenders using alts.')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var a = "perma";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, username: username },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Exiled ' + username;
          document.getElementById('lounge_succ').style.display='block';
        }
      },
      error: function(data) {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
    });
    }
  }
  function pardon(i) {
    if(confirm('Are you sure? This will set their jail time to 0.')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var a = "pardon";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, username: username },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Pardoned ' + username;
          document.getElementById('lounge_succ').style.display='block';
        }
      },
      error: function(data) {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
    });
    }
  }
  function promote(p,i) {
    if(confirm('Are you sure?')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      // Community Manager
      if(p == 'comm') { fa_var = "users"; }
      // Content Manager
      if(p == 'cont') { fa_var = "shield"; }
      // Design Police
      if(p == 'des') { fa_var = "paint-brush"; }
      // Peacekeeper
      if(p == 'pea') { fa_var = "hand-peace-o"; }
      var a = "promote";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, p: p, username: username },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Granted <i class="fa fa-' + fa_var + '" aria-hidden="true" style="font-size: 12px;"></i> to ' + username;
          document.getElementById('lounge_succ').style.display='block';
        }
      },
      error: function(data) {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
    });
    }
  }
  function demote(p,i) {
    if(confirm('Are you sure?')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      // Community Manager
      if(p == 'comm') { fa_var = "users"; }
      // Content Manager
      if(p == 'cont') { fa_var = "shield"; }
      // Design Police
      if(p == 'des') { fa_var = "paint-brush"; }
      // Peacekeeper
      if(p == 'pea') { fa_var = "hand-peace-o"; }
      var a = "demote";
      $.ajax({
      url: 'work.php',
      type: 'POST',
      data: { a: a, p: p, username: username },
      success: function(data){
        if(data == '') {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_err').style.display='none';
          document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Revoked <i class="fa fa-' + fa_var + '" aria-hidden="true" style="font-size: 12px;"></i> from ' + username;
          document.getElementById('lounge_succ').style.display='block';
        }
      },
      error: function(data) {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
    });
    }
  }
  function strike(i) {
    if(confirm('Are you sure?')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var selectedValue = $("#codes").val();
      var a = "str";
      var p = selectedValue;
      if(p == '0') {
        document.getElementById('lounge_sniff').style.display = 'none';
        document.getElementById('lounge_succ').style.display='none';
        document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> Must select a code';
        document.getElementById('lounge_err').style.display='block';
        document.getElementById('lounge_err').style.display='block';
      }
      else {
        $.ajax({
          url: 'work.php',
          type: 'POST',
          data: { a: a, p: p, username: username },
          success: function(data){
            if(data == '') {
              document.getElementById('lounge_sniff').style.display = 'none';
              document.getElementById('lounge_err').style.display='none';
              document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Striked ' + username + ' [Code #' + selectedValue + ']';
              document.getElementById('lounge_succ').style.display='block';
            }
          },
          error: function(data) {
            document.getElementById('lounge_sniff').style.display = 'none';
            document.getElementById('lounge_succ').style.display='none';
            document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
            document.getElementById('lounge_err').style.display='block';
            document.getElementById('lounge_err').style.display='block';
          }
        });
      }
    }
  }
  function cleanup(i) {
    if(confirm('Are you sure? This will remove most content from them on the site. Only do this if the amount of spam cannot be removed manually.')) {
      var input_name = "#input_" + i;
      var username = $(input_name).val();
      var a = "cln";
      $.ajax({
        url: 'work.php',
        type: 'POST',
        data: { a: a, username: username },
        success: function(data){
          if(data == '') {
            document.getElementById('lounge_sniff').style.display = 'none';
            document.getElementById('lounge_err').style.display='none';
            document.getElementById('lounge_succ').innerHTML = '<i class="fa fa-info-circle" aria-hidden="true"></i> Cleaned up';
            document.getElementById('lounge_succ').style.display='block';
          }
        },
        error: function(data) {
          document.getElementById('lounge_sniff').style.display = 'none';
          document.getElementById('lounge_succ').style.display='none';
          document.getElementById('lounge_err').innerHTML = '<i class="fa fa-warning" aria-hidden="true"></i> There was an error';
          document.getElementById('lounge_err').style.display='block';
          document.getElementById('lounge_err').style.display='block';
        }
      });
    }
  }
  </script>
</body>
</html>
