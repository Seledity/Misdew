<?php
session_start();
require_once("../inc/check-conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
# POST DATA
$resetid_p = safe($_GET['k']);
if($resetid_p && $u_username && $email_secure == '') {
  $cs = mysqli_query($conx, "SELECT tstamp,uqid,username,email_secure FROM forgot_password WHERE uqid='$resetid_p'");
  $ccnt = mysqli_num_rows($cs);
  if($ccnt == '0') {
    $_SESSION['m5'] = "ef_hef";
    header("location: /");
    exit();
  }
  $crs = mysqli_fetch_assoc($cs);
  $rs_tstamp = $crs['tstamp'];
  $rs_uqid = $crs['uqid'];
  $rs_username = $crs['username'];
  $rs_email = $crs['email_secure'];

if($email_secure == '') {
}
else {
  header("location: /");
  exit();
}

  // if email already exists
  $qq = mysqli_query($conx, "SELECT username FROM accounts WHERE email_secure='$rs_email'");
  $cc = mysqli_num_rows($qq);
  if($cc > 0) {
    $_SESSION['m6'] = "gen_error";
    header("location: /");
    exit();
  }

  # MAKE SURE LINK HASN'T REACHED ONE HOUR EXPIRE LIMIT
  $tttstamp = $rs_tstamp + 3600;
  if($tstamp >= $tttstamp) {
    mysqli_query($conx, "DELETE FROM forgot_password WHERE email_secure='$rs_email'");
    $_SESSION['m5'] = "ef_hef";
    header("location: /");
    exit();
  }
  mysqli_query($conx, "UPDATE accounts SET email_secure='$rs_email' WHERE username='$u_username'");
  mysqli_query($conx, "DELETE FROM forgot_password WHERE email_secure='$rs_email'");
  header("location: /");
  exit();
}
else {
  header("location: /");
  exit();
}
?>
