<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/hub') {
  $loc_desc = "chillin\' on the hub";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/hub' WHERE uid='$u_uid'");
}
$oldFigure = "20";
$newFigure = "400";

$percentChange = (1 - $oldFigure / $newFigure) * 100;
$percentChange = 100 - $percentChange;
if($u_hub_theme == 'droplets') {
  $hub_bg_color = "#f7f7f7";
  $hub_bg_img = "/img/hub-bg1.png";
  $hub_bg_props = "background-repeat: repeat";
}
elseif($u_hub_theme == 'stars') {
  $hub_bg_color = "#000";
  $hub_bg_img = "/img/hub-bg2.jpeg";
  $hub_bg_props = "background-size: cover; background-repeat: no-repeat";
}
elseif($u_hub_theme == 'galaxy') {
  $hub_bg_color = "#000";
  $hub_bg_img = "/img/hub-bg3.jpeg";
  $hub_bg_props = "background-size: cover; background-repeat: no-repeat";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hub+ | Misdew.com</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="<?php echo $meta_theme_color; ?>">
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
  .header {
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 4px 4px rgba(0,0,0,0.23);
  }
  .shout_div_contain {
  position: relative;
  width: 60%;
  max-width: 300px;
  margin: auto;
  border-radius: 50px;
}
.shout_dislike {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  padding: 10px;
  position: absolute;
  width: 20px;
  height: 20px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -15%;
  right: -2%;
  z-index: 3;
}
.shout_like {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  padding: 10px;
  position: absolute;
  width: 20px;
  height: 20px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -15%;
  left: -2%;
  z-index: 3;
}
#fp_2 {
  background-color: #f7f7f7;
  background-image: url('/img/hub-bg1.png');
  background-repeat: repeat;
}
.feed_post, .ptb3_td1, .ptb3_td2, .ptb3_td3 {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}
.feed_parea {
  background-image: url('/img/hub-bg1.png');
  background-repeat: repeat;
  background-color: #f7f7f7;
  color: #000;
}
::-webkit-input-placeholder {
  color: #000;
}
:-moz-placeholder {
  color: #000;
  opacity: 1;
}
::-moz-placeholder {
  color: #000;
  opacity: 1;
}
:-ms-input-placeholder {
  color: #000;
}
  </style>
</head>
<body>
  <center>
    <?php
    $back_button = false;
    $hub = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    echo "<div id=\"entire_shout\">";
    require_once("shout.php");
    echo "</div>";
