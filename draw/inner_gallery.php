<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
echo "<table style=\"width: 95%; max-width: 500px;\">";
$draw_q = mysqli_query($conx, "SELECT id,location,collections FROM draw WHERE uid='$u_uid' ORDER BY id DESC");
while($draw_r = mysqli_fetch_assoc($draw_q)) {
  $i++;
  $draw_id = $draw_r['id'];
  $draw_url = $draw_r['location'];
  $draw_collections = $draw_r['collections'];
  //if this is first value in row, create new row
  if ($i % 4 == 1) {
      echo "<tr>";
  }
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$u_uid' && theme_id='$g_themeid'");
  $usri_r = mysqli_fetch_assoc($usri_q);
  $username_color = $usri_r['username_color'];
  $username_tcolor = $usri_r['text_color'];
  echo "<td style=\"width: 25%; font-family: 'Dosis', sans-serif;\">";
  echo "<img onclick=\"toArt('$draw_id')\" src=\"$draw_url\" style=\"width: 100%; height auto; display: block;\" alt=\"\">";
  echo "<table class=\"gallery_opts\"><tr>
  <td id=\"collect_togg_$draw_id\" style=\"width: 33.33%;\">";
  if($draw_collections == 'no') {
    echo "<i onclick=\"mPublic('$draw_id')\" class=\"fa fa-globe\" aria-hidden=\"true\"></i>";
  }
  else {
    echo "<i onclick=\"mPrivate('$draw_id')\" class=\"fa fa-lock\" aria-hidden=\"true\"></i>";
  }
  echo "</td>
  <td id=\"toit_$draw_id\" onclick=\"toArt('$draw_id')\" style=\"width: 33.33%;\"></td>
  <td id=\"remove_togg_$draw_id\" onclick=\"mRemove('$draw_id')\" style=\"width: 33.33%;\">
  <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
  </td>
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
