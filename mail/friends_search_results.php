<?php
require_once("../inc/conx.php");
$q = safe($_GET['q']);
if(ctype_alnum($q) != true) {
  $q = null;
}
if($q) {
  $search_q = mysqli_query($conx, "SELECT uid,username,who_can_mail,md_verf FROM accounts WHERE username LIKE '$q%' && verified='yes'");
  $result_cnt = mysqli_num_rows($search_q);
  if($result_cnt == '0') {
    echo "<span class=\"no_results\">no results</span>";
  }
  while($search_r = mysqli_fetch_assoc($search_q)) {
    $s_uid = $search_r['uid'];
    $s_username = $search_r['username'];
    $s_whocan = $search_r['who_can_mail'];
    $s_verf = $search_r['md_verf'];
    if($s_verf == 'yes') {
      $verif_check = " <i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$s_uid' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      $username_color = $usri_r['username_color'];
      $chat_tcolor = $usri_r['text_color'];
    }
    if($s_uid == $u_uid) {
      echo "<span style=\"color: $username_color; font-weight: bold;\">$s_username$verif_check</span> ";
      echo "<span style=\"color: #808080; font-size: 10px;\">&bull; you</span>";
    }
    else {
      if($s_whocan == 'nobody') {
        echo "<span style=\"color: $username_color; font-weight: bold;\">$s_username$verif_check</span> ";
        echo "<span style=\"color: #808080; font-size: 10px;\">&bull; unavailable</span>";
      }
      if($s_whocan == 'friends') {
        $f_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND uid_rec='$s_uid' AND accepted='yes' ORDER BY id DESC");
        $fr_ct = mysqli_num_rows($f_q);
         if($fr_ct != '0') {
          echo "<span id=\"uid_$s_uid\" style=\"color: $username_color; font-weight: bold;\">$s_username$verif_check</span> ";
          echo "<span style=\"color: #808080; font-size: 10px;\">&bull; available</span>";
        }
      else {
        echo "<span style=\"color: $username_color; font-weight: bold;\">$s_username$verif_check</span> ";
        echo "<span style=\"color: #808080; font-size: 10px;\">&bull; unavailable</span>";
      }
    }
    if($s_whocan == 'anyone') {
      echo "<span id=\"uid_$s_uid\" style=\"color: $username_color; font-weight: bold;\">$s_username$verif_check</span> ";
      echo "<span style=\"color: #808080; font-size: 10px;\">&bull; available</span>";
    }
    }
    echo "<br>";
  }
}
?>
<script>
var Message = document.querySelectorAll("span[id^=uid_]");
[].forEach.call(Message, function(msg){
  msg.onclick = function(e){
    if (confirm("Message?")) {
      var msgo = new XMLHttpRequest();
      msgo.open("GET", "convo_create.php?u=" + msg.id.match(/([0-9]*)$/)[0], true);
      msgo.onreadystatechange = function(){
        if (msgo.readyState == 4)
          if(msgo.status == 200) {
            toMessages();
          }
          else {
            alert("error");
          }
      };
      msgo.send();
      return false;
    }
  };
});
</script>