?>



    <div id="postIt" style="display: none;">
      <form id="feed_form" method="post" action="shoutit.php">
        <table class="postbox_tb" style="border-top-left-radius: 1em; border-top-right-radius: 1em; background-color: #f7f7f7; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
          <tr>
            <td>
              <textarea maxlength="75" id="fpostb" name="post" rows="3" class="feed_parea" placeholder="type something..."></textarea>
            </td>
          </tr>
        </table>
        <div id="shout_timeslots" style="display: none;">
          <table class="postbox_tb" style="padding: 0px; padding-bottom: 6px; background-color: #e7e7e7; border-top: 1px solid #c7c7c7; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); font-family: 'Dosis', sans-serif;">
            <tr>
              <td>
                <span style="font-size: 12px; color: #808080;">
                  How long do you want your Shout to show? <br>
                  <select name="shoutTimePick" id="shoutTimePick">
                    <option value="1" selected>1 hour = -1,000 MDF</option>
                    <option value="2">2 hours = -2,000 MDF</option>
                    <option value="3">3 hours = -3,000 MDF</option>
                    <option value="4">4 hours = -4,000 MDF</option>
                    <option value="5">5 hours = -5,000 MDF</option>
                  </select>
                </span>
              </td>
            </tr>
          </table>
        </div>
        <table class="postbox_tb" id="postbox_tb2" style="border-bottom-left-radius: 1em; border-bottom-right-radius: 1em; padding-top: 5px; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
            <td class="postbox2_td">
              <i onclick="shoutTimeExp('shout_timeslots');" class="fa fa-clock-o" aria-hidden="true" style="color: #fff;"></i>
            </td>
            <td class="postbox2_td2">
              <input type="submit" value="shout" class="postbox_sub" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
            </td>
            <td class="postbox2_td">
              <i onclick="alert('You are about to make a Shout. The first person to successfuly post theirs is shown until the time selected expires.');" class="fa fa-bullhorn" aria-hidden="true" style="color: #fff;"></i>
            </td>
          </tr>
        </table> <br>
      </form>
      </div>


    <?php
    // funds
    echo "<table class=\"funds_cont\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); border-top-left-radius: 1em; border-top-right-radius: 1em;\">";
    echo "<tr>";
    echo "<td class=\"funds_td1\">";
    echo "<i class=\"fa fa-university\" aria-hidden=\"true\"></i> ";
    echo "<span onclick=\"window.location='/wallet';\">Wallet <sup><span style=\"font-size: 12px;\"><i class=\"fa fa-external-link-square\"></i></span></sup></span>";
    echo "</td>";
    echo "<td class=\"funds_td2\"><span style=\"font-weight: bold;\">";
    $funds_bal = number_format((float)$u_funds, 2, '.', '');
    echo number_format($funds_bal, 2, '.', ',');
    //echo " MDF";
    echo "</span><span style=\"font-size: 14px;\"> MDF</span>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    // app tray
    $query = mysqli_query($conx, "SELECT app_uqid FROM user_apps WHERE uid='$u_uid' && hidden='no' ORDER BY arrange");
    $per_row = 4;
    $app_id  = 0;
    echo "<table class=\"hub_apps\" style=\"padding-top: 8px; padding-bottom: 8px; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); background-color: $hub_bg_color !important; background-image:url('$hub_bg_img'); $hub_bg_props;\">";
    while ($app = mysqli_fetch_assoc($query)) {
      $app_id = $app_id + 1;
      if ($app_id % $per_row == 1) {
        echo "<tr>";
      }
      $app_uqid = $app['app_uqid'];
      $appy = mysqli_query($conx, "SELECT uqid,title,app_color,app_titlecolor,link,icon FROM apps WHERE uqid='$app_uqid'");
      while($ap = mysqli_fetch_assoc($appy)) {
        $app_uqqid = $ap['uqid'];
        $app_color = $ap['app_color'];
        $app_tcolor = $ap['app_titlecolor'];
        if($u_hub_theme == 'droplets') {
          $app_tcolor = "#000";
        }
        elseif($u_hub_theme == 'stars') {
          $app_color = "#252525";
          $app_tcolor = "#fff";
        }
        elseif($u_hub_theme == 'galaxy') {
          $app_color = "#003e66";
          $app_tcolor = "#fff";
        }
        $app_name = $ap['title'];
        $app_link = $ap['link'];
        $app_icon = $ap['icon'];
      }
      echo "<td style=\"background-color: transparent; padding-bottom: 3px;padding-top: 3px;\" class=\"appc_$app_uqqid\">
                  <center>
                  <table style=\"width: 100%; max-width: 80px;\" class=\"darkatb\">
                    <tr>
                      <td class=\"appi_$app_uqqid\" onclick=\"window.location='$app_link';\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); border-radius: 1em; background-image:url('$app_icon'); background-color: $app_color; background-size: 100% 100%; padding: 25px; font-family: 'Dosis', sans-serif; text-align: center; font-size: 20px;\">&nbsp;</td>
                    </tr>
                  </table>
                  <span style=\"color: $app_tcolor; font-family: 'Dosis', sans-serif; font-weight: bold; font-size: 11px;\">$app_name</span>
                </td>";
      if ($app_id % $per_row == 0)
        echo "</tr>";
    }
    $spacercells = $per_row - ($app_id % $per_row);
    if ($spacercells < $per_row) {
      for ($j=1; $j <= $spacercells; $j++) {
        //"<td></td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    ?>
    <div id="hub_themez" style="display: none; ";><table class="hub_apps" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); padding-top: 5px; padding-bottom: 5px; font-size: 14px; text-align: center; color: #878787; font-family: 'Dosis', sans-serif; background-color: #f2f2f2;">
      <tr>
        <td onclick="var log_conf=confirm('Use \'Droplets\' theme?');if(log_conf == true){window.location='theme.php?i=droplets&&t=<?php echo $u_token; ?>';}" style="background-image:url('/img/hub-bg1.png');background-repeat:repeat;font-weight: bold; color: #000; padding: 12px;">
          Droplets
        </td>
        <td onclick="var log_conf=confirm('Use \'Stars\' theme?');if(log_conf == true){window.location='theme.php?i=stars&&t=<?php echo $u_token; ?>';}" style="background-image:url('/img/hub-bg2.jpeg');background-size: cover; background-repeat: no-repeat; font-weight: bold; color: #fff; padding: 12px;">
          Stars
        </td>
        <td onclick="var log_conf=confirm('Use \'Galaxy\' theme?');if(log_conf == true){window.location='theme.php?i=galaxy&&t=<?php echo $u_token; ?>';}" style="background-image:url('/img/hub-bg3.jpeg');background-size: cover; background-repeat: no-repeat; font-weight: bold; color: #fff; padding: 12px;">
          Galaxy
        </td>
      </tr>
    </table></div>
    <table class="hub_apps" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); border-bottom-left-radius: 1em; border-bottom-right-radius: 1em; padding-top: 5px; padding-bottom: 5px; font-size: 14px; text-align: center; color: #878787; font-family: 'Dosis', sans-serif; background-color: #f2f2f2;">
      <tr>
        <td onclick="expandZ('hub_themez');" style="border-right: 1px solid #878787;">
          Change Theme
        </td>
        <td onclick="window.location='/market'" style="border-left: 1px solid #878787;">
          App Market
        </td>
      </tr>
    </table> <br>
    <?php
    if($u_cont_mang == 'yes' || $u_comm_mang == 'yes' || $u_design_pol == 'yes' || $u_peacekpr == 'yes') {
      echo "<div onclick=\"window.location='/lounge';\" class=\"hub_lounge\">Looks like you have special permissions. <br> Tap here to visit the staff lounge. <br>
      <i class=\"fa fa-bed\" aria-hidden=\"true\"></i></div>";
      echo "<br>";
    }
    echo "<div id=\"recently_active\" style=\"display: none;\">";
    require_once("recently_active.php");
    echo "</div>";
    echo "<div id=\"online_list\">";
    require_once("online_list.php");
    echo "</div><br>";

    ?>

    <?php
    // Code of Conduct / ToS
    echo "<div class=\"code_of_conduct\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); border-radius: 1em;\">
      <span style=\"font-size: 20px; font-weight: bold;\">Code of Conduct</span> <br>";
      $codeq = mysqli_query($conx, "SELECT num,weight,content FROM codes ORDER BY num ASC");
      while($coder = mysqli_fetch_assoc($codeq)) {
        $code_num = $coder['num'];
        $code_weight = $coder['weight'];
        $code_content = $coder['content'];
        echo "<span style=\"font-weight: bold;\">#$code_num:</span> ";
        echo "$code_content <span style=\"font-size: 11px; font-weight: bold;\">[$code_weight]</span><br>";
      }
      echo "<span style=\"font-size: 12px;\">";
      echo "Each violation automatically adds up. Jailing occurs after 2 strikes. <br>";
      echo "By accessing/using Misdew, you are agreeing to our <span onclick=\"window.location='/privacy-policy.html'\" class=\"terms_exp\">Privacy Policy</span>. <br>";
      echo "The Code of Conduct and Privacy Policy may be modified at any time.";
      echo "</span>";
      echo "</div>";
      ?>
    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  <script>
  function shoutTimeExp(id) {
    var e = document.getElementById(id);
    if(e.style.display == '') {
      $("#shout_timeslots").slideUp(500);
    }
    else {
      $("#shout_timeslots").slideDown(500);
      e.style.display = '';
    }
  }
  function shoutLikeDis(i,v) {
    var token = "<?php echo $u_token; ?>";
    $.ajax({
    url: 'shout_likedis.php',
    type: 'POST',
    data: { token: token, id: i, likedis: v },
    success: function(data){
      if(data == '') {
        updShout();
      }
    },
    error: function(data) {
      updShout();
    }
  });
  }
  $("#feed_form").submit(function(e){
    e.preventDefault();
    if($("textarea[name=post]").val().trim() == "")
    return;
    $.post("shoutit.php", {body: $("textarea[name=post]").val(), timeslot: $("select[name=shoutTimePick]").val(), submit: "send"}, function(data) {
      if(data != '') {
        expand('postIt');
        updShout();
      }
      else {
        expand('postIt');
        updShout();
      }
    });
    expand('postIt');
    updShout();
    $("textarea[name=post]").val("");
  });
  function updShout() {
    $.get("shout.php", function(d) {
      $("#entire_shout").html(d);
    });
  }
  function writePost() {
    expand('postIt');
  }
  function more(id) {
    var e = document.getElementById(id);
    if(e.style.display == '') {
      e.style.display = 'none';
      document.getElementById('show_recent').className = "fa fa-plus";
    }
    else {
      e.style.display = '';
      document.getElementById('show_recent').className = "fa fa-times";
    }
  }
  function moreRecently(id) {
    var e = document.getElementById(id);
    if(e.style.display == '') {
      $("#recently_active").slideUp(500);
    }
    else {
      $("#recently_active").slideDown(500);
      e.style.display = '';
    }
  }
  function expandZ(id) {
    var e = document.getElementById(id);
    if(e.style.display == '') {
      $("#hub_themez").slideUp(500);
    }
    else {
      $("#hub_themez").slideDown(500);
      e.style.display = '';
    }
  }
  function expand(id) {
    var e = document.getElementById(id);
    if(e.style.display == 'block')
    e.style.display = 'none';
    else
    e.style.display = 'block';
  }
  function upList() {
    $.get("online_list.php", function(d) {
      $("#online_list").html(d);
    });
  }
  setInterval('upList()', 3000);
  function recList() {
    $.get("recently_active.php", function(d) {
      $("#recently_active").html(d);
    });
  }
  setInterval('recList()', 10000);
  </script>
</body>
</html>
