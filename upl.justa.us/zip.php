<?php
$md_conx = mysqli_connect("127.0.0.1","mdv5","ur own password","mdv5");
$conx = mysqli_connect("127.0.0.1","uploads","ur own password","uploads");
if(mysqli_connect_errno($conx)) {
	exit();
}
$required_key = $_POST['key'];
$required_user = "v5";
$ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'];
$timestamp = time();
if($required_key == 'ur own key') {
	$encoded_file = $_POST['file'];
	$decoded_file = base64_decode($encoded_file);
	$f = finfo_open();
	$mime_type = finfo_buffer($f, $decoded_file, FILEINFO_MIME_TYPE);
	$mime_type = substr($mime_type, 12);
	if($mime_type == 'zip') {
		function randStr($length = 10) {
			return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}
		$genRand = randStr();
		file_put_contents('zip_uploads/' . $required_user . $genRand . "." . $mime_type, $decoded_file);
		$url = "https://upl.justa.us/i/" . $required_user . $genRand;
		$loc = "https://upl.justa.us/zip_uploads/$required_user$genRand.$mime_type";
		mysqli_query($conx, "INSERT INTO zip_uploads (file_location, file_alias, tstamp) VALUES ('$loc','$required_user$genRand','$timestamp')");
		$tstamp = time();
		mysqli_query($md_conx, "INSERT INTO notifs (rstring, uid, snoozeable, app_uqid, message, tstamp) VALUES ('$tstamp','1','no','misdew','Someone uploaded a .zip','$tstamp')");
		echo "Submitted.";
	}
	else {
		echo "Error.";
	}
}
?>
