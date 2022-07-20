<?php
$cloudx = mysqli_connect("127.0.0.1","uploads","ur own password","uploads");
if(mysqli_connect_errno($cloudx)) {
  exit();
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
$fffiilletype = $cloudr['filetype'];
if($fffiilletype == 'Image') {
$file_location = "image_uploads/$fa1";
}
if($fffiilletype == 'Video') {
$file_location = "image_uploads/v/$fa1";
}



if($uid == $ver_uid && $ver_id == $id) {

  mysqli_query($cloudx, "DELETE FROM image_uploads WHERE id='$id'");

  if (!unlink($file_location)) {
      exit();
  }
  else { }


}
else {
  exit();
}
?>
