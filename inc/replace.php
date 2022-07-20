<?php
// ******************************************** //
// ********* SET PROPERTIES OF EMOJIS ********* //
// ******************************************** //
$emoji_width = "20px";
$emoji_height = "20px";
$emoji_type = $u_emoji_type;
// ******************************************** //
// *************** EMOJI FACES *************** //
// ******************************************** //
$string = str_replace(":pepe:","<img src=\"/img/stickers/pepe.png\" alt=\":pepe:\" style=\"width: auto; height: 80px;\">",$string);


$string = str_replace(":kane:","<img src=\"/img/stickers/kane.gif\" alt=\":kane:\" style=\"width: auto; height: 80px;\">",$string);



$string = str_replace(":pepe-punch:","<img src=\"/img/stickers/pepe-punch.png\" alt=\":pepe-punch:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-gun1:","<img src=\"/img/stickers/pepe-gun1.png\" alt=\":pepe-gun1:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-mk:","<img src=\"/img/stickers/pepe-mk.png\" alt=\":pepe-mk:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-sad1:","<img src=\"/img/stickers/pepe-sad1.png\" alt=\":pepe-sad1:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-weetawd:","<img src=\"/img/stickers/pepe-weetawd.png\" alt=\":pepe-weetawd:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-HAHA:","<img src=\"/img/stickers/pepe-HAHA.png\" alt=\":pepe-HAHA:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-eyes:","<img src=\"/img/stickers/pepe-eyes.png\" alt=\":pepe-eyes:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-k:","<img src=\"/img/stickers/pepe-k.png\" alt=\":pepe-k:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":wojak:","<img src=\"/img/stickers/wojak.png\" alt=\":wojak:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":withered:","<img src=\"/img/stickers/withered.png\" alt=\":pepe-HAHA:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":lock:","<img src=\"/img/stickers/lock.png\" alt=\":pepe-HAHA:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":pepe-grog:","<img src=\"/img/stickers/pepe-grog.png\" alt=\":pepe-grog:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":roblock:","<img src=\"/img/stickers/roblock.png\" alt=\":roblock:\" style=\"width: auto; height: 80px;\">",$string);



$string = str_replace(":easter-pepe:","<img src=\"/img/stickers/easter-pepe.png\" alt=\":easter-pepe:\" style=\"width: auto; height: 100px;\">",$string);
$string = str_replace(":cow-gif:","<img src=\"/img/stickers/yak.gif\" alt=\":cow-gif:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":easter-gif:","<img src=\"/img/stickers/easter-gif.gif\" alt=\":easter-gif:\" style=\"width: auto; height: 90px;\">",$string);

