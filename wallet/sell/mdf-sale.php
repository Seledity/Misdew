<?php
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$current_tst = time();
$sub_token = safe($_POST['token']);
$mdf_amnt = safe($_POST['sell_amount']);
$mdf_amnt = abs($mdf_amnt);
if(isset($mdf_amnt) && $sub_token == $u_token) {
  if($u_funds >= $mdf_amnt) {



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
    $mdf_to_tru_bal = $mdf_amnt * $mdf_bal_value;



    $mdx = mysqli_query($conx, "SELECT * FROM mdf_treasury WHERE id='1'");
    $mdy = mysqli_fetch_assoc($mdx);
    $mdf_total_tres = $mdy['total_mdf'];
    mysqli_query($conx, "UPDATE accounts SET funds='$u_funds'-$mdf_amnt WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE accounts SET tru_funds='$u_funds_tru'+$mdf_to_tru_bal WHERE uid='$u_uid'");
    mysqli_query($conx, "UPDATE mdf_treasury SET total_mdf='$mdf_total_tres'+$mdf_amnt WHERE id='1'");
    mysqli_query($conx, "UPDATE mdf_treasury SET last_deposit='$current_tst' WHERE id='1'");
  }
  else {
    exit();
  }
}
else {
  exit();
}
?>
