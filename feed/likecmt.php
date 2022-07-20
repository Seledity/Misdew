<?php
/* Coded by Neonacid64 */
require_once("../inc/conx.php");
$id = safe($_GET['id']);
$pid = safe($_GET['i']);

$query = mysqli_query($conx, "SELECT * FROM feedcmt_likes WHERE cmt_id = '$id' && uid = '$u_uid'");
$amount = mysqli_num_rows($query);
if($u_token == safe($_GET['token'])){
if($amount == 0){
mysqli_query($conx, "INSERT INTO feedcmt_likes (uid, cmt_id, post_id) VALUES ('$u_uid', '$id', '$pid')");
}else{
mysqli_query($conx, "DELETE FROM feedcmt_likes WHERE uid = '".$u_uid."' AND cmt_id = '$id'");
}
$querytwo = mysqli_query($conx, "SELECT * FROM feedcmt_likes WHERE cmt_id = '$id' && uid = '".$u_uid."'");
$amounttwo = mysqli_num_rows($querytwo);
$likcnt_q = mysqli_query($conx, "SELECT id FROM feedcmt_likes WHERE cmt_id='$id'");
$likcnt_r = number_format(mysqli_num_rows($likcnt_q));
if($likcnt_r != '1') {
  $lsz = "s";
}
	// do stuff
	if(safe($_GET["_t"])) {
    if($amounttwo == 1) {
      echo "<span><i class='fa fa-thumbs-up' id='like_simple'></i></span> $likcnt_r like$lsz";
    }
    else {
      echo "<i class='fa fa-thumbs-up'></i> $likcnt_r like$lsz";
    }
  }
  else {
    // redirect
    header('location: index.php');
	}
}
else {
die('Invalid token.');
}
// dis code is end
?>
