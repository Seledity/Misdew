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
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username FROM accounts WHERE username='$g_user'")) == '0') {
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
<div class="comment_box">
  <center>
    <table style="width: 95%; word-break: break-word;">
      <tr>
        <td style="width: 100%;">
          <div id="comment" placeholder="Write a comment..." class="comment_box" contenteditable></div>
        </td>
        <td onclick="pComment();">
          <button id="pstcomm" class="comment_button">
            <i class="fa fa-pencil" aria-hidden="true"></i>
          </button>
        </td>
      </tr>
    </table>
  <center>
  </div>
<?php
echo "<div id=\"comments\">";
require_once("comments.php");
echo "</div><br>";

if($u_username != $cnv_username) {
  echo "<div class=\"question_ask_box\">
  <center>
    <table style=\"width: 95%; word-break: break-word;\">
      <tr>
        <td style=\"width: 100%;\">
          <div id=\"question\" placeholder=\"Ask a question...\" class=\"question_ask_box\" contenteditable></div>
        </td>
        <td onclick=\"askQuest('norm');\">
          <button id=\"norm\" class=\"question_ask_buttons\">
            <i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>
          </button>
        </td>
        <td onclick=\"askQuest('anon');\">
          <button id=\"anon\" class=\"question_ask_buttons\">
            <i class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i>
          </button>
        </td>
      </tr>
    </table>
  <center>
  </div>";
}
echo "<div id=\"questions\">";
require_once("questions.php");
echo "</div>";
?>
<script>
function upQs() {
  $.get("questions.php?u=<?php echo $cnv_username; ?>", function(d) {
    $("#questions").html(d);
  });
}
function upCs() {
  $.get("comments.php?u=<?php echo $cnv_username; ?>", function(d) {
    $("#comments").html(d);
  });
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
        upQs();
      }
    },
    error: function(data) {
      document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>';
    }
  });
  document.getElementById(true_btn).innerHTML = '<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
  }
}
function dComment(c_id) {
  if (confirm('Remove?')) {
    $.ajax({
    url: 'comment_delete.php',
    type: 'GET',
    data: { c_id: c_id },
    success: function(data){
      if(data == '') {
        upCs();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function loadQuests() {
  var amount = document.getElementById("qamount").value;
  var qcontent = document.getElementById("ld_quests");
  $.ajax({
    type: 'get',
    url: 'more_questions.php',
    data: {
      amntcnt:amount, c: <?php echo $cnv_uid; ?>
    },
    success: function(more_content) {
      qcontent.innerHTML = qcontent.innerHTML+more_content;
      document.getElementById("qamount").value = Number(amount)+3;
    }
  });
  var getcount = new XMLHttpRequest();
  getcount.open("GET", "questamnt.php?c=<?php echo $cnv_uid;?>", true);
  getcount.onreadystatechange = function(){
    if(getcount.readyState == 4)
    if(getcount.status == 200) {
      document.getElementById("qLd").innerHTML = '<div id=\"questions_loadmore\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
      var numCont = getcount.responseText;
      if(numCont <= Number(amount) + 3) {
        document.getElementById("qLd").innerHTML = "";
      }
    }
    else{
      alert("error");
      document.getElementById("qLd").innerHTML = '<div id=\"questions_loadmore\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
    }
  };
  getcount.send();
  return false;
}
function loadComments() {
  var camount = document.getElementById("camount").value;
  var ccontent = document.getElementById("ld_comments");
  $.ajax({
    type: 'get',
    url: 'more_comments.php',
    data: {
      amntcnt:camount, u: <?php echo $cnv_uid; ?>
    },
    success: function(more_content) {
      ccontent.innerHTML = ccontent.innerHTML+more_content;
      document.getElementById("camount").value = Number(camount)+5;
    }
  });
  var getcount = new XMLHttpRequest();
  getcount.open("GET", "cmtamnt.php?c=<?php echo $cnv_uid;?>", true);
  getcount.onreadystatechange = function(){
    if(getcount.readyState == 4)
    if(getcount.status == 200) {
      document.getElementById("cLd").innerHTML = '<div id=\"comments_loadmore\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
      var numCont = getcount.responseText;
      if(numCont <= Number(camount) + 5) {
        document.getElementById("cLd").innerHTML = "";
      }
    }
    else{
      alert("error");
      document.getElementById("qLd").innerHTML = '<div id=\"questions_loadmore\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
    }
  };
  getcount.send();
  return false;
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
function askQuest(button_used) {
  document.getElementById("anon").innerHTML = '<i class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i>';
  document.getElementById("norm").innerHTML = '<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>';
  if(button_used == 'anon') {
    ask_type = "anon";
    conf_win = "Ask anonymously?";
  }
  else {
    ask_type = "norm";
    conf_win = "Ask normally?";
  }
  if (confirm(conf_win)) {
    var question = $('#question').html();
    var question = htmlToText(question);
    if(question !='') {
      var cnv_uid = "<?php echo "$cnv_uid"; ?>";
      $.ajax({
      url: 'question_ask.php',
      type: 'POST',
      data: { question: question, ask_type: ask_type, cnv_uid: cnv_uid },
      success: function(data){
        if(data == '') {
          $('#question').empty();
          document.getElementById(ask_type).innerHTML = '<i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>';
        }
      },
      error: function(data) {
        document.getElementById(ask_type).innerHTML = '<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>';
      }
    });
    document.getElementById(ask_type).innerHTML = '<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
    }
  }
}
function pComment() {
  document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>';
  var comment = $('#comment').html();
  var comment = htmlToText(comment);
  if(comment !='') {
    var cnv_uid = "<?php echo $cnv_uid; ?>";
    $.ajax({
    url: 'post_comment.php',
    type: 'POST',
    data: { comment: comment, cnv_uid: cnv_uid },
    success: function(data){
      if(data == '') {
        $('#comment').empty();
        document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>';
        upCs();
      }
    },
    error: function(data) {
      document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>';
    }
  });
  document.getElementById("pstcomm").innerHTML = '<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
  }
}
</script>
