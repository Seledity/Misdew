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
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username,picture,comm_mang,cont_mang,design_police,peacekeeper,donor,online_time,strikes,jailed,bot,bio,css FROM accounts WHERE username='$g_user'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_uid = $cnv_r['uid'];
if($cnv_uid != $u_uid) {
  header("location: /canvas");
  exit();
}
$cnv_username = $cnv_r['username'];
$cnv_picture = $cnv_r['picture'];
$cnv_comm_mang = $cnv_r['comm_mang'];
$cnv_cont_mang = $cnv_r['cont_mang'];
$cnv_design_pol = $cnv_r['design_police'];
$cnv_peacekpr = $cnv_r['peacekeeper'];
$cnv_donor = $cnv_r['donor'];
$cnv_onltime = $cnv_r['online_time'];
$cnv_strikes = $cnv_r['strikes'];
$cnv_jailed = $cnv_r['jailed'];
$cnv_bot = $cnv_r['bot'];
$cnv_bio = $cnv_r['bio'];
$cnv_css = $cnv_r['css'];
# Online time
$newtime = time() - $cnv_onltime;
$mens = round($newtime / 60);
if($mens <= 1) {
  $cv_activeness = "#00FF00";
}
elseif($mens <= 2) {
  $cv_activeness = "#FFA500";
}
else {
  $cv_activeness = "#FF0000";
}
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
$cnv_footer_fc = $cnv_der['footer_fc'];
$cnv_changes_update_bc = $cnv_der['changes_update_bc'];
$cnv_contain_design_editor_bc = $cnv_der['contain_design_editor_bc'];
$cnv_figures_perc_bg = $cnv_der['figures_perc_bg'];
$cnv_figures_contain_fc = $cnv_der['figures_contain_fc'];
$cnv_figures_contain_bg = $cnv_der['figures_contain_bg'];
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
$cnv_figures_percont_bg = $cnv_der['figures_percont_bg'];
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
if($cnv_design_editor_title_fc) {
  echo ".design_editor_title {
    color:$cnv_design_editor_title_fc!important;
  }";
}
if($cnv_design_editor_desc_fc) {
  echo ".design_editor_desc {
    color:$cnv_design_editor_desc_fc!important;
  }";
}
if($cnv_design_editor_input_bg) {
  echo ".design_editor_input {
    background-color:$cnv_design_editor_input_bg!important;
  }";
}
if($cnv_design_editor_input_fc) {
  echo ".design_editor_input {
    color:$cnv_design_editor_input_fc!important;
  }";
}
if($cnv_design_editor_input_ph) {
  echo ".design_editor_input::-webkit-input-placeholder {
    color: $cnv_design_editor_input_ph;
  }
  .design_editor_input:-moz-placeholder {
    color: $cnv_design_editor_input_ph;
    opacity: 1;
  }
  .design_editor_input::-moz-placeholder {
    color: $cnv_design_editor_input_ph;
    opacity: 1;
  }
  .design_editor_input:-ms-input-placeholder {
    color: $cnv_design_editor_input_ph;
  }
  #bio[placeholder]:empty:before {
  content: attr(placeholder);
  color: $cnv_design_editor_input_ph; }
  #css[placeholder]:empty:before {
  content: attr(placeholder);
  color: $cnv_design_editor_input_ph; }
  ";
}
?>
</style>
<div class="info_top_bar" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_info_top_bar_bg != '') {
  echo "background-color:$cnv_info_top_bar_bg!important;";
}
if ($cnv_info_top_bar_fc != '') {
  echo "color:$cnv_info_top_bar_fc!important;";
}
?>">
  <table style="width: 100%; text-align: center;">
    <tr>
      <td style="width: 33.33%; text-align: left;">
        <?php
        # If account is a bot.
        if($cnv_bot == 'yes') {
          echo "<i title=\"Bot\" class=\"fa fa-android\" aria-hidden=\"true\"></i> ";
        }
        # Display the appropriate badges earned by the user.
        // Community Manager Badge.
        if($cnv_comm_mang == 'yes') {
          echo "<i title=\"Community Manager\" class=\"fa fa-users\" aria-hidden=\"true\"></i> ";
        }
        // Account Manager Badge.
        if($cnv_cont_mang == 'yes') {
          echo "<i title=\"Content Manager\" class=\"fa fa-shield\" aria-hidden=\"true\"></i> ";
        }
        // Design Police Badge.
        if($cnv_design_pol == 'yes') {
          echo "<i title=\"Design Police\" class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> ";
        }
        // Peacekeeper Badge.
        if($cnv_peacekpr == 'yes') {
          echo "<i title=\"Peacekeeper\" class=\"fa fa-hand-peace-o\" aria-hidden=\"true\"></i> ";
        }
        // Donor Badge.
        if($cnv_donor == 'yes') {
          echo "<i title=\"Donor\" class=\"fa fa-heartbeat\" aria-hidden=\"true\"></i> ";
        }
        ?>
      </td>
      <td style="width: 33.33%; text-align: center;">
        <?php
        # Account standing status.
        // If the user has been jailed.
        if($cnv_jailed == 'yes') {
          echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i> <br> <span style=\"font-size: 9px;\">Account jailed</span>";
        }
        ?>
      </td>
      <td style="width: 33.33%; text-align: right;">
        <?php
        if($cnv_username != $u_username) {
          # Online status
          if($mens <= 1) {
            echo "active now";
          }
          elseif($mens <= 2) {
            echo "active recently";
          }
          else {
            echo "active ";
            echo timeago($cnv_onltime);
            echo " ago";
          }
        }
        else {
          echo "<span id=\"view_mode\" onclick=\"toMain()\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> view mode</span>";
        }
        ?>
      </td>
    </tr>
  </table>
