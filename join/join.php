<?php
session_start();
require_once("../inc/conx.php");
if($logged_in == true) {
  header("location: /join");
  exit();
}
# POST DATA
$username_p = safe($_POST['username']);
$password_p = safe($_POST['password']);
$confirm_password_p = safe($_POST['confirm_password']);
$email_addr = safe($_POST['email']);
# EMAIL VERIFICATION
// filter banned usernames
$username_p = str_ireplace("misdew","","$username_p");
$username_p = str_ireplace("anonymous","","$username_p");
// filter banned emails
$email_addr = str_ireplace("protonmail.com","","$email_addr");
$email_addr = str_ireplace("hornyalwary.top","","$email_addr");
$email_addr = str_ireplace("grr.la","","$email_addr");
$email_addr = str_ireplace("riski.cf","","$email_addr");
$email_addr = str_ireplace("mailscheap.us","","$email_addr");
$email_addr = str_ireplace("rejo.technology","","$email_addr");
$email_addr = str_ireplace("bbhost.us","","$email_addr");
$email_addr = str_ireplace("garasikita.pw","","$email_addr");
$email_addr = str_ireplace("9.fackme.gq","","$email_addr");
$email_addr = str_ireplace("6.fackme.gq","","$email_addr");
$email_addr = str_ireplace("maswae.world","","$email_addr");
$email_addr = str_ireplace("sexyalwasmi.top","","$email_addr");
$email_addr = str_ireplace("vuiy.pw","","$email_addr");
$email_addr = str_ireplace("3.emailfake.ml","","$email_addr");
$email_addr = str_ireplace("mail.bestoption25.club","","$email_addr");
$email_addr = str_ireplace("locantowsite.club","","$email_addr");
$email_addr = str_ireplace("1000rebates.stream","","$email_addr");
$email_addr = str_ireplace("alvinjozz.website","","$email_addr");
$email_addr = str_ireplace("rollindo.agency","","$email_addr");
$email_addr = str_ireplace("two.fackme.gq","","$email_addr");
$email_addr = str_ireplace("8.fackme.gq","","$email_addr");
$email_addr = str_ireplace("inaby.com","","$email_addr");
$email_addr = str_ireplace(".pp.ua","","$email_addr");
$email_addr = str_ireplace("axon7zte.com","","$email_addr");
$email_addr = str_ireplace("kgq701.com","","$email_addr");
$email_addr = str_ireplace("lenovog4.com","","$email_addr");
$email_addr = str_ireplace("alienware13.com","","$email_addr");
$email_addr = str_ireplace("akgq701.com","","$email_addr");
$email_addr = str_ireplace("envy17.com","","$email_addr");
$email_addr = str_ireplace("xperiae5.com","","$email_addr");
$email_addr = str_ireplace("honor-8.com","","$email_addr");
$email_addr = str_ireplace("xperiae5.com","","$email_addr");
$email_addr = str_ireplace("lgxscreen.com","","$email_addr");
$email_addr = str_ireplace("pavilionx2.com","","$email_addr");
$email_addr = str_ireplace("klipschx12.com","","$email_addr");
$email_addr = str_ireplace("alliancewe.us","","$email_addr");
$email_addr = str_ireplace("almondwe.us","","$email_addr");
$email_addr = str_ireplace("acuitywe.us","","$email_addr");
$email_addr = str_ireplace("allaroundwe.us","","$email_addr");
$email_addr = str_ireplace("americaswe.us","","$email_addr");
$email_addr = str_ireplace("interserver.ga","","$email_addr");
$email_addr = str_ireplace("allstarwe.us","","$email_addr");
$email_addr = str_ireplace("analyticswe.us","","$email_addr");
$email_addr = str_ireplace("analyticalwe.us","","$email_addr");
$email_addr = str_ireplace("ambitiouswe.us","","$email_addr");
$email_addr = str_ireplace("aheadwe.us","","$email_addr");
$email_addr = str_ireplace("clearwatermail.info","","$email_addr");
$email_addr = str_ireplace("gsxstring.ga","","$email_addr");
$email_addr = str_ireplace("simscity.cf","","$email_addr");
$email_addr = str_ireplace("allinonewe.us","","$email_addr");
$email_addr = str_ireplace("advantagewe.us","","$email_addr");
$email_addr = str_ireplace("activitywe.us","","$email_addr");
$email_addr = str_ireplace("allegrowe.us","","$email_addr");
$email_addr = str_ireplace("yourtube.ml","","$email_addr");
$email_addr = str_ireplace("abacuswe.us","","$email_addr");
$email_addr = str_ireplace("teleworm.us","","$email_addr");
$email_addr = str_ireplace("armyspy.com","","$email_addr");
$email_addr = str_ireplace("emailure.net","","$email_addr");
$email_addr = str_ireplace("nwytg.com","","$email_addr");
$email_addr = str_ireplace("keromail.com","","$email_addr");
$email_addr = str_ireplace("dispostable.com","","$email_addr");
if (!filter_var($email_addr, FILTER_VALIDATE_EMAIL)) {
	$_SESSION['m6'] = "gen_error";
	header("location: /join");
	exit();
}
# ACCOUNT CREATION
if($username_p && $password_p && $confirm_password_p && $email_addr) {
  // define the error variables
  $pdnm = '';
  $uinan = '';
  $unitl = '';
  $unae = '';
  // if the passwords do not match
  if($password_p != $confirm_password_p) {
    $pdnm = true;
  }
  // if the username isn't alphanumeric
  if(!ctype_alnum($username_p)) {
    $uinan = true;
  }
  // if username is longer than 13 characters
  if(strlen($username_p) > 13) {
    $unitl = true;
  }
  // if username already exists
  $q = mysqli_query($conx, "SELECT username FROM accounts WHERE username='$username_p'");
  $c = mysqli_num_rows($q);
  if($c > 0) {
    $unae = true;
  }
  // hash the email
  $email_hasher = "make ur own random shit here like ...asfkjfj&*Y$#@JK.asfdHf... i know this shit prob aint too secure maybe but i tried";
  $email_hashed = hash("sha256",$email_hasher.$email_addr);
  // if email already exists
  $qq = mysqli_query($conx, "SELECT username FROM accounts WHERE email_secure='$email_hashed'");
  $cc = mysqli_num_rows($qq);
  if($cc > 0) {
    $_SESSION['m6'] = "gen_error";
  	header("location: /join");
  	exit();
  }
  // if length error
  if($unitl == true) {
    $_SESSION['m4'] = "user_leng";
    header("location: /join");
    exit();
  }
  // if username exists error
  if($unae == true) {
    $_SESSION['m5'] = "user_exi";
    header("location: /join");
    exit();
  }
  // if both username and password error
  elseif($pdnm == true && $uinan == true && $unitl == '') {
    $_SESSION['m3'] = "pdnm_aumna";
    header("location: /join");
    exit();
  }
  // if just password error
  elseif($pdnm == true && $uinan == '') {
    $_SESSION['m1'] = "chec_yapass";
    header("location: /join");
    exit();
  }
  // if just username error
  elseif($uinan == true && $pdnm == '') {
    $_SESSION['m2'] = "user_alnum";
    header("location: /join");
    exit();
  }
  // hash the password
  $password_hashed = hash("sha256",$username_p.$password_p);

  // generate random strings
  function genRand1($length = 50) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  function genRand2($length = 50) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  function genRand3($length = 50) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  function genRand4($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
  $genran_str1 = genRand1();
  $genran_str2 = genRand2();
  $genran_str3 = genRand3();
  $gentoken = genRand4();
  # ACTUAL ACCOUNT CREATION
  $site_locdesc = "attemptin\' verification";
  mysqli_query($conx, "INSERT INTO accounts (username, password, email_secure, token, rstringa, rstringb, rstringc, last_ip, current_ip, uagent, joinstamp, site_locdesc) VALUES ('$username_p','$password_hashed','$email_hashed','$gentoken','$genran_str1','$genran_str2','$genran_str3','$ipaddr','$ipaddr','$uagent','$tstamp','$site_locdesc')");
  # LOG USER IN TO ACCOUNT
  $cs = mysqli_query($conx, "SELECT uid,token,username,rstringa,rstringb,rstringc FROM accounts WHERE username='$username_p'");
  $cr = mysqli_fetch_assoc($cs);
  $c_userid = $cr['uid'];
  $c_username = $cr['username'];
  $c_token = $cr['token'];
  $c_rstringa = $cr['rstringa'];
  $c_rstringb = $cr['rstringb'];
  $c_rstringc = $cr['rstringc'];
  setcookie("akgnxoPwqlIs", $c_rstringa, time()+3600*24*30, '/', '.misdew.com');
  setcookie("LoILilzcnmwe", $c_rstringb, time()+3600*24*30, '/', '.misdew.com');
  setcookie("puTtxXvbEkOo", $c_rstringc, time()+3600*24*30, '/', '.misdew.com');
  # PUSH OUT EMAIL
  $to = $email_addr;
  $subject = "misdew.com verification";
  $txt = "$c_username, <br>
        Thank you for creating an account. Now it's time to verify. <br>
        Follow the link below to continue. Please allow it to load completely. <br><br>
        <a href=\"https://misdew.com/join/verify.php?k=$c_token\">https://misdew.com/join/verify.php?k=$c_token</a> <br><br>
      </span>
    </center>";
  $headers = "Content-Type: text/html; charset=utf-8";
  mail($to,$subject,$txt,$headers);
  header("location: /hub");
  exit();
}
else {
  $_SESSION['m'] = "all_req";
  header("location: /join");
  exit();
}
?>
