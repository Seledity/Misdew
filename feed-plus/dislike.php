<?php
/* Coded by Neonacid64 */
require_once("../inc/conx.php");
$id = safe($_GET['id']);
$is_post = safe($_GET['post']);

$query = mysqli_query($conx, "SELECT * FROM feed_dislikes WHERE post_id = '$id' && uid = '$u_uid'");
$amount = mysqli_num_rows($query);
if($u_token == safe($_GET['token'])){
if($amount == 0){
mysqli_query($conx, "INSERT INTO feed_dislikes (uid, post_id) VALUES ('$u_uid', '$id')");
}else{
mysqli_query($conx, "DELETE FROM feed_dislikes WHERE uid = '".$u_uid."' AND post_id = '$id'");
}
$querytwo = mysqli_query($conx, "SELECT * FROM feed_dislikes WHERE post_id = '$id' && uid = '".$u_uid."'");
$amounttwo = mysqli_num_rows($querytwo);
$likcnt_q = mysqli_query($conx, "SELECT id FROM feed_dislikes WHERE post_id='$id'");
$likcnt_r = number_format(mysqli_num_rows($likcnt_q));
if($likcnt_r != '1') {
  $lsz = "s";
}
}
else {
exit();
}
// dis code is end
?>
