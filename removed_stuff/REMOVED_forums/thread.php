<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$get_thread_id = safe($_GET['i']);
$threads_q = mysqli_query($conx, "SELECT id,spindle_uqid,content FROM forum_threads WHERE id='$get_thread_id'");
$thread_exist = mysqli_num_rows($threads_q);
$threads_r = mysqli_fetch_assoc($threads_q);
$thread_id = $threads_r['id'];
$thread_spindle_uqid = $threads_r['spindle_uqid'];
$thread_content = $threads_r['content'];
if($thread_exist == '0') {
  exit();
}
echo "<span id=\"refresh\" onclick=\"refresh('$thread_id');\">refresh</span> <br><br>";
?>
<style>
/* CONTENT HERE FOR THIS PAGE */
/* MAKE SURE TO ADD TO THEMES */
/* CONTENT HERE FOR THIS PAGE */
.threads_cont {
  width: 90%;
  max-width: 450px;
  padding: 8px;
  background-color: #fff;
  font-family: 'Dosis', sans-serif;
  text-align: left;
}
</style>
<?php
$thread_q = mysqli_query($conx, "SELECT * FROM forum_threads WHERE id='$thread_id'");
$thread_r = mysqli_fetch_assoc($thread_q);
$thread_name = $thread_r['name'];
$thread_uid = $thread_r['uid'];
$usr_q = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$thread_uid'");
while($usr_r = mysqli_fetch_assoc($usr_q)) {
  $thread_username = $usr_r['username'];
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$thread_uid' && theme_id='$g_themeid'");
  while($usri_r = mysqli_fetch_assoc($usri_q)) {
    $username_color = $usri_r['username_color'];
    $thread_tcolor = $usri_r['text_color'];
    echo "<div class=\"threads_cont\">hi</div>";
  }
}
?>
<script>
function toThreads(uqid) {
  document.getElementById('goback').innerHTML = "go back..";
  $.get("threads.php?u=" + uqid, function(d) {
    $("#action_bar_page").html(d);
  });
}
function refresh(id) {
  document.getElementById('refresh').innerHTML = "refresh..";
  $.get("thread.php?i=" + id, function(d) {
    $("#action_bar_page").html(d);
  });
}
</script>
