<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$uploc = "Chat";
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "ur own";
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
 curl_setopt($curl, CURLOPT_URL, 'https://upl.justa.us/image-direct.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
 $url = curl_exec($curl);
 $url_comp = substr($url, 19);
 $comp_url = "http://misdew-ds.com/$url_comp";
 if($url!=""){
   $disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
   $disr = mysqli_fetch_assoc($disq);
   $dis_id = $disr['id'];
   $dis_uid = $disr['uid'];
   $dis_pmuid = $disr['pmuid'];
   $msgtype = $disr['msgtype'];
   if($dis_uid == $u_uid) {
     if($msgtype != 'pm') {
       mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
     }
   }
   mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp, mtype, imgurl, comp_imgurl) VALUES ('$u_uid', '$url', '$tstamp','img','$url','$comp_url')");
   echo $url;
 }
 else {
   // there was an error uploading the image
 }
 curl_close ($curl);
}



?>
