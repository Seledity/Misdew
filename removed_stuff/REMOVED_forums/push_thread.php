<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$f_type = safe($_POST['type']);
$f_uqid = safe($_POST['uqid']);
$f_title = safe($_POST['title']);
$f_content = safe($_POST['content']);
$split = explode('1', $f_uqid);
$spindle_uqid = $split[0];
$subspindle_uqid = $split[1];
if($f_title != '') {
  if($f_type == 'save') {
    $draft = "yes";
  }
  elseif($f_type == 'post') {
    $draft = "no";
  }
  else {
    exit();
  }
  mysqli_query($conx, "INSERT INTO forum_threads (draft,spindle_uqid,name,uid,content,tstamp) VALUES ('$draft','$f_uqid','$f_title','$u_uid','$f_content','$tstamp')");
  if($f_type == 'post') {
    mysqli_query($conx, "UPDATE forum_spindles SET tstamp='$tstamp' WHERE uqid='$spindle_uqid'");
  }
}
?>
