<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$app_uqid = "justaboard";
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM user_apps WHERE uid='$u_uid' && app_uqid='$app_uqid'")) == '0') {
	header("location: /hub");
	exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/app/justaboard') {
  $loc_desc = "usin\' Justin Soundboard";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/app/justaboard' WHERE uid='$u_uid'");
}
?>
<html>
	<head>
		<title>Justin Soundboard!</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
		<script src="script.js"></script>
	</head>
	<body>
		<h1>The Justin soundboard!</h1>
		<h2>If anyone is actually willing to put some better CSS code into this, please let me know.</h2>
		<h6>(I'm fucking terrible with design)</h6>
		<nav id="nav1">
			<a href="javascript:atehundollas.play()">$800</a>
			<br />
			<br />
			<br />
			<a href="javascript:atehunindick.play()">800 in dick</a>
			<br />
			<br />
			<br />
			<a href="javascript:autistic.play()">Autistic</a>
			<br />
			<br />
			<br />
			<a href="javascript:bathinginshit.play()">Bathing in shit</a>
			<br />
			<br />
			<br />
			<a href="javascript:bathtubcannonball.play()">Cannonballs into bathtub</a>
			<br />
			<br />
			<br />
			<a href="javascript:beingasnake.play()">Being a snake</a>
			<br />
			<br />
			<br />
			<a href="javascript:calcareoussponge.play()">Calcareous sponge</a>
			<br />
			<br />
			<br />
			<a href="javascript:cardboardcharger.play()">Cardboard charger</a>
			<br />
			<br />
			<br />
			<a href="javascript:checkthatout.play()">Check that out</a>
			<br />
			<br />
			<br />
			<a href="javascript:completeanduttershit.play()">Complete and utter shit</a>
			<br />
			<br />
			<br />
			<a href="javascript:contentcop.play()">Content cop</a>
			<br />
			<br />
			<br />
			<a href="javascript:contentdeputy.play()">Content deputy</a>
			<br />
			<br />
			<br />
			<a href="javascript:crazyasshit.play()">Crazy as shit</a>
			<br />
			<br />
			<br />
			<a href="javascript:dontmove.play()">Don't move</a>
			<br />
			<br />
			<br />
			<a href="javascript:filterfeeders.play()">Filter feeders</a>
			<br />
			<br />
			<br />
			<a href="javascript:fook.play()">Fook</a>
			<br />
			<br />
			<br />
			<a href="javascript:fucking.play()">FUCKING</a>
			<br />
			<br />
			<br />
			<a href="javascript:fuckingpussy.play()">Fucking pussy</a>
			<br />
			<br />
			<br />
			<a href="javascript:funnyaf.play()">Funny af</a>
			<br />
			<br />
			<br />
			<a href="javascript:giveyoupokemon.play()">Give you Pokemon</a>
			<br />
			<br />
			<br />
			<a href="javascript:gonetoshit.play()">Gone to shit</a>
			<br />
			<br />
			<br />
			<a href="javascript:h3h3productions.play()">h3h3productions</a>
			<br />
			<br />
			<br />
			<a href="javascript:healthyaf.play()">Healthy af</a>
			<br />
			<br />
			<br />
			<a href="javascript:hughmungus.play()">Hugh Mungus</a>
			<br />
			<br />
			<br />
			<a href="javascript:idubbz.play()">iDubbz</a>
			<br />
			<br />
			<br />
			<a href="javascript:keemstar.play()">Keemstar</a>
			<br />
			<br />
			<br />
			<a href="javascript:leafy.play()">Leafy</a>
			<br />
			<br />
			<br />
			<a href="javascript:lisp.play()">Lisp</a>
			<br />
			<br />
			<br />
			<a href="javascript:litrally.play()">Litrally</a>
			<br />
			<br />
			<br />
			<a href="javascript:mmob.play()">Minding my own business</a>
			<br />
			<br />
			<br />
			<a href="javascript:oobleck.play()">Oobleck</a>
			<br />
			<br />
			<br />
			<a href="javascript:ruinthatshit.play()">Ruin that shit</a>
			<br />
			<br />
			<br />
			<a href="javascript:sexualharassment.play()">Sexual harassment</a>
			<br />
			<br />
			<br />
			<a href="javascript:toomuchwater.play()">Too much water</a>
			<br />
			<br />
			<br />
			<a href="javascript:tourettes.play()">Tourettes</a>
			<br />
			<br />
			<br />
			<a href="javascript:triggered.play()">Triggered to the max</a>
			<br />
			<br />
			<br />
			<a href="javascript:wazzupdude.play()">What's up dude</a>
			<br />
			<br />
			<br />
			<a href="javascript:witaf.play()">What in the actual fuck</a>
			<br />
			<br />
			<br />
			<a href="javascript:worriedaboutchin.play()">Worried about chin</a>
		</nav>
	</body>
</html>
