<?php
require_once("inc/conx.php");
if($logged_in == true) {
  header("location: /hub");
  exit();
}
# POST DATA
$username_p = safe($_POST['username']);
$password_p = safe($_POST['password']);
if($username_p && $password_p) {
  $cs = mysqli_query($conx, "SELECT auth_app,uid,username,verified,password,rstringa,rstringb,rstringc,2fa FROM accounts WHERE username='$username_p'");
  $ccnt = mysqli_num_rows($cs);
  $cr = @mysqli_fetch_assoc($cs);
  $c_username = $cr['username'];
  $c_uuid = $cr['uid'];
  $c_password = $cr['password'];
  $c_verified = $cr['verified'];
  $c_rstringa = $cr['rstringa'];
  $c_rstringb = $cr['rstringb'];
  $c_rstringc = $cr['rstringc'];
  $c_2fa = $cr['2fa'];
  $c_authapp = $cr['auth_app'];
  # ACCOUNT IS NOT VERIFIED
  if($c_verified != 'yes') {
    $kill = '';
    $msg = 'nvdjrj6jfnxalpowqnzaiywliz';
    setcookie("akgnxoPwqlIs", $kill, time()+3600*24*30, '/', '.misdew.com');
    setcookie("LoILilzcnmwe", $kill, time()+3600*24*30, '/', '.misdew.com');
    setcookie("puTtxXvbEkOo", $kill, time()+3600*24*30, '/', '.misdew.com');
    setcookie("hwsmnzeiopqm", $msg, time()+3600*24*30, '/', '.misdew.com');
    //header("location: /");
    echo "error, please go back and try again";
    exit();
  }
  # IF THE USERNAME DOES NOT EXIST
  if($ccnt == 0) {
    echo "error, please go back and try again";
    exit();
  }
  // hash the password
  $password_hashed = hash("sha256",$c_username.$password_p);
  # IF PASSWORD IS INCORRECT
  if($password_hashed != $c_password) {
    echo "error, please go back and try again";
    exit();
  }
  // check and require 2FA
  if($c_authapp == 'yes') {
    header("location: /totp");
    exit();
  }
  if($c_2fa == 'enabled') {
    header("location: /2fa");
    exit();
  }
  setcookie("akgnxoPwqlIs", $c_rstringa, time()+3600*24*30, '/', '.misdew.com');
  setcookie("LoILilzcnmwe", $c_rstringb, time()+3600*24*30, '/', '.misdew.com');
  setcookie("puTtxXvbEkOo", $c_rstringc, time()+3600*24*30, '/', '.misdew.com');
  $kill = '';
  setcookie("hwsmnzeiopqm", $kill, time()+3600*24*30, '/', '.misdew.com');
  header("location: /hub");
  exit();
}
else {
  echo "error, please go back and try again";
  exit();
}
?>
