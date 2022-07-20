<?php
require_once("../inc/conx.php");
if($u_csplit != 'on') {
  exit();
}
$save_color1 = safe($_POST['split_color1']);
$save_color2 = safe($_POST['split_color2']);
$save_color3 = safe($_POST['split_color3']);
$save_name1 = safe($_POST['split_name1']);
$save_name2 = safe($_POST['split_name2']);
$save_name3 = safe($_POST['split_name3']);

$split_combine = $save_name1.$save_name2.$save_name3;

if($split_combine != $u_username) {
  header("location: /throw_error");
}
else {
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_color='$save_color1' WHERE uid='$u_uid' && theme_id='$u_theme'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit2_color='$save_color2' WHERE uid='$u_uid' && theme_id='$u_theme'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit3_color='$save_color3' WHERE uid='$u_uid' && theme_id='$u_theme'");

  mysqli_query($conx, "UPDATE user_theme_colors SET csplit1_name='$save_name1' WHERE uid='$u_uid' && theme_id='$u_theme'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit2_name='$save_name2' WHERE uid='$u_uid' && theme_id='$u_theme'");
  mysqli_query($conx, "UPDATE user_theme_colors SET csplit3_name='$save_name3' WHERE uid='$u_uid' && theme_id='$u_theme'");
}
?>
