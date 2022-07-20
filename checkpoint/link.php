<?php
require_once("../inc/check-conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$gtoken = safe($_POST['token']);
if($gtoken == $u_token) {
  $new_email = safe($_POST['new_email']);
  $new_email_conf = safe($_POST['new_email_conf']);
  $password = safe($_POST['password']);
  $u_password = $y['password'];
  // If current password is correct
  // hash the password
  $password_hashed = hash("sha256",$u_username.$password);
  if($password_hashed == $u_password) {
    if($email_secure == '') {
      if($new_email == $new_email_conf) {
        // do something


        # GENERATE KEY TO RESET
        function genR($length = 10) {
          return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        }
        $resetid = genR();



        // hash the email
        $email_hasher = "ur own random sht here keep it consistent tho bro kl;fakfljsdlkjsdaf";
        $email_hashed = hash("sha256",$email_hasher.$new_email);

        // if email already exists
        $qq = mysqli_query($conx, "SELECT username FROM accounts WHERE email_secure='$email_hashed'");
        $cc = mysqli_num_rows($qq);
        if($cc > 0) {
          $_SESSION['m6'] = "gen_error";
        	header("location: /");
        	exit();
        }

        # INSERT RESET DETAILS
        mysqli_query($conx, "INSERT INTO forgot_password (tstamp,uqid,email_secure,username) VALUES ('$tstamp','$resetid','$email_hashed','$u_username')");
        # PUSH OUT EMAIL
        $to = $new_email;
        $subject = "misdew.com email update";
        $txt = "$u_username, <br>
              An email update was requested for your account. <br>
              Follow the link below to continue. <br><br>
              <a href=\"https://misdew.com/checkpoint/verify.php?k=$resetid\">https://misdew.com/checkpoint/verify.php?k=$resetid</a> <br><br>
            </span>
          </center>";
        $headers = "Content-Type: text/html; charset=utf-8";
        mail($to,$subject,$txt,$headers);
        $_SESSION['m4'] = "em_ss";
        header("location: /checkpoint");
        exit();




      }
      else {
        header("location: /throw_error");
        exit();
      }
    }
    else {
      header("location: /throw_error");
      exit();
    }
  }
  else {
    header("location: /throw_error");
    exit();
  }
}
?>
