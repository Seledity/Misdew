<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// App ID to move
$uapp_id = safe($_POST['app_id']);
// Up or Down
$move = safe($_POST['move']);
$query = mysqli_query($conx, "SELECT arrange FROM user_apps WHERE id='$uapp_id'");
$app = mysqli_fetch_assoc($query);
$uapp_arrange = $app['arrange'];
if($move == 'up') {
  mysqli_query($conx, "UPDATE user_apps SET arrange='$uapp_arrange'-1 WHERE id='$uapp_id' && uid='$u_uid'");
}
if($move == 'down') {
  mysqli_query($conx, "UPDATE user_apps SET arrange='$uapp_arrange'+1 WHERE id='$uapp_id' && uid='$u_uid'");
}
?>
