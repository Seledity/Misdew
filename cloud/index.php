<?php
$this_page = "cloud";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/cloud') {
  $loc_desc = "floatin\' in the cloud";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/cloud' WHERE uid='$u_uid'");
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
$cloudx_storage = formatSizeUnits($u_cloud_storage);
$cloudx_usage = formatSizeUnits($u_cloud_usage);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cloud - Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="<?php echo $meta_theme_color; ?>">
  <?php
  if($css_type == "sheet") {
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$g_sheet\">";
  }
  if($css_type == "raw") {
    echo "<style type=\"text/css\">$g_raw</style>";
  }
  $cloudxx = mysqli_connect("127.0.0.1","uploads","ur own pw","uploads");
  if(mysqli_connect_errno($cloudxx)) {
    exit();
  }
  $flecnt = mysqli_query($cloudxx, "SELECT * FROM image_uploads WHERE uid='$u_uid' && uid_doublecheck='$u_uid' ORDER BY id DESC");
  $cloud_count = mysqli_num_rows($flecnt);
  $cloud_count = number_format($cloud_count);
  // image count
  $imgflecnt = mysqli_query($cloudxx, "SELECT * FROM image_uploads WHERE uid='$u_uid' && uid_doublecheck='$u_uid' && filetype='Image' ORDER BY id DESC");
  $imgcloud_count = mysqli_num_rows($imgflecnt);
  $imgcloud_count = number_format($imgcloud_count);
  // video count
  $vidflecnt = mysqli_query($cloudxx, "SELECT * FROM image_uploads WHERE uid='$u_uid' && uid_doublecheck='$u_uid' && filetype='Video' ORDER BY id DESC");
  $vidcloud_count = mysqli_num_rows($vidflecnt);
  $vidcloud_count = number_format($vidcloud_count);
  ?>
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="apple-touch-icon" href="/img/logo.png">

