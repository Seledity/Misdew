<?php
session_start();
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
  exit();
}
# POST DATA
$resetid_p = safe($_GET['k']);
$newpass_p = safe($_POST['newpass']);
$cnewpass_p = safe($_POST['confnewpass']);
if($resetid_p && $newpass_p && $cnewpass_p) {
  $cs = mysqli_query($conx, "SELECT tstamp,uqid,username,email_secure FROM forgot_password WHERE uqid='$resetid_p'");
  $ccnt = mysqli_num_rows($cs);
  if($ccnt == '0') {
    $_SESSION['m5'] = "ef_hef";
    header("location: /forgot");
    exit();
  }
  $crs = mysqli_fetch_assoc($cs);
  $rs_tstamp = $crs['tstamp'];
  $rs_uqid = $crs['uqid'];
  $rs_username = $crs['username'];
  $rs_email = $crs['email_secure'];
  # MAKE SURE LINK HASN'T REACHED ONE HOUR EXPIRE LIMIT
  $tttstamp = $rs_tstamp + 3600;
  if($tstamp >= $tttstamp) {
    mysqli_query($conx, "DELETE FROM forgot_password WHERE email_secure='$rs_email'");
    $_SESSION['m5'] = "ef_hef";
    header("location: /forgot");
    exit();
  }
  if($newpass_p != $cnewpass_p) {
    $_SESSION['m'] = "p_dnm";
    header("location: /forgot/reset.php?k=$resetid_p");
    exit();
  }
  function geddit($length = 50) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $newstr = geddit();
  $newhashpass = hash("sha256",$rs_username.$newpass_p);
  mysqli_query($conx, "UPDATE accounts SET password='$newhashpass' WHERE username='$rs_username'");
  mysqli_query($conx, "UPDATE accounts SET rstringc='$newstr' WHERE username='$rs_username'");
  mysqli_query($conx, "DELETE FROM forgot_password WHERE email_secure='$rs_email'");
  # LOG USER IN TO ACCOUNT
  $cs = mysqli_query($conx, "SELECT rstringa,rstringb,rstringc FROM accounts WHERE username='$rs_username'");
  $cr = @mysqli_fetch_assoc($cs);
  $c_rstringa = $cr['rstringa'];
  $c_rstringb = $cr['rstringb'];
  $c_rstringc = $cr['rstringc'];
  setcookie("akgnxoPwqlIs", $c_rstringa, time()+3600*24*30, '/', '.misdew.com');
  setcookie("LoILilzcnmwe", $c_rstringb, time()+3600*24*30, '/', '.misdew.com');
  setcookie("puTtxXvbEkOo", $c_rstringc, time()+3600*24*30, '/', '.misdew.com');
  header("location: /");
  exit("");
}
else {
  $_SESSION['m3'] = "all_req";
  header("location: /forgot/reset.php?k=$resetid_p");
  exit();
}
?>
