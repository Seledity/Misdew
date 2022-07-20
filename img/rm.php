<?php
$cloudx = mysqli_connect("127.0.0.1","uploads","3Lza4PRGxcT3qPjz","uploads");
if(mysqli_connect_errno($cloudx)) {
  exit();
}
$mdv5 = mysqli_connect("127.0.0.1","mdv5","RKYCuxDSxjDbXjN9","mdv5");
if (mysqli_connect_errno($mdv5)) {
	echo mysqli_connect_error();
}
function safe($input) {
  global $cloudx;
  $valid_input = mysqli_real_escape_string($cloudx, trim(stripcslashes(htmlentities($input ,ENT_QUOTES, "UTF-8"))));
  return $valid_input;
}
$id = safe($_GET['id']);
$uid = safe($_GET['u']);
$uupldder = safe($_GET['upld']);


$cloudq = mysqli_query($cloudx, "SELECT * FROM image_uploads WHERE id='$id' && uid='$uid' && uid_doublecheck='$uid' && posted_uname='$uupldder' && verif_username='$uupldder'");
$cloudr = mysqli_fetch_assoc($cloudq);
$fa1 = $cloudr['file_name'];
$ver_id = $cloudr['id'];
$ver_uid = $cloudr['uid'];
$ver_cloudsize = $cloudr['cloud_size'];
$fffiilletype = $cloudr['filetype'];
if($fffiilletype == 'Image') {
$file_location = "uploads/$fa1";
$file_location_mdds = "../../misdew-ds.com/img/uploads/$fa1";



$cloud_file_size = filesize($file_location);

$x = mysqli_query($mdv5, "SELECT uid,cloud_usage FROM accounts WHERE uid='$ver_uid'");
$y = mysqli_fetch_assoc($x);
$uploader_uid = $y['uid'];
$uploader_usage = $y['cloud_usage'];
if($ver_cloudsize != '') {
mysqli_query($mdv5, "UPDATE accounts SET cloud_usage='$uploader_usage'-$cloud_file_size WHERE uid='$uploader_uid'");
}

}
if($fffiilletype == 'Video') {
$file_location = "uploads/v/$fa1";

$cloud_file_size = filesize($file_location);

$x = mysqli_query($mdv5, "SELECT uid,cloud_usage FROM accounts WHERE uid='$ver_uid'");
$y = mysqli_fetch_assoc($x);
$uploader_uid = $y['uid'];
$uploader_usage = $y['cloud_usage'];
if($ver_cloudsize != '') {
mysqli_query($mdv5, "UPDATE accounts SET cloud_usage='$uploader_usage'-$cloud_file_size WHERE uid='$uploader_uid'");
}

}



if($uid == $ver_uid && $ver_id == $id) {

  mysqli_query($cloudx, "DELETE FROM image_uploads WHERE id='$id'");

  if (!unlink($file_location)) {
      exit();
  }
  else { }

  if (!unlink($file_location_mdds)) {
      exit();
  }
  else { }


}
else {
  exit();
}
?>
