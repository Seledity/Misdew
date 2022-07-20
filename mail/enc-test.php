<?php
require_once("../inc/conx.php");
$enc_txt = mysqli_real_escape_string($conx, htmlentities($_POST['txt']));

$enc_string = mysqli_real_escape_string($conx, htmlentities($_POST['string']));
$secret_key = mysqli_real_escape_string($conx, htmlentities($_POST['1']));
$secret_iv = mysqli_real_escape_string($conx, htmlentities($_POST['2']));


function genRand1($length = 16) {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
function genRand2($length = 16) {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
$gensecret_key = genRand1();
$gensecret_iv = genRand2();

function encrypt_decrypt($action, $string, $secret_key, $secret_iv)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    if($enc_string != '' && $secret_key != '' && $secret_iv != '') {
      echo encrypt_decrypt("decrypt","$enc_string","$secret_key","$secret_iv");
      echo "<br><br>";
    }
    if($enc_txt != '') {
      echo "string: ";
      echo encrypt_decrypt("encrypt","$enc_txt","$gensecret_key","$gensecret_iv");
      echo "<br>";
      echo "key #1: $gensecret_key";

      echo "<br>";
      echo "key #2: $gensecret_iv";
      echo "<br><br>";

    }
?>
<form method="post">
  decrypt a message: <br>
<input id="string" name="string" type="password" placeholder="enter string"> <br>
<input id="1" name="1" type="password" placeholder="enter key #1"> <br>
<input id="2" name="2" type="password" placeholder="enter key #2"> <br>
<input type="submit" value="decrypt">
</form>
<br>
<form method="post">
  encrypt a message: <br>
<input id="txt" name="txt" type="text" placeholder="enter text"> <br>
<input type="submit" value="encrypt">
</form>