</div>
<div class="contain_username" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_contain_username_bg != '') {
  echo "background-color:$cnv_contain_username_bg!important;";
}
if ($cnv_contain_username_fc != '') {
  echo "color:$cnv_contain_username_fc!important;";
}
if ($cnv_contain_username_fs != '') {
  echo "font-size:$cnv_contain_username_fs!important;";
}
?>">
  <?php echo $cnv_username; ?>
</div>
<div class="contain_photo" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_contain_photo_bg != '') {
  echo "background-color:$cnv_contain_photo_bg!important;";
}
?>">
<div class="contain_photo_dot" stlye="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_contain_photo_dot_wd != '') {
  echo "width:$cnv_contain_photo_dot_wd!important;";
}
if ($cnv_contain_photo_dot_ht != '') {
  echo "height:$cnv_contain_photo_dot_ht!important;";
}
?>">
    <?php
    echo "<div class=\"photo_edit_pencil\" style=\"";
    if ($cnv_photo_edit_pencil_bg != '') {
      echo "background-color:$cnv_photo_edit_pencil_bg!important;";
    }
    if ($cnv_photo_edit_pencil_bc != '') {
      echo "border-color:$cnv_photo_edit_pencil_bc!important;";
    }
    echo "\"><span id=\"loader\"><i onclick=\"selectFile();\" id=\"fPath\" class=\"fa fa-pencil\" aria-hidden=\"true\" style=\"";
    if ($cnv_photo_edit_pencil_fc != '') {
      echo "color:$cnv_photo_edit_pencil_fc!important;";
    }
    echo "\"></i></span></div>";
    echo "<form id=\"imgUpl\" action=\"picture_upl.php\" enctype=\"multipart/form-data\" method=\"post\">
      <input id=\"fBrowse\" name=\"img\" type=\"file\" style=\"display: none;\">
      </form>";
    ?>
    <img id="picture" src="<?php echo $cnv_picture; ?>" style="
    <?php
    # DESIGN EDITOR STYLING #
    if ($cnv_picture_rd != '') {
      echo "border-radius:$cnv_picture_rd!important;";
    }
    if ($cnv_picture_wd != '') {
      echo "width:$cnv_picture_wd!important;";
    }
    if ($cnv_picture_ht != '') {
      echo "height:$cnv_picture_ht!important;";
    }
    ?>">
  </div>
</div>
<div id="changes_update_bio" class="changes_update" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_changes_update_bg != '') {
  echo "background-color:$cnv_changes_update_bg!important;";
}
if ($cnv_changes_update_fc != '') {
  echo "color:$cnv_changes_update_fc!important;";
}
if ($cnv_changes_update_bc != '') {
  echo "border-top-color:$cnv_changes_update_bc!important;";
}
?>">
  no changes detected</div>
