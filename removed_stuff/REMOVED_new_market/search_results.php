<?php
$this_page = "market";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$q = safe($_GET['q']);

// app tray
echo "<div class=\"market_table\">";
$appy = mysqli_query($conx, "SELECT uqid,title,app_color,app_titlecolor,link,icon,developer,price FROM apps WHERE title LIKE '$q%' && discoverable='yes' ORDER BY title");
$result_cnt = mysqli_num_rows($appy);
if($result_cnt == '0') {
  echo "<div style=\"padding: 8px;\"><span class=\"no_results\">no results <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i></span></div>";
}
while($ap = mysqli_fetch_assoc($appy)) {
  $app_uqqid = $ap['uqid'];
  $app_color = $ap['app_color'];
  $app_tcolor = $ap['app_titlecolor'];
  $app_name = $ap['title'];
  $app_link = $ap['link'];
  $app_icon = $ap['icon'];
  $app_dev = $ap['developer'];
  $app_price = $ap['price'];
  if($app_price == 0) {
    $app_price = "FREE";
  }
  else {
    $app_price = "$" . $app_price;
  }
  echo "<div style=\"background-color: $app_color; color: $app_tcolor; padding: 3px;\"><center>";
  echo "<table style=\"width: 95%; text-align: left;\"><tr><td style=\"text-align: left;\">";
  echo "<img src=\"$app_icon\" alt=\"\" style=\"display: block; border: 0; height: 50px; width: 50px; -webkit-box-shadow: 0 1px 10px -3px #000;\">";
  echo "</td><td style=\"text-align: left; width: 80%;\">";
  echo "&nbsp; <span style=\"font-weight: bold;\" id=\"mapp_nm_$app_uqqid\">$app_name</span> <br>";
  echo "&nbsp; <span style=\"font-size: 11px;\"><i class=\"fa fa-code\" aria-hidden=\"true\" style=\"font-weight: bold;\"></i> $app_dev <br>";
  echo "&nbsp; <span style=\"font-weight: bold;\">";
  $total_num = 0;
  $rate_c = mysqli_num_rows($rate_q = mysqli_query($conx, "SELECT rating FROM market_ratings WHERE app_uqid='$app_uqqid'"));
  while($rate_r = mysqli_fetch_assoc($rate_q)) {
    $ratings = $rate_r['rating'];

    $total_num += $ratings;

  }
  $rating = $total_num / $rate_c;
  $rating_dec = $rating - (int) $rating;
  $rating_num = floor($rating);
  if($rating_num == 5) {
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
  }
  if($rating_num == 4) {
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
  }
  if($rating_num == 3) {
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
  }
  if($rating_num == 2) {
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
  }
  if($rating_num == 1) {
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
  }
  if($rating_dec <= .5 && $rating_dec != 0) {
    echo "<i class=\"fa fa-star-half-o\" aria-hidden=\"true\"></i>";
  }
  if($rating_dec > .5 && $rating_dec != 0) {
    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
  }
  $left_over = 5 - $rating;
  $left_over = floor($left_over);
  if($left_over == 1) {
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  }
  if($left_over == 2) {
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  }
  if($left_over == 3) {
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  }
  if($left_over == 4) {
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  }
  if($left_over == 5) {
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
    echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  }
  if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE app_uqid='$app_uqqid' && uid='$u_uid'")) != 0) {
    echo " &nbsp; <i onclick=\"var log_conf=confirm('Open?');if(log_conf == true){window.location='$app_link';}\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
  }
  else {
    echo " &nbsp; $app_price";
  }
  echo "</span></span></td><td style=\"text-align: right;\">";
  echo " <i onclick=\"toApp('$app_uqqid','$app_name');\" class=\"fa fa-external-link-square\" aria-hidden=\"true\"></i>";
  echo "</td></tr></table>";
  echo "</center></div>";
}
echo "</div>";
?>
