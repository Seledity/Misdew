c<?php
session_start();
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
  exit();
}
# POST DATA
$token_p = safe($_GET['k']);
if($token_p) {
  $cs = mysqli_query($conx, "SELECT uid,username,token,verified FROM accounts WHERE token='$token_p'");
  $ccnt = mysqli_num_rows($cs);
  if($ccnt == '0') {
    header("location: /");
    exit();
  }
  $crs = mysqli_fetch_assoc($cs);
  $c_userid = $crs['uid'];
  $rs_username = $crs['username'];
  $rs_token = $crs['token'];
  $rs_verified = $crs['verified'];
  $curr_tst = time();
  if($rs_token == $token_p && $rs_verified != 'yes') {
    # DEFAULT USERNAME COLORS FOR THEME
    $theme_q = mysqli_query($conx, "SELECT id,default_color,default_tcolor FROM themes");
    while($theme_r = mysqli_fetch_assoc($theme_q)) {
      $theme_id = $theme_r['id'];
      $theme_dcolor = $theme_r['default_color'];
      $theme_tcolor = $theme_r['default_tcolor'];
      mysqli_query($conx, "INSERT INTO user_theme_colors (theme_id, uid, username_color, text_color) VALUES ('$theme_id','$c_userid','$theme_dcolor','$theme_tcolor')");
    }
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','canvas','1')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','feed','2')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','chat','3')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','mail','4')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','draw','5')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','cloud','6')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','alerts','7')");
    mysqli_query($conx, "INSERT INTO user_apps (uid, app_uqid, arrange) VALUES ('$c_userid','settings','8')");
    mysqli_query($conx, "INSERT INTO account_figures (uid) VALUES ('$c_userid')");
    mysqli_query($conx, "INSERT INTO canvas_design (uid) VALUES ('$c_userid')");
    mysqli_query($conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, view_link, tstamp) VALUES ('mdwLcm2MdtY4joNN','$c_userid','no','misdew','Welcome to Misdew! Please check with the Cloud app if you would like to upload files.','/cloud','$curr_tst')");
    mysqli_query($conx, "UPDATE accounts SET verified='yes' WHERE username='$rs_username'");
    # LOG USER IN TO ACCOUNT
    $cs = mysqli_query($conx, "SELECT rstringa,rstringb,rstringc FROM accounts WHERE username='$rs_username'");
    $cr = @mysqli_fetch_assoc($cs);
    $c_rstringa = $cr['rstringa'];
    $c_rstringb = $cr['rstringb'];
    $c_rstringc = $cr['rstringc'];
    setcookie("akgnxoPwqlIs", $c_rstringa, time()+3600*24*30, '/', '.misdew.com');
    setcookie("LoILilzcnmwe", $c_rstringb, time()+3600*24*30, '/', '.misdew.com');
    setcookie("puTtxXvbEkOo", $c_rstringc, time()+3600*24*30, '/', '.misdew.com');
    $kill = '';
    setcookie("hwsmnzeiopqm", $kill, time()+3600*24*30, '/', '.misdew.com');
    header("location: /hub");
    exit();
  }
  else {
    header("location: /");
    exit();
  }
}
else {
  header("location: /");
  exit();
}
?>
