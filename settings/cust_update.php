<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
// Update Emoji
$upd_emoji = safe($_POST['emoji']);
if(isset($upd_emoji)) {
  // Facebook
  if($upd_emoji == 'facebook') {
    mysqli_query($conx, "UPDATE accounts SET emoji_type='$upd_emoji' WHERE uid='$u_uid'");
  }
  // Google
  if($upd_emoji == 'google') {
    mysqli_query($conx, "UPDATE accounts SET emoji_type='$upd_emoji' WHERE uid='$u_uid'");
  }
  // Apple
  if($upd_emoji == 'apple') {
    mysqli_query($conx, "UPDATE accounts SET emoji_type='$upd_emoji' WHERE uid='$u_uid'");
  }
}
// Update Sticker
$upd_sticker = safe($_POST['sticker']);
if(isset($upd_sticker)) {
  // no icon
  if($upd_sticker == 'x') {
    $upd_sticker_url = "";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }


  // kane
  if($upd_sticker == 'kane') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".gif";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }

  // egg1
  if($upd_sticker == 'egg-1') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // egg2
  if($upd_sticker == 'egg-2') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // ricardo
  if($upd_sticker == 'ricardo') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // ricardo-smile
  if($upd_sticker == 'ricardo-smile') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }


  // meruem
  if($upd_sticker == 'meruem') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // hisoka
  if($upd_sticker == 'hisoka') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pouf
  if($upd_sticker == 'pouf') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // frodge
  if($upd_sticker == 'frodge') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // lovebirds
  if($upd_sticker == 'lovebirds') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }


  // cake
  if($upd_sticker == 'cake') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }

  // pepe
  if($upd_sticker == 'pepe') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pepe
  if($upd_sticker == 'yak') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".gif";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }

  // santa
  if($upd_sticker == 'santa') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // tree
  if($upd_sticker == 'tree') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // snowman
  if($upd_sticker == 'snowman') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // jew
  if($upd_sticker == 'jew') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }



  // atom
  if($upd_sticker == 'atom') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // banana
  if($upd_sticker == 'banana') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // basicbanana
  if($upd_sticker == 'basicbanana') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // bunny
  if($upd_sticker == 'bunny') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // cassette
  if($upd_sticker == 'cassette') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // cheshire
  if($upd_sticker == 'cheshire') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // clown
  if($upd_sticker == 'clown') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // coolcat
  if($upd_sticker == 'coolcat') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // cow
  if($upd_sticker == 'cow') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // crab
  if($upd_sticker == 'crab') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // crystals
  if($upd_sticker == 'crystals') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // doge
  if($upd_sticker == 'doge') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // donut
  if($upd_sticker == 'donut') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // duck
  if($upd_sticker == 'duck') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // elephant
  if($upd_sticker == 'elephant') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // fireguy
  if($upd_sticker == 'fireguy') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // flame
  if($upd_sticker == 'flame') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // fox
  if($upd_sticker == 'fox') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // gator
  if($upd_sticker == 'gator') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // gba
  if($upd_sticker == 'gba') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // ghosty
  if($upd_sticker == 'ghosty') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // globe
  if($upd_sticker == 'globe') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // greenbulb
  if($upd_sticker == 'greenbulb') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // grumpy
  if($upd_sticker == 'grumpy') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // highkitty
  if($upd_sticker == 'highkitty') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // icecream
  if($upd_sticker == 'icecream') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // illuminati
  if($upd_sticker == 'illuminati') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // jelly
  if($upd_sticker == 'jelly') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // knife
  if($upd_sticker == 'knife') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // leafy
  if($upd_sticker == 'leafy') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // loveballs
  if($upd_sticker == 'loveballs') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // mariostar
  if($upd_sticker == 'mariostar') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // monkee
  if($upd_sticker == 'monkee') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // motherboard
  if($upd_sticker == 'motherboard') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // nutella
  if($upd_sticker == 'nutella') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // owl
  if($upd_sticker == 'owl') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pacifier
  if($upd_sticker == 'pacifier') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pengiun
  if($upd_sticker == 'pengiun') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // picklerick
  if($upd_sticker == 'picklerick') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pikachu
  if($upd_sticker == 'pikachu') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pocketwatch
  if($upd_sticker == 'pocketwatch') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // poison
  if($upd_sticker == 'poison') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // poo
  if($upd_sticker == 'poo') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // popsicle
  if($upd_sticker == 'popsicle') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // pug
  if($upd_sticker == 'pug') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // puppy
  if($upd_sticker == 'puppy') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // rickandmorty
  if($upd_sticker == 'rickandmorty') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // rocket
  if($upd_sticker == 'rocket') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // ryuk
  if($upd_sticker == 'ryuk') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // scooter
  if($upd_sticker == 'scooter') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // shootingstar
  if($upd_sticker == 'shootingstar') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // siamese
  if($upd_sticker == 'siamese') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // skellington
  if($upd_sticker == 'skellington') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // squirrel
  if($upd_sticker == 'squirrel') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // totoro
  if($upd_sticker == 'totoro') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // wolf
  if($upd_sticker == 'wolf') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
  // foxoroomba
  if($upd_sticker == 'foxoroomba') {
    $upd_sticker_url = "/img/stickers/" . $upd_sticker . ".png";
    mysqli_query($conx, "UPDATE accounts SET sticker='$upd_sticker_url' WHERE uid='$u_uid'");
  }
}
?>
