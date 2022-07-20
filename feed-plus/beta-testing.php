<?php
$this_page = "feed";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
#   #   #   #   #   #   #
#    WEBSITE LOCATION   #
#   #   #   #   #   #   #
if($u_siteloc != '/feed-plus') {
  $loc_desc = "browsin\' feed+ beta";
  mysqli_query($conx, "UPDATE accounts SET site_locdesc='$loc_desc' WHERE uid='$u_uid'");
  mysqli_query($conx, "UPDATE accounts SET site_locurl='/feed-plus' WHERE uid='$u_uid'");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Feed+ | Misdew.com</title>
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
  <style type="text/css">
  body {
    background-color: <?php echo $bgcolor; ?>;
  }
  #header_tds {
    color: <?php echo $tdcolor; ?> !important;
  }
  .header {
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 4px 4px rgba(0,0,0,0.23);
  }
  .feed_new_tds {
    padding: 10px;
    border-radius: 5em;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  }
  .shout_div_contain {
  position: relative;
  width: 95%;
  max-width: 500px;
  margin: auto;
  border-radius: 50px;
  }
  .shout_dislike {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  padding: 10px;
  position: absolute;
  width: 25px;
  height: 25px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -40%;
  right: 0%;
  z-index: 3;
  }
  .shout_like {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  padding: 10px;
  position: absolute;
  width: 25px;
  height: 25px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -40%;
  left: 0%;
  z-index: 3;
  }
  .feed_cmt_btn {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  position: absolute;
  padding: 10px;
  width: 25px;
  height: 25px;
  font-size: 20px;
  border-radius: 50px;
  display: inline-block;
  bottom: -40%;
  left:0%;
  right:0%;
  margin-left:auto;
  margin-right:auto;
  z-index: 3;
  }
  #fp_2 {
  background-color: #f7f7f7;
  background-image: url('/img/hub-bg1.png');
  background-repeat: repeat;
  }
  .feed_post, .ptb3_td1, .ptb3_td2, .ptb3_td3 {
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
  }
  .feed_parea {
  background-image: url('/img/hub-bg1.png');
  background-repeat: repeat;
  background-color: #f7f7f7;
  color: #000;
  }
  ::-webkit-input-placeholder {
  color: #808080;
  }
  :-moz-placeholder {
  color: #808080;
  opacity: 1;
  }
  ::-moz-placeholder {
  color: #808080;
  opacity: 1;
  }
  :-ms-input-placeholder {
  color: #808080;
  }
  .feed_search {
    border: none;
    font-size: 18px;
    width: 90%;
    font-family: 'Dosis', sans-serif;
    color: #000;
    background-color: #fff;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 3px;
  }
  </style>
</head>
<body>
  <center>
    <?php
    $back_button = true;
    $linebreak = true;
    $alerts = true;
    require_once("../inc/header.php");
    ?>
    <div id="feed_search_bar" style="display: none; padding-bottom: 10px;">
      <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; border-radius: 20px; color: #808080; padding: 3px; padding-left: 8px;padding-right: 8px;background-color: #fff;text-align: center;width: 90%; max-width: 300px;">
    <table style="border-radius: 20px; color: #808080; border-spacing: 0px; padding: 3px; padding-left: 8px;padding-right: 8px;background-color: #fff;text-align: center;width: 90%; max-width: 300px;">
      <tr>
        <td style="border-radius: 20px;text-align: center; background-color: #fff;">
          <i class="fa fa-search"></i>
        </td>
        <td style="border-radius: 20px;width: 100%; text-align: center; background-color: #fff;">
          <input name="search_input" id="search_input" class="feed_search" type="text" placeholder="search for posts, tags, users">
        </td>
      </tr>
    </table>
    <div id="feed_sresults" style="display: none;">
    <table style="border-top: 1px solid #e7e7e7; border-spacing: 0px; padding-top: 0px; padding-left: 8px;padding-right: 8px;text-align: center;width: 100%;">
      <tr>
        <td style="font-size: 12px; width: 100%; text-align: left; background-color: #fff;">
          coming soon
        </td>
      </tr>
    </table>
  </div>
