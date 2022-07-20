<?php
require_once("conx.php");
function safe($input) {
  global $conx;
  $valid_input = mysqli_real_escape_string($conx, trim(stripcslashes(htmlentities($input ,ENT_QUOTES, "UTF-8"))));
  return $valid_input;
}
function atname($texto) {
	$texto = $texto;
	$a = array("/(|s)@(w*[A-Za-z0-9_]+w*)/");
	$b = array("$1<a href='/canvas/$2' style='color:#000;text-decoration:none;font-weight:bold;'>@$2</a>");
	$texto = preg_replace($a, $b, $texto);
	return $texto;
}
function clickurl($text){
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" style="color: blue; text-decoration: none;" target="_blank">$1</a>', $text);
}
if($u_datasaver == 'on') {
  function bbc($text) {
    $find = array(
      '~\[center\](.*?)\[/center\]~s',
      '~\[left\](.*?)\[/left\]~s',
      '~\[right\](.*?)\[/right\]~s',
      '~\[spoiler=(.*?)\](.*?)\[/spoiler\]~s',
      '~\[spoiler\](.*?)\[/spoiler\]~s',
      '~\[b\](.*?)\[/b\]~s',
      '~\[i\](.*?)\[/i\]~s',
      '~\[u\](.*?)\[/u\]~s',
      '~\[s\](.*?)\[/s\]~s',
      '~\[quote\](.*?)\[/quote\]~s',
      '~\[size=([0-9]*?)\](.*?)\[/size\]~s',
      '~\[color=([#A-z0-9]*?)\](.*?)\[/color\]~s',
      '~\[link=((?:ftp|https?)://[A-z0-9].*?)\](.*?)\[/link\]~s',
      '~\[img\](.*?)\[/img\]~s',
      '~\[img=(.*?)\ (.*?)\](.*?)\[/img\]~s',
      '~\[youtube\](.*?)\[/youtube\]~s',
      '~\[yt\](.*?)\[/yt\]~s',
      '~\[dailymotion\](.*?)\[/dailymotion\]~s',
      '~\[dm\](.*?)\[/dm\]~s',
      '~\[video\](.*?)\[/video\]~s'
    );
    $replace = array(
      "<center>$1</center>",
      "<div style=\"text-align:left;\">$1</div>",
      "<div style=\"text-align:right;\">$1</div>",
      "<div class=\"spoiler\"><span style=\"font-weight: bold;\">$1</span> <span onclick=\"showSpoiler(this);\" style=\"float: right;\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></span><div class=\"spoiler_hidden\" style=\"display:none;\">$2</div></div>",
      "<div class=\"spoiler\"><span style=\"font-weight: bold;\">Spoiler</span> <span onclick=\"showSpoiler(this);\" style=\"float: right;\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></span><div class=\"spoiler_hidden\" style=\"display:none;\">$1</div></div>",
      "<b>$1</b>",
      "<i>$1</i>",
      "<span style=\"text-decoration:underline;\">$1</span>",
      "<span style=\"text-decoration:line-through;\">$1</span>",
      "<pre>$1</pre>",
      "<span style=\"font-size:$1px;\">$2</span>",
      "<span style=\"color:$1;\">$2</span>",
      "<a href=\"$1\" style=\"color: blue; text-decoration: none;\">$2</a>",
      "<a href=\"$1\" style=\"color: blue; text-decoration: none;\">[view image]</a>",
      "<a href=\"$3\" style=\"color: blue; text-decoration: none;\">[view image]</a>",
      "<a href=\"https://www.youtube.com/watch?v=$1\" style=\"color: blue; text-decoration: none;\">[view YouTube video]</a>",
      "<a href=\"https://www.youtube.com/watch?v=$1\" style=\"color: blue; text-decoration: none;\">[view YouTube video]</a>",
      "<a href=\"https://www.dailymotion.com/video/$1\" style=\"color: blue; text-decoration: none;\">[view DailyMotion video]</a>",
      "<a href=\"https://www.dailymotion.com/video/$1\" style=\"color: blue; text-decoration: none;\">[view DailyMotion video]</a>",
      "<a href=\"$1\" style=\"color: blue; text-decoration: none;\">[view video]</a>"
    );
    $text = preg_replace($find, $replace, $text);
    return $text;
  }
}
else {
  function bbc($text) {
    $find = array(
      '~\[center\](.*?)\[/center\]~s',
      '~\[left\](.*?)\[/left\]~s',
      '~\[right\](.*?)\[/right\]~s',
      '~\[spoiler=(.*?)\](.*?)\[/spoiler\]~s',
      '~\[spoiler\](.*?)\[/spoiler\]~s',
      '~\[b\](.*?)\[/b\]~s',
      '~\[i\](.*?)\[/i\]~s',
      '~\[u\](.*?)\[/u\]~s',
      '~\[s\](.*?)\[/s\]~s',
      '~\[quote\](.*?)\[/quote\]~s',
      '~\[size=([0-9]*?)\](.*?)\[/size\]~s',
      '~\[color=([#A-z0-9]*?)\](.*?)\[/color\]~s',
      '~\[link=((?:ftp|https?)://[A-z0-9].*?)\](.*?)\[/link\]~s',
      '~\[img\](.*?)\[/img\]~s',
      '~\[img=(.*?)\ (.*?)\](.*?)\[/img\]~s',
      '~\[youtube\](.*?)\[/youtube\]~s',
      '~\[yt\](.*?)\[/yt\]~s',
      '~\[dailymotion\](.*?)\[/dailymotion\]~s',
      '~\[dm\](.*?)\[/dm\]~s',
      '~\[video\](.*?)\[/video\]~s'
    );
    $replace = array(
      "<center>$1</center>",
      "<div style=\"text-align:left;\">$1</div>",
      "<div style=\"text-align:right;\">$1</div>",
      "<div class=\"spoiler\"><span style=\"font-weight: bold;\">$1</span> <span onclick=\"showSpoiler(this);\" style=\"float: right;\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></span><div class=\"spoiler_hidden\" style=\"display:none;\">$2</div></div>",
      "<div class=\"spoiler\"><span style=\"font-weight: bold;\">Spoiler</span> <span onclick=\"showSpoiler(this);\" style=\"float: right;\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></span><div class=\"spoiler_hidden\" style=\"display:none;\">$1</div></div>",
      "<b>$1</b>",
      "<i>$1</i>",
      "<span style=\"text-decoration:underline;\">$1</span>",
      "<span style=\"text-decoration:line-through;\">$1</span>",
      "<pre>$1</pre>",
      "<span style=\"font-size:$1px;\">$2</span>",
      "<span style=\"color:$1;\">$2</span>",
      "<a href=\"$1\" style=\"color: blue; text-decoration: none;\">$2</a>",
      "<img src=\"$1\" alt=\"\" style=\"width: 80%; max-width: 100%;\">",
      "<img src=\"$3\" alt=\"\" style=\"width: $1; height: $2; max-width: 100%;\">",
      "<center><object data=\"https://www.youtube.com/embed/$1\" style=\"max-width: 100%;\"></object></center>",
      "<center><object data=\"https://www.youtube.com/embed/$1\" style=\"max-width: 100%;\"></object></center>",
      "<center><object data=\"//www.dailymotion.com/embed/video/$1?autoPlay=0\" style=\"max-width: 100%;\"></object></center>",
      "<center><object data=\"//www.dailymotion.com/embed/video/$1?autoPlay=0\" style=\"max-width: 100%;\"></object></center>",
      "<video playsinline preload=\"metadata\" style=\"background-color: #000;width: 80%; height: auto;\" controls src=\"$1\" preload=\"metadata\"> </video>"
    );
    $text = preg_replace($find, $replace, $text);
    return $text;
  }
}
?>
