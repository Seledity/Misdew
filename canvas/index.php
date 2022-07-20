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
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username FROM accounts WHERE username='$g_user' && verified='yes'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_uid = $cnv_r['uid'];
$cnv_username = $cnv_r['username'];

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
$cnv_deq = mysqli_query($conx, "SELECT * FROM canvas_design WHERE uid='$cnv_uid'");
$cnv_der = mysqli_fetch_assoc($cnv_deq);
$cnv_info_top_bar_bg = $cnv_der['info_top_bar_bg'];
$cnv_info_top_bar_fc = $cnv_der['info_top_bar_fc'];
$cnv_contain_username_bg = $cnv_der['contain_username_bg'];
$cnv_contain_username_fc = $cnv_der['contain_username_fc'];
$cnv_contain_username_fs = $cnv_der['contain_username_fs'];
$cnv_contain_photo_bg = $cnv_der['contain_photo_bg'];
$cnv_contain_photo_dot_wd = $cnv_der['contain_photo_dot_wd'];
$cnv_contain_photo_dot_ht = $cnv_der['contain_photo_dot_ht'];
$cnv_photo_edit_pencil_bg = $cnv_der['photo_edit_pencil_bg'];
$cnv_photo_edit_pencil_bc = $cnv_der['photo_edit_pencil_bc'];
$cnv_photo_edit_pencil_fc = $cnv_der['photo_edit_pencil_fc'];
$cnv_photo_activity_dot_bc = $cnv_der['photo_activity_dot_bc'];
$cnv_picture_rd = $cnv_der['picture_rd'];
$cnv_picture_wd = $cnv_der['picture_wd'];
$cnv_picture_ht = $cnv_der['picture_ht'];
$cnv_bio_bg = $cnv_der['bio_bg'];
$cnv_bio_bc = $cnv_der['bio_bc'];
$cnv_bio_fc = $cnv_der['bio_fc'];
$cnv_bio_fs = $cnv_der['bio_fs'];
$cnv_header_bg = $cnv_der['header_bg'];
$cnv_header_tds_fc = $cnv_der['header_tds_fc'];
$cnv_bg = $cnv_der['bg'];
$cnv_actbar = $cnv_der['actbar'];
$cnv_actbar_fc = $cnv_der['actbar_fc'];
$cnv_changes_update_bg = $cnv_der['changes_update_bg'];
$cnv_changes_update_fc = $cnv_der['changes_update_fc'];
$cnv_contain_design_editor_bg = $cnv_der['contain_design_editor_bg'];
$cnv_contain_design_editor_fc = $cnv_der['contain_design_editor_fc'];
$cnv_design_editor_title_fc = $cnv_der['design_editor_title_fc'];
$cnv_design_editor_desc_fc = $cnv_der['design_editor_desc_fc'];
$cnv_spoiler_bg = $cnv_der['spoiler_bg'];
$cnv_spoiler_fc = $cnv_der['spoiler_fc'];
$cnv_spoiler_hidden_bg = $cnv_der['spoiler_hidden_bg'];
$cnv_spoiler_hidden_fc = $cnv_der['spoiler_hidden_fc'];
$cnv_design_editor_input_bg = $cnv_der['design_editor_input_bg'];
$cnv_design_editor_input_fc = $cnv_der['design_editor_input_fc'];
$cnv_design_editor_input_ph = $cnv_der['design_editor_input_ph'];
$cnv_changes_update_bc = $cnv_der['changes_update_bc'];
$cnv_contain_design_editor_bc = $cnv_der['contain_design_editor_bc'];
$cnv_footer_fc = $cnv_der['footer_fc'];
$cnv_write_answer_ph = $cnv_der['write_answer_ph'];
$cnv_question_ask_box_fc = $cnv_der['question_ask_box_fc'];
$cnv_question_ask_box_bg = $cnv_der['question_ask_box_bg'];
$cnv_question_answered_bg = $cnv_der['question_answered_bg'];
$cnv_question_answered_fc = $cnv_der['question_answered_fc'];
$cnv_question_asked_bg = $cnv_der['question_asked_bg'];
$cnv_question_asked_fc = $cnv_der['question_asked_fc'];
$cnv_question_ask_buttons_bg = $cnv_der['question_ask_buttons_bg'];
$cnv_question_ask_buttons_fc = $cnv_der['question_ask_buttons_fc'];
$cnv_question_answer_buttons_bg = $cnv_der['question_answer_buttons_bg'];
$cnv_question_answer_buttons_fc = $cnv_der['question_answer_buttons_fc'];
$cnv_questions_loadmore_bg = $cnv_der['questions_loadmore_bg'];
$cnv_questions_loadmore_fc = $cnv_der['questions_loadmore_fc'];
$cnv_question_activdot_bc = $cnv_der['question_activdot_bc'];
$cnv_nname_fc = $cnv_der['nname_fc'];
$cnv_notif_bg = $cnv_der['notif_bg'];
$cnv_notif_fc = $cnv_der['notif_fc'];
$cnv_notif_bc = $cnv_der['notif_bc'];
$cnv_nview_fc = $cnv_der['nview_fc'];
$cnv_nsnooze_fc = $cnv_der['nsnooze_fc'];
$cnv_ndismiss_fc = $cnv_der['ndismiss_fc'];
$cnv_tago_fc = $cnv_der['tago_fc'];
$cnv_frnds_ibar_fc = $cnv_der['frnds_ibar_fc'];
$cnv_frnds_ibar_bg = $cnv_der['frnds_ibar_bg'];
$cnv_frnds_cont_fc = $cnv_der['frnds_cont_fc'];
$cnv_frnds_cont_bg = $cnv_der['frnds_cont_bg'];
$cnv_frnds_activdot_bc = $cnv_der['frnds_activdot_bc'];
$cnv_pending_req_fc = $cnv_der['pending_req_fc'];
$cnv_comment_box_fc = $cnv_der['comment_box_fc'];
$cnv_comment_box_bg = $cnv_der['comment_box_bg'];
$cnv_comment_box_ph = $cnv_der['comment_box_ph'];
$cnv_comment_button_fc = $cnv_der['comment_button_fc'];
$cnv_comment_button_bg = $cnv_der['comment_button_bg'];
$cnv_comments_loadmore_bg = $cnv_der['comments_loadmore_bg'];
$cnv_comments_loadmore_fc = $cnv_der['comments_loadmore_fc'];
$cnv_comment_bg = $cnv_der['comment_bg'];
$cnv_comment_fc = $cnv_der['comment_fc'];
$cnv_comment_activdot_bc = $cnv_der['comment_activdot_bc'];
$cnv_question_ask_box_ph = $cnv_der['question_ask_box_ph'];
if($cnv_actbar_fc == '') {
  $cnv_actbar_fc = "#fff";
}
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
<!DOCTYPE html>
<html>
<head>
  <?php
  if($cnv_username == $u_username) {
    echo "<title>Canvas - Misdew</title>";
  }
  else {
    echo "<title>$cnv_username - Misdew</title>";
  }
  ?>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
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
    background-color: <?php if($cnv_bg) { echo "$cnv_bg !important;"; } else { echo $bgcolor; } ?>;
  }
  #header_tds {
    color: <?php if($cnv_header_tds_fc) { echo "$cnv_header_tds_fc !important;"; } else { echo $tdcolor; } ?> !important;
  }
  <?php
  if($cnv_comment_box_fc) {
    echo ".comment_box {";
    echo "color: $cnv_comment_box_fc !important;";
    echo "}";
  }
  if($cnv_comment_box_bg) {
    echo ".comment_box {";
    echo "background-color: $cnv_comment_box_bg !important;";
    echo "}";
  }
  if($cnv_question_ask_box_ph) {
    echo ".question_ask_box[placeholder]:empty:before {";
    echo "content: attr(placeholder);";
    echo "color: $cnv_question_ask_box_ph;";
    echo "}";
  }
  if($cnv_comment_box_ph) {
    echo ".comment_box[placeholder]:empty:before {";
    echo "content: attr(placeholder);";
    echo "color: $cnv_comment_box_ph;";
    echo "}";
  }
  if($cnv_comment_button_fc) {
    echo ".comment_button {";
    echo "color: $cnv_comment_button_fc !important;";
    echo "}";
  }
  if($cnv_comment_button_bg) {
    echo ".comment_button {";
    echo "background-color: $cnv_comment_button_bg !important;";
    echo "}";
  }
  if($cnv_comments_loadmore_bg) {
    echo "#comments_loadmore {";
    echo "background-color: $cnv_comments_loadmore_bg !important;";
    echo "}";
  }
  if($cnv_comments_loadmore_fc) {
    echo "#comments_loadmore {";
    echo "color: $cnv_comments_loadmore_fc !important;";
    echo "}";
  }
  if($cnv_comment_bg) {
    echo ".comment {";
    echo "background-color: $cnv_comment_bg !important;";
    echo "}";
  }
  if($cnv_comment_fc) {
    echo ".comment {";
    echo "color: $cnv_comment_fc !important;";
    echo "}";
  }
  if($cnv_comment_activdot_bc) {
    echo ".comment_activdot {";
    echo "border-color: $cnv_comment_activdot_bc !important;";
    echo "}";
  }


















  if($cnv_frnds_ibar_fc) {
    echo ".frnds_ibar {";
    echo "color: $cnv_frnds_ibar_fc !important;";
    echo "}";
  }
  if($cnv_frnds_ibar_bg) {
    echo ".frnds_ibar {";
    echo "background-color: $cnv_frnds_ibar_bg !important;";
    echo "}";
  }
  if($cnv_frnds_cont_fc) {
    echo ".frnds_cont {";
    echo "color: $cnv_frnds_cont_fc !important;";
    echo "}";
  }
  if($cnv_frnds_cont_bg) {
    echo ".frnds_cont {";
    echo "background-color: $cnv_frnds_cont_bg !important;";
    echo "}";
  }
  if($cnv_frnds_activdot_bc) {
    echo ".frnds_activdot {";
    echo "border-color: $cnv_frnds_activdot_bc !important;";
    echo "}";
  }
  if($cnv_pending_req_fc) {
    echo ".pending_req {";
    echo "color: $cnv_pending_req_fc !important;";
    echo "}";
  }
  if($cnv_nname_fc) {
    echo ".nname {";
    echo "color: $cnv_nname_fc !important;";
    echo "}";
  }
  if($cnv_notif_bg) {
    echo ".notif {";
    echo "background-color: $cnv_notif_bg !important;";
    echo "}";
  }
  if($cnv_notif_bc) {
    echo ".notif {";
    echo "border-top-color: $cnv_notif_bc !important;";
    echo "}";
  }
  if($cnv_notif_fc) {
    echo ".notif {";
    echo "color: $cnv_notif_fc !important;";
    echo "}";
  }
  if($cnv_nview_fc) {
    echo ".nview {";
    echo "color: $cnv_nview_fc !important;";
    echo "}";
  }
  if($cnv_nsnooze_fc) {
    echo ".nsnooze {";
    echo "color: $cnv_nsnooze_fc !important;";
    echo "}";
  }
  if($cnv_tago_fc) {
    echo ".tago {";
    echo "color: $cnv_tago_fc !important;";
    echo "}";
  }
  if($cnv_ndismiss_fc) {
    echo ".ndismiss {";
    echo "color: $cnv_ndismiss_fc !important;";
    echo "}";
  }
  if($cnv_question_ask_box_ph) {
    echo ".question_ask_box[placeholder]:empty:before {";
    echo "content: attr(placeholder);";
    echo "color: $cnv_question_ask_box_ph;";
    echo "}";
  }
  if($cnv_write_answer_ph) {
    echo ".write_answer[placeholder]:empty:before {";
    echo "content: attr(placeholder);";
    echo "color: $cnv_write_answer_ph;";
    echo "}";
  }
  if($cnv_question_ask_box_fc) {
    echo ".question_ask_box {";
    echo "color: $cnv_question_ask_box_fc;";
    echo "}";
  }
  if($cnv_question_ask_box_bg) {
    echo ".question_ask_box {";
    echo "background-color: $cnv_question_ask_box_bg;";
    echo "}";
  }
  if($cnv_question_answered_bg) {
    echo ".question_answered {";
    echo "background-color: $cnv_question_answered_bg;";
    echo "}";
  }
  if($cnv_question_answered_fc) {
    echo ".question_answered {";
    echo "color: $cnv_question_answered_fc;";
    echo "}";
  }
  if($cnv_question_asked_bg) {
    echo ".question_asked {";
    echo "background-color: $cnv_question_asked_bg;";
    echo "}";
  }
  if($cnv_question_asked_fc) {
    echo ".question_asked {";
    echo "color: $cnv_question_asked_fc;";
    echo "}";
  }
  if($cnv_question_ask_buttons_bg) {
    echo ".question_ask_buttons {";
    echo "background-color: $cnv_question_ask_buttons_bg;";
    echo "}";
  }
  if($cnv_question_ask_buttons_fc) {
    echo ".question_ask_buttons {";
    echo "color: $cnv_question_ask_buttons_fc;";
    echo "}";
  }
  if($cnv_question_answer_buttons_bg) {
    echo ".question_answer_buttons {";
    echo "background-color: $cnv_question_answer_buttons_bg;";
    echo "}";
  }
  if($cnv_question_answer_buttons_fc) {
    echo ".question_answer_buttons {";
    echo "color: $cnv_question_answer_buttons_fc;";
    echo "}";
  }
  if($cnv_questions_loadmore_bg) {
    echo "#questions_loadmore {";
    echo "background-color: $cnv_questions_loadmore_bg;";
    echo "}";
  }
  if($cnv_questions_loadmore_fc) {
    echo "#questions_loadmore {";
    echo "color: $cnv_questions_loadmore_fc;";
    echo "}";
  }
  if($cnv_question_activdot_bc) {
    echo ".question_activdot {";
    echo "border-color: $cnv_question_activdot_bc;";
    echo "}";
  }
  ?>
  <?php if($cnv_header_bg) { echo ".header { background-color: $cnv_header_bg !important; }"; } ?>
  <?php if($cnv_actbar) { echo ".canvas_actbar { background-color: $cnv_actbar !important; }"; } if($cnv_actbar_fc) { echo ".canvas_actbar { color: $cnv_actbar_fc !important; }"; } ?>
  <?php
  if($cnv_spoiler_bg) {
    echo ".spoiler {
      background-color:$cnv_spoiler_bg!important;
    }";
  }
  if($cnv_spoiler_fc) {
    echo ".spoiler {
      color:$cnv_spoiler_fc!important;
    }";
  }
  if($cnv_spoiler_hidden_bg) {
    echo ".spoiler_hidden {
      background-color:$cnv_spoiler_hidden_bg!important;
    }";
  }
  if($cnv_spoiler_hidden_fc) {
    echo ".spoiler_hidden {
      color:$cnv_spoiler_hidden_fc;important;
    }";
  }
  if($cnv_footer_fc) {
    echo ".footer {
      color:$cnv_footer_fc;important;
    }";
  }
  ?>
  </style>
  <link rel="stylesheet" type="text/css" href="/user_css/canvas/default_user.php?u=<?php echo $cnv_username; ?>">
