<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// recently active // recently active
// recently active // recently active
// recently active // recently active
// recently active // recently active
// recently active // recently active
// recently active // recently active
$zmusr_q = mysqli_query($conx, "SELECT online_time FROM accounts ORDER BY username ASC");
while($zmusr_r = mysqli_fetch_assoc($zmusr_q)) {
  $mmb_onltime = $zmusr_r['online_time'];
  $HUAHHH = time() - $mmb_onltime;
  $mens = round($HUAHHH / 60);
  if($mens <= 2880 AND $mens > 6) {
    $zcounter++;
  }

}
echo "<div class=\"mail_cont\" style=\"border-top-left-radius: 1em; border-top-right-radius: 1em; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top: none; border-bottom: 1px dotted #ccc; font-weight: bold; font-size: 18px;\"><div style=\"font-size:12px;\"><br></div>$zcounter";
if($zcounter >= 20) {
  // Emoji+ replacement
  //$string = " :heart-eyes:";
  $string = " <img src=\"/img/stickers/ricardo-smile.png\" alt=\"\" style=\"height: 30px; width: auto;\">";
}
elseif($zcounter >= 15) {
  // Emoji+ replacement
  //$string = " :halo:";
  $string = " <img src=\"/img/stickers/pepe-weetawd.png\" alt=\"\" style=\"height: 30px; width: auto;\">";
}
elseif($zcounter >= 10) {
  // Emoji+ replacement
  //$string = " :drool:";
  $string = " <img src=\"/img/stickers/pepe-mk.png\" alt=\"\" style=\"height: 30px; width: auto;\">";
}
elseif($zcounter >= 4) {
  // Emoji+ replacement
  //$string = " :smile:";
  $string = " <img src=\"/img/stickers/pepe-k.png\" alt=\"\" style=\"height: 30px; width: auto;\">";
}
elseif($zcounter <= 3) {
  // Emoji+ replacement
  //$string = " :sleep:";
  $string = " <img src=\"/img/stickers/lock.png\" alt=\"\" style=\"height: 30px; width: auto;\">";
}
include("../inc/replace.php");
echo $string;
echo "<br> <span style=\"color: #808080; font-size: 12px; font-weight: none;\" onclick=\"moreRecently('recently_active')\">[tap to hide]</span><div style=\"font-size:12px;\"><br></div>";
echo "</div>";
$zmusr_q = mysqli_query($conx, "SELECT uid,username,picture,online_time,site_locdesc,site_locurl,who_can_mail,bot,comm_mang,cont_mang,design_police,peacekeeper,sticker,donor,md_verf FROM accounts ORDER BY username ASC");
while($zmusr_r = mysqli_fetch_assoc($zmusr_q)) {
  $mmb_uid = $zmusr_r['uid'];
  $mmb_username = $zmusr_r['username'];
  $mmb_picture = $zmusr_r['picture'];
  $mmb_onltime = $zmusr_r['online_time'];
  $mmb_locdesc = $zmusr_r['site_locdesc'];
  $mmb_locurl = $zmusr_r['site_locurl'];
  $mmb_whocan = $zmusr_r['who_can_mail'];
  $mmb_bot = $zmusr_r['bot'];
  $mmb_comm_mang = $zmusr_r['comm_mang'];
  $mmb_cont_mang = $zmusr_r['cont_mang'];
  $mmb_design_pol = $zmusr_r['design_police'];
  $mmb_peacekpr = $zmusr_r['peacekeeper'];
  $mmb_donor = $zmusr_r['donor'];
  $mmb_sticker = $zmusr_r['sticker'];
  $mmb_verif = $zmusr_r['md_verf'];
  if($mmb_verif == 'yes') {
    $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
  }
  else {
    $verif_check = "";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE uid='$u_uid' && blocked_uid='$mmb_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $mmb_uid = "286";
  }
  $blks = mysqli_query($conx, "SELECT blocked_uid FROM blocking WHERE blocked_uid='$u_uid' && uid='$mmb_uid'");
  $blkc = mysqli_num_rows($blks);
  if($blkc > 0) {
    $mmb_uid = "286";
  }
  // ************************ //
  // *** BLOCKING SYSTEM *** //
  // ************************ //
  //
  //  DATA SAVER
  if($u_datasaver == 'on' && $mmb_uid != $u_uid) {
    $mmb_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAABtklEQVR4AW1TNXgUYRC9HqdvoYW+PT/c3Z0KWvqWLp7drCvuDg3uVNEGh3hyro8ZLGuz31v7n/waW33i9H/oq7SlxmrjCOGBudocI5T5yd/8n9u9fI9QX0GEG0SuEPAbq/j5F/yf2pnnE9OPldT4gQAvzu88D3ON/x/zmP9brP3p6nUvwcgZuHLsCj49/4RrJ67xt8+A+ayL0cvRYFftjRZG7o+Aa+TBCMwNofQK61h83+e6ysCLzhdo1Brg4uejs4+gZJRg+v0YvYx6u3vz1E0Uxgrw1sTnCej7dch+g1EWlzxuGLg5gKh67bxGZ6ITSlb9Jy7PJfNYt9oYGx5DVH0f+I7edQJ6UwLUnMpBo3NjJrG11cLo8Gi0ePA7hPUihJQIKSuzwV3fbNP045X5Ci26gvXMeIbuZA+kjAwlpxTVVco+3zrzTGtbNby79g6lfAnNZhPF2SJeX3mN3o29ENN9LIS6SnWVVfLC0A5jA2mNBOOkAeeMC+mIjPZ0B3cXclYGJT4hLPfvbTbw7G0tq0FIiuhO9HAij7NIqSYJl3n3ttcgdKpoYsb6MtIdKSvtknPSfC//FxxTQV29mEp6AAAAAElFTkSuQmCC";
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
  /*if($mens <= 1) {
    $cv_activeness = "#00FF00";
  }
  elseif($mens <= 2) {
    $cv_activeness = "#FFA500";
  }
  elseif($mens < 5) {
    $cv_activeness = "#FF0000";
  }
  else {*/
    $cv_activeness = "#808080";
  //}
  if($mens <= 2880 AND $mens > 6) {
    if($mmb_uid != '286') {
    echo "<div class=\"mail_cont\" style=\"box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top: none; border-bottom: 1px dotted #ccc;\">
        <table style=\"text-align: center; width: 100%;\">
          <tr>
            <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$mmb_username';\">
              <div class=\"mphoto_contain_size\">
              <div class=\"mphoto_activity_dot\" style=\"background-color: $cv_activeness;\"></div> <img src=\"$mmb_picture\" class=\"list_picture\">
              </div>
              </div>
            </td>
            <td style=\"width: 50%; text-align: left;\">
              <span style=\"color: $username_color; font-weight: bold;\" onclick=\"window.location='/canvas/$mmb_username';\">$mmb_username $verif_check</span>";
              if($mmb_sticker != '') {
                echo "&nbsp; <img src=\"$mmb_sticker\" alt=\"\" style=\"height: 16px;\">";
              }
              echo "<br>
              <span title=\"$mmb_locurl\" style=\"font-size: 12px; color: $username_color;\"><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> active "; echo timeago($mmb_onltime); echo " ago</span>";
              echo "<span style=\"font-size: 8px; color: $username_color;\"> &nbsp; &nbsp; ";
              # If account is a bot.
              if($mmb_bot == 'yes') {
                echo "<i title=\"Bot\" class=\"fa fa-android\" aria-hidden=\"true\"></i> ";
              }
              # Display the appropriate badges earned by the user.
              // Community Manager Badge.
              if($mmb_comm_mang == 'yes') {
                echo "<i title=\"Community Manager\" class=\"fa fa-users\" aria-hidden=\"true\"></i> ";
              }
              // Account Manager Badge.
              if($mmb_cont_mang == 'yes') {
                echo "<i title=\"Content Manager\" class=\"fa fa-shield\" aria-hidden=\"true\"></i> ";
              }
              // Design Police Badge.
              if($mmb_design_pol == 'yes') {
                echo "<i title=\"Design Police\" class=\"fa fa-paint-brush\" aria-hidden=\"true\"></i> ";
              }
              // Peacekeeper Badge.
              if($mmb_peacekpr == 'yes') {
                echo "<i title=\"Peacekeeper\" class=\"fa fa-hand-peace-o\" aria-hidden=\"true\"></i> ";
              }
              // Donor Badge.
              if($mmb_donor == 'yes') {
                echo "<i title=\"Donor\" class=\"fa fa-heartbeat\" aria-hidden=\"true\"></i> </span>";
              }
            echo "</td>
            <td style=\"width: 20%;\">";
            if($mmb_username != $u_username) {
              if($mmb_whocan == 'nobody') {
                echo "<i style=\"color: transparent !important;\" class=\"fa fa-comment\" aria-hidden=\"true\"></i>";
              }
              if($mmb_whocan == 'friends') {
                $ff_q = mysqli_query($conx, "SELECT uid_rec FROM friends WHERE uid_req='$u_uid' AND uid_rec='$mmb_uid' AND accepted='yes'");
                $fr_ct = mysqli_num_rows($ff_q);
                 if($fr_ct != '0') {
                   echo "<i id=\"cuid_$mmb_uid\" style=\"color: $username_color;\" class=\"fa fa-comment\" aria-hidden=\"true\"></i>";
                }
              }
              if($mmb_whocan == 'anyone') {
                echo "<i id=\"cuid_$mmb_uid\" style=\"color: $username_color;\" class=\"fa fa-comment\" aria-hidden=\"true\"></i>";
              }
            }
            else {
              echo "<i style=\"color: transparent;\" class=\"fa fa-comment\" aria-hidden=\"true\"></i>";
            }
            echo "</td></tr>
        </table>
      </div>";
    }
  }
}
?>
<div class="mail_cont" style="border-bottom-left-radius: 1em; border-bottom-right-radius: 1em; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top: none; border-bottom: 1px dotted #ccc; font-weight: bold; font-size: 18px;">
&nbsp;
</div> <br>
