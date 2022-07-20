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
		$asdfasdfasdf = $y['chat_attack_hp'];
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
		if($u_jailed == 'no') {
			echo "<span onclick=\"window.location='/hub';\">Released! Refresh.</span>";
			exit();
		}
		$u_release_time = $y['release_time'];
		$u_release_time = $y['release_time'];
  }
  else {
    header("location: /");
    exit();
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
if($u_release_time == 'perma') {
	echo "Sentenced to Life.";
}
elseif($u_release_time <= time()) {
	echo "<span onclick=\"window.location='/hub';\">Released! Refresh.</span>";
	mysqli_query($conx, "UPDATE accounts SET jailed='no' WHERE uid='$u_uid'");
	mysqli_query($conx, "UPDATE accounts SET release_time='' WHERE uid='$u_uid'");
	if($asdfasdfasdf <= 0) {
		mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='$u_uid'");
	}
}
else {
	echo release_time($u_release_time) . " left";
}
?>
