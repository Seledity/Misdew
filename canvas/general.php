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
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username,picture,comm_mang,cont_mang,design_police,peacekeeper,donor,online_time,strikes,jailed,bot,bio,md_verf FROM accounts WHERE username='$g_user'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_uid = $cnv_r['uid'];
$cnv_md_verf = $cnv_r['md_verf'];
$cnv_username = $cnv_r['username'];
$cnv_picture = $cnv_r['picture'];
//
//  DATA SAVER
if($u_datasaver == 'on' && $cnv_uid != $u_uid) {
  $cnv_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
}
// DATA SAVER
//
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
$cnv_footer_fc = $cnv_der['footer_fc'];
$cnv_changes_update_bc = $cnv_der['changes_update_bc'];
$cnv_contain_design_editor_bc = $cnv_der['contain_design_editor_bc'];
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
          $block_option = "no";
        }
        # Display the appropriate badges earned by the user.
        // Community Manager Badge.
        if($cnv_comm_mang == 'yes') {
          echo "<i title=\"Community Manager\" class=\"fa fa-users\" aria-hidden=\"true\"></i> ";
          $block_option = "no";
        }
        // Account Manager Badge.
        if($cnv_cont_mang == 'yes') {
          echo "<i title=\"Content Manager\" class=\"fa fa-shield\" aria-hidden=\"true\"></i> ";
          $block_option = "no";
        }
        // Design Police Badge.
        if($cnv_design_pol == 'yes') {
          echo "<i title=\"Design Police\" class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> ";
          $block_option = "no";
        }
        // Peacekeeper Badge.
        if($cnv_peacekpr == 'yes') {
          echo "<i title=\"Peacekeeper\" class=\"fa fa-hand-peace-o\" aria-hidden=\"true\"></i> ";
          $block_option = "no";
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
          echo "<span id=\"design_mode\" onclick=\"toDesign()\"><i class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> design mode</span>";
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
  <?php
  if($cnv_md_verf == 'yes') {
    echo " <i style=\"font-size: 20px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
  }
  ?>
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
    // If Canvas is that of currently logged user, display edit icon
    if($cnv_username == $u_username) {
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
    }
    // If not, show online status
    else {
      echo "<form id=\"imgUpl\"><div class=\"photo_activity_dot\" style=\"background: $cv_activeness;";
      if ($cnv_photo_activity_dot_bc != '') {
        echo "border-color:$cnv_photo_activity_dot_bc!important;";
      }
      echo "\"></div></form>";
    }
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
<div id="bio" style="
<?php
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
?>word-break: break-word;">
  <?php
  $string = $cnv_bio;
  require("../inc/replace.php");
  echo bbc(atname(nl2br($string)));
  ?>
</div>
<?php
if($cnv_username == $u_username) {
  echo "<br>";
  echo "<div id=\"unansw_quests\">";
  require_once("unasw_questions.php");
  echo "</div>";
}
else {
  echo "<br>";
}
echo "<div id=\"frnds_ld\">";
require_once("friends.php");
echo "</div>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function remFrnd(remove_uid) {
  if (confirm('Remove?')) {
    $.ajax({
    url: 'friend_remove.php',
    type: 'POST',
    data: { remove_uid: remove_uid },
    success: function(data){
      if(data == '') {
        updFrnds();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function addFrnd(add_uid) {
  if (confirm('Request friendship?')) {
    $.ajax({
      url: 'friend_add.php',
      type: 'POST',
      data: { add_uid: add_uid },
      success: function(data){
        if(data == '') {
          updFrnds();
        }
      },
      error: function(data) {
        alert('error');
      }
    });
  }
}
function accFrnd(acc_uid) {
  if (confirm('Accept friendship?')) {
    $.ajax({
      url: 'friend_add.php?t=acc',
      type: 'POST',
      data: { add_uid: acc_uid },
      success: function(data){
        if(data == '') {
          updFrnds();
        }
      },
      error: function(data) {
        alert('error');
      }
    });
  }
}
function updQs() {
  $.get("unasw_questions.php", function(d) {
    $("#unansw_quests").html(d);
  });
}
function updFrnds() {
  $.get("friends.php?u=<?php echo $cnv_username; ?>", function(d) {
    $("#frnds_ld").html(d);
  });
}
function quesAnsw(quest_id) {
  var true_id = "answ_" + quest_id;
  var true_btn = "ansbtn_" + quest_id;
  var answer = $('#' + true_id).html();
  var answer = htmlToText(answer);
  if(answer !='') {
    $.ajax({
    url: 'question_answer.php',
    type: 'POST',
    data: { quest_id: quest_id, answer: answer },
    success: function(data){
      if(data == '') {
        $('#' + true_btn).empty();
        document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>';
        updQs();
      }
    },
    error: function(data) {
      document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>';
    }
  });
  document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
  }
}
function quesRem(quest_id) {
  if (confirm('Remove?')) {
    var true_btn = "rembtn_" + quest_id;
    $.ajax({
    url: 'question_delete.php',
    type: 'GET',
    data: { quest_id: quest_id },
    success: function(data){
      if(data == '') {
        $('#' + true_btn).empty();
        document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>';
        updQs();
      }
    },
    error: function(data) {
      document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>';
    }
  });
  document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
  }
}
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
</script>
