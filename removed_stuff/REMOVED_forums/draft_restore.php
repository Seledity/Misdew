<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$get_thread_id = safe($_GET['i']);
$thrd_q = mysqli_query($conx, "SELECT id,name,content,tstamp FROM forum_threads WHERE id='$get_thread_id' && draft='yes' ORDER BY id DESC");
while($thrd_r = mysqli_fetch_assoc($thrd_q)) {
  $thread_title = $thrd_r['name'];
  $thread_content = $thrd_r['content'];
  echo nl2br($thread_title);
  echo "--|~|1|~|MD|~|1|~|--";
  echo nl2br($thread_content);
}
?>
