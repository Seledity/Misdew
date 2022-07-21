<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$amount = safe($_GET['amntcnt']);
$promo_hkey = safe($_GET['c']);
if($promo_hkey == 'top_featured') {
  $promo_hkey = "top_featured";
  $promo_title = "Top Featured";
  $promo_desc = "Curated by our content managers.";
}
if($promo_hkey == 'apps') {
  $promo_hkey = "apps";
  $promo_title = "Apps";
  $promo_desc = "Sorted by most recently added.";
}
// app tray
$query = mysqli_query($conx, "SELECT uqid FROM market WHERE promo_hotkey='$promo_hkey' ORDER BY promo_tstamp DESC LIMIT $amount,12");
$per_row = 3;
$app_id  = 0;
echo "<div style=\"width: 95%; max-width: 450px; font-family: 'Dosis', sans-serif;\">";
echo "<table class=\"market_table\">";
while ($app = mysqli_fetch_assoc($query)) {
  $app_id = $app_id + 1;
  if ($app_id % $per_row == 1) {
    echo "<tr>";
  }
  $app_uqid = $app['uqid'];
  $appy = mysqli_query($conx, "SELECT uqid,title,app_color,app_titlecolor,link,icon,developer,price FROM apps WHERE uqid='$app_uqid'");
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
  }
  echo "<td style=\"background-color: $app_color; color: $app_tcolor;\">
  <center>
  <table style=\"width: 100%; max-width: 100px;\">
    <tr>
      <td class=\"mapp\" onclick=\"toApp('$app_uqqid','$app_name')\" style=\"background-image:url('$app_icon'); background-size: 100% 100%; background-color: $app_color;\">&nbsp;</td>
    </tr>
  </table>
  <span class=\"mapp_details\">
    <span id=\"mapp_nm_$app_uqid\" style=\"font-size: 13px; font-weight: bold;\">$app_name</span>
    <br>
    <i class=\"fa fa-code\" aria-hidden=\"true\" style=\"font-weight: bold;\"></i> $app_dev
    <br>
    <table style=\"width: 90%;\">
                  <tr>
                    <td>";
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
                    echo "</td>
                    <td style=\"text-align: right;\">";
                    if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE app_uqid='$app_uqid' && uid='$u_uid'")) != 0) {
                      echo "<i onclick=\"var log_conf=confirm('Open?');if(log_conf == true){window.location='$app_link';}\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
                    }
                    else {
                      echo "<span style=\"font-weight: bold;\">$app_price</span>";
                    }
                    echo "</td>
                  </tr>
                </table>
              </span>
            </center>
            </td>";
  if ($app_id % $per_row == 0)
    echo "</tr>";
}
$spacercells = $per_row - ($app_id % $per_row);
if ($spacercells < $per_row) {
  for ($j=1; $j <= $spacercells; $j++) {
    //"<td></td>";
  }
  echo "</tr>";
}
echo "</table></div>";
?>
