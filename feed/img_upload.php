<?php
require_once("../inc/conx.php");
$uploc = "Feed";
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "make YOUR OWN";
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
 $response = curl_exec($curl);
 echo trim($response);
 curl_close ($curl);
}
?>
