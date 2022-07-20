<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
echo "<table style=\"width: 95%; max-width: 500px;\">";
$draw_q = mysqli_query($conx, "SELECT id,uid,location,collections FROM draw WHERE collections='yes' ORDER BY order_tstamp DESC");
while($draw_r = mysqli_fetch_assoc($draw_q)) {
  $i++;
  $draw_id = $draw_r['id'];
  $draw_url = $draw_r['location'];
  $draw_uid = $draw_r['uid'];
  $draw_collections = $draw_r['collections'];
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$draw_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $draw_url = "http://misdew.com/draw/i/1sVpxlNLHCf.png";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$draw_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $draw_url = "http://misdew.com/draw/i/1sVpxlNLHCf.png";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  //if this is first value in row, create new row
  if ($i % 4 == 1) {
      echo "<tr>";
  }
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$draw_uid' && theme_id='$g_themeid'");
  $usri_r = mysqli_fetch_assoc($usri_q);
  $username_color = $usri_r['username_color'];
  $username_tcolor = $usri_r['text_color'];
  echo "<td style=\"width: 25%; font-family: 'Dosis', sans-serif;\">";
  echo "<img onclick=\"toArt('$draw_id')\" src=\"$draw_url\" style=\"width: 100%; height auto; display: block;\" alt=\"\">";
  echo "<table class=\"gallery_opts\"><tr>
  <td id=\"toit_$draw_id\" onclick=\"toArt('$draw_id')\" style=\"width: 100%; text-align: center;\"><i class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> view</td>
  </tr></table></td>";
  //if this is third value in row, end row
  if ($i % 4 == 0) {
      echo "</tr>";
  }
}
//if the counter is not divisible by 3, we have an open row
$spacercells = 4 - ($i % 4);
if ($spacercells < 4) {
    for ($j=1; $j<=$spacercells; $j++) {
        echo "";
    }
    echo "</tr>";
}
echo "</table>";
?>
<script>
function toArt(i) {
  var dot_loc = "toit_" + i;
  document.getElementById(dot_loc).innerHTML = '<i class="fa fa-paint-brush" aria-hidden="true"></i> view..';
  $.get("masterpiece.php?i=" + i, function(d) {
    $("#action_bar_page").html(d);
  });
}
</script>
