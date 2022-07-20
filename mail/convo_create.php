<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$c_uid = safe($_GET['u']);
if($c_uid == $u_uid) {
  exit();
}
$cu_slc = mysqli_query($conx, "SELECT username,who_can_mail FROM accounts WHERE uid='$c_uid'");
if(mysqli_num_rows($cu_slc) == '0') {
  exit();
}
$cu_rw = mysqli_fetch_assoc($cu_slc);
$cu_who_cmail = $cu_rw['who_can_mail'];
if($cu_who_cmail == 'nobody') {
  die("nobody");
}
if($cu_who_cmail == 'friends') {
  $f_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND uid_rec='$c_uid' AND accepted='yes' ORDER BY id DESC");
  $fr_ct = mysqli_num_rows($f_q);
  if($fr_ct == '0') {
    exit();
  }
}
if($u_mail_rand == 'on') {
  # CHOOSE A RANDOM IMAGE
  $cv_pic = rand(1,30);
  $cv_pic = "/img/random/$cv_pic.jpg";
  # CHOOSE A RANDOM NAME
  $names = Array("Misdew Gang","Misdew Crew","Untitled","Dew Crew","Best Friends","BFFs","Misdew","Misdewians","Dewds","Homies","Nerds","Friends","Losers","Hangout","Cool Kids","Rename","Name Me","Default","Turnt","Lit","MD","MDv5","New Convo");
  $cv_name = array_rand($names, 1);
  $cv_name = $names[$cv_name];
  # CHOOSE A RANDOM MESSAGE
  $messages = Array("Sup B\)","Hey.","Hey!","How are you?","Welcome!","Misdew is lit!","Conversation created.","Created.","Done.",":\)","Woo-hoo!","Yay!","This convo is awesome.","Sweet!","Rad.","B\) Yo.","Hi! :\)","Start chatting!");
  $cv_message = array_rand($messages, 1);
  $cv_message = $messages[$cv_message];
  # CHOOSE A RANDOM COLOR
  $colors = Array("blue","pink","red","orange","green","violet","indigo","#309dfc","#a64ca6","1985db","lime","hotpink","#5BEAD0","#5bea89","#5151CC","#8F51CC","#E0115F","#7b7d41","#87435a","#ff5c00","#aeb2c3","#15284F","#5b265b");
  $cv_color = array_rand($colors, 1);
  $cv_color = $colors[$cv_color];
}
else {
  $cv_pic = "/img/logo.png";
  $cv_name = "Untitled";
  $cv_message = "Created.";
  $cv_color = "blue";
}
# GENERATE A RANDOM STRING
function genRand($length = 15) {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
$rstr = genRand();
mysqli_query($conx, "INSERT INTO mail_convo (uqid, uid_owner, name, picture, main_color, can_add) VALUES ('$rstr','$u_uid','$cv_name','$cv_pic','$cv_color','no')");
mysqli_query($conx, "INSERT INTO mail_memb (uqid, uid, last_active, rank, latest_read) VALUES ('$rstr','$u_uid','$tstamp','admin','yes')");
mysqli_query($conx, "INSERT INTO mail_memb (uqid, uid, last_active, latest_read, sent) VALUES ('$rstr','$c_uid','$tstamp','yes','no')");
mysqli_query($conx, "INSERT INTO mail (uqid, uid_from, message, timestamp) VALUES ('$rstr','6','$cv_message','$tstamp')");
?>
