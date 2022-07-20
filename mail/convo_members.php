<?php
$this_page = "mail";
require_once("../inc/conx.php");
$cv_uqid = safe($_GET['i']);
if(mysqli_num_rows($cvo_slc = mysqli_query($conx, "SELECT id,rank FROM mail_memb WHERE uqid='$cv_uqid' && uid='$u_uid'")) == '0') {
  echo "<div class=\"mail_cont\"><br><span class=\"no_mail\">You do not belong to this conversation.</span><br><br></div>";
  exit();
}
$cvo_rw = mysqli_fetch_array($cvo_slc);
$cvo_rank = $cvo_rw['rank'];
$cva_s = mysqli_query($conx, "SELECT can_add FROM mail_convo WHERE uqid='$cv_uqid'");
$cva_r = mysqli_fetch_array($cva_s);
$cvo_cadd = $cva_r['can_add'];

if($cvo_cadd == 'yes') {
  echo "<div class=\"mail_addm\">
    <input id=\"search_query\" class=\"mail_addm_input\" placeholder=\"Add Member\" onkeypress=\"search()\" onkeyup=\"search()\">
  </div>
  <div id=\"addm_results\" class=\"mail_addm\" style=\"display: none;\">
    <div id=\"search_results\"></div>
  </div> <br>";
}
?>
<?php
$mmb_q = mysqli_query($conx, "SELECT id,uid,chat_time FROM mail_memb WHERE uqid='$cv_uqid' ORDER BY chat_time DESC");
while($mmb_r = mysqli_fetch_assoc($mmb_q)) {
  $mmb_id = $mmb_r['id'];
  $mmb_uid = $mmb_r['uid'];
  $chat_time = $mmb_r['chat_time'];
  $musr_q = mysqli_query($conx, "SELECT username,picture,md_verf FROM accounts WHERE uid='$mmb_uid'");
  while($musr_r = mysqli_fetch_assoc($musr_q)) {
    $mmb_username = $musr_r['username'];
    $mmb_picture = $musr_r['picture'];
    $mmb_verf = $musr_r['md_verf'];
    if($mmb_verf == 'yes') {
      $verif_check = "<i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on' && $mmb_uid != $u_uid) {
      $mmb_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
  }
  $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$mmb_uid' && theme_id='$g_themeid'");
  while($usri_r = mysqli_fetch_assoc($usri_q)) {
    $username_color = $usri_r['username_color'];
    $chat_tcolor = $usri_r['text_color'];
  }
  $HUAHHH = time() - $chat_time;
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
  echo "<div class=\"mail_cont\">
      <table style=\"text-align: center; width: 100%;\">
        <tr>
          <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$mmb_username';\">
            <div class=\"mphoto_contain_size\">
            <div class=\"mphoto_activity_dot\" style=\"background-color: $cv_activeness;\"></div> <img src=\"$mmb_picture\" class=\"list_picture\">
            </div>
            </div>
          </td>
          <td style=\"width: 50%; text-align: left;\">
            <span style=\"color: $username_color; font-weight: bold;\" onclick=\"window.location='/canvas/$mmb_username';\">$mmb_username $verif_check</span>
          </td>
          <td style=\"width: 20%;\">";
          if($cvo_rank == 'admin') {
            echo "<i id=\"mdel_$mmb_id\" class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: $username_color;\"></i>";
          }
          elseif($mmb_username == $u_username) {
            echo "<i id=\"mdel_$mmb_id\" class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: $username_color;\"></i>";
          }
          else {
            echo "<i class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: transparent;\"></i>";
          }
          echo "</td>
          </tr>
      </table>
    </div>";

  /*
  echo "<div class=\"mail_cont\">
    <table style=\"text-align: center; width: 100%;\">
      <tr>
        <td style=\"width: 20%;\" onclick=\"window.location='/canvas/$mmb_username';\">
          <img class=\"mail_friend_picture\" src=\"$mmb_picture\" alt=\"\">
        </td>
        <td style=\"width: 50%; text-align: left;\" onclick=\"window.location='/canvas/$mmb_username';\">
          <span style=\"color: $username_color; font-weight: bold;\">$mmb_username</span>
        </td>
        <td style=\"width: 20%;\">
        <i class=\"fa fa-circle\" aria-hidden=\"true\" id=\"$cv_activeness\"></i> &nbsp;&nbsp;";
          if($cvo_rank == 'admin') {
            echo "<i id=\"mdel_$mmb_id\" class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: $username_color;\"></i>";
          }
          elseif($mmb_username == $u_username) {
            echo "<i id=\"mdel_$mmb_id\" class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: $username_color;\"></i>";
          }
          else {
            echo "<i class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: transparent;\"></i>";
          }
        echo "</td>
      </tr>
    </table>
  </div>";*/
}
?>
<script>
var Del = document.querySelectorAll("i[id^=mdel_]");
[].forEach.call(Del, function(dt){
  dt.onclick = function(e){
    if (confirm("Exit this member?")) {
      var dto = new XMLHttpRequest();
      dto.open("GET", "exit.php?i=" + dt.id.match(/([0-9]*)$/)[0], true);
      dto.onreadystatechange = function(){
        if (dto.readyState == 4)
          if(dto.status == 200) {
            toMembers();
          }
          else {
            alert("error");
          }
      };
      dto.send();
      return false;
    }
  };
});
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
  $.get("members_search_results.php?i=<?php echo $cv_uqid; ?>&&q=" + q, function(d) {
    $("#search_results").html(d);
  });
}
</script>
