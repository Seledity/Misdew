<?php
$this_page = "canvas";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$g_user = safe($_GET['u']);
if($g_user == '') {
  $g_user = $u_username;
}
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username,strikes,jailed_count,joinstamp FROM accounts WHERE username='$g_user'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_uid = $cnv_r['uid'];
$cnv_joinstmp = $cnv_r['joinstamp'];
$cnv_username = $cnv_r['username'];
$cnv_strikes = $cnv_r['strikes'];
$cnv_jailed = $cnv_r['jailed_count'];
if($cnv_strikes != 1) {
  $strikes_plural = "s";
}
if($cnv_jailed != 1) {
  $jailed_plural = "s";
}

// ************************ //
// *** BLOCKING SYSTEM *** //
// ************************ //
$blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$cnv_uid'");
$blkc = mysqli_num_rows($blks);
if($blkc > 0) {
  header("location: /hub");
  exit();
}
$blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$cnv_uid'");
$blkc = mysqli_num_rows($blks);
if($blkc > 0) {
  header("location: /hub");
  exit();
}
// ************************ //
// *** BLOCKING SYSTEM *** //
// ************************ //

// User theme colors
$usri_q2 = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$cnv_uid' && theme_id='$g_themeid'");
$usri_r2 = mysqli_fetch_assoc($usri_q2);
$username_color = $usri_r2['username_color'];
$username_tcolor = $usri_r2['text_color'];
# SELECT DESIGN EDITOR STYLING #
$cnv_deq = mysqli_query($conx, "SELECT figures_perc_bg,figures_contain_fc,figures_contain_bg,figures_percont_bg FROM canvas_design WHERE uid='$cnv_uid'");
$cnv_der = mysqli_fetch_assoc($cnv_deq);
$cnv_figures_perc_bg = $cnv_der['figures_perc_bg'];
$cnv_figures_contain_fc = $cnv_der['figures_contain_fc'];
$cnv_figures_contain_bg = $cnv_der['figures_contain_bg'];
$cnv_figures_percont_bg = $cnv_der['figures_percont_bg'];
// User figures
$usr_fgq = mysqli_query($conx, "SELECT friendliness,activeness,peacekeeper,behavior FROM account_figures WHERE uid='$cnv_uid'");
$usr_fgr = mysqli_fetch_assoc($usr_fgq);
$cnv_friendliness = $usr_fgr['friendliness'];
$cnv_activeness = $usr_fgr['activeness'];
$cnv_peacekeeper = $usr_fgr['peacekeeper'];
$cnv_behavior = $usr_fgr['behavior'];
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/canvas/' . $cnv_username) {
  if($cnv_username == $u_username) {
    $loc_desc = "viewin\' their canvas";
  }
  else {
    $loc_desc = "stalkin\' a canvas";
  }
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/canvas/$cnv_username' WHERE uid='$u_uid'");
}
?>
<style type="text/css">
<?php
if($cnv_figures_contain_bg) {
  echo ".figures_contain {
    background-color: $cnv_figures_contain_bg;
  }";
}
if($cnv_figures_contain_fc) {
  echo ".figures_contain {
    color: $cnv_figures_contain_fc;
  }";
}
else {
  echo ".figures_contain {
    color: $username_color;
  }";
}
if($cnv_figures_perc_bg) {
  echo ".figures_perc {
    background-color: $cnv_figures_perc_bg;
  }";
}
else {
  echo ".figures_perc {
    background-color: $username_color;
  }";
}
if($cnv_figures_percont_bg) {
  echo ".figures_percont {
    background-color: $cnv_figures_percont_bg;
  }";
}
?>
</style>
<div class="figures_contain">
  <div style="text-align: center;"><span style="font-weight: bold; font-size: 13px;"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $cnv_username; ?> created their account <?php echo timeago($cnv_joinstmp); ?> ago.</span></div><br>
  <span style="font-weight: bold;">Friendliness

    <?php
    if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM friendliness WHERE uid='$u_uid' && uid_to='$cnv_uid' && action='up'")) == '0') {
      echo "&nbsp; <i onclick=\"addFriendliness();\" class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i>";
    }
    if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM friendliness WHERE uid='$u_uid' && uid_to='$cnv_uid' && action='down'")) == '0') {
     echo "&nbsp; <i onclick=\"subFriendliness();\" class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i>";
   }
   ?>
  </span> <br>
  <span style="font-size: 13px;">
    This is what the community has rated  <span style="font-weight: bold;"><?php echo $cnv_username; ?></span> in terms of how they act towards others.
  </span>
  <table style="width: 95%;">
    <tr>
      <td>
        <div class="figures_percont">
          <div class="figures_perc" style="width: <?php echo $cnv_friendliness; ?>%; max-width: 100%;">&nbsp;</div>
        </div>
      </td>
    </tr>
  </table> <br>

  <span style="font-weight: bold;">Activeness</span> <br>
  <span style="font-size: 13px;">
    This is how often  <span style="font-weight: bold;"><?php echo $cnv_username; ?></span> is active in the community.
  </span>
  <table style="width: 95%;">
    <tr>
      <td>
        <div class="figures_percont">
          <div class="figures_perc" style="width: <?php echo $cnv_activeness; ?>%; max-width: 100%;">&nbsp;</div>
        </div>
      </td>
    </tr>
  </table> <br>
