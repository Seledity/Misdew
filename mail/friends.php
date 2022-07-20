<div class="mail_addm">
  <input id="search_query" class="mail_addm_input" placeholder="Search Members" onkeypress="search()" onkeyup="search()">
</div>
<div id="addm_results" class="mail_addm" style="display: none;">
  <div id="search_results">
    <?php require_once("friends_search_results.php"); ?>
  </div>
</div> <br>
<?php
$f_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND accepted='yes' ORDER BY tstamp DESC");
$fr_ct = mysqli_num_rows($f_q);
if($fr_ct == '0') {
  echo "<div class=\"mail_cont\">
    <table style=\"text-align: center; width: 100%;\">
      <tr>
        <td style=\"width: 100%;\">
          <span class=\"no_mail\"><br>No friends. <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i><br><br></span>
        </td>
      </tr>
    </table>
  </div>";
}
while($f_r = mysqli_fetch_assoc($f_q)) {
  $fuid_rec = $f_r['uid_rec'];
  $fusr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$fuid_rec'");
  while($fusr_r = mysqli_fetch_assoc($fusr_q)) {
    $f_username = $fusr_r['username'];
    $f_picture = $fusr_r['picture'];
    $fonline_time = $fusr_r['online_time'];
    $f_verf = $fusr_r['md_verf'];
    if($f_verf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $f_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
  }
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$fuid_rec' && theme_id='$g_themeid'");
  while($usri_r = mysqli_fetch_assoc($usri_q)) {
    $username_color = $usri_r['username_color'];
    $chat_tcolor = $usri_r['text_color'];
  }
  $HUAHHH = time() - $fonline_time;
  $mens = round($HUAHHH / 60);
  if($mens <= 1) {
    $cv_activeness = "#00FF00";
  }
  elseif($mens <= 2) {
    $cv_activeness = "#FFA500";
  }
  elseif($mens < 5) {
    $cv_activeness = "#FF0000";
  }
  else {
    $cv_activeness = "#FF0000";
  }
  if($fr_ct > 0) {
    echo "<div class=\"mail_cont\">
        <table style=\"text-align: center; width: 100%;\">
          <tr>
            <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$f_username';\">
              <div class=\"mphoto_contain_size\">
              <div class=\"mphoto_activity_dot\" style=\"background-color: $cv_activeness;\"></div> <img src=\"$f_picture\" class=\"list_picture\">
              </div>
              </div>
            </td>
            <td style=\"width: 50%; text-align: left;\">
              <span style=\"color: $username_color; font-weight: bold;\" onclick=\"window.location='/canvas/$f_username';\">$f_username $verif_check</span>
            </td>
            <td style=\"width: 20%;\">
            <i id=\"cuid_$fuid_rec\" class=\"fa fa-comment\" aria-hidden=\"true\" style=\"color: $username_color;\"></i>
            </td>
            </tr>
        </table>
      </div>";
    /*echo "<div class=\"mail_cont\">
      <table style=\"text-align: center; width: 100%;\">
        <tr>
          <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$f_username';\">
            <img class=\"mail_friend_picture\" src=\"$f_picture\" alt=\"\">
          </td>
          <td style=\"width: 50%; text-align: left;\" onclick=\"window.location='/canvas/$f_username';\">
            <span style=\"color: $username_color; font-weight: bold;\">$f_username</span>
          </td>
          <td style=\"width: 20%;\">
            <i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"$f_activeness\"></i> &nbsp;&nbsp;
            <i id=\"cuid_$fuid_rec\" class=\"fa fa-comment\" aria-hidden=\"true\" style=\"color: $username_color;\"></i>
          </td>
        </tr>
      </table>
    </div>";*/
  }
}
?>
<script>
function search() {
  var searchQ = document.getElementById("search_query");
  var q = searchQ.value;
  var sb = document.getElementById("addm_results");
  var q = q.replace(/[^a-z0-9]/gi,'');
  if(q == '') {
    sb.style.display = 'none';
  }
  else {
    sb.style.display = '';
  }
  document.getElementById("search_results").innerHTML = '<span class=\"no_results\">searching..</span>';
  $.get("friends_search_results.php?q=" + q, function(d) {
    $("#search_results").html(d);
  });
}
var Msg = document.querySelectorAll("i[id^=cuid_]");
[].forEach.call(Msg, function(ms){
  ms.onclick = function(e){
    if (confirm("Message?")) {
      var mso = new XMLHttpRequest();
      mso.open("GET", "convo_create.php?u=" + ms.id.match(/([0-9]*)$/)[0], true);
      mso.onreadystatechange = function(){
        if (mso.readyState == 4)
          if(mso.status == 200) {
            var convo_url = mso.responseText
            toMessages();
          }
          else {
            alert("error");
          }
      };
      mso.send();
      return false;
    }
  };
});
</script>
