<?php
$this_page = "draw";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/draw') {
  $loc_desc = "craftin\' in draw";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/draw' WHERE uid='$u_uid'");
}
echo "<div id=\"gallery\">";
require_once("inner_gallery.php");
echo "</div>";
?>
<script>
function refGallery() {
  $.get("inner_gallery.php", function(d) {
    $("#gallery").html(d);
  });
}
function toArt(i) {
  var dot_loc = "toit_" + i;
  document.getElementById(dot_loc).innerHTML = '...';
  $.get("masterpiece.php?i=" + i, function(d) {
    $("#action_bar_page").html(d);
  });
}
function mPublic(i) {
  if(confirm('Make public?')) {
    var togg_id = "collect_togg_" + i;
    document.getElementById(togg_id).innerHTML = '<i class="fa fa-spinner" aria-hidden="true"></i>';
    $.ajax({
    url: 'make_public.php',
    type: 'POST',
    data: { i: i },
    success: function(data){
      if(data == '') {
        document.getElementById(togg_id).innerHTML = '<i onclick="mPrivate(\'' + i + '\')" class="fa fa-lock" aria-hidden="true"></i>';
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function mPrivate(i) {
  if(confirm('Make private?')) {
    var togg_id = "collect_togg_" + i;
    document.getElementById(togg_id).innerHTML = '<i class="fa fa-spinner" aria-hidden="true"></i>';
    $.ajax({
    url: 'make_private.php',
    type: 'POST',
    data: { i: i },
    success: function(data){
      if(data == '') {
        document.getElementById(togg_id).innerHTML = '<i onclick="mPublic(\'' + i + '\')" class="fa fa-globe" aria-hidden="true"></i>';
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function mRemove(i) {
  if(confirm('Remove?')) {
    var togg_id = "remove_togg_" + i;
    document.getElementById(togg_id).innerHTML = '<i class="fa fa-spinner" aria-hidden="true"></i>';
    $.ajax({
    url: 'remove.php',
    type: 'POST',
    data: { i: i },
    success: function(data){
      if(data == '') {
        refGallery();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
</script>
