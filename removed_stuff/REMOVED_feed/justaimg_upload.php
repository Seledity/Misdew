<?php
require_once("../inc/conx.php");
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $POST_DATA = array(
   'file' => base64_encode($data)
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
