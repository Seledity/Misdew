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
  echo "$";
  echo $btc_usdp;
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
  echo "$";
  echo $cake_usdp;
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
  echo "$";
  echo $cake_usdp;
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
  $mdf_bal_value = number_format((float)$mdf_bal_value, 2, '.', '');
  $mdf_bal_value = number_format($mdf_bal_value, 2, '.', ',');
  echo "$";
  echo $mdf_bal_value;
}
?>
