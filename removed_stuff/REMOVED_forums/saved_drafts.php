<select id="restore_drft" style="width: 100%;" onchange="restoreDraft();">
  <option>Select a Draft</option>
<?php
  require_once("../inc/conx.php");
  if($logged_in == false) {
    header("location: /");
    exit();
  }
  $default_spindle_uqid = safe($_GET['u']);
  $split = explode('1', $default_spindle_uqid);
  $spindle_uqid = $split[0];
  $subspindle_uqid = $split[1];
  $thrd_q = mysqli_query($conx, "SELECT id,name,content,tstamp FROM forum_threads WHERE uid='$u_uid' && spindle_uqid='$default_spindle_uqid' && draft='yes' ORDER BY id DESC");
  while($thrd_r = mysqli_fetch_assoc($thrd_q)) {
    $vthread_id = $thrd_r['id'];
    $vthread_title = $thrd_r['name'];
    $vthread_content = $thrd_r['content'];
    $vthread_tstamp = $thrd_r['tstamp'];
    echo "<option value=\"$vthread_id\">$vthread_title (";
    echo timeago($vthread_tstamp);
    echo " ago)</option>";
  }
  ?>
</select>
