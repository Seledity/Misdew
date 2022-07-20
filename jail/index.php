<?php
# CONNECT TO THE DATABASE
$conx = mysqli_connect("127.0.0.1","mdv5","ur own pw","mdv5");
if (mysqli_connect_errno($conx)) {
	echo mysqli_connect_error();
}
# CHECK TO SEE IF THE USER IS LOGGED IN
if (isset($_COOKIE['akgnxoPwqlIs']) && isset($_COOKIE['LoILilzcnmwe']) && isset($_COOKIE['puTtxXvbEkOo'])) {
	$rstra = $_COOKIE['akgnxoPwqlIs'];
	$rstrb = $_COOKIE['LoILilzcnmwe'];
	$rstrc = $_COOKIE['puTtxXvbEkOo'];
	$cks = mysqli_query($conx, "SELECT rstringa,rstringb,rstringc FROM accounts WHERE rstringa='$rstra' && rstringb='$rstrb' && rstringc='$rstrc'");
	$ckcn = mysqli_num_rows($cks);
	if($ckcn > 0) {
		$logged_in = true;
	}
	else {
		$logged_in = false;
	}
	# STUFF FOR BEING LOGGED IN
	if($logged_in == true) {
		$x = mysqli_query($conx, "SELECT uid,verified,username,jailed,release_time,chat_attack_hp FROM accounts WHERE rstringa='$rstra' && rstringb='$rstrb' && rstringc='$rstrc'");
		$y = mysqli_fetch_assoc($x);
		$u_uid = $y['uid'];
		$u_verified = $y['verified'];
		$cfffchat_attack_hp = $y['chat_attack_hp'];
		if($u_verified != 'yes') {
			$kill = '';
			$msg = 'nvdjrj6jfnxalpowqnzaiywliz';
		  setcookie("akgnxoPwqlIs", $kill, time()+3600*24*30, '/', '.justa.us');
		  setcookie("LoILilzcnmwe", $kill, time()+3600*24*30, '/', '.justa.us');
		  setcookie("puTtxXvbEkOo", $kill, time()+3600*24*30, '/', '.justa.us');
			setcookie("hwsmnzeiopqm", $msg, time()+3600*24*30, '/', '.justa.us');
			header("location: /");
			exit();
		}
		$u_username = $y['username'];
		$u_jailed = $y['jailed'];
		$u_release_time = $y['release_time'];
    if($u_jailed != 'yes') {
      header("location: /hub");
      exit();
    }
		if($u_jailed == 'no') {
			exit();
		}
		$u_release_time = $y['release_time'];
  }
  else {
    header("location: /");
    exit();
  }
}
// User theme colors
$usri_q2 = mysqli_query($conx, "SELECT username_color,text_color FROM user_theme_colors WHERE uid='$u_uid' && theme_id='1'");
$usri_r2 = mysqli_fetch_assoc($usri_q2);
$username_color = $usri_r2['username_color'];
$username_tcolor = $usri_r2['text_color'];
function timeago($session_time) {
  $time_difference = time() - $session_time;
  $seconds = $time_difference;
  $minutes = round($time_difference/60);
  $hours = round($time_difference/3600);
  $days = round($time_difference/86400);
  $weeks = round($time_difference/604800);
  $months = round($time_difference/2419200);
  $years = round($time_difference/29030400);
  $s_ago = "s"; $m_ago = "m"; $h_ago = "h"; $w_ago = "w"; $d_ago = "d";
  if($seconds <= 59) { echo "$seconds$s_ago"; }
  else if($minutes <= 59) {
    if($minutes == 1) { echo "1$m_ago"; }
    else { echo "$minutes$m_ago"; }
  }
  else if($hours <= 23) {
    if($hours == 1) { echo "1$h_ago"; }
    else { echo "$hours$h_ago"; }
  }
  else if($days <= 6) {
    if($days == 1) { echo "1$d_ago"; }
    else { echo "$days$d_ago"; }
  }
  else if($weeks > 0) {
    if($weeks == 1) { echo "1$w_ago"; }
    else { echo "$weeks$w_ago"; }
  }
}
function release_time($session_time) {
	$time_difference = $session_time - time();
  $seconds = $time_difference;
  $minutes = round($time_difference/60);
  $hours = round($time_difference/3600);
  $days = round($time_difference/86400);
  $weeks = round($time_difference/604800);
  $months = round($time_difference/2419200);
  $years = round($time_difference/29030400);
  $s_ago = "s"; $m_ago = "m"; $h_ago = "h"; $w_ago = "w"; $d_ago = "d";
  if($seconds <= 59) { echo "$seconds$s_ago"; }
  else if($minutes <= 59) {
    if($minutes == 1) { echo "1$m_ago"; }
    else { echo "$minutes$m_ago"; }
  }
  else if($hours <= 23) {
    if($hours == 1) { echo "1$h_ago"; }
    else { echo "$hours$h_ago"; }
  }
  else if($days <= 6) {
    if($days == 1) { echo "1$d_ago"; }
    else { echo "$days$d_ago"; }
  }
  else if($weeks > 0) {
    if($weeks == 1) { echo "1$w_ago"; }
    else { echo "$weeks$w_ago"; }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Jail - Misdew</title>
  <meta charset="utf-8">
  <meta name="description" content="We are a fairly cool social network.">
  <meta name="keywords" content="Misdew, MD, Social, Network, Communication, 3DS, DSi, Nintendo">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="google" value="notranslate">
  <meta name="theme-color" content="#a64ca6">
  <link rel="stylesheet" type="text/css" href="/css/consistent.css">
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="apple-touch-icon" href="/img/logo.png">
</head>
<body>
  <center>
    <div class="header">
      <table style="width: 100%; text-align: center;">
        <tr>
          <td style="width: 100%;"><img src="/img/header.png" alt="" style="width: 40%; padding-top: 5px;"></td>
        </tr>
      </table>
    </div> <br>
    <div style="text-align: center; width: 90%; max-width: 450px; background-color: #fff; font-family: 'Dosis', sans-serif; padding: 8px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
      <?php echo "<span style=\"font-weight: bold; color: $username_color; font-size: 20px;\">$u_username</span>"; ?>
      <div style="text-align: left; color: #878787;">
				<?php
				if($cfffchat_attack_hp <= 0) {
					echo "<b>------------------------------------</b><br>";
					echo "<b>No worries, $u_username.</b> <br><br>";
					echo "<b>You were only jailed by the Chat Attack game.</b> <br><br>";
					echo "<b>You recieved no strikes and have done nothing wrong.</b> <br><br>";
					echo "<b>This game only jails you for 2 minutes.</b> <br><br>";
					echo "<b>The amount of jail time left is automatically updated below.</b> <br><br>";
					echo "<b>Have fun!</b> <br>";
					echo "<b>------------------------------------</b>";
					echo "<br><br>";
				}
				?>
        Your account has been banned- you no longer have access to your Misdew.com account. You are in jail.
        If you are curious on what you have done wrong, please review the content below. <br><br>
				Do not create another account. If you think that this is a mistake, please email <b>me@justa.us</b> <br><br>
				If you would like us to remove all of your content, please let us know at the email <b>me@justa.us</b> <br>
				<table style="width: 100%; padding: 8px; font-weight: bold; padding-bottom: 0px;">
					<tr>
						<td style="text-align: left; width: 50%;">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<span id="release_time">
								<?php
								if($u_release_time == 'perma') {
									echo "Sentenced to Life.";
								}
								elseif($u_release_time <= time()) {
									echo "<span onclick=\"window.location='/hub';\">Released! Refresh.</span>";
									mysqli_query($conx, "UPDATE accounts SET jailed='no' WHERE uid='$u_uid'");
									mysqli_query($conx, "UPDATE accounts SET release_time='' WHERE uid='$u_uid'");
									if($cfffchat_attack_hp <= 0) {
										mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='$u_uid'");
									}
								}
								else {
									echo release_time($u_release_time) . " left";
								}
								?>
							</span>
						</td>
						<td style="font-size: 11px; text-align: right; width: 50%;">
							<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
							<?php
							if($u_release_time == 'perma') {
								echo "You are not allowed on Misdew";
							}
							else {
								echo "Evading adds 1 week + strike";
							}
							?>
						</td>
					</tr>
				</table>
      </div>
    </div> <br>
    <div style="color: <?php echo $username_color; ?>; text-align: left; width: 95%; max-width: 500px; background-color: #fff; font-family: 'Dosis', sans-serif; padding: 8px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
      <?php
      $cnv_strike_count = mysqli_num_rows($cnv_strq = mysqli_query($conx, "SELECT * FROM account_strikes WHERE uid_issuee='$u_uid' ORDER BY id DESC"));
      while($cnv_strr = mysqli_fetch_assoc($cnv_strq)) {
        $cnvstr_violation_code = $cnv_strr['violation_code'];
        $cnvstr_violation_time = $cnv_strr['violation_time'];
        $cnvstr_uid_issuer = $cnv_strr['uid_issuer'];
        $cnvstr_code_weight = $cnv_strr['violation_time'];
        $cnvstr_last_strike = $cnv_strr['last_strike'];
        $cnvstr_total_time = $cnv_strr['total_time'];
        $cnvstr_issued_tstamp = $cnv_strr['issued_tstamp'];
        // Select issuer information
        $cnvstr_uq = mysqli_query($conx, "SELECT username FROM accounts WHERE uid='$cnvstr_uid_issuer'");
        $cnvstr_ur = mysqli_fetch_assoc($cnvstr_uq);
        $cnvstr_username = $cnvstr_ur['username'];
        // User theme colors
        $susri_q2 = mysqli_query($conx, "SELECT username_color FROM user_theme_colors WHERE uid='$cnvstr_uid_issuer' && theme_id='1'");
        $susri_r2 = mysqli_fetch_assoc($susri_q2);
        $strk_username_color = $susri_r2['username_color'];
        echo "<span style=\"font-weight: bold;\">Violated Code #$cnvstr_violation_code</span><br>";
        echo "<span style=\"font-size: 13px;\">";
        echo "This offense took place <span style=\"font-weight: bold;\">";
        echo timeago($cnvstr_issued_tstamp);
        echo " ago</span> and resulted in <span style=\"font-weight: bold;\">1 strike</span> ";
        echo "with the weight of <span style=\"font-weight: bold;\">$cnvstr_code_weight</span>.";
        if($cnvstr_last_strike == 'yes') {
          echo " It also resulted in the account being jailed for <span style=\"font-weight: bold;\">$cnvstr_total_time</span>.";
        }
        echo " It was recorded and taken care of by <span style=\"font-weight: bold; color: $strk_username_color;\">$cnvstr_username.</span></span><br>";
      }
      ?>
    </div>
		<div style="text-align: left; width: 95%; max-width: 500px; background-color: #fff; font-family: 'Dosis', sans-serif; padding: 8px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
			<span style="font-size: 20px; font-weight: bold;">Code of Conduct</span> <br>
			<?php
			$codeq = mysqli_query($conx, "SELECT num,weight,content FROM codes ORDER BY num ASC");
			while($coder = mysqli_fetch_assoc($codeq)) {
				$code_num = $coder['num'];
				$code_weight = $coder['weight'];
				$code_content = $coder['content'];
				echo "<span style=\"font-weight: bold;\">#$code_num:</span> ";
				echo "$code_content <span style=\"font-size: 11px; font-weight: bold;\">[ $code_weight ]</span><br>";
			}
			echo "<span style=\"font-size: 12px;\">";
			echo "Each violation automatically adds up. Jailing occurs after 2 strikes. <br>";
			echo "You also agree to the <span onclick=\"expand('terms');\" style=\"color: #0000FF;\">terms of service</span> by accessing Misdew. <br>";
			echo "The Code of Conduct and Terms of Service may be modified at any time without prior notice.";
			echo "</span>";
			echo "<div id=\"terms\" style=\"display: none;\"><br> By accessing or using Misdew in any manner, including, but not limited to, visiting or browsing Misdew or contributing content or other materials to Misdew, you agree to be bound by these Terms of Service. Capitalized terms are defined in this agreement.
			<br>
			<span style=\"font-weight: bold; font-size: 20px;\">Intellectual Property</span><br>
			Misdew and its original content, features and functionality are owned by Misdew and are protected by international copyright, trademark, patent, trade secret and other intellectual property or proprietary rights laws.
			<br>
			<span style=\"font-weight: bold; font-size: 20px;\">Termination</span><br>
			We may terminate your access to Misdew, without cause or notice, which may result in the forfeiture and destruction of all information associated with you. All provisions of this agreement that by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity, and limitations of liability.
			<br>
			<span style=\"font-weight: bold; font-size: 20px;\">Links to other websites</span><br>
			Misdew may contain links to third-party websites that are not owned or controlled by Misdew.
			<br>
			Misdew has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party websites or services. We strongly advise you to read the terms and conditions and privacy policy of any third-party website that you visit.
			<br>
			<span style=\"font-weight: bold; font-size: 20px;\">Governing law</span><br>
			This agreement (and any further rules, polices, or guidelines incorporated by reference) shall be governed and construed in accordance with the laws of Indiana, without giving effect to any principles of conflicts of law.
			<br>
			<span style=\"font-weight: bold; font-size: 20px;\">Changes to this agreement</span><br>
			We reserve the right, at our sole discretion, to modify or replace these Terms of Service by posting the updated terms on Misdew. Your continued use of Misdew after any such changes constitutes your acceptance of the new Terms of Service.
			<br>
			Please review this agreement periodically for changes. If you do not agree to any of this agreement or any changes to this agreement, do not use, access or continue to access Misdew or discontinue any use of Misdew immediately.
			<br>
			<span style=\"font-weight: bold; font-size: 20px;\">Contact us</span><br>
			If you have any questions about this agreement, please contact <a href=\"mailto:me@justa.us\" style=\"color: #000; font-weight: bold; text-decoration: none;\">me@justa.us</a>
			<br></div>";
			?>
		</div> <br>
		<div style="text-align: center; width: 90%; max-width: 450px; font-family: 'Dosis', sans-serif; padding: 8px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
			<div style="text-align: center; color: #808080;">
				If you believe that any of this is a mistake, please contact <a href="mailto:me@justa.us" style="color: #878787; font-weight: bold; text-decoration: none;">me@justa.us</a>
			</div>
		</div> <br>
    <div class="footer">&copy; Copyright Misdew</span>
  </center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
	function updRelease() {
		$.get("release_time.php", function(d) {
			$("#release_time").html(d);
		});
	}
	setInterval('updRelease()', 1000);
	function expand(id) {
		var e = document.getElementById(id);
		if(e.style.display == 'block')
		e.style.display = 'none';
		else
		e.style.display = 'block';
	}
	</script>
</body>
</html>
