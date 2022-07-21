<?php
$this_page = "market";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$p_app_uqid = safe($_POST['app_uqid']);
$p_u_token = safe($_POST['token']);
// If POSTED token is not equal to the correct user token.
if($p_u_token != $u_token) {
  exit();
}
else {
  // If the POSTED app UQID is invalid.
  if(mysqli_num_rows($appq = mysqli_query($conx, "SELECT uqid,price,developer FROM apps WHERE uqid='$p_app_uqid'")) == 0) {
    exit();
  }
  // POSTED data has made it through all checks.
  else {
    $appr = mysqli_fetch_assoc($appq);
    $app_uqid = $appr['uqid'];
    $app_price_d = $appr['price'];
    $app_dev = $appr['developer'];
    $devq = mysqli_query($conx, "SELECT uid,funds FROM accounts WHERE username='$app_dev'");
    $devr = mysqli_fetch_assoc($devq);
    $app_dev_uid = $devr['uid'];
    $app_dev_funds = $devr['funds'];
    if($app_price_d != 0) {
      if($app_price_d > $u_funds) {
        exit();
      }
      else {
        $new_funds = $u_funds - $app_price_d;
        mysqli_query($conx, "UPDATE accounts SET funds='$new_funds' WHERE uid='$u_uid'");
        // Give the Developer their Fair Share
        $dev_funds = $app_price_d * ((100-30) / 100);
        mysqli_query($conx, "UPDATE accounts SET funds='$app_dev_funds'+$dev_funds WHERE uid='$app_dev_uid'");
        // Give Uncle MD its Fair Share
        $devvq = mysqli_query($conx, "SELECT uid,funds FROM accounts WHERE username='Misdew'");
        $devvr = mysqli_fetch_assoc($devvq);
        $app_dev_uidd = $devvr['uid'];
        $app_dev_fundss = $devvr['funds'];
        $md_funds = $app_price_d - $dev_funds;
        mysqli_query($conx, "UPDATE accounts SET funds='$app_dev_fundss'+$md_funds WHERE uid='$app_dev_uidd'");
      }
    }
    $arrange = mysqli_num_rows(mysqli_query($conx, "SELECT id FROM user_apps WHERE uid='$u_uid'"));
    $arrange = $arrange + 1;
    mysqli_query($conx, "INSERT INTO user_apps (arrange,uid,app_uqid) VALUES ('$arrange','$u_uid','$app_uqid')");
  }
}
?>