<div onkeyup="editBio()" onkeypress="editBio()" id="bio" style="<?php
# DESIGN EDITOR STYLING #
if ($cnv_bio_bg != '') {
  echo "background-color:$cnv_bio_bg!important;";
}
if ($cnv_bio_fc != '') {
  echo "color:$cnv_bio_fc!important;";
}
if ($cnv_bio_fs != '') {
  echo "font-size:$cnv_bio_fs!important;";
}
if ($cnv_bio_bc != '') {
  echo "border-top-color:$cnv_bio_bc!important;";
}
?>" placeholder="Enter bio..." contenteditable><?php echo nl2br($cnv_bio); ?></div>
<br>
<div id="changes_update_css" class="changes_update" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_changes_update_bg != '') {
  echo "background-color:$cnv_changes_update_bg!important;";
}
if ($cnv_changes_update_fc != '') {
  echo "color:$cnv_changes_update_fc!important;";
}
if ($cnv_changes_update_bc != '') {
  echo "border-top-color:$cnv_changes_update_bc!important;";
}
?>">no changes detected</div>
<div class="contain_design_editor" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_contain_design_editor_bg != '') {
  echo "background-color:$cnv_contain_design_editor_bg!important;";
}
if ($cnv_contain_design_editor_fc != '') {
  echo "color:$cnv_contain_design_editor_fc!important;";
}
if ($cnv_contain_design_editor_bc != '') {
  echo "border-top-color:$cnv_contain_design_editor_bc!important;";
}
?>">
  <div class="design_editor_options"><span onclick="window.location='/canvas';"><i class="fa fa-eye" aria-hidden="true"></i> View Design</span> &nbsp; &nbsp; &nbsp; &nbsp; <span onclick="var log_conf=confirm('Empty?');if(log_conf == true){emptyCSS();}"><i class="fa fa-trash" aria-hidden="true"></i> Empty Form</span></div>