</div>
    </div>







    <div id="postIt" style="display: none; padding-bottom: 10px;">
      <form id="feed_form" method="post" action="ppost.php">
        <table class="postbox_tb" style="border-top-left-radius: 1em; border-top-right-radius: 1em; background-color: #f7f7f7; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
          <tr>
            <td>
              <textarea id="fpostb" name="post" rows="4" class="feed_parea" placeholder="type something..."></textarea>
            </td>
          </tr>
        </table>
        <table class="postbox_tb" id="postbox_tb2" style="background-color: <?php echo $u_ucolor; ?> !important; color: <?php echo $u_tcolor; ?> !important; border-bottom-left-radius: 1em; border-bottom-right-radius: 1em; padding-top: 5px; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
            <td class="postbox2_td">
              <span id="vloader"><i onclick="var log_conf=confirm('Upload a video?\nMP4 Files Only');if(log_conf == true){selectVid();};" id="vPath" class="fa fa-film" aria-hidden="true" style="color: <?php echo $u_tcolor; ?> !important;"></i></span>
            </td>
            <td class="postbox2_td2">
              <input type="submit" value="post" class="postbox_sub" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: <?php echo $u_ucolor; ?> !important; color: <?php echo $u_tcolor; ?> !important; border: 1px solid <?php echo $u_tcolor; ?> !important;">
            </td>
            <td class="postbox2_td">
              <span id="loader"><i onclick="var log_conf=confirm('Upload an image?');if(log_conf == true){selectFile();};" id="fPath" class="fa fa-image" aria-hidden="true" style="color: <?php echo $u_tcolor; ?> !important;"></i></span>
            </td>
          </tr>
        </table>
      </form>
    </div>


    <div id="newPstBar" style="display: visible;">
      <table style="width: 80%; max-width: 400px; border-spacing: 10px; font-family: 'Dosis', sans-serif; text-align: center;">
        <tr>
          <td onclick="writePost();fpostb.focus();" class="feed_new_tds" style="background-color: #ff3c64;">
            <i class="fa fa-align-left"></i> Post
          </td>
          <td onclick="alert('Polls are being upgraded.');" class="feed_new_tds" style="background-color: #ff3c64;">
            <i class="fa fa-bar-chart"></i> Poll
          </td>
          <td onclick="XpandSearch('feed_search_bar');" class="feed_new_tds" style="background-color: #ff3c64;">
            <i class="fa fa-search"></i> Search
          </td>
        </tr>
      </table>
    </div>

    <div style="font-size: 12px; font-family: 'Dosis', sans-serif; color: #808080; padding-top: 8px; width: 95%; max-width: 500px;">
      <i class="fa fa-rss"></i> sorted by newest <br>
      <!--<i class="fa fa-clock-o"></i> sorted by oldest-->
    </div>
    <br>

    <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top-left-radius: 1em;border-top-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #53c5bf; width: 95%; max-width: 500px; background-color: #333;">
      <table style="width: 100%; padding: 10px; padding-top: 5px; padding-bottom: 5px;text-align: left;">
        <tr>
          <td>
            <i class="fa fa-align-left"></i>
          </td>
          <td style="text-align: left;">
            <div style="position: relative; width: 36px; height: 36px; border-radius: 50px;">
              <div style="background-color: #00FF00; border: 2px solid #333; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;">
              </div>
              <img onclick="window.location='/canvas/Lock';" src="https://misdew.com/img/uploads/51__pjKI3mMhNEnbiA.gif" class="list_picture">
            </div>
          </td>
          <td style="width: 100%;font-weight: bold;text-align: left;">
            Lock <i class="fa fa-check-circle"></i> <span style="font-weight: normal; font-size: 12px;">&bull; 32m ago</span>
          </td>
          <td style="font-weight: bold;text-align: right;">
            <i class="fa fa-pencil"></i>
          </td>
          <td style="font-weight: bold;text-align: right;"></td>
          <td style="font-weight: bold;text-align: right;">
            <i class="fa fa-trash"></i>
          </td>
          <td style="font-weight: bold;text-align: right;"></td>
          <td style="font-weight: bold;text-align: right;">
            <i class="fa fa-external-link-square"></i>
          </td>
        </tr>
      </table>
    </div>
    <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;">
      <table style="width: 100%; padding: 10px; text-align: left;">
        <tr>
          <td>
            Hello, <br> welcome to the new feed. <br> This post isn't real and was made by <b>@Seledity</b>. <br><br> G'day.
          </td>
        </tr>
      </table>
    </div>
    <div style="border-top: 1px solid #cecece; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #808080; width: 95%; max-width: 500px; background-color: #E5E5E5;">
      <table style="font-size: 13px; color: #808080; text-align: center; width: 100%; padding: 10px; padding-bottom: 0px; padding-top: 0px; text-align: left;">
        <tr>
          <td style="text-align: left; width: 33.3333333333%;">
            <b>2</b> likes
          </td>
          <td style="text-align: center; width: 33.3333333333%;">
            <b>0</b> comments
          </td>
          <td style="text-align: right; width: 33.3333333333%;">
            <b>2</b> dislikes
          </td>
        </tr>
      </table>
    </div>
    </div>
    <div class="shout_div_contain">
    <div class="shout_like" style="background-color: #53c5bf;"><i class="fa fa-thumbs-up" style="color: #333;"></i></div>
    <div onclick="showComments('show_comments_1234','1234','#333','#53c5bf');" id="cmtbtn_1234" class="feed_cmt_btn" style="background-color: #333"><i id="cmtbtxt_1234" class="fa fa-comment" style="color: #53c5bf;"></i></div>
    <div class="shout_dislike" style="background-color: #333;"><i class="fa fa-thumbs-down" style="color: #53c5bf;"></i></div>
  <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: #333; font-family: 'Dosis', sans-serif; padding: 8px;  color: #fff;">
    &nbsp;
  </div></div>
  <div id="show_comments_1234" style="display: none; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-bottom-left-radius: 1em;border-bottom-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;">
    <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #333; width: 100%; background-color: #53c5bf;">
      <table style="width: 100%; text-align: left;padding-top: 12px;">
        <tr>
          <td style="color: #333; font-size: 12px;">
            liked by <b>Seledity</b>, <b>Lock</b> <br>
            disliked by <b>Makari</b>, <b>R</b>
          </td>
        </tr>
      </table>
    </div>
    <div style="box-shadow: 0 1px 6px rgba(0,0,0,0.16), 0 1px 6px rgba(0,0,0,0.23);padding-top: 4px; padding-bottom: 4px;text-align: left;font-family: 'Dosis', sans-serif; color: #53c5bf; width: 100%; background-color: #333;">
      <table style="width: 100%; color: #53c5bf; padding-right: 8px; padding-left: 8px;">
        <tr>
          <td>
            <i class="fa fa-image"></i>
          </td>
          <td></td>
          <td>
            <i class="fa fa-film"></i>
          </td>
          <td style="width: 100%;word-break:break-word;">
            <div name="body" class="comment_" id="comment_" placeholder="write a comment..." style="width: 98%;padding: 8px;font-family: 'Dosis', sans-serif; font-size: 15px; color: #53c5bf; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #333; outline: none; text-align: left;" contenteditable>
              write something...
            </div>
          </td>
          <td style="padding-left: 8px;">
            <i class="fa fa-paper-plane"></i>
          </td>
        </tr>
      </table>
    </div>
    comments will look the same
  </div>
  <br><br>

















  <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top-left-radius: 1em;border-top-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #F9F891; width: 95%; max-width: 500px; background-color: #15284F;">
    <table style="width: 100%; padding: 10px; padding-top: 5px; padding-bottom: 5px;text-align: left;">
      <tr>
        <td>
          <i class="fa fa-bar-chart"></i>
        </td>
        <td style="text-align: left;">
          <div style="position: relative; width: 36px; height: 36px; border-radius: 50px;">
            <div style="background-color: #00FF00; border: 2px solid #15284F; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;">
            </div>
            <img onclick="window.location='/canvas/Seledity';" src="https://misdew.com/img/uploads/1__cByPFJDLVQTiK3.jpeg" class="list_picture">
          </div>
        </td>
        <td style="width: 100%;font-weight: bold;text-align: left;">
          Seledity <i class="fa fa-check-circle"></i> <span style="font-weight: normal; font-size: 12px;">&bull; 1h ago</span>
        </td>
        <td style="font-weight: bold;text-align: right;">
          <i class="fa fa-trash"></i>
        </td>
        <td style="font-weight: bold;text-align: right;">

        </td>
        <td style="font-weight: bold;text-align: right;">
          <i class="fa fa-external-link-square"></i>
        </td>
      </tr>
    </table>
  </div>
  <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;">
    <table style="width: 100%; padding: 10px; padding-bottom: 0px; text-align: left;">
      <tr>
        <td>
          What do you think about Feed+ so far?
        </td>
      </tr>
    </table>
    <table style="color: #5d5d5d; border-collapse:separate; border-spacing:0 10px;width: 100%; padding: 10px; padding-top: 0px; padding-bottom: 0px; text-align: left;">
      <tr>
        <td style="font-weight: bold; background-color: #c0c0c0; border: 1px solid #a6a6a6; padding: 8px; border-radius: 10px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
          <span style="font-weight: normal; font-size: 12px;">50% &bull;</span> I think that it's pretty cool.
        </td>
      </tr>
      <tr>
        <td style="font-weight: bold; background-color: #e1e1e1; padding: 8px; border-radius: 10px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
          <span style="font-weight: normal; font-size: 12px;">30% &bull;</span> Ugly as fuck. Feed>
        </td>
      </tr>
      <tr>
        <td style="font-weight: bold; background-color: #e1e1e1; padding: 8px; border-radius: 10px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
          <span style="font-weight: normal; font-size: 12px;">20% &bull;</span> Idgaf. Kill yourself, faggot.
        </td>
      </tr>
    </table>
    <table style="width: 100%; padding: 10px; padding-top: 0px; text-align: left;">
      <tr>
        <td style="font-size: 12px; color: #808080;">
          17 total votes - no time limit
        </td>
      </tr>
    </table>
  </div>
  <div style="border-top: 1px solid #cecece; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #808080; width: 95%; max-width: 500px; background-color: #E5E5E5;">
    <table style="font-size: 13px; color: #808080; text-align: center; width: 100%; padding: 10px; padding-bottom: 0px; padding-top: 0px; text-align: left;">
      <tr>
        <td style="text-align: left; width: 33.3333333333%;">
          <b>4</b> likes
        </td>
        <td style="text-align: center; width: 33.3333333333%;">
          <b>0</b> comments
        </td>
        <td style="text-align: right; width: 33.3333333333%;">
          <b>7</b> dislikes
        </td>
      </tr>
    </table>
  </div>
  </div>
  <div class="shout_div_contain">
  <div class="shout_like" style="background-color: #F9F891;"><i class="fa fa-thumbs-up" style="color: #15284F;"></i></div>
  <div onclick="showComments('show_comments_5678','5678','#15284F','#F9F891');" id="cmtbtn_5678" class="feed_cmt_btn" style="background-color: #15284F"><i id="cmtbtxt_5678" class="fa fa-comment" style="color: #F9F891;"></i></div>
  <div class="shout_dislike" style="background-color: #15284F;"><i class="fa fa-thumbs-down" style="color: #F9F891;"></i></div>
