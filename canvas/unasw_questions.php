<?php
$this_page = "canvas";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$cv_cr = mysqli_num_rows($cv_qq = mysqli_query($conx, "SELECT * FROM canvas_askbox WHERE uid_canvas='$u_uid' && answer='' ORDER BY id DESC"));
echo "<div id=\"ld_quests\">";
$count = 0;
while($cv_qr = mysqli_fetch_assoc($cv_qq)) {
  $count++;
  $cvq_id = $cv_qr['id'];
  $cvq_uid_asker = $cv_qr['uid_asker'];
  $cvq_anonymous = $cv_qr['anonymous'];
  $cvq_question = $cv_qr['question'];
  $cvq_answer = $cv_qr['answer'];
  # SELECT ACCOUNT DATA FOR QUESTIONS
  $usr_q = mysqli_query($conx, "SELECT username,picture,online_time,md_verf FROM accounts WHERE uid='$cvq_uid_asker'");
  while($usr_r = mysqli_fetch_assoc($usr_q)) {
    // Account data
    $quest_username = $usr_r['username'];
    $quest_picture = $usr_r['picture'];
    $mmb_verf = $usr_r['md_verf'];
    if($mmb_verf == 'yes') {
      $verif_check = " <i style=\"font-size: 14px;\" class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>";
    }
    else {
      $verif_check = "";
    }
    //
    //  DATA SAVER
    if($u_datasaver == 'on') {
      $quest_picture = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAACklEQVR4AWNoAAAAggCBTBfX3wAAAABJRU5ErkJggg==";
    }
    // DATA SAVER
    //
    $quest_onltime = $usr_r['online_time'];
    // Activity Dot
    $new_time = time() - $quest_onltime;
    $mens = round($new_time / 60);
    if($mens <= 1) { $cv_activeness = "#00FF00"; } // Active within one minute
    elseif($mens <= 2) { $cv_activeness = "#FFA500"; } // Active within two minutes
    elseif($mens < 5) { $cv_activeness = "#FF0000"; } // Active within five minutes
    else { $cv_activeness = "#FF0000"; } // Active over five minutes
    # SELECT THEME COLORS FOR ACCOUNTS
    $usri_q = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$cvq_uid_asker' && theme_id='$g_themeid'");
    while($usri_r = mysqli_fetch_assoc($usri_q)) {
      // Theme data
      $qusername_color = $usri_r['username_color'];
      $qquest_tcolor = $usri_r['text_color'];
    }
  }
  if($cvq_anonymous == 'yes') {
    $quest_username = "Anonymous";
    $quest_picture = "/img/anon.png";
    $cv_activeness = "#309dfc";
    $verif_check = "";
    $qusername_color = $cv_activeness;
  }
  echo "<div class=\"question_asked\"><table><tr><td>";
  echo "<div class=\"question_psize\">";
  echo "<div class=\"question_activdot\" style=\"background-color: $cv_activeness;\"></div>";
  echo "<img src=\"$quest_picture\" class=\"list_picture\" onclick=\"window.location='/canvas/$quest_username';\"></div></td><td>";
  echo "<span style=\"color: $qusername_color; font-weight: bold;\" onclick=\"window.location='/canvas/$quest_username';\"> $quest_username $verif_check ";
  echo "<i class=\"fa fa-question-circle\" aria-hidden=\"true\"></i></span> <br>";
  $string = $cvq_question;
  require("../inc/replace.php");
  echo nl2br($string);
  echo "</td></tr></table></div>";
  echo "<div class=\"question_answered\">";
  echo "<table style=\"width: 100%;\"><tr><td>";
  echo "<i class=\"fa fa-reply\" aria-hidden=\"true\" style=\"padding-right: 6px;\"></i></td><td style=\"width: 100%;\">";
  echo "<div id=\"answ_$cvq_id\" class=\"write_answer\" placeholder=\"Write an answer...\" contenteditable></div></td><td>";
  echo "<button id=\"ansbtn_$cvq_id\" onclick=\"quesAnsw('$cvq_id');\" class=\"question_answer_buttons\">";
  echo "<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>";
  echo "</button></td><td>";
  echo "<button id=\"rembtn_$cvq_id\" onclick=\"quesRem('$cvq_id');\" class=\"question_answer_buttons\">";
  echo "<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>";
  echo "</button></td></tr></table>";
  echo "</div>";
  if($count == $cv_cr) {
    echo "<br>";
  }
}
echo "</div>";
?>
