<?php
require_once("../inc/conx.php");
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows($cvo_slc = mysqli_query($conx, "SELECT id,rank FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  exit();
}
$uploc = "Mail";
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "make ur own";
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
 mysqli_query($conx, "UPDATE mail_convo SET picture='$url' WHERE uqid='$cv_uqid'");
 echo trim($url);
 curl_close ($curl);
}
?>