<div class="design_editor_input" onkeyup="editCSS();" onkeypress="editCSS();" id="css" style="border-top: none;" placeholder="Enter CSS..." contenteditable><?php echo nl2br($cnv_css); ?></div>
</div> <br>
<div id="changes_update_design" class="changes_update" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_changes_update_bg != '') {
  echo "background-color:$cnv_changes_update_bg!important;";
}
if ($cnv_changes_update_fc != '') {
  echo "color:$cnv_changes_update_fc!important;";
}
if ($cnv_changes_update_bc != '') {
  echo "border-top-color:$cnv_changes_update_bc!important;";
}
?>">no changes detected <br> hit enter to ensure save
</div>
<div class="contain_design_editor" style="
<?php
# DESIGN EDITOR STYLING #
if ($cnv_contain_design_editor_bg != '') {
  echo "background-color:$cnv_contain_design_editor_bg!important;";
}
if ($cnv_contain_design_editor_fc != '') {
  echo "color:$cnv_contain_design_editor_fc!important;";
}
if ($cnv_contain_design_editor_bc != '') {
  echo "border-top-color:$cnv_contain_design_editor_bc!important;";
}
?>">
  <div class="design_editor_options"><span onclick="window.location='/canvas';"><i class="fa fa-eye" aria-hidden="true"></i> View Design</span> &nbsp; &nbsp; &nbsp; &nbsp; <span onclick="var log_conf=confirm('Empty?');if(log_conf == true){emptyForm();}"><i class="fa fa-trash" aria-hidden="true"></i> Empty Form</span></div>
  <!-- Design editor: .body -->
  <span class="design_editor_title">.body</span> <br>
  <span class="design_editor_desc">This contains your entire Canvas page.</span> <br>
  <input value="<?php echo $cnv_bg; ?>" id="bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .header -->
  <span class="design_editor_title">.header</span> <br>
  <span class="design_editor_desc">This is at the very top of every page on Misdew.</span> <br>
  <input value="<?php echo $cnv_header_bg; ?>" id="header_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .header_tds -->
  <span class="design_editor_title">.header_tds</span> <br>
  <span class="design_editor_desc">These are the navigational icons on the Misdew header.</span> <br>
  <input value="<?php echo $cnv_header_tds_fc; ?>" id="header_tds_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Color [color/hex/rgb]">
  <!-- Design editor: .canvas_actbar -->
  <span class="design_editor_title">.canvas_actbar</span> <br>
  <span class="design_editor_desc">This is the navigational bar at the bottom of the Misdew header.</span> <br>
  <input value="<?php echo $cnv_actbar; ?>" id="actbar" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Color [color/hex/rgb]">
  <input value="<?php echo $cnv_actbar_fc; ?>" id="actbar_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .info_top_bar -->
  <span class="design_editor_title">.info_top_bar</span> <br>
  <span class="design_editor_desc">This is the very top of your Canvas. It contains information about your account.</span> <br>
  <input value="<?php echo $cnv_info_top_bar_bg; ?>" id="info_top_bar_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_info_top_bar_fc; ?>" id="info_top_bar_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .contain_username -->
  <span class="design_editor_title">.contain_username</span> <br>
  <span class="design_editor_desc">This is the part of your Canvas that contains your username in big, bold letters.</span> <br>
  <input value="<?php echo $cnv_contain_username_bg; ?>" id="contain_username_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_contain_username_fc; ?>" id="contain_username_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_contain_username_fs; ?>" id="contain_username_fs" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Size [px]">
  <!-- Design editor: .contain_photo -->
  <span class="design_editor_title">.contain_photo</span> <br>
  <span class="design_editor_desc">This part of your Canvas contains your picture.</span> <br>
  <input value="<?php echo $cnv_contain_photo_bg; ?>" id="contain_photo_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .contain_photo_dot -->
  <span class="design_editor_title">.contain_photo_dot</span> <br>
  <span class="design_editor_desc">This part of your Canvas contains your activity dot.</span> <br>
  <input value="<?php echo $cnv_contain_photo_dot_wd; ?>" id="contain_photo_dot_wd" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Width [px]">
  <input value="<?php echo $cnv_contain_photo_dot_ht; ?>" id="contain_photo_dot_ht" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Height [px]">
  <!-- Design editor: .photo_edit_pencil -->
  <span class="design_editor_title">.photo_edit_pencil</span> <br>
  <span class="design_editor_desc">This is the edit icon on your Canvas that allows you to change your picture.</span> <br>
  <input value="<?php echo $cnv_photo_edit_pencil_bg; ?>" id="photo_edit_pencil_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_photo_edit_pencil_bc; ?>" id="photo_edit_pencil_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <input value="<?php echo $cnv_photo_edit_pencil_fc; ?>" id="photo_edit_pencil_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .photo_activity_dot -->
  <span class="design_editor_title">.photo_activity_dot</span> <br>
  <span class="design_editor_desc">This is the acitvity dot on your picture that is displayed to others viewing your Canvas.</span> <br>
  <input value="<?php echo $cnv_photo_activity_dot_bc; ?>" id="photo_activity_dot_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <!-- Design editor: #picture -->
  <span class="design_editor_title">#picture</span> <br>
  <span class="design_editor_desc">This is the picture displayed on your Canvas.</span> <br>
  <input value="<?php echo $cnv_picture_rd; ?>" id="picture_rd" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Roundness [em/px]">
  <input value="<?php echo $cnv_picture_wd; ?>" id="picture_wd" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Width [px]">
  <input value="<?php echo $cnv_picture_ht; ?>" id="picture_ht" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Height [px]">
  <!-- Design editor: #bio -->
  <span class="design_editor_title">#bio</span> <br>
  <span class="design_editor_desc">This part of your Canvas contains your bio.</span> <br>
  <input value="<?php echo $cnv_bio_bg; ?>" id="bio_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_bio_bc; ?>" id="bio_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <input value="<?php echo $cnv_bio_fc; ?>" id="bio_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_bio_fs; ?>" id="bio_fs" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Size [px]">
  <!-- Design editor: .changes_update -->
  <span class="design_editor_title">.changes_update</span> <br>
  <span class="design_editor_desc">This part of your Canvas is within the design mode and contains whether or not a save has taken place.</span> <br>
  <input value="<?php echo $cnv_changes_update_bg; ?>" id="changes_update_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_changes_update_fc; ?>" id="changes_update_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
    <input value="<?php echo $cnv_changes_update_bc; ?>" id="changes_update_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <!-- Design editor: .contain_design_editor -->
  <span class="design_editor_title">.contain_design_editor</span> <br>
  <span class="design_editor_desc">This part of your Canvas is within the design mode and contains this editor.</span> <br>
  <input value="<?php echo $cnv_contain_design_editor_bg; ?>" id="contain_design_editor_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_contain_design_editor_fc; ?>" id="contain_design_editor_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_contain_design_editor_bc; ?>" id="contain_design_editor_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <!-- Design editor: .design_editor_title -->
  <span class="design_editor_title">.design_editor_title</span> <br>
  <span class="design_editor_desc">This is the title text that is displayed in the Canvas design editor.</span> <br>
  <input value="<?php echo $cnv_design_editor_title_fc; ?>" id="design_editor_title_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .design_editor_desc -->
  <span class="design_editor_title">.design_editor_desc</span> <br>
  <span class="design_editor_desc">This is the description text of the Canvas design editor.</span> <br>
  <input value="<?php echo $cnv_design_editor_desc_fc; ?>" id="design_editor_desc_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .design_editor_input -->
  <span class="design_editor_title">.design_editor_input</span> <br>
  <span class="design_editor_desc">These are the text inputs on the Canvas design editor.</span> <br>
  <input value="<?php echo $cnv_design_editor_input_bg; ?>" id="design_editor_input_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_design_editor_input_fc; ?>" id="design_editor_input_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_design_editor_input_ph; ?>" id="design_editor_input_ph" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Placeholder Color [color/hex/rgb]">
  <!-- Design editor: .spoiler -->
  <span class="design_editor_title">.spoiler</span> <br>
  <span class="design_editor_desc">This is the part of a spoiler that is always shown.</span> <br>
  <input value="<?php echo $cnv_spoiler_bg; ?>" id="spoiler_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_spoiler_fc; ?>" id="spoiler_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .spoiler_hidden -->
  <span class="design_editor_title">.spoiler_hidden</span> <br>
  <span class="design_editor_desc">This is the part of a spoiler that is primarily hidden.</span> <br>
  <input value="<?php echo $cnv_spoiler_hidden_bg; ?>" id="spoiler_hidden_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_spoiler_hidden_fc; ?>" id="spoiler_hidden_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .footer -->
  <span class="design_editor_title">.footer</span> <br>
  <span class="design_editor_desc">This is at the very bottom of each page on Misdew.</span> <br>
  <input value="<?php echo $cnv_footer_fc; ?>" id="footer_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .figures_contain -->
  <span class="design_editor_title">.figures_contain</span> <br>
  <span class="design_editor_desc">This is the container that holds your Figures page.</span> <br>
  <input value="<?php echo $cnv_figures_contain_fc; ?>" id="figures_contain_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_figures_contain_bg; ?>" id="figures_contain_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .figures_perc -->
  <span class="design_editor_title">.figures_perc</span> <br>
  <span class="design_editor_desc">This is the bar in Figures that shows what you have.</span> <br>
  <input value="<?php echo $cnv_figures_perc_bg; ?>" id="figures_perc_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .figures_perc -->
  <span class="design_editor_title">.figures_percont</span> <br>
  <span class="design_editor_desc">This is the bar in Figures that shows what you have.</span> <br>
  <input value="<?php echo $cnv_figures_percont_bg; ?>" id="figures_percont_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .write_answer -->
  <span class="design_editor_title">.write_answer</span> <br>
  <span class="design_editor_desc">This is the area in which you respond to unanswered questions.</span> <br>
  <input value="<?php echo $cnv_write_answer_ph; ?>" id="write_answer_ph" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Placeholder Color [color/hex/rgb]">
  <!-- Design editor: .question_ask_box -->
  <span class="design_editor_title">.question_ask_box</span> <br>
  <span class="design_editor_desc">This is the area in which questions are asked.</span> <br>
  <input value="<?php echo $cnv_question_ask_box_fc; ?>" id="question_ask_box_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_question_ask_box_bg; ?>" id="question_ask_box_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_question_ask_box_ph; ?>" id="question_ask_box_ph" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Placeholder Color [color/hex/rgb]">
  <!-- Design editor: .question_asked -->
  <span class="design_editor_title">.question_asked</span> <br>
  <span class="design_editor_desc">This is the area in which questions are contained.</span> <br>
  <input value="<?php echo $cnv_question_asked_fc; ?>" id="question_asked_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_question_asked_bg; ?>" id="question_asked_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .question_answered -->
  <span class="design_editor_title">.question_answered</span> <br>
  <span class="design_editor_desc">This is the area in which answers are contained.</span> <br>
  <input value="<?php echo $cnv_question_answered_fc; ?>" id="question_answered_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_question_answered_bg; ?>" id="question_answered_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .question_ask_buttons -->
  <span class="design_editor_title">.question_ask_buttons</span> <br>
  <span class="design_editor_desc">These are the buttons next to where questions are asked.</span> <br>
  <input value="<?php echo $cnv_question_ask_buttons_fc; ?>" id="question_ask_buttons_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_question_ask_buttons_bg; ?>" id="question_ask_buttons_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .question_answer_buttons -->
  <span class="design_editor_title">.question_answer_buttons</span> <br>
  <span class="design_editor_desc">These are the buttons next to where you answer questions.</span> <br>
  <input value="<?php echo $cnv_question_answer_buttons_fc; ?>" id="question_answer_buttons_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_question_answer_buttons_bg; ?>" id="question_answer_buttons_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .questions_loadmore -->
  <span class="design_editor_title">.questions_loadmore</span> <br>
  <span class="design_editor_desc">This is the button which loads more questions.</span> <br>
  <input value="<?php echo $cnv_questions_loadmore_fc; ?>" id="questions_loadmore_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_questions_loadmore_bg; ?>" id="questions_loadmore_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .question_activdot -->
  <span class="design_editor_title">.question_activdot</span> <br>
  <span class="design_editor_desc">This is the activity dot displayed on questions.</span> <br>
  <input value="<?php echo $cnv_question_activdot_bc; ?>" id="question_activdot_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <!-- Design editor: .notif -->
  <span class="design_editor_title">.notif</span> <br>
  <span class="design_editor_desc">This is the notification that appears at the top of the page.</span> <br>
  <input value="<?php echo $cnv_notif_fc; ?>" id="notif_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_notif_bg; ?>" id="notif_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_notif_bc; ?>" id="notif_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <!-- Design editor: .nname -->
  <span class="design_editor_title">.nname</span> <br>
  <span class="design_editor_desc">This is app name on a notification.</span> <br>
  <input value="<?php echo $cnv_nname_fc; ?>" id="nname_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .nview -->
  <span class="design_editor_title">.nview</span> <br>
  <span class="design_editor_desc">This is "view" option on a notification.</span> <br>
  <input value="<?php echo $cnv_nview_fc; ?>" id="nview_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .nsnooze -->
  <span class="design_editor_title">.nsnooze</span> <br>
  <span class="design_editor_desc">This is "snooze" option on a notification.</span> <br>
  <input value="<?php echo $cnv_nsnooze_fc; ?>" id="nsnooze_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .ndismiss -->
  <span class="design_editor_title">.ndismiss</span> <br>
  <span class="design_editor_desc">This is "dismiss" option on a notification.</span> <br>
  <input value="<?php echo $cnv_ndismiss_fc; ?>" id="ndismiss_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .tago -->
  <span class="design_editor_title">.tago</span> <br>
  <span class="design_editor_desc">This is the text that tells how long ago something was.</span> <br>
  <input value="<?php echo $cnv_tago_fc; ?>" id="tago_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .frnds_ibar -->
  <span class="design_editor_title">.frnds_ibar</span> <br>
  <span class="design_editor_desc">This is the bar displayed above your friends list.</span> <br>
  <input value="<?php echo $cnv_frnds_ibar_fc; ?>" id="frnds_ibar_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_frnds_ibar_bg; ?>" id="frnds_ibar_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .frnds_cont -->
  <span class="design_editor_title">.frnds_cont</span> <br>
  <span class="design_editor_desc">This is the container for each friend on your Canvas.</span> <br>
  <input value="<?php echo $cnv_frnds_cont_fc; ?>" id="frnds_cont_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_frnds_cont_bg; ?>" id="frnds_cont_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .frnds_activdot -->
  <span class="design_editor_title">.frnds_activdot</span> <br>
  <span class="design_editor_desc">This is the activity dot displayed within your friends.</span> <br>
  <input value="<?php echo $cnv_frnds_activdot_bc; ?>" id="frnds_activdot_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
  <!-- Design editor: .pending_req -->
  <span class="design_editor_title">.pending_req</span> <br>
  <span class="design_editor_desc">This is the text displayed next to a pending friend request.</span> <br>
  <input value="<?php echo $cnv_pending_req_fc; ?>" id="pending_req_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <!-- Design editor: .comment_box -->
  <span class="design_editor_title">.comment_box</span> <br>
  <span class="design_editor_desc">This is the area in which comments are typed.</span> <br>
  <input value="<?php echo $cnv_comment_box_fc; ?>" id="comment_box_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_comment_box_bg; ?>" id="comment_box_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <input value="<?php echo $cnv_comment_box_ph; ?>" id="comment_box_ph" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Placeholder Color [color/hex/rgb]">
  <!-- Design editor: .comment_button -->
  <span class="design_editor_title">.comment_button</span> <br>
  <span class="design_editor_desc">This is the button that posts comments.</span> <br>
  <input value="<?php echo $cnv_comment_button_fc; ?>" id="comment_button_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_comment_button_bg; ?>" id="comment_button_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .comments_loadmore -->
  <span class="design_editor_title">.comments_loadmore</span> <br>
  <span class="design_editor_desc">This is the button which loads more comments.</span> <br>
  <input value="<?php echo $cnv_comments_loadmore_fc; ?>" id="comments_loadmore_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_comments_loadmore_bg; ?>" id="comments_loadmore_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .comment -->
  <span class="design_editor_title">.comment</span> <br>
  <span class="design_editor_desc">This contains each comment on your Canvas.</span> <br>
  <input value="<?php echo $cnv_comment_fc; ?>" id="comment_fc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Font Color [color/hex/rgb]">
  <input value="<?php echo $cnv_comment_bg; ?>" id="comment_bg" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Background Color [color/hex/rgb]">
  <!-- Design editor: .comment_activdot -->
  <span class="design_editor_title">.comment_activdot</span> <br>
  <span class="design_editor_desc">This is the activity dot displayed within your comments.</span> <br>
  <input value="<?php echo $cnv_comment_activdot_bc; ?>" id="comment_activdot_bc" onkeyup="saveInput(this);" onkeypress="saveInput(this);" class="design_editor_input" placeholder="Border Color [color/hex/rgb]">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function emptyForm() {
  var input_id = "empty";
  var input_var = "empty";
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "design_save.php?i=" + encodeURIComponent(input_id) + "&&v=" + encodeURIComponent(input_var), true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        document.getElementById('changes_update_design').innerHTML = "changes saved";
        $(':input').val('');
      }
      else {
        document.getElementById('changes_update_design').innerHTML = "save failed";
      }
    };
  xhr.send();
  document.getElementById('changes_update_design').innerHTML = "saving changes..";
  return false;
}
function saveInput(id) {
  var input_id = id.id;
  var input_var = id.value;
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "design_save.php?i=" + encodeURIComponent(input_id) + "&&v=" + encodeURIComponent(input_var), true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        document.getElementById('changes_update_design').innerHTML = "changes saved";
      }
      else {
        document.getElementById('changes_update_design').innerHTML = "save failed";
      }
    };
  xhr.send();
  document.getElementById('changes_update_design').innerHTML = "saving changes..";
  return false;
}
function selectFile() {
  document.getElementById('fBrowse').click();
  document.getElementById('fPath').value = document.getElementById('fBrowse').value;
}
var form = document.forms.namedItem("imgUpl");
form.addEventListener('change', function(ev) {
  var oOutput = document.querySelector("div"),
  oData = new FormData(form);
  var oReq = new XMLHttpRequest();
  document.getElementById('loader').innerHTML = "<img src='https://i.imgur.com/pvQ0NaJ.gif' height='12' width='12' alt='' style='border:0;'>";
  oReq.open("POST", "picture_upl.php", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      var cnv_pic = oReq.responseText;
      if(cnv_pic != '') {
        document.getElementById("picture").src = cnv_pic;
        document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-pencil' aria-hidden='true'></i>";
      }
      else
        document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-exclamation' aria-hidden='true'></i>";
      form.reset();
    }
  };
  oReq.send(oData);
  ev.preventDefault();
}, false);
/**
 * Returns the style for a node.
 *
 * @param n The node to check.
 * @param p The property to retrieve (usually 'display').
 * @link http://www.quirksmode.org/dom/getstyles.html
 */
