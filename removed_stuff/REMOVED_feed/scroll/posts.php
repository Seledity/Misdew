<?php
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
# SELECT TEN POSTS FROM FEED
$feed_q = mysqli_query($conx, "SELECT id,uid,post,tstamp,random_str,visibility,edited,img,allow_comments FROM feed ORDER BY id DESC LIMIT 1");
while($feed_r = mysqli_fetch_assoc($feed_q)) {
  // Feed data
  $feed_id = $feed_r['id'];
  $feed_uid = $feed_r['uid'];
  $string = $feed_r['post'];
  $feed_tstamp = $feed_r['tstamp'];
  $feed_randomstr = $feed_r['random_str'];
  $feed_visibility = $feed_r['visibility'];
  $feed_edited = $feed_r['edited'];
  $feed_img = $feed_r['img'];
  $feed_allowcomments = $feed_r['allow_comments'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$feed_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $feed_uid = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$feed_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $feed_uid = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  // Emoji+ replacement
  include("../../inc/replace.php");
  # SELECT ACCOUNT DATA FOR FEED POSTS
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time FROM accounts WHERE uid='$feed_uid'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    // Account data
    $feed_username = $usr_r['username'];
    $feed_picture = $usr_r['picture'];
    $feed_onltime = $usr_r['online_time'];
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $feed_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC";
    }
    // DATA SAVER
    //
    // Activity Dot
    $new_time = time() - $feed_onltime;
    $mens = round($new_time / 60);
    if($mens <= 1) { $cv_activeness = "#00FF00"; } // Active within one minute
    elseif($mens <= 2) { $cv_activeness = "#FFA500"; } // Active within two minutes
    elseif($mens < 5) { $cv_activeness = "#FF0000"; } // Active within five minutes
    else { $cv_activeness = "#FF0000"; } // Active over five minutes
    # SELECT THEME COLORS FOR ACCOUNTS
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$feed_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      // Theme data
      $username_color = $usri_r['username_color'];
      $feed_tcolor = $usri_r['text_color'];
    }


// start here

echo "<div style=\" font-family: 'Dosis', sans-serif; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 100%; width: 100%; max-width: 600px;\">";
echo "<table style=\"border-collapse: collapse; table-layout: fixed; width: 100%;\">";
echo "<tr><td style=\"padding: 8px; text-align: left; color: $feed_tcolor; background-color: $username_color; width: 100%;\">";
echo "<table><tr><td><img onclick=\"window.location='/canvas/$feed_username';\" src=\"$feed_picture\" class=\"list_picture\"></td>";
echo "<td><span style=\"font-weight: bold;\">$feed_username</span>";
echo " <span style=\"font-size: 12px;\">&bull; "; echo timeago($feed_tstamp); echo " ago</span>";
echo "</td></tr></table>";
echo "</td></tr></table>";
echo "<table style=\"  width: 100%; height: 100%; border-collapse: collapse; table-layout: fixed;\">";
echo "<tr><td style=\"text-align: center; background-color: #8c66b2; width: 10%;\">b</td>";
echo "<td style=\"word-wrap: break-word;overflow-x: scroll; overflow-y: scroll; text-align: center; background-color: #fff; width: 80%;\">";
echo "<div style=\"overflow: scroll;\">";
echo bbc(atname(nl2br($string)));
echo "sdafdasf</div>";
echo "</td>";
echo "<td style=\"text-align: center; background-color: #8c66b2; width: 10%;\">n</td></tr>";
echo "</table>";
echo "</div>";





// end here

  }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
