<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$coin_id = safe($_GET['i']);

if($coin_id == 'btc') {
  $site_requested_from = "https://misdew.com";
  $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
  $body = curl_exec($ch);
  curl_close($ch);
  $json_output = json_decode($body,true);
  $btc_usdp_raw = $json_output['0']['current_price'];
  $btc_usdp = $json_output['0']['current_price'];
  $btc_usdp = number_format((float)$btc_usdp, 2, '.', '');
  $btc_usdp = number_format($btc_usdp, 2, '.', ',');

  $btc_bal_val = $u_funds_btc * $btc_usdp_raw;
  $btc_bal_val = number_format((float)$btc_bal_val, 2, '.', '');
  $btc_bal_val = number_format($btc_bal_val, 2, '.', ',');

  echo "$";
  echo $btc_bal_val;
}
if($coin_id == 'cake') {
  $site_requested_from = "https://misdew.com";
  $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=pancakeswap-token';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
  $body = curl_exec($ch);
  curl_close($ch);
  $json_output = json_decode($body,true);
  $cake_usdp_raw = $json_output['0']['current_price'];
  $cake_usdp = $json_output['0']['current_price'];
  $cake_usdp = number_format((float)$cake_usdp, 2, '.', '');
  $cake_usdp = number_format($cake_usdp, 2, '.', ',');

  $cake_bal_val = $u_funds_cake * $cake_usdp_raw;
  $cake_bal_val = number_format((float)$cake_bal_val, 2, '.', '');
  $cake_bal_val = number_format($cake_bal_val, 2, '.', ',');

  echo "$";
  echo $cake_bal_val;
}
if($coin_id == 'dot') {
  $site_requested_from = "https://misdew.com";
  $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=polkadot';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
  $body = curl_exec($ch);
  curl_close($ch);
  $json_output = json_decode($body,true);
  $cake_usdp_raw = $json_output['0']['current_price'];
  $cake_usdp = $json_output['0']['current_price'];
  $cake_usdp = number_format((float)$cake_usdp, 2, '.', '');
  $cake_usdp = number_format($cake_usdp, 2, '.', ',');

  $cake_bal_val = $u_funds_dot * $cake_usdp_raw;
  $cake_bal_val = number_format((float)$cake_bal_val, 2, '.', '');
  $cake_bal_val = number_format($cake_bal_val, 2, '.', ',');

  echo "$";
  echo $cake_bal_val;
}
if($coin_id == 'tru') {
  $tru_bal_val = $u_funds_tru * 1;
  $tru_bal_val = number_format((float)$tru_bal_val, 2, '.', '');
  $tru_bal_val = number_format($tru_bal_val, 2, '.', ',');
  echo "$";
  echo $tru_bal_val;
}
if($coin_id == 'mdf') {
  $site_requested_from = "https://misdew.com";
  $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=pancakeswap-token';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, $site_requested_from);
  $body = curl_exec($ch);
  curl_close($ch);
  $json_output = json_decode($body,true);
  $cake_usdp_raw = $json_output['0']['current_price'];
  $cake_usdp = $json_output['0']['current_price'];
  $mdf_bal_value = $cake_usdp/515;
  $mdf_bal_val = $u_funds * $mdf_bal_value;
  $mdf_bal_val = number_format((float)$mdf_bal_val, 2, '.', '');
  $mdf_bal_val = number_format($mdf_bal_val, 2, '.', ',');
  echo "$";
  echo $mdf_bal_val;
}
?>
