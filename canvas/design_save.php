<?php
require_once("../inc/conx.php");
$design_id = safe($_GET['i']);
$design_value = safe($_GET['v']);
if($design_id == 'empty' && $design_value == 'empty') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_activdot_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comments_loadmore_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comments_loadmore_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_button_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_button_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_box_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_box_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET comment_box_ph='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET pending_req_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET frnds_activdot_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET frnds_cont_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET frnds_cont_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET frnds_ibar_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET frnds_ibar_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET nname_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET figures_percont_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET notif_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET notif_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET notif_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET nview_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET nsnooze_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET ndismiss_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET write_answer_ph='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_box_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_box_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_box_ph='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_answered_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_answered_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_asked_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_asked_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_buttons_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_buttons_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_answer_buttons_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_answer_buttons_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET questions_loadmore_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET questions_loadmore_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET question_activdot_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET figures_contain_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET figures_contain_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET figures_perc_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET changes_update_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_design_editor_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET footer_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_input_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_input_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_input_ph='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET changes_update_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET changes_update_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_design_editor_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_design_editor_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_title_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_desc_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_hidden_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_hidden_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET actbar='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET actbar_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET tago_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET header_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET header_tds_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET info_top_bar_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET info_top_bar_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_username_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_username_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_username_fs='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_photo_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_photo_dot_wd='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET contain_photo_dot_ht='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET photo_edit_pencil_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET photo_edit_pencil_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET photo_edit_pencil_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET photo_activity_dot_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET picture_rd='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET picture_wd='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET picture_ht='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET bio_bg='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET bio_bc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET bio_fc='' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE canvas_design SET bio_fs='' WHERE uid='$u_uid'");
}
if($design_id == 'question_ask_box_ph') {
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_box_ph='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_activdot_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_activdot_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comments_loadmore_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET comments_loadmore_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comments_loadmore_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET comments_loadmore_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_button_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_button_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_button_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_button_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_box_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_box_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_box_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_box_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'comment_box_ph') {
  mysqli_query($conx, "UPDATE canvas_design SET comment_box_ph='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'pending_req_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET pending_req_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'frnds_activdot_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET frnds_activdot_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'frnds_cont_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET frnds_cont_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'frnds_cont_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET frnds_cont_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'frnds_ibar_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET frnds_ibar_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'frnds_ibar_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET frnds_ibar_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'figures_percont_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET figures_percont_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'nname_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET nname_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'tago_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET tago_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'notif_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET notif_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'notif_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET notif_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'notif_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET notif_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'nview_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET nview_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'nsnooze_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET nsnooze_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'ndismiss_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET ndismiss_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'write_answer_ph') {
  mysqli_query($conx, "UPDATE canvas_design SET write_answer_ph='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_ask_box_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_box_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_ask_box_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_box_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_answered_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET question_answered_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_answered_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET question_answered_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_asked_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET question_asked_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_asked_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET question_asked_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_ask_buttons_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_buttons_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_ask_buttons_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET question_ask_buttons_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_answer_buttons_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET question_answer_buttons_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_answer_buttons_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET question_answer_buttons_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'questions_loadmore_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET questions_loadmore_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'questions_loadmore_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET questions_loadmore_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'question_activdot_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET question_activdot_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'figures_contain_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET figures_contain_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'figures_contain_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET figures_contain_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'figures_perc_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET figures_perc_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'changes_update_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET changes_update_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_design_editor_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_design_editor_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'footer_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET footer_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'design_editor_input_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_input_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'design_editor_input_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_input_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'design_editor_input_ph') {
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_input_ph='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'changes_update_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET changes_update_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'changes_update_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET changes_update_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_design_editor_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_design_editor_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_design_editor_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_design_editor_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'design_editor_title_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_title_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'design_editor_desc_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET design_editor_desc_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'spoiler_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'spoiler_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'spoiler_hidden_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_hidden_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'spoiler_hidden_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET spoiler_hidden_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'actbar') {
  mysqli_query($conx, "UPDATE canvas_design SET actbar='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'actbar_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET actbar_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'bg') {
  mysqli_query($conx, "UPDATE canvas_design SET bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'header_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET header_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'header_tds_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET header_tds_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'info_top_bar_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET info_top_bar_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'info_top_bar_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET info_top_bar_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_username_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_username_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_username_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_username_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_username_fs') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_username_fs='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_photo_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_photo_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_photo_dot_wd') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_photo_dot_wd='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'contain_photo_dot_ht') {
  mysqli_query($conx, "UPDATE canvas_design SET contain_photo_dot_ht='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'photo_edit_pencil_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET photo_edit_pencil_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'photo_edit_pencil_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET photo_edit_pencil_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'photo_edit_pencil_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET photo_edit_pencil_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'photo_activity_dot_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET photo_activity_dot_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'picture_rd') {
  mysqli_query($conx, "UPDATE canvas_design SET picture_rd='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'picture_wd') {
  mysqli_query($conx, "UPDATE canvas_design SET picture_wd='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'picture_ht') {
  mysqli_query($conx, "UPDATE canvas_design SET picture_ht='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'bio_bg') {
  mysqli_query($conx, "UPDATE canvas_design SET bio_bg='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'bio_bc') {
  mysqli_query($conx, "UPDATE canvas_design SET bio_bc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'bio_fc') {
  mysqli_query($conx, "UPDATE canvas_design SET bio_fc='$design_value' WHERE uid='$u_uid'");
}
if($design_id == 'bio_fs') {
  mysqli_query($conx, "UPDATE canvas_design SET bio_fs='$design_value' WHERE uid='$u_uid'");
}
?>
