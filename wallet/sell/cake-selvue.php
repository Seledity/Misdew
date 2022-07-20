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
$cake_to_tru_bal = $amnt * $cake_usdp;
$cake_to_tru_bal = number_format((float)$cake_to_tru_bal, 2, '.', '');
$cake_to_tru_bal = number_format($cake_to_tru_bal, 2, '.', ',');
echo "$";
echo $cake_to_tru_bal;
?>
