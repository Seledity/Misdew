<?php
require_once("../inc/conx.php");
if($u_chatyping != 'no') {
mysqli_query($conx, "UPDATE accounts SET chat_istyping='no' WHERE uid='$u_uid'");
}
?>
