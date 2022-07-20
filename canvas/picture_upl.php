<?php
require_once("../inc/conx.php");
$uploc = "Canvas";
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "make ur own key bro upl.justa.us directory....";
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
 $comp_url = "http://misdew-ds.com/$url_comp"; // ye so like misdew ds is a ds version and images and stuff are auto copied into a directory there but u wont need the misdew ds stuff so u can remove it all urself HUAHHHHHH  if u choose 
 if($url == '') {
   exit();
 }
 else {
 mysqli_query($conx, "UPDATE accounts SET picture='$url' WHERE uid='$u_uid'");
 mysqli_query($conx, "UPDATE accounts SET picture_mdds='$comp_url' WHERE uid='$u_uid'");
}
 echo trim($url);
 curl_close ($curl);
}
?>