function getNodeStyle( n, p ) {
  return n.currentStyle ?
    n.currentStyle[p] :
    document.defaultView.getComputedStyle(n, null).getPropertyValue(p);
}

//IF THE NODE IS NOT ACTUALLY IN THE DOM then this won't take into account <div style="display: inline;">text</div>
//however for simple things like `contenteditable` this is sufficient, however for arbitrary html this will not work
function isNodeBlock(node) {
  if (node.nodeType == document.TEXT_NODE) {return false;}
  var d = getNodeStyle( node, 'display' );//this is irrelevant if the node isn't currently in the current DOM.
  if (d.match( /^block/ ) || d.match( /list/ ) || d.match( /row/ ) ||
      node.tagName == 'BR' || node.tagName == 'HR' ||
      node.tagName == 'DIV' // div,p,... add as needed to support non-DOM nodes
     ) {
    return true;
  }
  return false;
}

/**
 * Converts HTML to text, preserving semantic newlines for block-level
 * elements.
 *
 * @param node - The HTML node to perform text extraction.
 */
function htmlToText( htmlOrNode, isNode ) {
  var node = htmlOrNode;
  if (!isNode) {node = jQuery("<span>"+htmlOrNode+"</span>")[0];}
  //TODO: inject "unsafe" HTML into current DOM while guaranteeing that it won't
  //      change the visible DOM so that `isNodeBlock` will work reliably
  var result = '';
  if( node.nodeType == document.TEXT_NODE ) {
    // Replace repeated spaces, newlines, and tabs with a single space.
    result = node.nodeValue.replace( /\s+/g, ' ' );
  } else {
    for( var i = 0, j = node.childNodes.length; i < j; i++ ) {
      result += htmlToText( node.childNodes[i], true );
      if (i < j-1) {
        if (isNodeBlock(node.childNodes[i])) {
          result += '\n';
        } else if (isNodeBlock(node.childNodes[i+1]) &&
                   node.childNodes[i+1].tagName != 'BR' &&
                   node.childNodes[i+1].tagName != 'HR') {
          result += '\n';
        }
      }
    }
  }
  return result;
}
function editBio() {
  var bio = $('#bio').html();
  var bio = htmlToText(bio);
  $.ajax({
  url: 'main_edit.php',
  type: 'POST',
  data: { bio: bio },
  success: function(data){
    if(data == '') {
      document.getElementById('changes_update_bio').innerHTML = "changes saved";
    }
  },
  error: function(data) {
    document.getElementById('changes_update_bio').innerHTML = "save failed";
  }
});
document.getElementById('changes_update_bio').innerHTML = "saving changes...";
}
function editCSS() {
  var css = $('#css').html();
  var css = htmlToText(css);
  $.ajax({
  url: 'css_edit.php',
  type: 'POST',
  data: { css: css },
  success: function(data){
    if(data == '') {
      document.getElementById('changes_update_css').innerHTML = "changes saved";
    }
  },
  error: function(data) {
    document.getElementById('changes_update_css').innerHTML = "save failed";
  }
});
document.getElementById('changes_update_css').innerHTML = "saving changes...";
}
function emptyCSS() {
  var css = "";
  $.ajax({
  url: 'css_edit.php',
  type: 'POST',
  data: { css: css },
  success: function(data){
    if(data == '') {
      $('#css').empty();
      document.getElementById('changes_update_css').innerHTML = "changes saved";
    }
  },
  error: function(data) {
    document.getElementById('changes_update_css').innerHTML = "save failed";
  }
});
document.getElementById('changes_update_css').innerHTML = "saving changes...";
}
</script>
