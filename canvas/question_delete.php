<?php
require_once("../inc/conx.php");
$quest_id = safe($_GET['quest_id']);
mysqli_query($conx, "DELETE FROM canvas_askbox WHERE id='$quest_id' && uid_canvas='$u_uid'");
exit();
?>
