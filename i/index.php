<?php
$conx = mysqli_connect("127.0.0.1","uploads","ur own pw here","uploads");
if(mysqli_connect_errno($conx)) {
	exit();
}
$file_alias = $_GET['i'];
if(mysqli_num_rows($query = mysqli_query($conx, "SELECT file_name,filetype FROM image_uploads WHERE file_alias='$file_alias'")) == '0') {
	header("location: https://misdew.com/img/dne.png");
	exit();
}
$fetch = mysqli_fetch_assoc($query);
$file_name = $fetch['file_name'];
$file_type = $fetch['filetype'];
if($file_type == 'Video') {
	$file_location = "https://misdew.com/img/uploads/v/$file_name";
}
if($file_type == 'Image') {
	$file_location = "https://misdew.com/img/uploads/$file_name";
}
header("location: $file_location");
exit();
?>
