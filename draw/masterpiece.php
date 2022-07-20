<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$draw_id = safe($_GET['i']);
$dwq = mysqli_query($conx, "SELECT location,name,description,uid,collections,funds FROM draw WHERE id='$draw_id'");
$dwr = mysqli_fetch_assoc($dwq);
$draw_loc = $dwr['location'];
$draw_name = $dwr['name'];
$draw_description = $dwr['description'];
$draw_uid = $dwr['uid'];
$draw_collections = $dwr['collections'];
$draw_donations = $dwr['funds'];
// ************************ //
// *** BLOCKING SYSTEM *** //
// ************************ //
$blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$draw_uid'");
$blkc = mysqli_num_rows($blks);
if($blkc > 0) {
  $draw_uid = "286";
}
$blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$draw_uid'");
$blkc = mysqli_num_rows($blks);
if($blkc > 0) {
  $draw_uid = "286";
}
if($draw_uid == '286') {
  die("");
}
// ************************ //
// *** BLOCKING SYSTEM *** //
// ************************ //
$draw_donations = "$".$draw_donations;
$drwq = mysqli_query($conx, "SELECT username,md_verf FROM accounts WHERE uid='$draw_uid'");
$drwr = mysqli_fetch_assoc($drwq);
$draw_username = $drwr['username'];
$draw_vrf = $drwr['md_verf'];
if($draw_vrf == 'yes') {
  $verif_check = " <i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
}
else {
  $verif_check = "";
}
if($draw_collections == 'no' && $u_uid != $draw_uid) {
  header("location: /draw");
  exit();
}
# GET LIKE COUNT
$cntq = mysqli_query($conx, "SELECT id FROM draw_likes WHERE draw_id='$draw_id'");
$like_count = mysqli_num_rows($cntq);
if($like_count != '1') {
  $like_s_or_nah = "s";
}
else {
  $like_s_or_nah = "";
}
# HAVE THEY LIKED IT
$hasl = mysqli_query($conx, "SELECT id FROM draw_likes WHERE draw_id='$draw_id' && uid='$u_uid'");
$hasr = mysqli_fetch_assoc($hasl);
$has_liked = mysqli_num_rows($hasl);
if($has_liked == '0') {
  $like_act = "like";
}
else {
  $like_act = "unlike";
}
# GET DISLIKE COUNT
$cntq = mysqli_query($conx, "SELECT id FROM draw_dislikes WHERE draw_id='$draw_id'");
$dislike_count = mysqli_num_rows($cntq);
if($dislike_count != '1') {
  $dislike_s_or_nah = "s";
}
else {
  $dislike_s_or_nah = "";
}
# HAVE THEY DISLIKED IT
$hasl = mysqli_query($conx, "SELECT id FROM draw_dislikes WHERE draw_id='$draw_id' && uid='$u_uid'");
$hasr = mysqli_fetch_assoc($hasl);
$has_disliked = mysqli_num_rows($hasl);
if($has_disliked == '0') {
  $dislike_act = "dislike";
}
else {
  $dislike_act = "undislike";
}
# LIKE vs. DISLIKE battle
$total_both = $dislike_count + $like_count;
$like_perc = ($like_count / $total_both) * 100;
$dislike_perc = ($dislike_count / $total_both) * 100;
?>
<div class="draw_container">
  <?php echo "<span style=\"font-weight: bold;\" onclick=\"window.location='/canvas/$draw_username';\">$draw_username$verif_check</span>"; ?>
  <img src="<?php echo $draw_loc; ?>" alt="" style="display: block; width: 50%; padding: 4px;">
  <table class="draw_stats">
    <tr>
      <td style="text-align: left; width: 50%;">
        <span id="like_count"><?php echo $like_count . " like" . $like_s_or_nah; ?></span>
        &nbsp; &nbsp;
        <span id="dislike_count"><?php echo $dislike_count . " dislike" . $dislike_s_or_nah; ?></span>
      </td>
      <!--<td id="funds_raised" style="text-align: right; width: 50%;">
        <?php
        echo $draw_donations . " raised";
        ?>
      </td>-->
    </tr>
  </table>
  <div id="battle" style="width: 95%; padding: 4px;">
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <td id="like_battle" class="like_battle" style="width: <?php echo $like_perc; ?>%;">
        </td>
        <td id="dislike_battle" class="dislike_battle" style="width: <?php echo $dislike_perc; ?>%;">
        </td>
      </tr>
    </table>
  </div>
  <table style="width: 95%; text-align: center; padding: 4px;">
    <tr>
      <td class="draw_like" onclick="likeArt();">
        <i class="fa fa-thumbs-up" aria-hidden="true"></i> <span id="has_liked"><?php echo $like_act; ?></span>
      </td>
      <!--<td  class="draw_donate">
        <i class="fa fa-money" aria-hidden="true"></i> donate
      </td>-->
      <td class="draw_dislike" onclick="dislikeArt();">
        <i class="fa fa-thumbs-down" aria-hidden="true"></i> <span id="has_disliked"><?php echo $dislike_act; ?></span>
      </td>
    </tr>
  </table>
  <?php
  if($draw_uid == $u_uid) {
    echo "<div id=\"draw_changes\">no changes detected</div>";
    echo "<div onkeypress=\"eTitle();\" onkeyup=\"eTitle();\" id=\"draw_etitle\" style=\"outline: none; padding: 4px; font-weight: bold;\" contenteditable>$draw_name</div>";
    echo "<div onkeypress=\"eDesc();\" onkeyup=\"eDesc();\" id=\"draw_edesc\" style=\"outline: none; text-align: left; padding: 4px; padding-top: 0px;\" contenteditable>";
    echo "$draw_description";
    echo "</div>";
  }
  else {
    $string = $draw_name;
    require("../inc/replace.php");
    echo "<div><span style=\"font-weight: bold;\">$string</span></div>";
    echo "<div style=\"text-align: left; padding: 4px;\">";
    $string = $draw_description;
    require("../inc/replace.php");
    echo "$string";
    echo "</div>";
  }
  ?>
