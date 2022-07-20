<?php
$this_page = "canvas";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$g_user = safe($_GET['u']);
if($g_user == '') {
  $g_user = $u_username;
}
if(mysqli_num_rows($cnv_q = mysqli_query($conx, "SELECT uid,username FROM accounts WHERE username='$g_user'")) == '0') {
  header("location: /hub");
  exit();
}
$cnv_r = mysqli_fetch_assoc($cnv_q);
$cnv_uid = $cnv_r['uid'];
$cnv_username = $cnv_r['username'];
if($cnv_username != $u_username) {
  echo "<div class=\"frnds_ibar\">
    <table style=\"width: 95%; text-align: center;\">
      <tr>
        <td style=\"width: 33.33%; text-align: left;\">";
        $fff_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND uid_rec='$cnv_uid' AND accepted='yes'");
        $frr_ct = mysqli_num_rows($fff_q);
        $ffff_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND uid_rec='$cnv_uid' AND accepted='no'");
        $frrr_ct = mysqli_num_rows($ffff_q);
        if($frr_ct != '0') {
           echo "<span onclick=\"remFrnd('$cnv_uid');\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Remove</span>";
        }
        elseif($frrr_ct != '0') {
           echo "<i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Pending</span>";
        }
        else {
          echo "<span onclick=\"addFrnd('$cnv_uid');\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Add</span>";
        }
        echo "</td>";
        if($block_option == 'no') {
          echo "<td style=\"width: 33.33%; text-align: left;\">
          </td>";
        }
        else {
          echo "<td style=\"width: 33.33%; text-align: center;\" onclick=\"block('$cnv_uid');\">
            <i class=\"fa fa-ban\" aria-hidden=\"true\"></i> Block
          </td>";
        }
        echo "<td style=\"width: 33.33%; text-align: right;\" onclick=\"alert('To report an account, please send an email to me@justa.us with your report. We take this seriously.');\">
          <i class=\"fa fa-flag\" aria-hidden=\"true\"></i> Report
        </td>
      </tr>
    </table>
  </div>";
}
if($cnv_username == $u_username) {
$f_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$cnv_uid' && accepted='no' && orig_uid!='$u_uid' ORDER BY tstamp DESC");
while($f_r = mysqli_fetch_assoc($f_q)) {
  $frnd_uid = $f_r['uid_rec'];
$musr_q = mysqli_query($conx, "SELECT uid,username,picture,online_time,site_locdesc,site_locurl,who_can_mail,md_verf FROM accounts WHERE uid='$frnd_uid'");
while($musr_r = mysqli_fetch_assoc($musr_q)) {
  $mmb_uid = $musr_r['uid'];
  $mmb_username = $musr_r['username'];
  $mmb_picture = $musr_r['picture'];
  $mmb_onltime = $musr_r['online_time'];
  $mmb_locdesc = $musr_r['site_locdesc'];
  $mmb_locurl = $musr_r['site_locurl'];
  $mmb_verf = $musr_r['md_verf'];
  if($mmb_verf == 'yes') {
    $verif_check = " <i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
  }
  else {
    $verif_check = "";
  }
  $s_whocan = $musr_r['who_can_mail'];
  //
  //  DATA SAVER
  if($u_datasaver == 'on') {
    $mmb_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
  }
  // DATA SAVER
  //
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$mmb_uid' && theme_id='$g_themeid'");
  while($usri_r = mysqli_fetch_assoc($usri_q)) {
    $username_color = $usri_r['username_color'];
    $chat_tcolor = $usri_r['text_color'];
  }
  $HUAHHH = time() - $mmb_onltime;
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
    echo "<div class=\"frnds_cont\">
        <table style=\"text-align: center; width: 100%;\">
          <tr>
            <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$mmb_username';\">
              <div class=\"frnds_cont_psize\">
              <div class=\"frnds_activdot\" style=\"background-color: $cv_activeness;\"></div> <img src=\"$mmb_picture\" class=\"list_picture\">
              </div>
              </div>
            </td>
            <td style=\"width: 50%; text-align: left;\">
              <span class=\"frnds_username\" style=\"color: $username_color; font-weight: bold;\" onclick=\"window.location='/canvas/$mmb_username';\">$mmb_username$verif_check</span>
              <span class=\"pending_req\"> &nbsp; <i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> pending</span>
            </td>
            <td style=\"width: 20%;\">";
                          echo "<i onclick=\"accFrnd('$mmb_uid');\" style=\"color: $username_color;\" class=\"fa fa-plus-circle frnd_accept\" aria-hidden=\"true\"></i> &nbsp; &nbsp;";
              echo "<i onclick=\"remFrnd('$mmb_uid');\" style=\"color: $username_color;\" class=\"fa fa-trash\" aria-hidden=\"true\"></i>";
          echo "</td></tr>
        </table>
      </div>";
}
}
}
$cccccount = mysqli_num_rows($f_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$cnv_uid' AND accepted='yes' ORDER BY tstamp DESC"));
if($cccccount == 0) {
  echo "<div class=\"frnds_cont\"><span class=\"no_cont\"><br>No friends. <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i><br><br></span></div>";
}
while($f_r = mysqli_fetch_assoc($f_q)) {
  $frnd_uid = $f_r['uid_rec'];
$musr_q = mysqli_query($conx, "SELECT uid,username,picture,online_time,site_locdesc,site_locurl,who_can_mail,md_verf FROM accounts WHERE uid='$frnd_uid'");
while($musr_r = mysqli_fetch_assoc($musr_q)) {
  $mmb_uid = $musr_r['uid'];
  $mmb_username = $musr_r['username'];
  $mmb_picture = $musr_r['picture'];
  $mmb_onltime = $musr_r['online_time'];
  $mmb_locdesc = $musr_r['site_locdesc'];
  $mmb_locurl = $musr_r['site_locurl'];
  $s_whocan = $musr_r['who_can_mail'];
  $mmb_verf = $musr_r['md_verf'];
  if($mmb_verf == 'yes') {
    $verif_check = " <i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
  }
  else {
    $verif_check = "";
  }
  //
  //  DATA SAVER
  if($u_datasaver == 'on') {
    $mmb_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
  }
  // DATA SAVER
  //
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$mmb_uid' && theme_id='$g_themeid'");
  while($usri_r = mysqli_fetch_assoc($usri_q)) {
    $username_color = $usri_r['username_color'];
    $chat_tcolor = $usri_r['text_color'];
  }
  $HUAHHH = time() - $mmb_onltime;
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
    echo "<div class=\"frnds_cont\">
        <table style=\"text-align: center; width: 100%;\">
          <tr>
            <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$mmb_username';\">
              <div class=\"frnds_cont_psize\">
              <div class=\"frnds_activdot\" style=\"background-color: $cv_activeness;\"></div> <img src=\"$mmb_picture\" class=\"list_picture\">
              </div>
              </div>
            </td>
            <td style=\"width: 50%; text-align: left;\">
              <span class=\"frnds_username\" style=\"color: $username_color; font-weight: bold;\" onclick=\"window.location='/canvas/$mmb_username';\">$mmb_username$verif_check</span>
            </td>
            <td style=\"width: 20%;\">";
            if($cnv_username == $u_username) {
              echo "<i onclick=\"remFrnd('$mmb_uid');\" style=\"color: $username_color;\" class=\"fa fa-trash frnd_remove\" aria-hidden=\"true\"></i> &nbsp; &nbsp;";
            }
            if($s_whocan == 'nobody') {
              echo "<i style=\"color: transparent !important;\" class=\"fa fa-comment\" aria-hidden=\"true\"></i>";
            }
            if($s_whocan == 'friends') {
              $ff_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND uid_rec='$mmb_uid' AND accepted='yes'");
              $fr_ct = mysqli_num_rows($ff_q);
               if($fr_ct != '0') {
                 echo "<i id=\"cuid_$mmb_uid\"  style=\"color: $username_color;\" class=\"fa fa-comment frnd_message\" aria-hidden=\"true\"></i>";
              }
          }
          if($s_whocan == 'anyone') {
            echo "<i id=\"cuid_$mmb_uid\" style=\"color: $username_color;\" class=\"fa fa-comment frnd_message\" aria-hidden=\"true\"></i>";
          }
          echo "</td></tr>
        </table>
      </div>";
}
}
?>
<script>
function block(uid) {
  if(confirm('Block this person?')) {
    $.ajax({
    url: 'block.php',
    type: 'POST',
    data: { uid: uid },
    success: function(data){
      if(data == '') {
        alert('Blocked.');
        window.location.replace("/hub");
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
var Msg = document.querySelectorAll("i[id^=cuid_]");
[].forEach.call(Msg, function(ms){
  ms.onclick = function(e){
    if (confirm("Message?")) {
      var mso = new XMLHttpRequest();
      mso.open("GET", "/mail/convo_create.php?u=" + ms.id.match(/([0-9]*)$/)[0], true);
      mso.onreadystatechange = function(){
        if (mso.readyState == 4)
          if(mso.status == 200) {
            window.location.replace("/mail");
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