</head>
<body>
  <center>
    <?php
    $back_button = true;
    $linebreak = false;
    $alerts = false;
    require_once("../inc/header.php");
    ?>
    <div id="action_bar" class="canvas_actbar">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td id="generalTab" onclick="toGeneral()" class="action_bar_tab" style="border-bottom: 1px solid <?php echo $cnv_actbar_fc; ?>;">
            General
          </td>
          <td id="figuresTab" onclick="toFigures()" class="action_bar_tab">
            Figures
          </td>
          <td id="interactTab" onclick="toInteract()" class="action_bar_tab">
            Interact
          </td>
        </tr>
      </table>
    </div> <br>
    <?php
    //require_once("../inc/load_alerts.php");
    echo "<div id=\"action_bar_page\">";
    require_once("general.php");
    echo "</div>";
    require_once("../inc/footer.php");
    ?>
  </center>
  <span id="bg_color" style="visibility: hidden;"><?php if($cnv_header_bg) { $bgcolor = $cnv_header_bg; } echo $bgcolor; ?></span>
  <script>
  function getStyleRuleValue(style, selector, sheet) {
      var sheets = typeof sheet !== 'undefined' ? [sheet] : document.styleSheets;
      for (var i = 0, l = sheets.length; i < l; i++) {
          var sheet = sheets[i];
          if( !sheet.cssRules ) { continue; }
          for (var j = 0, k = sheet.cssRules.length; j < k; j++) {
              var rule = sheet.cssRules[j];
              if (rule.selectorText && rule.selectorText.split(',').indexOf(selector) !== -1) {
                  return rule.style[style];
              }
          }
      }
      return null;
  }
  function getStyleRuleValueCustom(style, selector, sheet) {
      var sheets = typeof sheet !== 'undefined' ? [sheet] : document.styleSheets;
      for (var i = 1, l = sheets.length; i < l; i++) {
          var sheet = sheets[i];
          if( !sheet.cssRules ) { continue; }
          for (var j = 0, k = sheet.cssRules.length; j < k; j++) {
              var rule = sheet.cssRules[j];
              if (rule.selectorText && rule.selectorText.split(',').indexOf(selector) !== -1) {
                  return rule.style[style];
              }
          }
      }
      return null;
  }
  // Automatically set the meta-theme to the background-color of the header to ensure a more consistent design.
  var color = getStyleRuleValue('background-color', '.header');
  var color_custom = getStyleRuleValueCustom('background-color', '.header');
  if(color_custom) {
    color = color_custom;
  }
  var alt_color = document.getElementById("bg_color").innerHTML;
  if(color == '') {
    color = alt_color;
  }
  $(window).load(function () {
      $('head').append('<meta name="theme-color" content="' + color + '">');
  });
  function toGeneral() {
    document.getElementById('generalTab').innerHTML = "General..";
    $.get("general.php?u=<?php echo "$cnv_username"; ?>", function(d) {
      document.getElementById('generalTab').innerHTML = "General";
      document.getElementById("generalTab").style.borderBottom = '1px solid <?php echo $cnv_actbar_fc; ?>';
      document.getElementById("interactTab").style.borderBottom = 'none';
      document.getElementById("figuresTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toFigures() {
    document.getElementById('figuresTab').innerHTML = "Figures..";
    $.get("figures.php?u=<?php echo "$cnv_username"; ?>", function(d) {
      document.getElementById('figuresTab').innerHTML = "Figures";
      document.getElementById("generalTab").style.borderBottom = 'none';
      document.getElementById("interactTab").style.borderBottom = 'none';
      document.getElementById("figuresTab").style.borderBottom = '1px solid <?php echo $cnv_actbar_fc; ?>';
      $("#action_bar_page").html(d);
    });
  }
  function toInteract() {
    document.getElementById('interactTab').innerHTML = "Interact..";
    $.get("interact.php?u=<?php echo "$cnv_username"; ?>", function(d) {
      document.getElementById('interactTab').innerHTML = "Interact";
      document.getElementById("generalTab").style.borderBottom = 'none';
      document.getElementById("interactTab").style.borderBottom = '1px solid <?php echo $cnv_actbar_fc; ?>';
      document.getElementById("figuresTab").style.borderBottom = 'none';
      $("#action_bar_page").html(d);
    });
  }
  function toDesign() {
    document.getElementById('design_mode').innerHTML = "<i class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> design mode...";
    $.get("design_mode.php?u=<?php echo "$cnv_username"; ?>", function(d) {
      $("#action_bar_page").html(d);
    });
  }
  function toMain() {
    document.getElementById('view_mode').innerHTML = "<i class=\"fa fa-eye\" aria-hidden=\"true\"></i> view mode...";
    $.get("general.php?u=<?php echo "$cnv_username"; ?>", function(d) {
      $("#action_bar_page").html(d);
    });
  }
  </script>
</body>
</html>