</div>
<table class="draw_comment">
  <tr>
    <td style="width: 100%;">
      <div id="comment" class="draw_comment_input" placeholder="Write a comment..." contenteditable></div>
    </td>
    <td>
      <button onclick="pComment();" id="pstcomm" class="draw_comment_button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
    </td>
  </tr>
</table>
<div id="inner_comments">
<?php
# SELECT COMMENTS
$cmt_cnt = mysqli_num_rows($cmt_q = mysqli_query($conx, "SELECT id,uid,tstamp,content FROM draw_comments WHERE draw_id='$draw_id' ORDER BY id DESC"));
if($cmt_cnt == 0) {
  echo "<div style=\"padding: 12px; font-family: 'Dosis', sans-serif;\" class=\"no_cont\">
  No comments <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i>
  </div>";
}
while($cmt_r = mysqli_fetch_assoc($cmt_q)) {
  $cmt_id = $cmt_r['id'];
  $cmt_uid = $cmt_r['uid'];
  $cmt_tstamp = $cmt_r['tstamp'];
  $string = $cmt_r['content'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$cmt_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $cmt_uid = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$cmt_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $cmt_uid = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  include("../inc/replace.php");
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$cmt_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    $cmt_username = $usr_r['username'];
    $cmt_pic = $usr_r['picture'];
    $cmt_onltime = $usr_r['online_time'];
    $cmnt_vrf = $usr_r['md_verf'];
    if($cmnt_vrf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $cmt_pic = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
    $HUAHHH = time() - $cmt_onltime;
    $mens = round($HUAHHH / 60);
    if($mens <= 1) {
      $cv_activeness = "#00FF00";
    }
    elseif($mens <= 2) {
      $cv_activeness = "#FFA500";
    }
    elseif($mens < 5) {
      $cv_activeness = "#FF0000";
    }
    else {
      $cv_activeness = "#FF0000";
    }
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$cmt_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = $usri_r['username_color'];
      $cmt_tcolor = $usri_r['text_color'];
    }
  }
  if($cmt_uid != '286') {
  echo "<table style=\"padding-bottom: 5px; padding-top: 5px; font-family: 'Dosis', sans-serif; width: 100%;\"><tr><td>
      <div style=\"position: relative; width: 36px; height: 36px; border-radius: 50px;\">
      <div id=\"draw_cv_act\" style=\"background-color: $cv_activeness;\"></div> <img onclick=\"window.location='/canvas/$cmt_username';\" src=\"$cmt_pic\" class=\"list_picture\"></div></td>";
      echo "<td style=\"width: 100%; text-align: left;\"><span onclick=\"window.location='/canvas/$cmt_username';\" style=\"color: $username_color; font-weight: bold;\">$cmt_username $verif_check</span>";
      echo "<span class=\"tago\" style=\"font-size: 9px;\"> &bull; ";
      echo timeago($cmt_tstamp);
      echo " ago</span> &nbsp;";
      if($cmt_uid == $u_uid) {
        echo "<i onclick=\"dComment('$cmt_id');\" class=\"fa fa-trash\" aria-hidden=\"true\" style=\"font-size: 13px; color: $username_color\"></i>";
      }
      echo "<br><span style=\"font-size: 14px;\">"; echo bbc(atname(nl2br($string))); echo "</span>";
      echo "</td></tr></table>";
    }
}
?>
</div>
<script>
function eTitle() {
  var title = $('#draw_etitle').html();
  var title = htmlToText(title);
  var draw_id = <?php echo $draw_id; ?>;
  $.ajax({
  url: 'edit.php',
  type: 'POST',
  data: { title: title, i: draw_id },
  success: function(data){
    if(data == '') {
      document.getElementById("draw_changes").innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById("draw_changes").innerHTML = 'save failed';
  }
});
document.getElementById("draw_changes").innerHTML = 'saving changes...';
}
function eDesc() {
  var desc = $('#draw_edesc').html();
  var desc = htmlToText(desc);
  var draw_id = <?php echo $draw_id; ?>;
  $.ajax({
  url: 'edit.php',
  type: 'POST',
  data: { desc: desc, i: draw_id },
  success: function(data){
    if(data == '') {
      document.getElementById("draw_changes").innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById("draw_changes").innerHTML = 'save failed';
  }
});
document.getElementById("draw_changes").innerHTML = 'saving changes...';
}
function editMode() {
  document.getElementById('d_edit').innerHTML = '<i class="fa fa-paint-brush" aria-hidden="true"></i> edit mode...';
}
function pComment() {
  document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>';
  var comment = $('#comment').html();
  var comment = htmlToText(comment);
  if(comment !='') {
    var draw_id = "<?php echo $draw_id; ?>";
    $.ajax({
    url: 'post_comment.php',
    type: 'POST',
    data: { comment: comment, draw_id: draw_id },
    success: function(data){
      if(data == '') {
        $('#comment').empty();
        document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>';
        updComments();
      }
    },
    error: function(data) {
      document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>';
    }
  });
  document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
  }
}
function updComments() {
  $.get("inner_comments.php?i=<?php echo $draw_id; ?>", function(d) {
    $("#inner_comments").html(d);
  });
}
function dComment(i) {
  if(confirm('Delete?')) {
    $.ajax({
    url: 'delete_comment.php',
    type: 'POST',
    data: { i: i },
    success: function(data){
      if(data == '') {
        updComments();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function updBattle() {
  $.get("battle.php?i=<?php echo $draw_id; ?>", function(d) {
    $("#battle").html(d);
  });
}
function likeArt() {
  document.getElementById('like_count').innerHTML = "...";
  $.ajax({
  url: 'like_art.php',
  type: 'POST',
  data: { i: <?php echo $draw_id; ?> },
  success: function(data){
    if(data == '') {
      var art = new XMLHttpRequest();
      art.open("GET", "like_amnt.php?i=" + <?php echo $draw_id; ?>, true);
      art.onreadystatechange = function(){
        if (art.readyState == 4)
          if(art.status == 200) {
            var hvy = new XMLHttpRequest();
            hvy.open("GET", "has_liked.php?i=" + <?php echo $draw_id; ?>, true);
            hvy.onreadystatechange = function(){
              if (hvy.readyState == 4)
                if(hvy.status == 200) {
                  document.getElementById('like_count').innerHTML = document.getElementById('like_count').innerHTML = art.responseText;
                  document.getElementById('has_liked').innerHTML = hvy.responseText;
                  updBattle();
                }
            };
            hvy.send();
            return false;
          }
          else {
            alert("error");
          }
      };
      art.send();
      return false;
    }
  },
  error: function(data) {
    alert('error');
  }
});
}
function dislikeArt() {
  document.getElementById('dislike_count').innerHTML = "...";
  $.ajax({
  url: 'dislike_art.php',
  type: 'POST',
  data: { i: <?php echo $draw_id; ?> },
  success: function(data){
    if(data == '') {
      var art = new XMLHttpRequest();
      art.open("GET", "dislike_amnt.php?i=" + <?php echo $draw_id; ?>, true);
      art.onreadystatechange = function(){
        if (art.readyState == 4)
          if(art.status == 200) {
            var hvy = new XMLHttpRequest();
            hvy.open("GET", "has_disliked.php?i=" + <?php echo $draw_id; ?>, true);
            hvy.onreadystatechange = function(){
              if (hvy.readyState == 4)
                if(hvy.status == 200) {
                  document.getElementById('dislike_count').innerHTML = document.getElementById('dislike_count').innerHTML = art.responseText;
                  document.getElementById('has_disliked').innerHTML = hvy.responseText;
                  updBattle();
                }
            };
            hvy.send();
            return false;
          }
          else {
            alert("error");
          }
      };
      art.send();
      return false;
    }
  },
  error: function(data) {
    alert('error');
  }
});
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
</script>
