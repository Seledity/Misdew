<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// notification tray
$nquery = mysqli_query($conx, "SELECT id,app_uqid,message,view_link,tstamp,rstring,snoozeable FROM notifs WHERE uid='$u_uid' && viewed='no' ORDER BY id DESC LIMIT 3");
while ($nrow = mysqli_fetch_assoc($nquery)) {
  $notifid = $nrow['id'];
  $app_uqid = $nrow['app_uqid'];
  $app_msg = $nrow['message'];
  $app_link = $nrow['view_link'];
  $app_tst = $nrow['tstamp'];
  $nrstr = $nrow['rstring'];
  $nsnoozb = $nrow['snoozeable'];
  $apdq = mysqli_query($conx, "SELECT uqid,title,app_color,link FROM apps WHERE uqid='$app_uqid'");
  while($ap = mysqli_fetch_assoc($apdq)) {
    $app_color = $ap['app_color'];
    $app_name = $ap['title'];
  }
  $asno = mysqli_query($conx, "SELECT snooze FROM user_apps WHERE app_uqid='$app_uqid' && uid='$u_uid'");
  while($nz = mysqli_fetch_assoc($asno)) {
    $app_snooze = $nz['snooze'];
  }
  echo "<div onclick=\"expand('$nrstr');\" class=\"notif\">
    <span class=\"nname\" style=\"font-family: 'Dosis', sans-serif; color: $app_color; font-weight: bold;\" id=\"appname_$app_uqid\">$app_name</span> <span class=\"tago\">&bull; ";
    echo timeago($app_tst);
    echo "</span> <br>
    $app_msg
  </div>
  <div class=\"notif\" style=\"display: none; border-top: 1px solid #ccc; font-size: 15px; color: $app_color; font-family: 'Dosis', sans-serif;\" id=\"$nrstr\">";
  //only echo a view link if one is there
  if($app_link) {
    echo "<a class=\"nview\" href=\"/inc/view.php?i=$notifid&&t=$u_token\" style=\"color: $app_color; text-decoration: none;\" id=\"view_$app_uqid\">view</a> &nbsp;&nbsp;&nbsp; ";
  }
  // snooze
  if($nsnoozb == 'yes') {
    if($app_snooze == 'yes') {
      echo "<a id=\"tid_$notifid\" class=\"nsnooze\" href=\"wake.php?i=$notifid&&t=$u_token\" style=\"color: $app_color; text-decoration: none;\" id=\"snooze_$app_uqid\">wake</a> &nbsp;&nbsp;&nbsp;";
    }
    else {
      echo "<a id=\"tid_$notifid\" class=\"nsnooze\" style=\"color: $app_color; text-decoration: none;\" id=\"snooze_$app_uqid\">snooze</a> &nbsp;&nbsp;&nbsp;";
    }
  }
  echo "<a id=\"did_$notifid\" class=\"ndismiss\" style=\"color: $app_color; text-decoration: none;\" id=\"snooze_$app_uqid\">dismiss</a>
  </div>";
}
// get extra count at bottom of notifs
$extra = mysqli_query($conx, "SELECT uid FROM notifs WHERE uid='$u_uid' && viewed='no' ORDER BY id");
$ncount = mysqli_num_rows($extra);
if($ncount > 3) {
  $how_many = $ncount - 3;
  echo "<div class=\"notif\" style=\"font-size: 13px\" onclick=\"window.location='/alerts';\">+$how_many more</div> <br>";
}
elseif($ncount >= 1) {
  echo "<br>";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function upAlerts() {
  $.get("/inc/alerts.php", function(d) {
    $("#ld_alerts").html(d);
  });
}
var Alerts = document.querySelectorAll("a[id^=tid_]");
[].forEach.call(Alerts, function(notif){
  notif.onclick = function(e){
      var notifo = new XMLHttpRequest();
      notifo.open("GET", "/inc/toggle.php?t=<?php echo $u_token; ?>&&i=" + notif.id.match(/([0-9]*)$/)[0], true);
      notifo.onreadystatechange = function(){
        if (notifo.readyState == 4)
          if(notifo.status == 200) {
            upAlerts();
          }
          else {
            alert("error");
          }
      };
      notif.innerHTML = "...";
      notifo.send();
      return false;
  };
});
var Alerts = document.querySelectorAll("a[id^=did_]");
[].forEach.call(Alerts, function(notif){
  notif.onclick = function(e){
      var notifo = new XMLHttpRequest();
      notifo.open("GET", "/inc/dismiss.php?t=<?php echo $u_token; ?>&&i=" + notif.id.match(/([0-9]*)$/)[0], true);
      notifo.onreadystatechange = function(){
        if (notifo.readyState == 4)
          if(notifo.status == 200) {
            upAlerts();
          }
          else {
            alert("error");
          }
      };
      notif.innerHTML = "...";
      notifo.send();
      return false;
  };
});
</script>
