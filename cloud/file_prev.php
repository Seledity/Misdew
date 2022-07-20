<?php
$conx = mysqli_connect("127.0.0.1","uploads","ur own password here","uploads");
if(mysqli_connect_errno($conx)) {
	exit();
}

function formatSizeUnits($bytes)
{
		if ($bytes >= 1073741824)
		{
				$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		}
		elseif ($bytes >= 1048576)
		{
				$bytes = number_format($bytes / 1048576, 2) . ' MB';
		}
		elseif ($bytes >= 1024)
		{
				$bytes = number_format($bytes / 1024, 2) . ' KB';
		}
		elseif ($bytes > 1)
		{
				$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
				$bytes = $bytes . ' byte';
		}
		else
		{
				$bytes = '0 bytes';
		}

		return $bytes;
}


$file_alias = $_GET['i'];
$fileeee_uid = $_GET['z'];
if(mysqli_num_rows($query = mysqli_query($conx, "SELECT cloud_size,file_name,filetype FROM image_uploads WHERE file_alias='$file_alias' && uid_doublecheck='$fileeee_uid'")) == '0') {
	echo "error";
}
$fetch = mysqli_fetch_assoc($query);
$file_name = $fetch['file_name'];
$file_type = $fetch['filetype'];
$file_cloudsz = $fetch['cloud_size'];
if($file_type == 'Video') {
	$file_location = "https://misdew.com/img/uploads/v/$file_name";
  echo "<video playsinline preload=\"metadata\" style=\"background-color: #000;width: 50%; height: auto;\" src=\"$file_location\" controls preload=\"metadata\"> </video>";
	echo "<br>";
	$vidend = "[/video]";
	echo "<textarea rows=\"4\">[video]$file_location$vidend</textarea>";
	$video_file = "../img/uploads/v/$file_name";
	$file_sizee = filesize($video_file);
	$file_sizee = formatSizeUnits($file_sizee);
	if($file_cloudsz != '') {
	echo "<span style=\"color: #808080; font-size: 12px;\"><br>This file takes up <b>~$file_sizee</b> of your Cloud storage.</span>";
	}}
if($file_type == 'Image') {
	$file_location = "https://misdew.com/img/uploads/$file_name";
  echo "<img src=\"$file_location\" style=\"width: 50%;\">";
	echo "<br>";
	$imgend = "[/img]";
	echo "<textarea rows=\"4\">[img]$file_location$imgend</textarea>";
	$image_file = "../img/uploads/$file_name";
	$file_sizee = filesize($image_file);
	$file_sizee = formatSizeUnits($file_sizee);
	if($file_cloudsz != '') {
	echo "<span style=\"color: #808080; font-size: 12px;\"><br>This file takes up <b>~$file_sizee</b> of your Cloud storage.</span>";
	}
$exif = @exif_read_data($image_file, 0, true);
$brand = $exif["IFD0"]["Make"];
$camera = $exif["IFD0"]["Model"];
$software = $exif["IFD0"]["Software"];
$filesize = $exif["FILE"]["FileSize"];
$date_time = $exif["IFD0"]["DateTime"];
$width = $exif["COMPUTED"]["Width"];
$height = $exif["COMPUTED"]["Height"];
$aperture = $exif["COMPUTED"]["ApertureFNumber"];
$shutter_speed = $exif["EXIF"]["ExposureTime"];
$iso = $exif["EXIF"]["ISOSpeedRatings"];
$focal_length = $exif["EXIF"]["FocalLength"];
$lens = $exif["EXIF"]["UndefinedTag:0xA434"];
$fl_calc = eval('return ' . $focal_length . ';');
$focal_length_mm = "$fl_calc";

$exiiif = @exif_read_data($image_file);
$lat = $exiiif["GPSLatitude"];

if($brand != '') {
	$brand = "<br> <b>Device:</b> $brand <br>";
}
if($camera != '') {
	$camera = "<b>Model:</b> $camera <br>";
}
if($software != '') {
	$software = "<b>Software:</b> $software <br>";
}
if($width != '') {
	$size = "<br> <b>Resolution:</b> $height x $width<br>";
}
if($filesize != '') {
	$filesize = "<b>File Size:</b> $filesize<br>";
}
if($date_time != '') {
	$date_time = "<b>Date / Time:</b> $date_time <br>";
}
if($aperture != '') {
	$aperture = "<b>Aperture:</b> $aperture <br>";
}
if($shutter_speed != '') {
	$shutter_speed = "<b>Shutter Speed:</b> $shutter_speed <br>";
}
if($iso != '') {
	$iso = "<b>ISO:</b> $iso <br>";
}
if($focal_length != '') {
	$focal_length = "<b>Focal Length:</b> $focal_length <br>";
}
if($focal_length_mm != 0) {
	$focal_length_mm = "<b>Focal Length (mm):</b> $focal_length_mm mm <br>";
}
if($lens != '') {
	$lens = "<b>Lens:</b> $lens <br>";
}
if($lat != '') {
	$lat = "<br><br> <b><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i> There are GPS location coordinates attached to this file. <i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><br>
	<i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i> Anyone with access to this file can see the GPS coordinates. <i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><br>
	<i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i> We highly advise that you delete this photo for your privacy. <i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><i class=\"fa fa-exclamation fa-lg\" aria-hidden=\"true\"></i><br></b>";
}
echo "<span style=\"color: #808080; font-size: 12px;\"><br>If there is any EXIF/metadata for this image, it will be shown below. $lat$brand$camera$software$size$filesize$date_time$aperture$shutter_speed$iso$focal_length$focal_length_mm$lens</span>";
}
?>