<div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: #15284F; font-family: 'Dosis', sans-serif; padding: 8px;  color: #fff;">
  &nbsp;
</div></div>
<div id="show_comments_5678" style="display: none; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-bottom-left-radius: 1em;border-bottom-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;">
  <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #15284F; width: 100%; background-color: #F9F891;">
    <table style="width: 100%; text-align: left;padding-top: 12px;">
      <tr>
        <td style="color: #15284F; font-size: 12px;">
          liked by <b>Seledity</b>, <b>Lock</b>, <b>Yak</b>, <b>Makari</b> <br>
          disliked by <b>xperttheef</b>, <b>R</b>, <b>sbus</b>, <b>narjis321</b>, <b>Deku</b>, <b>cooldude101</b>, <b>Todoroki</b>
        </td>
      </tr>
    </table>
  </div>
  <div style="box-shadow: 0 1px 6px rgba(0,0,0,0.16), 0 1px 6px rgba(0,0,0,0.23);padding-top: 4px; padding-bottom: 4px;text-align: left;font-family: 'Dosis', sans-serif; color: #F9F891; width: 100%; background-color: #15284F;">
    <table style="width: 100%; color: #F9F891; padding-right: 8px; padding-left: 8px;">
      <tr>
        <td>
          <i class="fa fa-image"></i>
        </td>
        <td>
          <i class="fa fa-film"></i>
        </td>
        <td style="width: 100%;word-break:break-word;">
          <div name="body" class="comment_" id="comment_" placeholder="write a comment..." style="width: 98%;padding: 8px;font-family: 'Dosis', sans-serif; font-size: 15px; color: #F9F891; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: #15284F; outline: none; text-align: left;" contenteditable>
            write something...
          </div>
        </td>
        <td style="padding-left: 8px;">
          <i class="fa fa-paper-plane"></i>
        </td>
      </tr>
    </table>
  </div>
  comments will look the same
