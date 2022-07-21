<?php
$this_page = "market";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$app_id = safe($_GET['i']);
if($app_id == '') {
  exit();
}
$appq = mysqli_query($conx, "SELECT uqid,icon,link,title,app_color,app_titlecolor,description,version,developer,price,category FROM apps WHERE uqid='$app_id'");
$appr = mysqli_fetch_assoc($appq);
$app_uqid = $appr['uqid'];
$app_color = $appr['app_color'];
$app_tcolor = $appr['app_titlecolor'];
$app_name = $appr['title'];
$app_link = $appr['link'];
$app_icon = $appr['icon'];
$app_dev = $appr['developer'];
$app_price_d = $appr['price'];
$app_desc = $appr['description'];
$app_version = $appr['version'];
$app_category = $appr['category'];
if($app_price_d == 0) {
  $app_price = "FREE";
}
else {
  $app_price = "$" . $app_price_d;
}
$mrktq = mysqli_query($conx, "SELECT promo_hotkey FROM market WHERE uqid='$app_uqid'");
$mrktr = mysqli_fetch_assoc($mrktq);
$mrkt_promo_hotkey = $mrktr['promo_hotkey'];
?>
<?php
echo "<div class=\"market_app_contain\" style=\"background-color: $app_color; color: $app_tcolor;\">";
echo "<table style=\"width: 100%; text-align: center;\">";
echo "<tr>";
echo "<td>";
echo "<span style=\"font-size: 23px; font-weight: bold;\">$app_name</span>";
echo "<br>";
echo "<span style=\"font-size: 13px;\"><i class=\"fa fa-code\" aria-hidden=\"true\" style=\"font-weight: bold;\"></i> $app_dev</span>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"text-align: center;\">";
echo "<img class=\"mapp_cont_img\" src=\"$app_icon\" alt=\"\" style=\"-webkit-box-shadow: 0 1px 10px -3px #000; width: 100px; height: 100px;\">";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"text-align: right;\">";
if($u_cont_mang == 'yes' && $mrkt_promo_hotkey != 'top_featured') {
  echo " <span id=\"feature_ic\"><i onclick=\"featureApp();\" class=\"fa fa-thumb-tack\" aria-hidden=\"true\"></i></span> &nbsp;";
}
if($mrkt_promo_hotkey == 'top_featured') {
  echo " <i onclick=\"alert('This app has been featured.');\" class=\"fa fa-trophy\" aria-hidden=\"true\"></i> &nbsp;";
}
if($app_prchsd = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE app_uqid='$app_uqid' && uid='$u_uid'")) != 0) {
  echo "<div onclick=\"var log_conf=confirm('Open?');if(log_conf == true){window.location='$app_link';}\" style=\"font-size: 14px; color: $app_color; background-color: $app_tcolor; display: inline-block; padding: 4px; font-weight: bold;\">&nbsp; LAUNCH &nbsp; </div>";
}
elseif($app_price_d > $u_funds && $app_price_d != 0) {
  echo "<div style=\"font-size: 14px; color: $app_color; background-color: $app_tcolor; display: inline-block; padding: 4px; font-weight: bold;\">&nbsp; INSUFFICIENT FUNDS &nbsp; </div>";
}
else {
  echo "<div id=\"purchase_btn\" onclick=\"purchase('$app_uqid','$app_price');\" style=\"font-size: 14px; color: $app_color; background-color: $app_tcolor; display: inline-block; padding: 4px; font-weight: bold;\">&nbsp; $app_price &nbsp; </div>";
}
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "<div class=\"market_app_contain\" style=\"font-size: 14px; background-color: $app_tcolor; color: $app_color;\">";
$string = $app_desc;
require_once("../inc/replace.php");
echo "$string <br><br>";
$app_rated = mysqli_num_rows($asdf = mysqli_query($conx, "SELECT uid,rating FROM market_ratings WHERE app_uqid='$app_uqid' && uid='$u_uid'"));
$asdfr = mysqli_fetch_assoc($asdf);
$rated_num = $asdfr['rating'];
$total_num = 0;
$rate_c = mysqli_num_rows($rate_q = mysqli_query($conx, "SELECT rating FROM market_ratings WHERE app_uqid='$app_id'"));
while($rate_r = mysqli_fetch_assoc($rate_q)) {
  $ratings = $rate_r['rating'];
  $total_num += $ratings;
}
$rating = $total_num / $rate_c;
$rating_dec = $rating - (int) $rating;
$rating_num = floor($rating);
$rating_read = round($rating, 1);
echo "<center style=\"font-size: 25px;\">$rating_read<br>";
if($app_rated == 0 && $app_prchsd != 0) {
  echo "<span id=\"rater\" style=\"font-size: 11px;\"><i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> Rate by selecting a star value</span> <br>";
  echo "<i onclick=\"rateApp('1')\" class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  echo "<i onclick=\"rateApp('2')\" class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  echo "<i onclick=\"rateApp('3')\" class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  echo "<i onclick=\"rateApp('4')\" class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
  echo "<i onclick=\"rateApp('5')\" class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
}
else {
  if($app_prchsd != 0) {
    echo "<span onclick=\"ratingRemove();\" id=\"rater_r\" style=\"font-size: 11px;\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Remove $rated_num <i class=\"fa fa-star\" aria-hidden=\"true\"></i> rating</span> <br>";
  }
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
}
echo "</center><br>";
?>
</div>
<script>
function featureApp() {
  if(confirm('Feature this app? \n This cannot be undone. \n Also, only perform this action if you truly believe the app deserves special recognition. \n --> Hit the \'enter\' key or select \'ok\' to confirm \n --> Hit the \'escape\' key or select \'cancel\' to abort this action')) {
    document.getElementById('feature_ic').innerHTML = '<i onclick=\"featureApp();\" class=\"fa fa-spinner\" aria-hidden=\"true\"></i>';
    var app_uqid = "<?php echo $app_uqid;?>";
    var token = "<?php echo $u_token;?>";
    $.ajax({
    url: 'feature.php',
    type: 'POST',
    data: { app_uqid: app_uqid, token: token },
    success: function(data){
      if(data == '') {
        document.getElementById('feature_ic').innerHTML = '<i onclick="alert(\'This app has been featured.\');" class=\"fa fa-trophy\" aria-hidden=\"true\"></i>';
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function ratingRemove() {
  if(confirm('Remove your rating?')) {
    document.getElementById('rater_r').innerHTML = document.getElementById('rater_r').innerHTML + '..';
    var rating_num = '5';
    var app_uqid = "<?php echo $app_uqid;?>";
    var token = "<?php echo $u_token;?>";
    $.ajax({
    url: 'rate.php?t=r',
    type: 'POST',
    data: { app_uqid: app_uqid, token: token, rating_num: rating_num },
    success: function(data){
      if(data == '') {
        upPage();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function rateApp(rating) {
  var rating_num = rating;
  if(rating_num == '1') {
    var conf_msg = "Rate " + rating_num + " star?";
  }
  else {
    var conf_msg = "Rate " + rating_num + " stars?";
  }
  if(confirm(conf_msg)) {
    document.getElementById('rater').innerHTML = '<i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i> Rate by selecting a star value..';
    var app_uqid = "<?php echo $app_uqid;?>";
    var token = "<?php echo $u_token;?>";
    $.ajax({
    url: 'rate.php',
    type: 'POST',
    data: { app_uqid: app_uqid, token: token, rating_num: rating_num },
    success: function(data){
      if(data == '') {
        upPage();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function purchase(app_uqid, app_price) {
  if(confirm("Purchase?")) {
    document.getElementById('purchase_btn').innerHTML = "&nbsp; " + app_price + ".. &nbsp;";
    var token = "<?php echo $u_token;?>";
    $.ajax({
    url: 'purchase.php',
    type: 'POST',
    data: { app_uqid: app_uqid, token: token },
    success: function(data){
      if(data == '') {
        upPage();
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function upPage(app_uqid) {
  $.get("content.php?i=<?php echo $app_id; ?>", function(d) {
    $("#action_bar_page").html(d);
  });
}
</script>
