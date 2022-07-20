<?php
session_start();
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /");
  exit();
}
# POST DATA
$email_p = safe($_POST['email']);
$username_p = safe($_POST['username']);

// hash the email
$email_hasher = "make ur own random shit here like ...asfkjfj&*Y$#@JK.asfdHf... i know this shit prob aint too secure maybe but i tried";
$email_hashed = hash("sha256",$email_hasher.$email_p);

if($email_p) {
  $cs = mysqli_query($conx, "SELECT username,email_secure FROM accounts WHERE email_secure='$email_hashed' && username='$username_p'");
  $ccnt = mysqli_num_rows($cs);
  if(filter_var($email_p, FILTER_VALIDATE_EMAIL) === false) {
    $_SESSION['m2'] = "e_inv";
    header("location: /forgot");
    exit();
  }
  if($ccnt == '0') {
    $_SESSION['m'] = "generr";
    header("location: /forgot");
    exit();
  }
  $cr = @mysqli_fetch_assoc($cs);
  $c_username = $cr['username'];
  $c_email = $cr['email_secure'];
  # GENERATE KEY TO RESET
  function genR($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $resetid = genR();
  $ipaddr_r = $_SERVER['REMOTE_ADDR'];
  $useragent_r = $_SERVER['HTTP_USER_AGENT'];
  # CHECK TO SEE IF A RESET EMAIL HAS ALREADY BEEN SENT
  $qqq = mysqli_query($conx, "SELECT email_secure FROM forgot_password WHERE email_secure='$c_email'");
  $qqqnt = mysqli_num_rows($qqq);
  if($qqqnt > 0) {
    mysqli_query($conx, "UPDATE forgot_password SET uqid='$resetid' WHERE email_secure='$c_email'");
    mysqli_query($conx, "UPDATE forgot_password SET tstamp='$tstamp' WHERE email_secure='$c_email'");
    mysqli_query($conx, "UPDATE forgot_password SET ua='$useragent_r' WHERE email_secure='$c_email'");
    mysqli_query($conx, "UPDATE forgot_password SET ip='$ipaddr_r' WHERE email_secure='$c_email'");
  }
  else {
  # INSERT RESET DETAILS
  $innss = mysqli_query($conx, "INSERT INTO forgot_password (ip,ua,tstamp,uqid,email_secure,username) VALUES ('$ipaddr_r','$useragent_r','$tstamp','$resetid','$c_email','$c_username')");
  }
  # PUSH OUT EMAIL
  $to = $email_p;
  $subject = "misdew.com password reset";
  $txt = "$c_username, <br>
        A password reset was requested for your account. <br>
        Follow the link below to continue. <br><br>
        <a href=\"http://misdew.com/forgot/reset.php?k=$resetid\">http://misdew.com/forgot/reset.php?k=$resetid</a> <br><br>
      </span>
    </center>";
  $headers = "Content-Type: text/html; charset=utf-8";
  mail($to,$subject,$txt,$headers);
  $_SESSION['m4'] = "em_ss";
  header("location: /forgot");
  exit();
}
else {
  $_SESSION['m3'] = "all_req";
  header("location: /forgot");
  exit();
}
session_destroy();
?>
