<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
echo "<br>";
$query = mysqli_query($conx, "SELECT id,app_uqid,snooze,hidden FROM user_apps WHERE uid='$u_uid' ORDER BY arrange");
while ($app = mysqli_fetch_assoc($query)) {
  $uapp_id = $app['id'];
  $app_uqid = $app['app_uqid'];
  $app_snooze = $app['snooze'];
  $app_hidden = $app['hidden'];
  $appy = mysqli_query($conx, "SELECT uqid,title,app_color,app_titlecolor,link,icon FROM apps WHERE uqid='$app_uqid'");
  while($ap = mysqli_fetch_assoc($appy)) {
    $app_uqqid = $ap['uqid'];
    $app_color = $ap['app_color'];
    $app_tcolor = $ap['app_titlecolor'];
    $app_name = $ap['title'];
    $app_link = $ap['link'];
    $app_icon = $ap['icon'];
  }
  echo "<span style=\"color: $app_color; font-weight: bold; font-size: 18px;\">$app_name</span><br>";
  if($app_snooze == 'yes') {
    echo "<span onclick=\"togAlerts('$app_uqid')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-bell-slash\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">snoozed</span></span>";
  }
  else {
    echo "<span onclick=\"togAlerts('$app_uqid')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-bell\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">woke</span></span>";
  }
  echo "&nbsp;&nbsp; <span style=\"color: $app_color; font-weight: bold;\">|</span> &nbsp;&nbsp;";
  echo "<span onclick=\"appUp('$uapp_id')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-arrow-circle-up\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">move up</span></span>";
  echo "&nbsp;&nbsp; <span style=\"color: $app_color; font-weight: bold;\">|</span> &nbsp;&nbsp;";
  echo "<span onclick=\"appDown('$uapp_id')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-arrow-circle-down\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">move down</span></span>";
  echo "&nbsp;&nbsp; <span style=\"color: $app_color; font-weight: bold;\">|</span> &nbsp;&nbsp;";
  if($app_uqid != 'settings') {
    if($app_hidden == 'yes') {
      echo "<span onclick=\"togHide('$app_uqid')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-eye-slash\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">hidden</span></span>";
    }
    else {
      echo "<span onclick=\"togHide('$app_uqid')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">visible</span></span>";
    }
  }
  else {
    echo "<span onclick=\"alert('You cannot hide settings.')\" style=\"color: $app_color; font-size: 12px; font-weight: bold;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> <span style=\"color: $app_color; font-size: 12px;\">visible</span></span>";
  }
  echo "<br><br>";
  echo "<div onclick=\"window.location='$app_link';\" style=\"background-color: $app_color; color: $app_tcolor;  padding: 10px; font-weight: bold; text-align: center;\">tap to launch this app</div>";
  echo "<br>";
}
?>
