<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$post_token = safe($_POST['token']);
$post_teleid = safe($_POST['telegramid']);

if($u_token == $post_token) {
  $q = mysqli_query($conx, "SELECT username FROM accounts WHERE telegram_id='$post_teleid'");
  $c = mysqli_num_rows($q);
  /*if($c > 0) {
    exit();
    header("location: /");
  }*/

mysqli_query($conx, "UPDATE accounts SET telegram_id='$post_teleid' WHERE uid='$u_uid'");
mysqli_query($conx, "UPDATE accounts SET telegram_verf='no' WHERE uid='$u_uid'");
$bot_id = "1733434931:AAF8BccaB0eOldvq0QDcLphs6YOpF5g7sDQ";

# Note: you want to change the offset based on the last update_id you received
$url = 'https://api.telegram.org/bot' . $bot_id . '/getUpdates?offset=0';
$result = file_get_contents($url);
$result = json_decode($result, true);

foreach ($result['result'] as $message) {
    //var_dump($message);
}
# The chat_id variable will be provided in the getUpdates result
$botmsg = "$u_username requested to link your Telegram ID with their Misdew account. Type '/verify' to accept and complete the link.";
$url = 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?text='. $botmsg .'&chat_id=' . $post_teleid;
$result = file_get_contents($url);
$result = json_decode($result, true);

//var_dump($result['result']);
}
else {
  exit();
}
?>