</div> <br><br>







































<div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-top-left-radius: 1em;border-top-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #fff; width: 95%; max-width: 500px; background-color: blue;">
  <table style="width: 100%; padding: 10px; padding-top: 5px; padding-bottom: 5px;text-align: left;">
    <tr>
      <td>
        <i class="fa fa-align-left"></i>
      </td>
      <td style="text-align: left;">
        <div style="position: relative; width: 36px; height: 36px; border-radius: 50px;">
          <div style="background-color: #00FF00; border: 2px solid blue; position: absolute; width: 8px; height: 8px; border-radius: 50px; display: inline-block; bottom: 0; right: 0; z-index: 3;">
          </div>
          <img onclick="window.location='/canvas/xperttheef';" src="/img/logo.png" class="list_picture">
        </div>
      </td>
      <td style="width: 100%;font-weight: bold;text-align: left;">
        xperttheef <span style="font-weight: normal; font-size: 12px;">&bull; 3h ago</span>
      </td>
      <td style="font-weight: bold;text-align: right;">
        <i class="fa fa-pencil"></i>
      </td>
      <td style="font-weight: bold;text-align: right;"></td>
      <td style="font-weight: bold;text-align: right;">
        <i class="fa fa-trash"></i>
      </td>
      <td style="font-weight: bold;text-align: right;"></td>
      <td style="font-weight: bold;text-align: right;">
        <i class="fa fa-external-link-square"></i>
      </td>
    </tr>
  </table>
