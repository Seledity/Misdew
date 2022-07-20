<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
if($_POST['data']) {
  function gen($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }
  $rstr_g = gen();
  $p_data = mysqli_real_escape_string($conx, stripslashes($_POST['data']));
  $p_data = str_replace('data:image/png;base64,', '', $p_data);
  $p_data = str_replace(' ', '+', $p_data);
  $d_data = base64_decode($p_data);
  $file_sv = "i/".$u_uid.$rstr_g.".png";
  file_put_contents($file_sv, $d_data);
  $file_loc = "/draw/i/".$u_uid.$rstr_g.".png";
  $draw_name = "Untitled";
  $draw_desc = "The artist has not provided a description. :(";
  mysqli_query($conx, "INSERT INTO draw (uid, location, tstamp, name, description) VALUES ('$u_uid','$file_loc','$tstamp','$draw_name','$draw_desc')");
}
?>
