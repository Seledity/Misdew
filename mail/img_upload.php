<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$uploc = "Mail";
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows(mysqli_query($conx, "SELECT id FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  header("location: /mail");
  exit();
}
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "jCt5XrF4mwDntqsQD7NxX5TBuXAjFdPL";
 $POST_DATA = array(
   'file' => base64_encode($data),
   'key' => urlencode($required_key),
   'user' => urlencode($u_uid),
   'imagetype' => urlencode($u_uid),
   'imaeg' => urlencode($u_cloudterms),
   'fieltyp' => urlencode($u_cloudterms),
   'usernaem' => urlencode($u_username),
   'filextension' => urlencode($u_username),
   'uvia' => urlencode($uploc)
 );
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_URL, 'https://upl.justa.us/image.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
 $url = curl_exec($curl);
 if($url!=""){
   $disq = mysqli_query($conx, "SELECT id,uid_from FROM mail ORDER BY id DESC LIMIT 1");
   $disr = mysqli_fetch_assoc($disq);
   $dis_id = $disr['id'];
   $dis_uid = $disr['uid_from'];
   if($dis_uid == $u_uid) {
     if($msgtype != 'pm') {
       mysqli_query($conx, "UPDATE mail SET display_name='no' WHERE id='$dis_id'");
     }
   }
   mysqli_query($conx, "INSERT INTO mail (uqid, uid_from, message, timestamp, mtype, imgurl) VALUES ('$cv_uqid','$u_uid', '$url', '$tstamp','img','$url')");
   mysqli_query($conx, "UPDATE mail_memb SET last_active='$tstamp' WHERE uqid='$cv_uqid'");
 }
 else {
   // there was an error uploading the image
 }
 curl_close ($curl);
}
?>
