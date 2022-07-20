<?php
/*
$conx = mysqli_connect("127.0.0.1","uploads","ur own pw","uploads");
if(mysqli_connect_errno($conx)) {
	exit();
}
$directory = "image_uploads/";

// Open a directory, and read its contents
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)){
    while (($file = readdir($opendirectory)) !== false){

    }
    echo "<br><br><br>db<br>";
    $query = mysqli_query($conx, "SELECT file_name FROM image_uploads ORDER BY file_name ASC");
    while($fetch = mysqli_fetch_assoc($query)) {
      $file_name = $fetch['file_name'];

    }
    closedir($opendirectory);
  }
}
*/
?>
