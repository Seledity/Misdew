<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$default_spindle_uqid = safe($_GET['u']);
$split = explode('1', $default_spindle_uqid);
$spindle_uqid = $split[0];
$subspindle_uqid = $split[1];
/* GET SPINDLE INFO */
$spindles_q = mysqli_query($conx, "SELECT name,color,description,tstamp FROM forum_spindles WHERE uqid='$spindle_uqid'");
while($spindles_r = mysqli_fetch_assoc($spindles_q)) {
  $spindle_color = $spindles_r['color'];
  $spindle_name = $spindles_r['name'];
  $spindle_desc = $spindles_r['description'];
  $spindle_tstamp = $spindles_r['tstamp'];
  $spindle_actstamp = time() - $spindle_tstamp;
  $minutes = round($spindle_actstamp / 60);
  if($minutes <= 60) {
    $spindle_actdot = "#00FF00";
  }
  elseif($minutes <= 90) {
    $spindle_actdot = "#FFA500";
  }
  elseif($minutes < 120) {
    $spindle_actdot = "#FF0000";
  }
  else {
    $spindle_actdot = "#FF0000";
  }
}
/* IF IT IS A SUBSPINDLE */
if($subspindle_uqid != '') {
  $this_subspindle = true;
  /* GET SUBSPINDLE INFO */
  $spindles_q = mysqli_query($conx, "SELECT name FROM forum_subspindles WHERE uqid='$subspindle_uqid'");
  while($spindles_r = mysqli_fetch_assoc($spindles_q)) {
    $subspindle_name = $spindles_r['name'];
    if($subspindle_name != '') {
      $subspindle_name = "<br><span style=\"font-size: 12px;\">$subspindle_name</span>";
    }
  }
}
?>
<style>
/* CONTENT HERE FOR THIS PAGE */
/* MAKE SURE TO ADD TO THEMES */
/* CONTENT HERE FOR THIS PAGE */
.threads_cont {
  width: 90%;
  max-width: 450px;
  padding: 8px;
  background-color: #fff;
  font-family: 'Dosis', sans-serif;
  text-align: left;
  border-bottom: 1px dotted #ccc;
}
.spindle_details {
  width: 90%;
  max-width: 450px;
  padding: 8px;
  background-color: #fff;
  font-family: 'Dosis', sans-serif;
  text-align: left;
}
.spindle_tools {
  width: 90%;
  max-width: 450px;
  padding: 8px;
  background-color: #fff;
  font-family: 'Dosis', sans-serif;
  text-align: left;
}
.thread_name {
  font-weight: bold;
  font-size: 15px;
}
.spindle_subname {
  font-weight: bold;
  font-size: 12px;
}
.spindle_desc {
  color: #808080;
  font-size: 13px;
  text-align: center;
}
.spindle_info_cont {
  border-collapse: collapse;
  width: 100%;
}
.spindle_info {
  padding: 0;
  margin: 0;
  width: 100%;
  text-align: center;
}
.spindle_actcont {
  padding: 0;
  margin: 0;
  width: 50%;
  text-align: right;
}
.thread_info {
  padding: 0;
  margin: 0;
  width: 100%;
  text-align: left;
}
.thread_actcont {
  padding: 0;
  margin: 0;
  width: 50%;
  text-align: right;
}
#forum_no_threads {
  color: #808080;
}
#thrd_snippet {
  color: #808080;
  font-size: 12px;
}
#threads_loadmore {
  font-family: 'Dosis', sans-serif;
  outline: none;
  width: 90%;
  max-width: 450px;
  padding: 8px;
  color: #fff;
  text-align: center;
}
.thread_post_cont {
  font-size: 17px;
  width: 80%;
  max-width: 400px;
  padding: 8px;
  background-color: #fff;
  font-family: 'Dosis', sans-serif;
  text-align: left;
}
.thread_post_input {
  font-family: 'Dosis', sans-serif;
  padding: 5px;
  width: 95%;
  font-size: 18px;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: none;
  background-color: #fff;
  color: #000;
}
.thread_post_input::-webkit-input-placeholder {
  color: #808080;
}
.thread_post_input:-moz-placeholder {
  color: #808080;
  opacity: 1;
}
.thread_post_input::-moz-placeholder {
  color: #808080;
  opacity: 1;
}
.thread_post_input:-ms-input-placeholder {
  color: #808080;
}
.thread_content_tools {
  text-align: center;
  font-family: 'Dosis', sans-serif;
  background-color: #fff;
  width: 95%;
  max-width: 500px;
  padding: 8px;
  padding-bottom: 0px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  word-break: break-all;
  color: #000;
  font-size: 18px;
  font-weight: normal;
}
#thread_content_input {
  text-align: left;
  font-family: 'Dosis', sans-serif;
  background-color: #fff;
  width: 95%;
  max-width: 500px;
  padding: 8px;
  padding-top: 0px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  outline: none;
  word-break: break-all;
  color: #000;
  font-size: 18px;
  font-weight: normal;
}
#thread_content_input[placeholder]:empty:before {
  content: attr(placeholder);
  color: #808080;
  font-weight: normal;
  font-size: 18px;
}
#threadpost_upd {
  text-align: center;
  font-family: 'Dosis', sans-serif;
  width: 80%;
  max-width: 400px;
  padding: 3px;
  padding-left: 8px;
  padding-right: 8px;
  background-color: #fff;
  color: #808080;
  font-size: 13px;
  border-bottom: 1px dotted #ccc;
}
</style>

