<?php
if ( isset($_FILES['img']) ) {
 $filename  = $_FILES['img']['tmp_name'];
 $handle    = fopen($filename, "r");
 $data      = fread($handle, filesize($filename));
 $required_key = "make ur own";
 $POST_DATA = array(
   'file' => base64_encode($data),
   'key' => urlencode($required_key),
   'user' => urlencode($u_uid)
 );
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_URL, 'https://upl.justa.us/zip.php');
 curl_setopt($curl, CURLOPT_TIMEOUT, 30);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
 $response = curl_exec($curl);
 echo trim($response);
 curl_close ($curl);
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<div style="background-color: turquoise; padding: 20px; width: 20px;"><span id="loader"><i onclick="selectFile();" id="fPath" class="fa fa-paperclip fa-lg" aria-hidden="true"></i></span></div>
<form id="imgUpl" action="upload.php" enctype="multipart/form-data" method="post">
  <input id="fBrowse" name="img" type="file" style="display: none;">
</form>





<script>
function selectFile() {
  document.getElementById('fBrowse').click();
  document.getElementById('fPath').value = document.getElementById('fBrowse').value;
}
var form = document.forms.namedItem("imgUpl");
form.addEventListener('change', function(ev) {
  var oOutput = document.querySelector("div"),
  oData = new FormData(form);
  var oReq = new XMLHttpRequest();
  document.getElementById('loader').innerHTML = "<img src='http://i.imgur.com/pvQ0NaJ.gif' height='12' width='12' alt='' style='border:0;'>";
  oReq.open("POST", "upload.php", true);
  oReq.onload = function(oEvent) {
    if (oReq.status == 200) {
      document.getElementById('loader').innerHTML = "<i onclick='selectFile();' id='fPath' class='fa fa-check' aria-hidden='true'></i>";
      form.reset();
    }
  };
  oReq.send(oData);
  ev.preventDefault();
}, false);
</script>
