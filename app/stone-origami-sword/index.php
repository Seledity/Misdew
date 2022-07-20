<?php
// CHECKS TO SEE IF USER OWNS APPLICATION
require_once("../../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$app_uqid = "stone-origami-sword";
if(mysqli_num_rows(mysqli_query($conx, "SELECT uid FROM user_apps WHERE uid='$u_uid' && app_uqid='$app_uqid'")) == '0') {
	header("location: /hub");
	exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/app/stone-origami-sword') {
  $loc_desc = "usin\' Stone Origami Sword";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/app/stone-origami-sword' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Blank HTML">

        <title>S.O.S. - Misdew</title>

        <link rel="stylesheet" href="main.css">
    </head>

    <body><center>

        <script src="./app.js"></script>
        <div class="title">


            <a href="/hub" style="text-decoration: none; color: #333;">Misdew</a>
            <br>
        </div>
        <table>
            <tr>
                <th id='rock' onclick="rockButton()"><img src="rock.png" alt="Rock"></th>
                <th id='paper' onclick="paperButton()"><img src="paper.png" alt="Paper"></th>
                <th id='scissors' onclick="scissorsButton()"><img src="scissors.png" alt="Scissors"></th>
            </tr>
        </table>

        <br>

        <div><a id='winStatic'></a><a id='winrate'>Good luck.</a></div>

        <br> <!-- Haha br go brrr -->

        <button id=buttonDiv onclick="button()"><a>Submit</button><br><br>
        <div><a id='bot'> </a></div>
        <div><a id='answer'> </a></div>

         <!-- AHaahaha br go brrrrrrrr-->



    </center></body>

</html>
