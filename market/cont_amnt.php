<?php
require_once("../inc/conx.php");
$promo_hkey = safe($_GET['c']);
if($promo_hkey == 'top_featured') {
  $promo_hkey = "top_featured";
}
if($promo_hkey == 'apps_and_games') {
  $promo_hkey = "apps_and_games";
}
$app_cnt = mysqli_num_rows(mysqli_query($conx, "SELECT uqid FROM market WHERE promo_hotkey='$promo_hkey' ORDER BY promo_tstamp DESC"));
echo $app_cnt;
?>
