<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($u_emoji_type == 'custom') { echo "<br> Your emoji is currently a custom set from another app."; }
?>
