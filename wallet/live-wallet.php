<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$coin_id = safe($_GET['i']);

if($coin_id == 'tru') {
  $tru_bal = number_format((float)$u_funds_tru, 2, '.', '');
  $tru_bal = number_format($tru_bal, 2, '.', ',');
  echo $tru_bal;
}
if($coin_id == 'mdf') {
  $funds_bal = number_format((float)$u_funds, 2, '.', '');
  $mdf_bal = number_format($funds_bal, 2, '.', ',');
  echo $mdf_bal;
}
if($coin_id == 'btc') {
  $btc_bal = number_format($u_funds_btc, 10, '.', ',');
  echo $btc_bal;
}
if($coin_id == 'cake') {
  $cake_bal = number_format($u_funds_cake, 10, '.', ',');
  echo $cake_bal;
}
if($coin_id == 'dot') {
  $cake_bal = number_format($u_funds_dot, 10, '.', ',');
  echo $cake_bal;
}
?>
