<?php
$this_page = "alerts";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$extra = mysqli_query($conx, "SELECT uid FROM notifs WHERE uid='$u_uid'");
$ncount = mysqli_num_rows($extra);
if($ncount > 0) {
  echo "<div class=\"clear_all\" onclick=\"var log_conf=confirm('Remove all Alerts?');if(log_conf == true){window.location='clearall.php?t=$u_token';}\"><button type=\"button\" style=\"box-shadow: 0 1px 20px rgba(0,0,0,0.19), 0 3px 3px rgba(0,0,0,0.23); color: #fff; border-radius: 20px; background-color: #ff3c64; font-size: 18px; padding: 8px; font-family: 'Dosis', sans-serif; border: 1px solid #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none;\"><i class=\"fa fa-trash\"></i> Remove All</button></div>";
}
$nquery = mysqli_query($conx, "SELECT id,app_uqid,message,view_link,tstamp,rstring,snoozeable FROM notifs WHERE uid='$u_uid' ORDER BY id DESC");
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
  echo "<div onclick=\"old('$nrstr');\" class=\"alert\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);max-width: 400px !important; width: 80% !important; border: none !important; border-radius: 1em; \">
    <span class=\"nname\" style=\"font-family: 'Dosis', sans-serif; color: $app_color; font-weight: bold;\" id=\"appname_$app_uqid\"><i class=\"fa fa-bell\"></i> $app_name</span> <span class=\"tago\">&bull; ";
    echo timeago($app_tst);
    echo " ago</span> <br>
    $app_msg
  <div class=\"alert\" style=\"display: visible; border-top: none !important; font-size: 15px; color: $app_color; font-family: 'Dosis', sans-serif; padding: 0px !important;\" id=\"$nrstr\">";
  //only echo a view link if one is there
  if($app_link) {
    echo "<a class=\"nview\" href=\"/inc/view.php?i=$notifid&&t=$u_token\" style=\"color: $app_color; text-decoration: none;\" id=\"view_$app_uqid\">view</a> &nbsp;&nbsp;&nbsp; ";
  }
  // snooze
  if($nsnoozb == 'yes') {
    if($app_snooze == 'yes') {
      echo "<a id=\"tid_$notifid\" class=\"nsnooze\" style=\"color: $app_color; text-decoration: none;\" id=\"snooze_$app_uqid\">wake</a> &nbsp;&nbsp;&nbsp;";
    }
    else {
      echo "<a id=\"tid_$notifid\" class=\"nsnooze\" style=\"color: $app_color; text-decoration: none;\" id=\"snooze_$app_uqid\">snooze</a> &nbsp;&nbsp;&nbsp;";
    }
  }
  echo "<a id=\"did_$notifid\" class=\"ndismiss\" style=\"color: $app_color; text-decoration: none;\" id=\"snooze_$app_uqid\">dismiss</a>
  </div></div> <br>";
}
$extra = mysqli_query($conx, "SELECT uid FROM notifs WHERE uid='$u_uid'");
$ncount = mysqli_num_rows($extra);
if($ncount == '0') {
  echo "<br> <div class=\"alert\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);max-width: 400px !important; width: 80% !important; border: none !important; border-radius: 1em; \">
    <span class=\"nname\" style=\"font-family: 'Dosis', sans-serif; color: #1985db; font-weight: bold;\" id=\"appname_alerts\">Alerts</span> <br>
    You don't have any alerts.
  </div> <br>";
}
else {
  mysqli_query($conx, "UPDATE notifs SET viewed='yes' WHERE uid='$u_uid'");
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
function old() {

}
function upAlerts() {
  $.get("alerts.php", function(d) {
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
function expand(id) {
  var e = document.getElementById(id);
  if(e.style.display == 'block')
  e.style.display = 'none';
  else
  e.style.display = 'block';
}
</script>
