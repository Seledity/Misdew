<?php
$this_page = "draw";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$color_palette = safe($_GET['p']);
if($color_palette == '' || $color_palette == 'default') {
  require_once("default_colors.php");
}
if($color_palette == 'sky') {
  require_once("sky_colors.php");
}
if($color_palette == 'water') {
  require_once("water_colors.php");
}
if($color_palette == 'flora') {
  require_once("flora_colors.php");
}
if($color_palette == 'skin') {
  require_once("skin_colors.php");
}
?>
