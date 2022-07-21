<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
?>
<style>
/* CONTENT HERE FOR THIS PAGE */
/* MAKE SURE TO ADD TO THEMES */
/* CONTENT HERE FOR THIS PAGE */
.spindle_cont {
  width: 90%;
  max-width: 450px;
  padding: 8px;
  background-color: #fff;
  font-family: 'Dosis', sans-serif;
  text-align: left;
  border-bottom: 1px dotted #ccc;
}
.spindle_name {
  font-weight: bold;
  font-size: 18px;
}
.spindle_subname {
  font-weight: bold;
  font-size: 12px;
}
.spindle_desc {
  color: #808080;
  font-size: 13px;
}
.spindle_info_cont {
  border-collapse: collapse;
  width: 100%;
}
.spindle_info {
  padding: 0;
  margin: 0;
  width: 50%;
  text-align: left;
}
.spindle_actcont {
  padding: 0;
  margin: 0;
  width: 50%;
  text-align: right;
}
</style>
<?php
$spindles_q = mysqli_query($conx, "SELECT * FROM forum_spindles ORDER BY id ASC");
while($spindles_r = mysqli_fetch_assoc($spindles_q)) {
  $spindle_uqid = $spindles_r['uqid'];
  $spindle_name = $spindles_r['name'];
  $spindle_desc = $spindles_r['description'];
  $spindle_tstamp = $spindles_r['tstamp'];
  $spindle_color = $spindles_r['color'];
  $spindle_actstamp = time() - $spindle_tstamp;
  $minutes = round($spindle_actstamp / 60);
  if($minutes <= 60) {
    $spindle_actdot = "#00FF00";
  }
  elseif($minutes <= 90) {
    $spindle_actdot = "#FFA500";
  }
  elseif($minutes < 120) {
    $spindle_actdot = "#FF0000";
  }
  else {
    $spindle_actdot = "#FF0000";
  }
  echo "<div class=\"spindle_cont\">
    <table class=\"spindle_info_cont\">
      <tr>
        <td class=\"spindle_info\">
          <span class=\"spindle_name\" style=\"color: $spindle_color;\" onclick=\"toThreads('$spindle_uqid','$spindle_name');\">
            <i class=\"fa fa-external-link-square\" aria-hidden=\"true\"></i> <span id=\"$spindle_uqid\">$spindle_name</span>
          </span>
        </td>
        <td class=\"spindle_actcont\">
          <i class=\"fa fa-circle\" aria-hidden=\"true\" style=\"font-size: 8px; color: $spindle_actdot;\"></i>
        </td>
      </tr>
    </table>
    <span class=\"spindle_desc\">
      $spindle_desc
    </span> <br>";
    $subspindles_q = mysqli_query($conx, "SELECT * FROM forum_subspindles WHERE spindle_uqid='$spindle_uqid' ORDER BY id ASC");
    while($subspindles_r = mysqli_fetch_assoc($subspindles_q)) {
      $s_spindle_uqid = $subspindles_r['spindle_uqid'];
      $subspindle_uqid = $subspindles_r['uqid'];
      $subspindle_name = $subspindles_r['name'];
      $coolsplit = "1";
      echo "<span class=\"spindle_subname\" style=\"color: $spindle_color;\" onclick=\"toThreads('$s_spindle_uqid$coolsplit$subspindle_uqid','$subspindle_name');\">
        <i class=\"fa fa-external-link-square\" aria-hidden=\"true\"></i> <span id=\"$s_spindle_uqid$coolsplit$subspindle_uqid\">$subspindle_name</span>
      </span> <br>";
    }
    echo "</div>";
}
?>
<script>
function toThreads(name,loading_name) {
  document.getElementById(name).innerHTML = loading_name + "..";
  var uqid = name;
  $.get("threads.php?u=" + uqid, function(d) {
    $("#action_bar_page").html(d);
  });
}
</script>
