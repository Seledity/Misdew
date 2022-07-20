<?php
$cloudx = mysqli_connect("127.0.0.1","uploads","YOUR OWN PASSWORD HERE","uploads");
if(mysqli_connect_errno($cloudx)) {
  exit();
}

$id = safe($_GET['id']);

$cloudq = mysqli_query($cloudx, "SELECT * FROM image_uploads WHERE id='$id'");
$cloudr = mysqli_fetch_assoc($cloudq);
$file_location = $cloudr['file_location'];


//mysqli_query($conx, "DELETE FROM image_uploads WHERE id='$id'");

if (!unlink($file_location)) {
    exit();
}
else {

}
?>
