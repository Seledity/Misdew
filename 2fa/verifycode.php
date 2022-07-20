<?php
session_start();
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
  exit();
}
# POST DATA
$username_p = safe($_POST['username']);
$password_p = safe($_POST['password']);
$t2facode = safe($_POST['2facode']);
if($username_p && $password_p && $t2facode) {
  $cs = mysqli_query($conx, "SELECT 2fa_code,uid,username,verified,password,2fa,email_secure,rstringa,rstringb,rstringc FROM accounts WHERE username='$username_p'");
  $ccnt = mysqli_num_rows($cs);
  $cr = @mysqli_fetch_assoc($cs);
  $c_username = $cr['username'];
  $c_uuid = $cr['uid'];
  $c_eemailhash = $cr['email_secure'];
  $c_password = $cr['password'];
  $c_verified = $cr['verified'];
  $c_2fa = $cr['2fa'];
  $c_2fa_code = $cr['2fa_code'];
  $c_rstringa = $cr['rstringa'];
  $c_rstringb = $cr['rstringb'];
  $c_rstringc = $cr['rstringc'];
  # ACCOUNT IS NOT VERIFIED
  if($c_verified != 'yes') {
    $kill = '';
    $msg = 'nvdjrj6jfnxalpowqnzaiywliz';
    setcookie("akgnxoPwqlIs", $kill, time()+3600*24*30, '/', '.misdew.com');
    setcookie("LoILilzcnmwe", $kill, time()+3600*24*30, '/', '.misdew.com');
    setcookie("puTtxXvbEkOo", $kill, time()+3600*24*30, '/', '.misdew.com');
    setcookie("hwsmnzeiopqm", $msg, time()+3600*24*30, '/', '.misdew.com');
    echo "error";
    exit();
  }
  # IF THE USERNAME DOES NOT EXIST
  if($ccnt == 0) {
    echo "error";
    exit();
  }
  // check and require 2FA
  if($c_2fa == 'enabled') {
    function genTFAc($length = 10) {
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
    $rand2facode = genTFAc();

    // hash the 2fa code
    $t2facodehasher = "make ur own but keep it consistent between files";
    $posted_2fahash = hash("sha256",$t2facodehasher.$t2facode);

    // hash the password
    $password_hashed = hash("sha256",$c_username.$password_p);
    # IF PASSWORD IS INCORRECT
    if($password_hashed != $c_password) {
      echo "error";
      exit();
    }
    if($c_2fa_code != $posted_2fahash) {
      echo "2FA code wrong, please go back and try again; email me@justa.us if you need help";
      exit();
    }


    if($password_hashed == $c_password && $posted_2fahash == $c_2fa_code) {
      // log the user in and delete 2FA entry from their account
      mysqli_query($conx, "UPDATE accounts SET 2fa_code='' WHERE uid='$c_uuid'");
      setcookie("akgnxoPwqlIs", $c_rstringa, time()+3600*24*30, '/', '.misdew.com');
      setcookie("LoILilzcnmwe", $c_rstringb, time()+3600*24*30, '/', '.misdew.com');
      setcookie("puTtxXvbEkOo", $c_rstringc, time()+3600*24*30, '/', '.misdew.com');
      $kill = '';
      setcookie("hwsmnzeiopqm", $kill, time()+3600*24*30, '/', '.misdew.com');
      header("location: /hub");
      exit();
    }
    else {
      echo "error";
      exit();
    }


  }
  else {
    echo "error";
    exit();
  }

}
else {
echo "error";
exit();
}
?>
