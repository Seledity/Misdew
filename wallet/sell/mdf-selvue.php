<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$amnt = safe($_GET['a']);
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
$mdf_bal_val = $amnt * $mdf_bal_value;
$mdf_bal_val = number_format((float)$mdf_bal_val, 2, '.', '');
$mdf_bal_val = number_format($mdf_bal_val, 2, '.', ',');
echo "$";
echo $mdf_bal_val;
?>
