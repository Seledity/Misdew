<?php
$this_page = "mail";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Which conversations are you a member of?
$m_csel = mysqli_query($conx, "SELECT id,uqid,last_active FROM mail_memb WHERE uid='$u_uid' ORDER BY last_active DESC");
if(mysqli_num_rows($m_csel) == 0) {
  echo "<div class=\"mail_cont\" onclick=\"toFriends();\"><br><span class=\"no_mail\">No conversations. <i class=\"fa fa-frown-o\" aria-hidden=\"true\"></i><br><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Create</span><br><br></div>";
}
while($m_crow = mysqli_fetch_assoc($m_csel)) {
  $m_id = $m_crow['id'];
  $m_cuqid = $m_crow['uqid'];
  $m_last_active = $m_crow['last_active'];
  // What exactly are these conversations?
  $cv_sel = mysqli_query($conx, "SELECT name,picture,main_color,main_color FROM mail_convo WHERE uqid='$m_cuqid'");
  while($cv_row = mysqli_fetch_assoc($cv_sel)) {
    $string = $cv_row['name'];
    $cv_pic = $cv_row['picture'];
    $cv_color = $cv_row['main_color'];
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $cv_pic = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
    include("../inc/replace.php");
    echo "<div class=\"mail_cont\">
      <table class=\"mail_header\">
        <tr>
          <td class=\"mail_picture_td\" onclick=\"window.location='convo.php?i=$m_cuqid';\">
            <img class=\"mail_picture\" src=\"$cv_pic\" alt=\"\">
          </td>
          <td class=\"mail_details\" onclick=\"window.location='convo.php?i=$m_cuqid';\">
            <span style=\"color: $cv_color\">$string</span>
          </td>
          <td class=\"tago\">
            ";
            echo timeago($m_last_active);
            echo "&nbsp;&nbsp; <i id=\"cdel_$m_id\" class=\"fa fa-sign-out\" aria-hidden=\"true\" style=\"color: $cv_color;\"></i>
          </td>
        </tr>
      </table>
      <table class=\"mail_message_qv\" onclick=\"window.location='convo.php?i=$m_cuqid';\">
        <tr>
          <td>";
        // Latest message in this conversation?
        $msg_sel = mysqli_query($conx, "SELECT uid_from,message FROM mail WHERE uqid='$m_cuqid' ORDER BY id DESC LIMIT 1");
        while($msg_row = mysqli_fetch_assoc($msg_sel)) {
          $msg_from = $msg_row['uid_from'];
          $string = trim(substr($msg_row['message'],0,30));
          include("../inc/replace.php");
          // Latest message is from...?
          $u_sel = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$msg_from'");
          while($u_row = mysqli_fetch_assoc($u_sel)) {
            $msg_from = $u_row['username'];
            if($msg_from == $u_username) {
              $msg_from = "You";
            }
          }
          echo "<span style=\"font-weight: bold;\">$msg_from:</span> $string";
          if(strlen($msg_row['message']) > 30) {
            echo "..";
          }
        }
          echo "</td>
        </tr>
      </table>
    </div>";
  }
}
?>
<script>
var Del = document.querySelectorAll("i[id^=cdel_]");
[].forEach.call(Del, function(dt){
  dt.onclick = function(e){
    if (confirm("Exit this conversation?")) {
      var dto = new XMLHttpRequest();
      dto.open("GET", "exit.php?i=" + dt.id.match(/([0-9]*)$/)[0], true);
      dto.onreadystatechange = function(){
        if (dto.readyState == 4)
          if(dto.status == 200) {
            toMessages();
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
</script>