<div id="spindle_newthread" style="display: none;">
  <div id="threadpost_upd">
  no changes detected
</div>
  <div class="thread_post_cont">
  <span style="font-weight: bold; color: <?php echo $spindle_color; ?>;">Title</span> <br>
  <span style="font-size: 13px; font-weight: normal; color: #808080;">
  You can use a maximum of 50 characters for your title.
</span> <br>
  <input id="thread_title_input" class="thread_post_input" placeholder="Enter Title" maxlength="50">
  <span style="font-weight: bold; color: <?php echo $spindle_color; ?>;">Content</span> <br>
  <span style="font-size: 13px; font-weight: normal; color: #808080;">
  Be sure that you are within the appropriate Spindle before posting. <br>
  You can restore previously saved drafts <span onclick="loadRestore('<?php echo $default_spindle_uqid; ?>');" style="text-decoration: underline;">here.</span>
  <span id="drafts_load" style="display: none;"></span>
  </span> <br>
<div class="thread_content_tools">
  <center>
  <table style="width: 100%;text-align: center; font-size: 13px; font-weight: bold;">
    <tr>
      <td onclick="insertBold();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-bold" aria-hidden="true"></i>
      </td>
      <td onclick="insertItalic();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-italic" aria-hidden="true"></i>
      </td>
      <td onclick="insertUnderline();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-underline" aria-hidden="true"></i>
      </td>
      <td onclick="insertStrikethrough();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-strikethrough" aria-hidden="true"></i>
      </td>
      <td onclick="selectFile();" id="fPath" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-picture-o" aria-hidden="true"></i>
        <form id="imgUpl" action="img_upload.php" enctype="multipart/form-data" method="post">
          <input id="fBrowse" name="img" type="file" style="display: none;">
        </form>
      </td>
      <td onclick="insertYouTube();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-youtube" aria-hidden="true"></i>
      </td>
      <td onclick="insertLeftAlign();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-align-left" aria-hidden="true"></i>
      </td>
      <td onclick="insertCenterAlign();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-align-center" aria-hidden="true"></i>
      </td>
      <td onclick="insertRightAlign();" style="color: #fff; padding: 5px; border-radius: 15px; color: <?php echo $spindle_color; ?>;">
        <i class="fa fa-align-right" aria-hidden="true"></i>
      </td>
    </tr>
  </table>
</center>
</div>
<div id="thread_content_input" placeholder="Enter Content" contenteditable=""></div>

<table style="width: 100%;text-align: center; font-size: 12px; font-weight: bold;">
  <tr>
    <td onclick="pushThread('save','<?php echo $default_spindle_uqid; ?>')" style="color: #fff; padding: 5px; border-radius: 15px; width: 33.33%; background-color: <?php echo $spindle_color; ?>;">
      <i class="fa fa-floppy-o" aria-hidden="true"></i> save draft
    </td>
    <td onclick="pushThread('post','<?php echo $default_spindle_uqid; ?>')" style="color: #fff; padding: 5px; border-radius: 15px; width: 33.33%; background-color: <?php echo $spindle_color; ?>;">
      <i class="fa fa-pencil-square-o" aria-hidden="true"></i> post
    </td>
    <td onclick="expand('spindle_newthread');" style="color: #fff; padding: 5px; border-radius: 15px; width: 33.33%; background-color: <?php echo $spindle_color; ?>;">
      <i class="fa fa-times-circle-o" aria-hidden="true"></i> close
    </td>
  </tr>