</div>
<div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;">
  <table style="width: 100%; padding: 10px; text-align: left;">
    <tr>
      <td>
        plz help mi acount was haked this isnt mi <br> plez disable nordvpn hacks *cries* <br><br> This post isn't real and was made by <b>@Seledity</b>. <br><br> G'day.
      </td>
    </tr>
  </table>
</div>
<div style="border-top: 1px solid #cecece; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: #808080; width: 95%; max-width: 500px; background-color: #E5E5E5;">
  <table style="font-size: 13px; color: #808080; text-align: center; width: 100%; padding: 10px; padding-bottom: 0px; padding-top: 0px; text-align: left;">
    <tr>
      <td style="text-align: left; width: 33.3333333333%;">
        <b>1</b> like
      </td>
      <td style="text-align: center; width: 33.3333333333%;">
        <b>0</b> comments
      </td>
      <td style="text-align: right; width: 33.3333333333%;">
        <b>1</b> dislike
      </td>
    </tr>
  </table>
</div>
</div>
<div class="shout_div_contain">
<div class="shout_like" style="background-color: blue;"><i class="fa fa-thumbs-up" style="color: #fff;"></i></div>
<div onclick="showComments('show_comments_8765','8765','blue','#fff');" id="cmtbtn_8765" class="feed_cmt_btn" style="background-color: blue"><i id="cmtbtxt_8765" class="fa fa-comment" style="color: #fff;"></i></div>
<div class="shout_dislike" style="background-color: #fff;"><i class="fa fa-thumbs-down" style="color: blue;"></i></div>
<div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);background-color: blue; font-family: 'Dosis', sans-serif; padding: 8px;  color: #fff;">
&nbsp;
</div></div>
<div id="show_comments_8765" style="display: none; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);border-bottom-left-radius: 1em;border-bottom-right-radius: 1em; font-family: 'Dosis', sans-serif; color: #000; width: 95%; max-width: 500px; background-color: #f7f7f7;">
<div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);font-family: 'Dosis', sans-serif; color: blue; width: 100%; background-color: #fff;">
  <table style="width: 100%; text-align: left;padding-top: 12px;">
    <tr>
      <td style="color: blue; font-size: 12px;">
        liked by <b>xperttheef</b><br>
        disliked by <b>ponything</b>
      </td>
    </tr>
  </table>