var elem = document.getElementById("post_full");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
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
// Post comment to a post.
function pComment(feed_randomstr) {
  // Get the content of the editable div.
  var comment_input_id = $('#comment_' + feed_randomstr).html();
  // Convert the content.
  var comment_input = htmlToText(comment_input_id);
  // Post the content.
  if(comment_input.trim() != '') {
    $.ajax({
      url: 'cmtp.php?i=' + feed_randomstr,
      type: 'POST',
      data: { body: comment_input },
      success: function(){
        $('#comment_' + feed_randomstr).empty();
        commentsUp(feed_randomstr);
      },
      error: function() {
        //alert("error");
        $('#comment_' + feed_randomstr).empty();
        commentsUp(feed_randomstr);
      }
    });
  }
}
// Delete comment from a post.
function dComment(feed_randomstr, comment_id) {
  if (confirm("Delete?")) {
    $.ajax({
      url: 'delcmnt.php',
      type: 'GET',
      data: { id: comment_id },
      success: function(){
        commentsUp(feed_randomstr);
      },
      error: function() {
        //alert("error");
        commentsUp(feed_randomstr);
      }
    });
  }
}
function cselectFile(feed_randomstr) {
  document.getElementById('cfBrowse_' + feed_randomstr).click();
  document.getElementById('cfPath_' + feed_randomstr).value = document.getElementById('cfBrowse_' + feed_randomstr).value;
  imgcUpl(feed_randomstr);
}
function imgcUpl(feed_randomstr) {
  var form = document.forms.namedItem("cimgUpl_" + feed_randomstr);
  form.addEventListener('change', function(ev) {
    var oOutput = document.querySelector("div"),
    oData = new FormData(form);
    var oReq = new XMLHttpRequest();
    document.getElementById('cloader_' + feed_randomstr).innerHTML = "<i class=\"fa fa-spinner\" aria-hidden=\"true\"></i>";
    oReq.open("POST", "img_upload.php", true);
    oReq.onload = function(oEvent) {
      if (oReq.status == 200) {
        var cpic = oReq.responseText;
        if(cpic != '') {
          document.getElementById('cloader_' + feed_randomstr).innerHTML = "<i class=\"fa fa-paperclip\" aria-hidden=\"true\"></i>";
          var adpti = "[img=50% auto]" + cpic + "[/img]";
          document.getElementById("comment_" + feed_randomstr).innerHTML = document.getElementById("comment_" + feed_randomstr).innerHTML + adpti;
          setEndOfContenteditable(document.getElementById("comment_" + feed_randomstr));
        }
        else
          document.getElementById('cloader_' + feed_randomstr).innerHTML = "<i class=\"fa fa-exclamation\" aria-hidden=\"true\"></i>";
        form.reset();
      }
    };
    oReq.send(oData);
    ev.preventDefault();
  }, false);
}
function setEndOfContenteditable(contentEditableElement)
{
    var range,selection;
    if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
    {
        range = document.createRange();//Create a range (a range is a like the selection but invisible)
        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        selection = window.getSelection();//get the selection object (allows you to change selection)
        selection.removeAllRanges();//remove any selections already made
        selection.addRange(range);//make the range you have just created the visible selection
    }
    else if(document.selection)//IE 8 and lower
    {
        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
        range.select();//Select the range (make it the visible selection
    }
}
function showComments(comments) {
  var rstr = comments.id;
  var e = "comments_" + rstr;
  var e = document.getElementById(e);
  document.getElementById("cmtbtn_" + rstr).innerHTML = "comment..";
  // Fetch comments for the post
  var getcmts = new XMLHttpRequest();
  getcmts.open("GET", "inner_comments.php?i=" + rstr, true);
  getcmts.onreadystatechange = function(){
    if(getcmts.readyState == 4)
    if(getcmts.status == 200) {
      var inn_comments = getcmts.responseText;
      document.getElementById("comments_inner_" + rstr).innerHTML = inn_comments;
      document.getElementById("cmtbtn_" + rstr).innerHTML = "comment";
      if(e.style.display == '')
        e.style.display = 'none';
      else
        e.style.display = '';
    }
    else {
      alert("getcmts error");
    }
  };
  getcmts.send();
  return false;
}
function commentsUp(fdid) {
  var rstr = fdid;
  var e = "comments_" + rstr;
  var e = document.getElementById(e);
  document.getElementById("cmtbtn_" + rstr).innerHTML = "comment..";
  // Fetch comments for the post
  var getcmts = new XMLHttpRequest();
  getcmts.open("GET", "inner_comments.php?i=" + rstr, true);
  getcmts.onreadystatechange = function(){
    if(getcmts.readyState == 4)
    if(getcmts.status == 200) {
      var inn_comments = getcmts.responseText;
      document.getElementById("comments_inner_" + rstr).innerHTML = inn_comments;
      document.getElementById("cmtbtn_" + rstr).innerHTML = "comment";
    }
    else {
      alert("commentsUp error");
    }
  };
  getcmts.send();
  var mainPC = document.getElementById("mpcomment_count");
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "mpcomments.php?i=" + rstr, true);
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4)
      if(xhr.status == 200) {
        mainPC.innerHTML = xhr.responseText;
      }
      else {
        alert("getcmts  error");
        mainPC.innerHTML = "getcmts error";
      }
    };
  xhr.send();
  mainPC.innerHTML = "...";
  return false;
}
function expand(id) {
  var e = document.getElementById(id);
  if(e.style.display == '')
    e.style.display = 'none';
  else
    e.style.display = '';
}
function loadmore() {
  document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
  var amount = document.getElementById("amount").value;
  var content = document.getElementById("ld_posts");
  $.ajax({
    type: 'get',
    url: 'moreposts.php',
    data: {
      amntcnt:amount
    },
    success: function(more_content) {
      content.innerHTML = content.innerHTML+more_content;
      document.getElementById("amount").value = Number(amount)+10;
    }
  });
  var getcount = new XMLHttpRequest();
  getcount.open("GET", "contamnt.php", true);
  getcount.onreadystatechange = function(){
    if(getcount.readyState == 4)
    if(getcount.status == 200) {
      document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
      var numCont = getcount.responseText;
      if(numCont <= Number(amount) + 10) {
        document.getElementById("more_div").innerHTML = "";
      }
    }
    else{
      alert("getcount error");
      document.getElementById("more_div").innerHTML = '<div id=\"more_div\"><table onclick=\"loadmore();\" class=\"writePost\"><tr><td class=\"wpost_td\" style=\"text-align: center;\"><i class=\"fa fa-chevron-circle-down fa-lg\" aria-hidden=\"true\"></i></td></tr></table></div>';
    }
  };
  getcount.send();
  return false;
}
</script>
