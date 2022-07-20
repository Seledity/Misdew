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
$email_p = safe($_POST['email']);
if($username_p && $password_p && $email_p) {
  $cs = mysqli_query($conx, "SELECT uid,username,verified,password,2fa,email_secure FROM accounts WHERE username='$username_p'");
  $ccnt = mysqli_num_rows($cs);
  $cr = @mysqli_fetch_assoc($cs);
  $c_username = $cr['username'];
  $c_uuid = $cr['uid'];
  $c_eemailhash = $cr['email_secure'];
  $c_password = $cr['password'];
  $c_verified = $cr['verified'];
  $c_2fa = $cr['2fa'];
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
    function genTFAc($length = 6) {
      return substr(str_shuffle("0123456789"), 0, $length);
    }
    $rand2facode = genTFAc();

    // hash the email
    $email_hasher = "make this ur own random string sht like askdlfjask;ldfjkl534jkl3j but make sure it matches in other files where email is encrypted like join and stuff ok";
    $email_hashed = hash("sha256",$email_hasher.$email_p);

    // hash the password
    $password_hashed = hash("sha256",$c_username.$password_p);
    # IF PASSWORD IS INCORRECT
    if($password_hashed != $c_password) {
      echo "error";
      exit();
    }

    if($email_hashed == $c_eemailhash && $password_hashed == $c_password) {
      // hash the 2fa code
      $tfa_hasher = "read above bro make ur own";
      $tfa_hashed = hash("sha256",$tfa_hasher.$rand2facode);
      mysqli_query($conx, "UPDATE accounts SET 2fa_code='$tfa_hashed' WHERE uid='$c_uuid'");
      # PUSH OUT EMAIL
      $to = $email_p;
      $subject = "misdew.com 2FA";
      $txt = "$c_username, <br>
            Your account was successfully logged into. <br>
            2FA has been enabled for your account so the code below is needed to fully login. <br>
            If you did not login, your account has been compromised. Please update your password immediately if you did not request a 2FA code. <br>
            Contact me@justa.us if you need any help. <br><br>
            Use this code on the 2FA page: $rand2facode
            <br><br>
          </span>
        </center>";
      $headers = "Content-Type: text/html; charset=utf-8";
      mail($to,$subject,$txt,$headers);
      header("location: /2fa/code.php");
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