</head>
<body>
  <body>
    <center>
      <?php
      $back_button = true;
      $linebreak = false;
      $alerts = true;
      require_once("../inc/header.php");
      ?>
      <?php
      //require_once("../inc/load_alerts.php");
      ?><br>
      <div class="settings_cont" style="display: visible;">
      <span style="font-size: 12px; color: #808080;">&nbsp; MD Cloud v2.8</span>
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td>
              <span class="settings_title">
                Cloud Disclaimer
              </span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="settings_desc">
                All of the files that you upload to Misdew are stored here. <br>
                You can view and manage your files in the Cloud. <br>
                By uploading files to Misdew, you agree to the <a href="file-terms.html" style="color: #0000FF;">terms.</a> <br>
                You must agree to the <a href="file-terms.html" style="color: #0000FF;">terms</a> to upload files. <br>
                File uploads to Misdew are not encrypted or secure. <br>
                Metadata is removed from JPG and JPEG files (such as location/device info). <br>
                Anyone can access a file if they have or find its link. <br>
                All files uploaded are linked to a Misdew account. <br>
                Files can become corrupt, broken, or deleted at any time. <br>
                You are responsible for your files- not Misdew. <br>
                Your files can be reviewed at any time- they are not private. <br>
                <?php
                if($u_cloudterms == "no") {
                  echo "<span style=\"font-weight: bold; color: #FF0000;\">-- You have NOT accepted the terms for your account -- <br> -- Accepting cannot be undone; email me@justa.us for info --</span>";
                }
                else {
                  echo "<span style=\"font-weight: bold; color: #4CA64C;\">-- You have accepted the terms for your account -- <br> -- This cannot be undone; email me@justa.us for info --</span> <br>";
                }
                ?>
            </td>
          </tr>
        </table>
      </div>


      <div class="settings_cont">
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td>
              <span class="settings_title">
                My Cloud
              </span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="settings_desc">
                View and manage your files below. <br>
                Deleting a file may not erase it permanently (i.e., cache). <br>
                Your Cloud has <?php echo $imgcloud_count; ?> image files and <?php echo $vidcloud_count; ?> video files. <br>
                There are <?php echo $cloud_count; ?> total files in your Cloud. <br>
                You are using ~<?php echo $cloudx_usage; ?> of your <?php echo $cloudx_storage; ?> Cloud storage.
              </span>
            </td>
          </tr>
          <?php
          if($u_cloudterms == "no") {
          echo "
          <tr>
            <td>
              <span style=\"font-weight: bold; color: #FF0000;\" onclick=\"window.location='https://misdew.com/cloud/file-terms.html'\">
                <br>YOU MUST AGREE TO THE TERMS IN ORDER TO UPLOAD AND MANAGE FILES. THIS CANNOT BE UNDONE. PLEASE CLICK HERE TO VIEW THE TERMS.
              </span>
            </td>
          </tr>";
        }
          ?>
        </table>


          <?php
          if($u_cloudterms == "yes") {
            //echo "<div style=\"font-family: 'Dosis', sans-serif;padding: 8px; color: #808080;\">";
            //echo "<i class=\"fa fa-list\"></i> list view</div>";
          $cloudx = mysqli_connect("127.0.0.1","uploads","ur own pw","uploads");
          if(mysqli_connect_errno($cloudx)) {
          	exit();
          }
          $cloudq = mysqli_query($cloudx, "SELECT * FROM image_uploads WHERE uid='$u_uid' && uid_doublecheck='$u_uid' ORDER BY id DESC");
          while($cloudr = mysqli_fetch_assoc($cloudq)) {
            $fileid = $cloudr['id'];
            $filelocation = $cloudr['file_location'];
            $filename = $cloudr['file_alias'];
            $vfilename = $cloudr['file_name'];
            $filestamp = $cloudr['tstamp'];
            $cloud_nickname = $cloudr['nickname'];
            $upl_via = $cloudr['upl_from'];
            $upl_type = $cloudr['filetype'];
            if($upl_type == 'Video') {
            	$filelocation = "https://misdew.com/img/uploads/v/$vfilename";
              $upl_icon = "<i class=\"fa fa-film\" aria-hidden=\"true\"></i>";
              $video_file = "../img/uploads/v/$file_name";
            	$file_sizee = filesize($video_file);
            	//$file_sizee = formatSizeUnits($file_sizee);
            }
            if($upl_type == 'Image') {
            	$filelocation = "https://misdew.com/img/uploads/$vfilename";
              $upl_icon = "<i class=\"fa fa-image\" aria-hidden=\"true\"></i>";
              $image_file = "../img/uploads/$file_name";
            	$file_sizee = filesize($image_file);
            	//$file_sizee = formatSizeUnits($file_sizee);
            }
            echo "<table style=\"padding: 4px; padding-left: 8px; padding-right: 8px; width: 100%; border-bottom: 1px solid #ececec;\"><tr><td style=\"width: 85%;\">";
            echo "<span style=\"font-weight: bold; color: $u_ucolor\">
            $upl_icon $cloud_nickname</span>
            <br>
            <span style=\"color: #808080; font-size: 12px;\">
            uploaded via $upl_via";
            echo " &bull; ";
            echo timeago($filestamp);
            echo " ago</span>";
            echo "</td>";
            echo "<td><i class=\"fa fa-star-o\" aria-hidden=\"true\" onclick=\"alert('Favorite Cloud files soon.');\"></i></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td><i class=\"fa fa-eye\" aria-hidden=\"true\" onclick=\"showPrev('$filename');\"></i></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td><i class=\"fa fa-expand\" aria-hidden=\"true\" onclick=\"window.open('$filelocation');\"></i></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td><i class=\"fa fa-trash\" aria-hidden=\"true\" id=\"pdel_$fileid\"></i></td>";
            echo "</tr></table>";


            echo "<table id=\"cloud_$filename\" style=\"display: none; padding: 8px; width: 100%; border-bottom: 1px solid #808080;\"><tr><td style=\"width: 85%;\">";
            echo "<div id=\"cloudprev_$filename\"></div>";
            echo "</td></tr></table>";
          }
        }
          ?>

      </div>



      <?php
      require_once("../inc/footer.php");
      ?>
    </center>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
    var Del = document.querySelectorAll("i[id^=pdel_]");
    [].forEach.call(Del, function(dt){
      dt.onclick = function(e){
        if (confirm("Delete this file? \n Deleting a file may not erase it permanently (i.e., cache). \n There may still be a cached version of this file available.")) {
          var dto = new XMLHttpRequest();
          dto.open("GET", "https://misdew.com/img/rm.php?id=" + dt.id.match(/([0-9]*)$/)[0] + "&u=<?php echo "$u_uid&upld=$u_username"; ?>", true);
          dto.onreadystatechange = function(){
            if (dto.readyState == 4)
              if(dto.status == 200) {
                alert("deleted, please refresh to verify");
              }
              else {
                alert("deleted, please refresh to verify");
              }
          };
          dto.send();
          return false;
        }
      };
    });
    function more(id) {
      var e = document.getElementById(id);
      if(e.style.display == '') {
        e.style.display = 'none';
      }
      else {
        e.style.display = '';
      }
    }
    function showPrev(fileprev) {
      var rstr = fileprev;
      var rstt = <?php echo $u_uid; ?>;
      var e = "cloudprev_" + rstr;
      var fp = "cloud_" + fileprev;
      var e = document.getElementById(e);
      var fp = document.getElementById(fp);
      // Fetch comments for the post
      var getcmts = new XMLHttpRequest();
      getcmts.open("GET", "file_prev.php?i=" + rstr + "&&z=" + rstt, true);
      getcmts.onreadystatechange = function(){
        if(getcmts.readyState == 4)
        if(getcmts.status == 200) {
          var inn_prev = getcmts.responseText;
          document.getElementById("cloudprev_" + rstr).innerHTML = inn_prev;
          if(fp.style.display == '')
            fp.style.display = 'none';
          else
            fp.style.display = '';
        }
        else {
          alert("error getting preview");
        }
      };
      getcmts.send();
      return false;
    }
    </script>
</body>
</html>