</table>
</div>
<br>
</div>
<?php
echo "<div id=\"ld_threads\">";
require_once("actual_threads.php");
echo "</div>";
if($thread_count > 10) {
  echo "<div id=\"more_div\" onclick=\"loadThreads('$spindle_color');\">";
  echo "<div id=\"threads_loadmore\" style=\"background-color: $spindle_color;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>";
  echo "</div>";
}
?>
<input id="amount" type="hidden" value="10">
<script>
function loadRestore(uqid) {
  $.get("saved_drafts.php?u=" + uqid, function(d) {
    $("#drafts_load").html(d);
  });
  expandIt('drafts_load');
}
function pushThread(type,uqid) {
  var title = document.getElementById("thread_title_input").value;
  var content = $('#thread_content_input').html();
  var content = htmlToText(content);
  if(type == 'save') {
    document.getElementById('threadpost_upd').innerHTML = "saving draft..";
  }
  if(type == 'post') {
    document.getElementById('threadpost_upd').innerHTML = "posting thread..";
  }
  $.ajax({
  url: 'push_thread.php',
  type: 'POST',
  data: { type: type, uqid: uqid, title: title, content: content },
  success: function(data){
    if(data == '') {
      if(type == 'post') {
        expand('spindle_newthread');
        document.getElementById("thread_content_input").innerHTML = '';
        document.getElementById("thread_title_input").value = '';
        refreshThreads(uqid);
      }
      if(type == 'save') {
        document.getElementById('threadpost_upd').innerHTML = "saved draft";
        $.get("saved_drafts.php?u=" + uqid, function(d) {
          $("#drafts_load").html(d);
        });
        document.getElementById("thread_content_input").innerHTML = '';
        document.getElementById("thread_title_input").value = '';
      }
    }
  },
  error: function(data) {
    alert('error');
  }
});
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
  document.getElementById('threadpost_upd').innerHTML = "uploading image..";
  oReq.open("POST", "img_upload.php", true);
  oReq.onload = function(oEvent) {
    if(oReq.status == 200) {
      var img_url = oReq.responseText;
      if(img_url != '') {
        var atoinp = "[img]" + img_url + "[/img]";
        document.getElementById('threadpost_upd').innerHTML = "image uploaded";
        document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + atoinp;
      }
      form.reset();
    }
  };
  oReq.send(oData);
  ev.preventDefault();
}, false);
function restoreDraft() {
  var thread_id = $("#restore_drft").val();
  var forum_content_input = document.getElementById("thread_content_input");
  var forum_title_input = document.getElementById("thread_title_input");
  if(confirm('Are you sure? Any text entered in the fields below will be erased and replaced. This cannot be undone.')) {
    var restore_draft = new XMLHttpRequest();
    restore_draft.open("GET", "draft_restore.php?i=" + thread_id, true);
    restore_draft.onreadystatechange = function(){
      if(restore_draft.readyState == 4)
      if(restore_draft.status == 200) {
        var draft_restored = restore_draft.responseText;
        var information = draft_restored.split('--|~|1|~|MD|~|1|~|--');
        var forum_title_restore = information[0];
        var forum_content_restore = information[1];
        forum_title_input.value = forum_title_restore;
        forum_content_input.innerHTML = forum_content_restore;
      }
      else {
        alert("error");
      }
    };
    restore_draft.send();
    return false;
    forum_content_input.innerHTML = 'null';
    forum_title_input.value = 'null';
    alert("Title:\n" + draft.title + "\nContent:\n" + draft.content);
  }
}
function expandIt(id) {
  var e = document.getElementById(id);
  if(e.style.display == '')
    e.style.display = 'none';
  else
    e.style.display = '';
}
function insertBold() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[b][/b]";
}
function insertItalic() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[i][/i]";
}
function insertUnderline() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[u][/u]";
}
function insertStrikethrough() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[s][/s]";
}
function insertYouTube() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[yt][/yt]";
}
function insertLeftAlign() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[left][/left]";
}
function insertCenterAlign() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[center][/center]";
}
function insertRightAlign() {
  document.getElementById("thread_content_input").innerHTML = document.getElementById("thread_content_input").innerHTML + "[right][/right]";
}
function refreshThreads(uqid) {
  $.get("actual_threads.php?u=" + uqid, function(d) {
    $("#ld_threads").html(d);
  });
  document.getElementById("amount").value = Number(10);
  document.getElementById("more_div").innerHTML = '<div id=\"threads_loadmore\" style=\"background-color: <?php echo $spindle_color; ?>;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
}
function loadThreads(spindle_color) {
  document.getElementById("more_div").innerHTML = '<div id=\"threads_loadmore\" style=\"background-color: ' + spindle_color + ';\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
  var amount = document.getElementById("amount").value;
  var content = document.getElementById("ld_threads");
  $.ajax({
    type: 'get',
    url: 'more_threads.php?u=<?php echo $default_spindle_uqid; ?>',
    data: {
      amntcnt:amount
    },
    success: function(more_content) {
      content.innerHTML = content.innerHTML+more_content;
      document.getElementById("amount").value = Number(amount)+10;
    }
  });
  var getcount = new XMLHttpRequest();
  getcount.open("GET", "thread_count.php?u=<?php echo $default_spindle_uqid; ?>", true);
  getcount.onreadystatechange = function(){
    if(getcount.readyState == 4)
    if(getcount.status == 200) {
      document.getElementById("more_div").innerHTML = '<div id=\"threads_loadmore\" style=\"background-color: ' + spindle_color + ';\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
      var numCont = getcount.responseText;
      if(numCont <= Number(amount) + 10) {
        document.getElementById("more_div").innerHTML = "";
      }
    }
    else{
      alert("error");
      document.getElementById("more_div").innerHTML = '<div id=\"threads_loadmore\" style=\"background-color: ' + spindle_color + ';\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></div>';
    }
  };
  getcount.send();
  return false;
}
function toThread(id,loading_name) {
  document.getElementById("thd_" + id).innerHTML = loading_name + "..";
  $.get("thread.php?i=" + id, function(d) {
    $("#action_bar_page").html(d);
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