</div>
<div style="box-shadow: 0 1px 6px rgba(0,0,0,0.16), 0 1px 6px rgba(0,0,0,0.23);padding-top: 4px; padding-bottom: 4px;text-align: left;font-family: 'Dosis', sans-serif; color: #fff; width: 100%; background-color: blue;">
  <table style="width: 100%; color: #fff; padding-right: 8px; padding-left: 8px;">
    <tr>
      <td>
        <i class="fa fa-image"></i>
      </td>
      <td>
        <i class="fa fa-film"></i>
      </td>
      <td style="width: 100%;word-break:break-word;">
        <div name="body" class="comment_" id="comment_" placeholder="write a comment..." style="width: 98%;padding: 8px;font-family: 'Dosis', sans-serif; font-size: 15px; color: #fff; -webkit-appearance: none; -moz-appearance: none; appearance: none; border: none; background-color: blue; outline: none; text-align: left;" contenteditable>
          write something...
        </div>
      </td>
      <td style="padding-left: 8px;">
        <i class="fa fa-paper-plane"></i>
      </td>
    </tr>
  </table>
</div>
comments will look the same
</div>

  <br><div id="sdf">
    <table style="width: 60%; max-width: 300px; border-spacing: 10px; font-family: 'Dosis', sans-serif; text-align: center;">
      <tr>
        <td class="feed_new_tds" style="background-color: #ff3c64; font-size: 20px;">
          <i class="fa fa-chevron-circle-down fa-lg"></i>
        </td>
      </tr>
    </table>
  </div>



    <?php
    require_once("../inc/footer.php");
    ?>
  </center>
  </div>
  <script>
  function writePost() {
    Xpand('postIt');
  }
  function showComments(id, post_id, bgcolor, txtcolor) {
    var e = document.getElementById(id);
    var did = "#" + id;
    var cmt_btn_did = "cmtbtn_" + post_id;
    var cmt_btn_txt_did = "cmtbtxt_" + post_id;
    if(e.style.display == '') {
      $(did).slideUp(500);
      document.getElementById(cmt_btn_did).style.backgroundColor = bgcolor;
      document.getElementById(cmt_btn_txt_did).style.color = txtcolor;
    }
    else {
      $(did).slideDown(500);
      document.getElementById(cmt_btn_did).style.backgroundColor = txtcolor;
      document.getElementById(cmt_btn_txt_did).style.color = bgcolor;
      e.style.display = '';
    }
  }
  function Xpand(id) {
    var e = document.getElementById(id);
    var slid = "#" + id;
    if(e.style.display == '') {
      $(slid).slideUp(100);
    }
    else {
      $(slid).slideDown(100);
      e.style.display = '';
    }
  }
  function XpandSearch(id) {
    var e = document.getElementById(id);
    var hidden_id = "#" + id;
    if(e.style.display == '') {
      $(hidden_id).slideUp(100);
    }
    else {
      $(hidden_id).slideDown(100);
      document.getElementById("search_input").focus();
      e.style.display = '';
      alert('Search does not work yet.');
    }
  }
  </script>
</body>
</html>
