<?php
require_once("../inc/conx.php");
$draw_id = safe($_GET['i']);
$cntq = mysqli_query($conx, "SELECT id FROM draw_likes WHERE draw_id='$draw_id'");
$like_count = mysqli_num_rows($cntq);
$ddd = mysqli_query($conx, "SELECT id FROM draw_dislikes WHERE draw_id='$draw_id'");
$dislike_count = mysqli_num_rows($ddd);
$total_both = $dislike_count + $like_count;
$like_perc = ($like_count / $total_both) * 100;
$dislike_perc = ($dislike_count / $total_both) * 100;
?>
<table style="width: 100%; border-collapse: collapse;">
  <tr>
    <td id="like_battle" class="like_battle" style="width: <?php echo $like_perc; ?>%;">
    </td>
    <td id="dislike_battle" class="dislike_battle" style="width: <?php echo $dislike_perc; ?>%;">
    </td>
  </tr>
</table>
