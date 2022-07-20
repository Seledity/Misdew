<?php
$conx = mysqli_connect("127.0.0.1","uploads","ur own password","uploads");
if(mysqli_connect_errno($conx)) {
	exit();
}
# CONNECT TO THE DATABASE
$mdv5 = mysqli_connect("127.0.0.1","mdv5","ur own password","mdv5");
if (mysqli_connect_errno($mdv5)) {
	echo mysqli_connect_error();
}
$required_key = $_POST['key'];
$required_user = $_POST['user'];
$uid_dblechk = $_POST['imagetype'];
$posted_uname = $_POST['usernaem'];
$username_dblchk = $_POST['filextension'];
$u_via = $_POST['uvia'];

$terms_accept = $_POST['imaeg'];
$dbchk_terms_accept = $_POST['fieltyp'];
// DOUBLE CHECK USER LOGGED IN AND MAKE SURE THEY'VE ACCEPTED UPLOAD TERMS OF SERVICE
if($terms_accept == 'no') {
	exit();
}
if($dbchk_terms_accept == 'no') {
	exit();
}
if($posted_uname == $username_dblchk) {
	$usertruth = "yes";
}
else {
	$usertruth = "no";
	exit();
}
if($required_user == $uid_dblechk) {
	$triplecheck = "yes";
}
else {
	$triplecheck = "no";
	exit();
}


if($dbchk_terms_accept == 'yes' && $terms_accept == 'yes' && $triplecheck == 'yes' && $usertruth == 'yes') {
	## BREAK THE UPLOAD IF THEY ARE PAST THEIR LIMIT
	## BREAK THE UPLOAD IF THEY ARE PAST THEIR LIMIT
	## BREAK THE UPLOAD IF THEY ARE PAST THEIR LIMIT
	$breakx = mysqli_query($mdv5, "SELECT cloud_usage,cloud_storage FROM accounts WHERE uid='$required_user'");
	$breaky = mysqli_fetch_assoc($breakx);
	$uploader_storage = $breaky['cloud_storage'];
	$uploader_usage = $breaky['cloud_usage'];
	if($uploader_usage >= $uploader_storage) {
		exit();
	}
	## BREAK THE UPLOAD IF THEY ARE PAST THEIR LIMIT
	## BREAK THE UPLOAD IF THEY ARE PAST THEIR LIMIT
	## BREAK THE UPLOAD IF THEY ARE PAST THEIR LIMIT
$genRand2 = "__";
$ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'];
$timestamp = time();
if($required_key == 'ur own key here ') {
	$encoded_file = $_POST['file'];
	$decoded_file = base64_decode($encoded_file);
	$f = finfo_open();
	$mime_type = finfo_buffer($f, $decoded_file, FILEINFO_MIME_TYPE);
	$mime_type = substr($mime_type, 6);
	if($mime_type == 'gif' OR $mime_type == 'jpg' OR $mime_type == 'jpeg' OR $mime_type == 'png' OR $mime_type == 'ico') {
		function randStr($length = 14) {
			return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}
		$genRand = randStr();
		file_put_contents('../Misdew.com/img/uploads/' . $required_user . $genRand2 . $genRand . "." . $mime_type, $decoded_file);


		// Store the path of source file
		$source = "../Misdew.com/img/uploads/$required_user$genRand2$genRand.$mime_type";
		// Store the path of destination file
		$destination = "../misdew-ds.com/img/uploads/$required_user$genRand2$genRand.$mime_type";
		// Copy the file from /user/desktop/geek.txt
		// to user/Downloads/geeksforgeeks.txt'
		// directory
		copy($source, $destination);
		$cloud_file_size = filesize($source);

		$x = mysqli_query($mdv5, "SELECT uid,cloud_usage FROM accounts WHERE uid='$required_user'");
		$y = mysqli_fetch_assoc($x);
		$uploader_uid = $y['uid'];
		$uploader_usage = $y['cloud_usage'];
		mysqli_query($mdv5, "UPDATE accounts SET cloud_usage='$uploader_usage'+$cloud_file_size WHERE uid='$uploader_uid'");

		if($mime_type == 'jpg' OR $mime_type == 'jpeg') {
				$incoming_file = "../Misdew.com/img/uploads/$required_user$genRand2$genRand.$mime_type";
						$img = new Imagick(realpath($incoming_file));
						 $profiles = $img->getImageProfiles("icc", true);
						 $img->stripImage();

			 if(!empty($profiles)) {
					$img->profileImage("icc", $profiles['icc']);
			 }

				$img->writeImage($incoming_file);
			}
		$url = "https://misdew.com/i/" . $required_user . $genRand2 . $genRand;
		$fylname = "$required_user$genRand2$genRand.$mime_type";
		$loc = "https://misdew.com/img/uploads/$required_user$genRand2$genRand.$mime_type";
		$loc2 = "http://misdew-ds.com/img/uploads/$required_user$genRand2$genRand.$mime_type";
		mysqli_query($conx, "INSERT INTO image_uploads (cloud_size, file_name, file_location, file_alias, tstamp, uid, uid_doublecheck, posted_uname, verif_username, upl_from, mdds_path) VALUES ('$cloud_file_size','$fylname','$loc','$required_user$genRand2$genRand','$timestamp','$required_user','$uid_dblechk','$posted_uname','$username_dblchk','$u_via','$loc2')");
		echo trim($url);
	}
}
}
?>
