<?php
require_once("../../inc/check-conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Checkpoint - Misdew</title>
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
      require_once("../../inc/header.php");
      ?> <br>
      <div class="settings_cont">
      <span style="font-size: 12px; color: #808080;">&nbsp; You must take action to continue using Misdew.com</span>
        <table style="width: 100%; padding: 8px;">
          <tr>
            <td>
              <span class="settings_title">
                Checkpoint: Email Storing Update
              </span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="settings_desc">
                Every email address associated with a Misdew.com account has been removed from our databases for additional security.
                Email addresses were previously stored in plaintext. They are now being hashed using SHA256- the same method used to secure your Misdew.com password.
                <br> Please enter a valid email address below. You will receive an email from us asking you to confirm the linking of this email address to your Misdew.com account. <br><br>
                If you encounter any issues or need help, please send an email to me@justa.us <br><br>
              </span>
              </td>
            </tr>
            <tr>
              <td>
                <input autocomplete="off" type="text" id="new_email" name="new_email" class="settings_input" placeholder="New Email"> <br>
                <input autocomplete="off" type="text" id="new_email_conf" name="new_email_conf" class="settings_input" placeholder="Confirm New Email"> <br>
                <input autocomplete="off" type="password" id="password" name="password" class="settings_input" placeholder="Enter Password"> <br>
              </td>
            </tr>
            <tr>
              <td onclick="newEmail();">
                <center><div class="change_pass_btn" style="background-color: #a64ca6;">Update</div></center>
              </td>
            </tr>
          </table>
      </div>

<br>
      <span style="font-family: 'Dosis', sans-serif; color: #808080; font-size: 12px;">Still need help? Send an email to <b>me@justa.us</b></span><br>
      <?php
      require_once("../../inc/footer.php");
      ?>
    </center>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>
    function newEmail() {
      if(confirm('Are you sure that everything is correct?')) {
        var password = document.getElementById('password').value;
        var new_email = document.getElementById('new_email').value;
        var new_email_conf = document.getElementById('new_email_conf').value;
        var token = "<?php echo $u_token; ?>";
        $.ajax({
        url: 'link.php',
        type: 'POST',
        data: { token: token, new_email: new_email, new_email_conf: new_email_conf, password: password },
        success: function(data){
          if(data == '') {
            var password = document.getElementById('password').value = '';
            var new_email = document.getElementById('new_email').value = '';
            var new_email_conf = document.getElementById('new_email_conf').value = '';
            alert('If all went well: A verification email should have been sent. Please click the link in the email in order to link this new email address to your account. Please allow time for the email to arrive and check your spam folder.');
          }
        },
        error: function(data) {
          alert('If all went well: A verification email should have been sent. Please click the link in the email in order to link this new email address to your account. Please allow time for the email to arrive and check your spam folder.');
        }
      });
      }
    }
  </script>
</body>
</html>
