<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$uploc = "Chat";
if ( isset($_FILES['vid']) ) {
 $filename  = $_FILES['vid']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "ur own key here";
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
 curl_setopt($curl, CURLOPT_URL, 'https://upl.justa.us/video.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
 $url = curl_exec($curl);
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
   $url_link = "<span id=\"mdLink\" onclick=\"window.open(\'$url\');\" style=\"font-weight: bold; text-decoration: underline;\">view file</span>";
   $disq = mysqli_query($conx, "SELECT id,uid,pmuid,msgtype FROM chat ORDER BY id DESC LIMIT 1");
   $disr = mysqli_fetch_assoc($disq);
   $dis_id = $disr['id'];
   $dis_uid = $disr['uid'];
   $jb_uid = "6";
   if($dis_uid == $jb_uid) {
       mysqli_query($conx, "UPDATE chat SET display_name='no' WHERE id='$dis_id'");
   }
   mysqli_query($conx, "INSERT INTO chat (uid, message, tstamp) VALUES ('6', '<b>@$u_username</b> uploaded a video: $url_link', '$tstamp')");
   echo $url;
 }
 else {
   // there was an error uploading the image
 }
 curl_close ($curl);
}



?>