<!--
  <span style="font-weight: bold;">Peacekeeper</span> <br>
  <span style="font-size: 13px;">
    This is what peacekeepers, account managers, and community managers have rated <span style="font-weight: bold;"><?php echo $cnv_username; ?></span> in terms of how peaceful they act in hostile situations.
  </span>
  <table style="width: 95%;">
    <tr>
      <td>
        <div class="figures_percont">
          <div class="figures_perc" style="width: <?php echo $cnv_peacekeeper; ?>%; max-width: 100%;">&nbsp;</div>
        </div>
      </td>
    </tr>
  </table> <br>

  <span style="font-weight: bold;">Behavior</span> <br>
  <span style="font-size: 13px;">
    This is a score that <span style="font-weight: bold;"><?php echo $cnv_username; ?></span> has earned for themself in terms of how they obey the rules.
  </span>
  <table style="width: 95%;">
    <tr>
      <td>
        <div class="figures_percont">
          <div class="figures_perc" style="width: <?php echo $cnv_behavior; ?>%; max-width: 100%; ">&nbsp;</div>
        </div>
      </td>
    </tr>
  </table> <br> -->
  <span style="font-size: 13px;">
    <span style="font-weight: bold;"><?php echo $cnv_username; ?></span> has been <span style="font-weight: bold;">jailed <?php echo $cnv_jailed; ?></span> time<?php echo $jailed_plural; ?>. <br>
    <span style="font-weight: bold;"><?php echo $cnv_username; ?></span> has accumulated <span style="font-weight: bold;"><?php echo $cnv_strikes; ?> strike<?php echo $strikes_plural; ?>.</span>
  </span> <br>
<?php
$cnv_strike_count = mysqli_num_rows($cnv_strq = mysqli_query($conx, "SELECT * FROM account_strikes WHERE uid_issuee='$cnv_uid' ORDER BY id DESC"));
if($cnv_strike_count != 0) {
  echo "<br>";
}
while($cnv_strr = mysqli_fetch_assoc($cnv_strq)) {
  $cnvstr_violation_code = $cnv_strr['violation_code'];
  $cnvstr_violation_time = $cnv_strr['violation_time'];
  $cnvstr_uid_issuer = $cnv_strr['uid_issuer'];
  $cnvstr_code_weight = $cnv_strr['violation_time'];
  $cnvstr_last_strike = $cnv_strr['last_strike'];
  $cnvstr_total_time = $cnv_strr['total_time'];
  $cnvstr_issued_tstamp = $cnv_strr['issued_tstamp'];
  // Select issuer information
  $cnvstr_uq = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$cnvstr_uid_issuer'");
  $cnvstr_ur = mysqli_fetch_assoc($cnvstr_uq);
  $cnvstr_username = $cnvstr_ur['username'];
  // User theme colors
  $susri_q2 = mysqli_query($conx, "SELECT username_color FROM user_theme_colors WHERE uid='$cnvstr_uid_issuer' && theme_id='$g_themeid'");
  $susri_r2 = mysqli_fetch_assoc($susri_q2);
  $strk_username_color = $susri_r2['username_color'];
  echo "<span style=\"font-weight: bold;\">Violated Code #$cnvstr_violation_code</span><br>";
  echo "<span style=\"font-size: 13px;\">";
  echo "This offense took place <span style=\"font-weight: bold;\">";
  echo timeago($cnvstr_issued_tstamp);
  $string = $cnvstr_code_weight;
  require("../inc/replace.php");
  echo " ago</span> and resulted in <span style=\"font-weight: bold;\">1 strike</span> ";
  echo "with the weight of <span style=\"font-weight: bold;\">$string</span>.";
  if($cnvstr_last_strike == 'yes') {
    echo " It also resulted in the account being jailed for <span style=\"font-weight: bold;\">$cnvstr_total_time</span>.";
  }
  echo " It was recorded and taken care of by <span onclick=\"window.location='/canvas/$cnvstr_username';\" style=\"font-weight: bold; color: $strk_username_color;\">$cnvstr_username.</span></span><br>";
}
?>
<?php
if($cnv_uid == $u_uid) {
  echo "<br><div style=\"text-align: center; font-size: 12px;\">
    Embarrassed of your strike and jail record? <br>
    Clear all of it for <b>1,000,000 MDF.</b> <br>
    <span onclick=\"eraseBad();\" style=\"text-decoration: underline;\">Tap this text to do so right now.</span>
  </div>";
}
?>
</div>
<script>
<?php
if($u_funds >= 1000000) {
  $msg = "Erase your strike and jail record? \\n Total cost: 1,000,000 MDF";
}
else {
  $msg = "You do not have enough MDF. \\n Total needed: 1,000,000 MDF";
}
?>
function eraseBad() {
  var msg = "<?php echo $msg; ?>";
  if(confirm(msg)) {
    var cnv_uid = <?php echo $cnv_uid; ?>;
    var uu_uid = <?php echo $u_uid; ?>;
    var token = "<?php echo $u_token; ?>";
    $.ajax({
    url: 'clearbad.php',
    type: 'POST',
    data: { cnv_uid: cnv_uid, uu_uid: uu_uid, token: token },
    success: function(data){
      if(data == '') {
        toFigures();
      }
    },
    error: function(data) {
      toFigures();
    }
  });
    toFigures();
  }
}
function subFriendliness() {
  if(confirm('Knock down friendliness rating?\nYou can only ever do this once per user!')) {
    var cnv_uid = <?php echo $cnv_uid; ?>;
    var action = "down";
    $.ajax({
    url: 'friendliness.php',
    type: 'POST',
    data: { cnv_uid: cnv_uid, action: action },
    success: function(data){
      if(data == '') {
        toFigures();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function addFriendliness() {
  if(confirm('Bump up friendliness rating?\nYou can only ever do this once per user!')) {
    var cnv_uid = <?php echo $cnv_uid; ?>;
    var action = "up";
    $.ajax({
    url: 'friendliness.php',
    type: 'POST',
    data: { cnv_uid: cnv_uid, action: action },
    success: function(data){
      if(data == '') {
        toFigures();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
</script>