$string = str_replace(":ricardo:","<img src=\"/img/stickers/ricardo.png\" alt=\":ricardo:\" style=\"width: auto; height: 80px;\">",$string);
$string = str_replace(":ricardo-smile:","<img src=\"/img/stickers/ricardo-smile.png\" alt=\":ricardo-smile:\" style=\"width: auto; height: 80px;\">",$string);
// *** infinity sign *** //
$string = str_replace("âˆž","∞",$string);
$string = str_replace("RB:","<img src=\"/img/stickers/epic-rainbow.png\" alt=\"RB:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":ponything:","<img src=\"/img/stickers/pony-thing.png\" alt=\":ponything:\" style=\"width: $emoji_width; height: auto;\">",$string);
// *** Smiley *** //
//$string = str_replace(":)","<img src=\"/img/emojis/$emoji_type/smile.png\" alt=\":)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":smile:","<img src=\"/img/emojis/$emoji_type/smile.png\" alt=\":)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("☺","<img src=\"/img/emojis/$emoji_type/smile.png\" alt=\":)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🙂","<img src=\"/img/emojis/$emoji_type/smile.png\" alt=\":)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Tear *** //
//$string = str_replace(":'(","<img src=\"/img/emojis/$emoji_type/tear.png\" alt=\":'(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
//$string = str_replace(";(","<img src=\"/img/emojis/$emoji_type/tear.png\" alt=\":'(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":tear:","<img src=\"/img/emojis/$emoji_type/tear.png\" alt=\":'(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😢","<img src=\"/img/emojis/$emoji_type/tear.png\" alt=\":'(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Drool *** //
$string = str_replace(":&euro;","<img src=\"/img/emojis/$emoji_type/drool.png\" alt=\":€\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":drool:","<img src=\"/img/emojis/$emoji_type/drool.png\" alt=\":€\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🤤","<img src=\"/img/emojis/$emoji_type/drool.png\" alt=\":€\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Angry (red) *** //
$string = str_replace("]:[","<img src=\"/img/emojis/$emoji_type/angry_red.png\" alt=\"]:[\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":angry_red:","<img src=\"/img/emojis/$emoji_type/angry_red.png\" alt=\"]:[\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😡","<img src=\"/img/emojis/$emoji_type/angry_red.png\" alt=\"]:[\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Smirk *** //
//$string = str_replace(";/","<img src=\"/img/emojis/$emoji_type/smirk.png\" alt=\";/\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":smirk:","<img src=\"/img/emojis/$emoji_type/smirk.png\" alt=\";/\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😏","<img src=\"/img/emojis/$emoji_type/smirk.png\" alt=\";/\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Unamused *** //
//$string = str_replace("-_-","<img src=\"/img/emojis/$emoji_type/unamused.png\" alt=\"-_-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":unamused:","<img src=\"/img/emojis/$emoji_type/unamused.png\" alt=\"-_-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😑","<img src=\"/img/emojis/$emoji_type/unamused.png\" alt=\"-_-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Heart-Eyes *** //
//$string = str_replace("&amp;)","<img src=\"/img/emojis/$emoji_type/heart-eyes.png\" alt=\"&)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":heart-eyes:","<img src=\"/img/emojis/$emoji_type/heart-eyes.png\" alt=\"&)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😍","<img src=\"/img/emojis/$emoji_type/heart-eyes.png\" alt=\"&)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Halo *** //
//$string = str_replace("[]:]","<img src=\"/img/emojis/$emoji_type/halo.png\" alt=\"[]:]\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":halo:","<img src=\"/img/emojis/$emoji_type/halo.png\" alt=\"[]:]\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😇","<img src=\"/img/emojis/$emoji_type/halo.png\" alt=\"[]:]\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** No-Face *** //
//$string = str_replace(":1","<img src=\"/img/emojis/$emoji_type/no-face.png\" alt=\":1\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":no-face:","<img src=\"/img/emojis/$emoji_type/no-face.png\" alt=\":1\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😶","<img src=\"/img/emojis/$emoji_type/no-face.png\" alt=\":1\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Sunglasses *** //
$string = str_replace("B)","<img src=\"/img/emojis/$emoji_type/sunglasses.png\" alt=\"B)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
//$string = str_replace("8)","<img src=\"/img/emojis/$emoji_type/sunglasses.png\" alt=\"B)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":sunglasses:","<img src=\"/img/emojis/$emoji_type/sunglasses.png\" alt=\"B)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😎","<img src=\"/img/emojis/$emoji_type/sunglasses.png\" alt=\"B)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Exhausted *** //
//$string = str_replace("D:'","<img src=\"/img/emojis/$emoji_type/exhausted.png\" alt=\"D:'\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":exhausted:","<img src=\"/img/emojis/$emoji_type/exhausted.png\" alt=\"D:'\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😫","<img src=\"/img/emojis/$emoji_type/exhausted.png\" alt=\"D:'\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Sleep *** //
//$string = str_replace(":z","<img src=\"/img/emojis/$emoji_type/sleep.png\" alt=\":z\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":sleep:","<img src=\"/img/emojis/$emoji_type/sleep.png\" alt=\":z\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😴","<img src=\"/img/emojis/$emoji_type/sleep.png\" alt=\":z\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Sad *** //
//$string = str_replace(":(","<img src=\"/img/emojis/$emoji_type/sad.png\" alt=\":(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":sad:","<img src=\"/img/emojis/$emoji_type/sad.png\" alt=\":(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😞","<img src=\"/img/emojis/$emoji_type/sad.png\" alt=\":(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Cry *** //
//$string = str_replace(":&quot;(","<img src=\"/img/emojis/$emoji_type/cry.png\" alt=\":&quot;(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":cry:","<img src=\"/img/emojis/$emoji_type/cry.png\" alt=\":&quot;(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😭","<img src=\"/img/emojis/$emoji_type/cry.png\" alt=\":&quot;(\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Sick *** //
//$string = str_replace(":[]","<img src=\"/img/emojis/$emoji_type/sick.png\" alt=\":[]\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":sick:","<img src=\"/img/emojis/$emoji_type/sick.png\" alt=\":[]\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😷","<img src=\"/img/emojis/$emoji_type/sick.png\" alt=\":[]\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Dizzy *** //
//$string = str_replace("xO","<img src=\"/img/emojis/$emoji_type/dizzy.png\" alt=\"xO\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":dizzy:","<img src=\"/img/emojis/$emoji_type/dizzy.png\" alt=\"xO\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😵","<img src=\"/img/emojis/$emoji_type/dizzy.png\" alt=\"xO\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Fearful *** //
//$string = str_replace("D'8","<img src=\"/img/emojis/$emoji_type/fearful.png\" alt=\"D'8\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":fearful:","<img src=\"/img/emojis/$emoji_type/fearful.png\" alt=\"D'8\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😨","<img src=\"/img/emojis/$emoji_type/fearful.png\" alt=\"D'8\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Scream *** //
$string = str_replace(":scream:","<img src=\"/img/emojis/$emoji_type/scream.png\" alt=\"=O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😱","<img src=\"/img/emojis/$emoji_type/scream.png\" alt=\"=O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Crazy *** //
//$string = str_replace(";p","<img src=\"/img/emojis/$emoji_type/crazy.png\" alt=\";p\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":crazy:","<img src=\"/img/emojis/$emoji_type/crazy.png\" alt=\";p\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😜","<img src=\"/img/emojis/$emoji_type/crazy.png\" alt=\";p\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Surprised *** //
$string = str_replace(":surprised:","<img src=\"/img/emojis/$emoji_type/surprised.png\" alt=\":o\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😮","<img src=\"/img/emojis/$emoji_type/surprised.png\" alt=\":o\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Kiss *** //
//$string = str_replace(";*","<img src=\"/img/emojis/$emoji_type/kiss.png\" alt=\";*\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":kiss:","<img src=\"/img/emojis/$emoji_type/kiss.png\" alt=\";*\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😘","<img src=\"/img/emojis/$emoji_type/kiss.png\" alt=\";*\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Hushed *** //
//$string = str_replace(":#","<img src=\"/img/emojis/$emoji_type/hushed.png\" alt=\":#\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":hushed:","<img src=\"/img/emojis/$emoji_type/hushed.png\" alt=\":#\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😯","<img src=\"/img/emojis/$emoji_type/hushed.png\" alt=\":#\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Laughing *** //
//$string = str_replace("XD","<img src=\"/img/emojis/$emoji_type/laughing.png\" alt=\"XD\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":laughing:","<img src=\"/img/emojis/$emoji_type/laughing.png\" alt=\"XD\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😆","<img src=\"/img/emojis/$emoji_type/laughing.png\" alt=\"XD\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Laughing (tears) *** //
//$string = str_replace("X&quot;D","<img src=\"/img/emojis/$emoji_type/laughing_tears.png\" alt=\"X&quot;D\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":laughing_tears:","<img src=\"/img/emojis/$emoji_type/laughing_tears.png\" alt=\"X&quot;D\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😂","<img src=\"/img/emojis/$emoji_type/laughing_tears.png\" alt=\"X&quot;D\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Kissy *** //
//$string = str_replace(":*","<img src=\"/img/emojis/$emoji_type/kissy.png\" alt=\":*\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":kissy:","<img src=\"/img/emojis/$emoji_type/kissy.png\" alt=\":*\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😗","<img src=\"/img/emojis/$emoji_type/kissy.png\" alt=\":*\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Monkey (eyes) *** //
//$string = str_replace("$" . "O","<img src=\"/img/emojis/$emoji_type/monkey_eyes.png\" alt=\"&#36;O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":monkey_eyes:","<img src=\"/img/emojis/$emoji_type/monkey_eyes.png\" alt=\"&#36;O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🙈","<img src=\"/img/emojis/$emoji_type/monkey_eyes.png\" alt=\"&#36;O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Monkey (ears) *** //
//$string = str_replace("||O","<img src=\"/img/emojis/$emoji_type/monkey_ears.png\" alt=\"||O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":monkey_ears:","<img src=\"/img/emojis/$emoji_type/monkey_ears.png\" alt=\"||O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🙉","<img src=\"/img/emojis/$emoji_type/monkey_ears.png\" alt=\"||O\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Monkey (mouth) *** //
//$string = str_replace(":@","<img src=\"/img/emojis/$emoji_type/monkey_mouth.png\" alt=\":@\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":monkey_mouth:","<img src=\"/img/emojis/$emoji_type/monkey_mouth.png\" alt=\":@\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🙊","<img src=\"/img/emojis/$emoji_type/monkey_mouth.png\" alt=\":@\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Alien *** //
//$string = str_replace("&deg;v&deg;","<img src=\"/img/emojis/$emoji_type/alien.png\" alt=\"&deg;v&deg;\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":alien:","<img src=\"/img/emojis/$emoji_type/alien.png\" alt=\"&deg;v&deg;\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("👽","<img src=\"/img/emojis/$emoji_type/alien.png\" alt=\"&deg;v&deg;\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Ghost *** //
//$string = str_replace("(^O^)","<img src=\"/img/emojis/$emoji_type/ghost.png\" alt=\"(^O^)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":ghost:","<img src=\"/img/emojis/$emoji_type/ghost.png\" alt=\"(^O^)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("👻","<img src=\"/img/emojis/$emoji_type/ghost.png\" alt=\"(^O^)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Wink *** //
//$string = str_replace(";)","<img src=\"/img/emojis/$emoji_type/wink.png\" alt=\";)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":wink:","<img src=\"/img/emojis/$emoji_type/wink.png\" alt=\";)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😉","<img src=\"/img/emojis/$emoji_type/wink.png\" alt=\";)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Poo *** //
//$string = str_replace("/&Otilde;\\","<img src=\"/img/emojis/$emoji_type/poo.png\" alt=\"/Õ\\\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":poo:","<img src=\"/img/emojis/$emoji_type/poo.png\" alt=\"/Õ\\\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("💩","<img src=\"/img/emojis/$emoji_type/poo.png\" alt=\"/Õ\\\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Nerd *** //
//$string = str_replace("8}","<img src=\"/img/emojis/$emoji_type/nerd.png\" alt=\"8}\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":nerd:","<img src=\"/img/emojis/$emoji_type/nerd.png\" alt=\"8}\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🤓","<img src=\"/img/emojis/$emoji_type/nerd.png\" alt=\"8}\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Dissatisfied *** //
$string = str_replace(":dissatisfied:","<img src=\"/img/emojis/$emoji_type/dissatisfied.png\" alt=\":dissatisfied:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😒","<img src=\"/img/emojis/$emoji_type/dissatisfied.png\" alt=\":dissatisfied:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Thinker *** //
$string = str_replace(":thinker:","<img src=\"/img/emojis/$emoji_type/thinker.png\" alt=\":thinker:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🤔","<img src=\"/img/emojis/$emoji_type/thinker.png\" alt=\":thinker:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Silly  *** //
$string = str_replace(":silly:","<img src=\"/img/emojis/$emoji_type/silly.png\" alt=\":silly:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🙃","<img src=\"/img/emojis/$emoji_type/silly.png\" alt=\":silly:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Awkward  *** //
$string = str_replace(":awkward:","<img src=\"/img/emojis/$emoji_type/awkward.png\" alt=\":awkward:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("😬","<img src=\"/img/emojis/$emoji_type/awkward.png\" alt=\":awkward:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Injured  *** //
$string = str_replace(":injured:","<img src=\"/img/emojis/$emoji_type/injured.png\" alt=\":injured:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🤕","<img src=\"/img/emojis/$emoji_type/injured.png\" alt=\":injured:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Vomit  *** //
$string = str_replace(":vomit:","<img src=\"/img/emojis/$emoji_type/vomit.png\" alt=\":vomit:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🤢","<img src=\"/img/emojis/$emoji_type/vomit.png\" alt=\":vomit:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// ******************************************** //
// *************** EMOJI GESTURE ************** //
// ******************************************** //
// *** Peace *** //
//$string = str_replace("-Y-","<img src=\"/img/emojis/$emoji_type/peace.png\" alt=\"-Y-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":peace:","<img src=\"/img/emojis/$emoji_type/peace.png\" alt=\"-Y-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("✌","<img src=\"/img/emojis/$emoji_type/peace.png\" alt=\"-Y-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("✌️","<img src=\"/img/emojis/$emoji_type/peace.png\" alt=\"-Y-\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// ******************************************** //
// *************** EMOJI ANIMALS ************** //
// ******************************************** //
// *** Cat *** //
//$string = str_replace("^-^","<img src=\"/img/emojis/$emoji_type/cat.png\" alt=\"^-^\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":cat:","<img src=\"/img/emojis/$emoji_type/cat.png\" alt=\"^-^\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🐈","<img src=\"/img/emojis/$emoji_type/cat.png\" alt=\"^-^\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Snake *** //
//$string = str_replace("(S)","<img src=\"/img/emojis/$emoji_type/snake.png\" alt=\"(S)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":snake:","<img src=\"/img/emojis/$emoji_type/snake.png\" alt=\"(S)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🐍","<img src=\"/img/emojis/$emoji_type/snake.png\" alt=\"(S)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// ******************************************** //
// *************** EMOJI SYMBOLS ************** //
// ******************************************** //
// *** Boi  *** //
$string = str_replace(":boi:","<img src=\"/img/emojis/$emoji_type/boi.png\" alt=\":boi:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("👋","<img src=\"/img/emojis/$emoji_type/boi.png\" alt=\":boi:\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Heart (red) *** //
$string = str_replace("&lt;3","<img src=\"/img/emojis/$emoji_type/heart_red.png\" alt=\"<3\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":heart_red:","<img src=\"/img/emojis/$emoji_type/heart_red.png\" alt=\"<3\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("&hearts;","<img src=\"/img/emojis/$emoji_type/heart_red.png\" alt=\"<3\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("❤️","<img src=\"/img/emojis/$emoji_type/heart_red.png\" alt=\"<3\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
// *** Knife *** //
//$string = str_replace("(7)","<img src=\"/img/emojis/$emoji_type/knife.png\" alt=\"(7)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace(":knife:","<img src=\"/img/emojis/$emoji_type/knife.png\" alt=\"(7)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
$string = str_replace("🔪","<img src=\"/img/emojis/$emoji_type/knife.png\" alt=\"(7)\" style=\"width: $emoji_width; height: $emoji_width;\">",$string);
?>
