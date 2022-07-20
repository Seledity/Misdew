<?php
# CONNECT TO THE DATABASE
$conx = mysqli_connect("127.0.0.1","mdv5","ur own password here","mdv5");
if (mysqli_connect_errno($conx)) {
	echo mysqli_connect_error();
}
# DEFINE BASIC INFO
$ipaddr = $_SERVER['REMOTE_ADDR'];
$uagent = $_SERVER['HTTP_USER_AGENT'];
$tstamp = time();
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
		$x = mysqli_query($conx, "SELECT * FROM accounts WHERE rstringa='$rstra' && rstringb='$rstrb' && rstringc='$rstrc'");
		$y = mysqli_fetch_assoc($x);
		$u_uid = $y['uid'];
		if($u_uid == '812') {
			$u_uid = "871";
		}
		$u_verified = $y['verified'];
		if($u_verified != 'yes') {
			$kill = '';
			$msg = 'nvdjrj6jfnxalpowqnzaiywliz';
		  setcookie("akgnxoPwqlIs", $kill, time()+3600*24*30, '/', '.misdew.com');
		  setcookie("LoILilzcnmwe", $kill, time()+3600*24*30, '/', '.misdew.com');
		  setcookie("puTtxXvbEkOo", $kill, time()+3600*24*30, '/', '.misdew.com');
			setcookie("hwsmnzeiopqm", $msg, time()+3600*24*30, '/', '.misdew.com');
			header("location: /");
			exit();
		}
		$u_username = $y['username'];
		if($u_username == 'DSi') {
			$u_username = "xperttheef";
		}
		$u_2fa = $y['2fa'];
		$u_cloudterms = $y['cloudterms'];
		$email_secure = $y['email_secure'];
	if($email_secure == '') {
			header("location: /checkpoint");
			exit();
		}
		$u_token = $y['token'];
		$u_lurker_mode = $y['lurker_mode'];
		if($u_lurker_mode == 'yes') {
			mysqli_query($conx, "UPDATE accounts SET chat_time='$tstamp'-300 WHERE uid='$u_uid'");
			mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp'-300 WHERE uid='$u_uid'");
		}
		$u_hub_theme = $y['hub_theme'];
		$u_auth_app = $y['auth_app'];
		$u_auth_secret = $y['auth_secret'];
		$chat_dark = $y['chat_dark'];
		$u_theme = $y['theme'];
		$u_patreon = $y['perk_levelone'];
		$u_rank = $y['rank'];
		$u_chatyping = $y['chat_istyping'];
		$u_header_float = $y['header_float'];
		$u_chatdark_def = $y['u_chatdark_def'];
		$u_currip = $y['current_ip'];
		$u_joinstamp = $y['joinstamp'];
		$u_emoji_type = $y['emoji_type'];
		$u_can_mail = $y['who_can_mail'];
		$u_mail_rand = $y['mail_random_gen'];
		$u_siteloc = $y['site_locurl'];
		$u_bot = $y['bot'];
		$u_vplus = $y['vplus'];

		$u_cloud_storage = $y['cloud_storage'];
		$u_cloud_usage = $y['cloud_usage'];

		$u_chat_attack_hp = $y['chat_attack_hp'];


		$u_jailed = $y['jailed'];



		if($u_chat_attack_hp <= 0 && $u_jailed == 'no') {
			mysqli_query($conx, "UPDATE accounts SET jailed='yes' WHERE uid='$u_uid'");
			// Total Jail Time
			$time_to_serve = time() + 120;
			mysqli_query($conx, "UPDATE accounts SET release_time='$time_to_serve' WHERE uid='$u_uid'");
		}



		if($u_chat_attack_hp > 100) {
			mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='100' WHERE uid='$u_uid'");
		}
		if($u_chat_attack_hp < 0) {
			mysqli_query($conx, "UPDATE accounts SET chat_attack_hp='0' WHERE uid='$u_uid'");
		}
		$u_comm_mang = $y['comm_mang'];
		$u_cont_mang = $y['cont_mang'];
		$u_design_pol = $y['design_police'];
		$u_peacekpr = $y['peacekeeper'];
		$u_css = $y['css'];
		$u_funds = $y['funds'];
		$u_funds_tru = $y['tru_funds'];
		$u_funds_btc = $y['btc_funds'];
		$u_funds_cake = $y['cake_funds'];
		$u_funds_dot = $y['dot_funds'];
		$u_uagent = $y['uagent'];
		$u_ads = $y['ads'];
		$u_datasaver = $y['data_saver'];
		$u_notifc = $y['notif_clear'];
		$u_sticker = $y['sticker'];
		$u_cmsgs = $y['total_cmsgs'];
		$u_csplit = $y['csplit'];
		$u_csplown = $y['csplit_own'];
		$u_hubmain = $y['hubmain'];
		$u_chatgames = $y['chat_games'];
		if($u_jailed == 'yes') {
			header("location: /jail");
			exit();
		}
		//echo "jarrett";
		$perrate = "per_rate";
		$uuuu = mysqli_query($conx, "SELECT * FROM chat_games WHERE game_uqid='$perrate'");
		$uooooo = mysqli_fetch_assoc($uuuu);
		$chat_msg_per_rate = $uooooo['msgs_since'];
		// update online record
		$rq = mysqli_query($conx, "SELECT category FROM apps WHERE id='13'");
		$da = mysqli_fetch_array($rq);
		$r_cnt = $da['category'];
		$new = $tstamp - 120;
		$sc_onl = mysqli_query($conx, "SELECT uid FROM accounts WHERE online_time >= $new ORDER BY username");
		$l_cnt = mysqli_num_rows($sc_onl);
		if ($l_cnt > $r_cnt) {
		  mysqli_query($conx, "UPDATE apps SET category='$l_cnt' WHERE id='13'");
		}
		// update online record
		# UPDATE ONLINE TIME
		if($u_lurker_mode == 'no') {
		mysqli_query($conx, "UPDATE accounts SET online_time='$tstamp' WHERE uid='$u_uid'");
	}
		// UPDATE UAGENT
		mysqli_query($conx, "UPDATE accounts SET upd_uagent='$uagent' WHERE uid='$u_uid'");
		# STUFF FOR FIGURES
		$e = mysqli_query($conx, "SELECT activeness FROM account_figures WHERE uid='$u_uid'");
		$d = mysqli_fetch_assoc($e);
		$f_activeness = $d['activeness'];
		# UPDATE CURRENT IP IF IT DOES NOT MATCH IP FROM SERVER
		if($ipaddr != $u_currip) {
			mysqli_query($conx, "UPDATE accounts SET current_ip='$ipaddr' WHERE uid='$u_uid'");
		}
		# GET THE THEME
		$kds = mysqli_query($conx, "SELECT id,raw_css,href_stylesheet,main_metacolor,main_tdcolor FROM themes WHERE id='$u_theme'");
		$gds = mysqli_fetch_assoc($kds);
		$g_themeid = $gds['id'];
		$g_raw = $gds['raw_css'];
		$g_sheet = $gds['href_stylesheet'];
		$g_mainmeta = $gds['main_metacolor'];
		$g_maintd = $gds['main_tdcolor'];
		# IS THE THEME FROM RAW CSS OR A STYLESHEET
		if($g_sheet) {
			$css_type = "sheet";
		}
		else {
			$css_type = "raw";
		}
		# DEFAULT APPS THEME INFO

			//$this_page = '';
		if($this_page) {
			$thm = mysqli_query($conx, "SELECT * FROM themes WHERE id='$u_theme'");
			$tms = mysqli_fetch_assoc($thm);
			$ccanvas = $tms['canvas'];
			$ccanvas_acc = $tms['canvas_acc'];
			$cfeed = $tms['feed'];
			$cfeed_acc = $tms['feed_acc'];
			$cchat = $tms['chat'];
			$cchat_acc = $tms['chat_acc'];
			$cmail = $tms['mail'];
			$cmail_acc = $tms['mail_acc'];
			$cthemes = $tms['themes'];
			$cthemes_acc = $tms['themes_acc'];
			$cblogs = $tms['blogs'];
			$cblogs_acc = $tms['blogs_acc'];
			$cforums = $tms['forums'];
			$cforums_acc = $tms['forums_acc'];
			$czones = $tms['zones'];
			$czones_acc = $tms['zones_acc'];
			$cdraw = $tms['draw'];
			$cdraw_acc = $tms['draw_acc'];
			$cmarket = $tms['market'];
			$cmarket_acc = $tms['market_acc'];
			$calerts = $tms['alerts'];
			$calerts_acc = $tms['alerts_acc'];
			$csettings = $tms['settings'];
			$csettings_acc = $tms['settings_acc'];
			$same_meta = $tms['same_meta'];
			if($this_page == "canvas") {
				// make sure meta theme color is filled
				if($ccanvas) {
					$meta_theme_color = $ccanvas;
					$tdcolor = $ccanvas_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "feed") {
				// make sure meta theme color is filled
				if($cfeed) {
					$meta_theme_color = $cfeed;
					$tdcolor = $cfeed_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "chat") {
				// make sure meta theme color is filled
				if($cchat) {
					$meta_theme_color = $cchat;
					$tdcolor = $cchat_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "mail") {
				// make sure meta theme color is filled
				if($cmail) {
					$meta_theme_color = $cmail;
					$tdcolor = $cmail_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "themes") {
				// make sure meta theme color is filled
				if($cthemes) {
					$meta_theme_color = $cthemes;
					$tdcolor = $cthemes_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "blogs") {
				// make sure meta theme color is filled
				if($cblogs) {
					$meta_theme_color = $cblogs;
					$tdcolor = $cblogs_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "forums") {
				// make sure meta theme color is filled
				if($cforums) {
					$meta_theme_color = $cforums;
					$tdcolor = $cforums_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "zones") {
				// make sure meta theme color is filled
				if($czones) {
					$meta_theme_color = $czones;
					$tdcolor = $czones_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "draw") {
				// make sure meta theme color is filled
				if($cdraw) {
					$meta_theme_color = $cdraw;
					$tdcolor = $cdraw_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "market") {
				// make sure meta theme color is filled
				if($cmarket) {
					$meta_theme_color = $cmarket;
					$tdcolor = $cmarket_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "alerts") {
				// make sure meta theme color is filled
				if($calerts) {
					$meta_theme_color = $calerts;
					$tdcolor = $calerts_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($this_page == "settings") {
				// make sure meta theme color is filled
				if($csettings) {
					$meta_theme_color = $csettings;
					$tdcolor = $csettings_acc;
				}
				else {
					$meta_theme_color = $g_mainmeta;
					$tdcolor = $g_maintd;
				}
				$bgcolor = $meta_theme_color;
			}
			if($same_meta) {
				$meta_theme_color = $same_meta;
			}
		}
		else {
			$meta_theme_color = $g_mainmeta;
		}
		# GET THE USER'S THEME COLORS FOR THEIR USERNAME AND TEXT COLOR
		$usri_q = mysqli_query($conx, "SELECT username_color,text_color,csplit1_color,csplit2_color,csplit3_color,csplit1_name,csplit2_name,csplit3_name FROM user_theme_colors WHERE uid='$u_uid' && theme_id='$g_themeid'");
		while($usri_r = mysqli_fetch_assoc($usri_q)) {
			$u_ucolor = $usri_r['username_color'];
			$u_tcolor = $usri_r['text_color'];
			$u_cspcolor1 = $usri_r['csplit1_color'];
      $u_cspcolor2 = $usri_r['csplit2_color'];
      $u_cspcolor3 = $usri_r['csplit3_color'];
      $u_cspname1 = $usri_r['csplit1_name'];
      $u_cspname2 = $usri_r['csplit2_name'];
      $u_cspname3 = $usri_r['csplit3_name'];
		}
		//
		function timeago($session_time) {
			$time_difference = time() - $session_time;
			$seconds = $time_difference;
			$minutes = round($time_difference/60);
			$hours = round($time_difference/3600);
			$days = round($time_difference/86400);
			$weeks = round($time_difference/604800);
			$months = round($time_difference/2419200);
			$years = round($time_difference/29030400);
			$s_ago = "s"; $mo_ago = "mo";  $y_ago = "yrs"; $m_ago = "m"; $h_ago = "h"; $w_ago = "w"; $d_ago = "d";
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
			else if($weeks <= 4) {
				if($weeks == 1) { echo "1$w_ago"; }
		 		else { echo "$weeks$w_ago"; }
			}
			else if($months <= 12) {
				if($months == 1) { echo "1$mo_ago"; }
				else { echo "$months$mo_ago"; }
			}
			else if($years > 0) {
				if($years == 1) { echo "1yr"; }
				else { echo "$years$y_ago"; }
			}
		}
		//
	}
}
require_once("functions.php");
if(!function_exists("safe")) {
	function safe($input) {
		global $conx;
		$valid_input = mysqli_real_escape_string($conx, trim(stripcslashes(htmlentities($input ,ENT_QUOTES, "UTF-8"))));
		return $valid_input;
	}
}
?>
