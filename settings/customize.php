<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
?>
<div id="settings_upd">
  no changes detected
</div>
<div class="settings_cont">
  <table style="width: 100%; padding: 8px;">
    <tr>
      <td>
        <span class="settings_title">
          Emoji
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
            You can change the way you view emoji on the site here.
            <?php if($u_emoji_type == 'custom') { echo "<div id=\"custom_emoji\">Your emoji is currently a custom set from another app.</div>"; } ?>
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updEmoji('facebook');" name="emoji" value="facebook" type="radio"<?php if($u_emoji_type == 'facebook') { echo " checked"; } ?>>
        <img src="/img/emojis/facebook/heart-eyes.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/smile.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/wink.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/drool.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/ghost.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/poo.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/heart_red.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/facebook/boi.png" alt="" style="width: 20px; height: 20px;">
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updEmoji('google');" name="emoji" value="google" type="radio"<?php if($u_emoji_type == 'google') { echo " checked"; } ?>>
        <img src="/img/emojis/google/heart-eyes.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/smile.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/wink.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/drool.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/ghost.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/poo.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/heart_red.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/google/boi.png" alt="" style="width: 20px; height: 20px;">
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="updEmoji('apple');" name="emoji" value="apple" type="radio"<?php if($u_emoji_type == 'apple') { echo " checked"; } ?>>
        <img src="/img/emojis/apple/heart-eyes.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/smile.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/wink.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/drool.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/ghost.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/poo.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/heart_red.png" alt="" style="width: 20px; height: 20px;">
        <img src="/img/emojis/apple/boi.png" alt="" style="width: 20px; height: 20px;">
      </td>
    </tr>
  </table>
    <table style="width: 100%; padding: 8px;">
      <tr>
        <td>
          <span class="settings_title">
            Chat: Force Dark Mode
          </span>
        </td>
      </tr>
      <tr>
        <td>
          <span class="settings_desc">
              Toggle whether or not Chat should be forced to use Dark Mode. <br>
              You must have Dark Mode purchased for the Chat to change this. <br>
              If you don't already have Dark Mode- buy it in Chat by clicking the "+"

          </span>
        </td>
      </tr>
      <tr>
        <td>
          <input onchange="updChatTheme('yes');" name="chattheme" value="chattheme" type="radio"<?php if($u_chatdark_def == 'yes') { echo " checked"; } ?>>
          on
        </td>
      </tr>
      <tr>
        <td>
          <input onchange="updChatTheme('no');" name="chattheme" value="chattheme" type="radio"<?php if($u_chatdark_def == 'no') { echo " checked"; } ?>>
          off<br><br>
        </td>
      </tr>
    <tr>
      <td>
        <span class="settings_title">
          Sticker
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
            You can change your site sticker here. Tap a sticker below or tap <span onclick="updSticker('x')" style="text-decoration: underline;">here</span> to set your sticker to nothing.
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <img onclick="updSticker('kane')" src="/img/stickers/kane.gif" alt="" style="height: 40px;">
        <img onclick="updSticker('egg-1')" src="/img/stickers/egg-1.png" alt="" style="height: 40px;">
        <img onclick="updSticker('egg-2')" src="/img/stickers/egg-2.png" alt="" style="height: 40px;">
        <img onclick="updSticker('ricardo-smile')" src="/img/stickers/ricardo-smile.png" alt="" style="height: 40px;">
        <img onclick="updSticker('ricardo')" src="/img/stickers/ricardo.png" alt="" style="height: 40px;">
        <img onclick="updSticker('meruem')" src="/img/stickers/meruem.png" alt="" style="height: 40px;">
        <img onclick="updSticker('hisoka')" src="/img/stickers/hisoka.png" alt="" style="height: 40px;">
        <img onclick="updSticker('pouf')" src="/img/stickers/pouf.png" alt="" style="height: 40px;">
        <img onclick="updSticker('frodge')" src="/img/stickers/frodge.png" alt="" style="height: 40px;">
        <img onclick="updSticker('lovebirds')" src="/img/stickers/lovebirds.png" alt="" style="height: 40px;">
        <img onclick="updSticker('cake')" src="/img/stickers/cake.png" alt="" style="height: 40px;">
        <img onclick="updSticker('yak')" src="/img/stickers/yak.gif" alt="" style="height: 40px;">
        <img onclick="updSticker('pepe')" src="/img/stickers/pepe.png" alt="" style="height: 40px;">
        <img onclick="updSticker('santa')" src="/img/stickers/santa.png" alt="" style="height: 40px;">
        <img onclick="updSticker('tree')" src="/img/stickers/tree.png" alt="" style="height: 40px;">
        <img onclick="updSticker('snowman')" src="/img/stickers/snowman.png" alt="" style="height: 40px;">
        <img onclick="updSticker('jew')" src="/img/stickers/jew.png" alt="" style="height: 40px;">
        <img onclick="updSticker('atom')" src="/img/stickers/atom.png" alt="" style="height: 40px;">
        <img onclick="updSticker('banana')" src="/img/stickers/banana.png" alt="" style="height: 40px;">
        <img onclick="updSticker('basicbanana')" src="/img/stickers/basicbanana.png" alt="" style="height: 40px;">
        <img onclick="updSticker('bunny')" src="/img/stickers/bunny.png" alt="" style="height: 40px;">
        <img onclick="updSticker('cassette')" src="/img/stickers/cassette.png" alt="" style="height: 40px;">
        <img onclick="updSticker('cheshire')" src="/img/stickers/cheshire.png" alt="" style="height: 40px;">
        <img onclick="updSticker('clown')" src="/img/stickers/clown.png" alt="" style="height: 40px;">
        <img onclick="updSticker('coolcat')" src="/img/stickers/coolcat.png" alt="" style="height: 40px;">
        <img onclick="updSticker('cow')" src="/img/stickers/cow.png" alt="" style="height: 40px;">
        <img onclick="updSticker('crab')" src="/img/stickers/crab.png" alt="" style="height: 40px;">
        <img onclick="updSticker('crystals')" src="/img/stickers/crystals.png" alt="" style="height: 40px;">
        <img onclick="updSticker('doge')" src="/img/stickers/doge.png" alt="" style="height: 40px;">
        <img onclick="updSticker('donut')" src="/img/stickers/donut.png" alt="" style="height: 40px;">
        <img onclick="updSticker('duck')" src="/img/stickers/duck.png" alt="" style="height: 40px;">
        <img onclick="updSticker('elephant')" src="/img/stickers/elephant.png" alt="" style="height: 40px;">
        <img onclick="updSticker('fireguy')" src="/img/stickers/fireguy.png" alt="" style="height: 40px;">
        <img onclick="updSticker('flame')" src="/img/stickers/flame.png" alt="" style="height: 40px;">
        <img onclick="updSticker('fox')" src="/img/stickers/fox.png" alt="" style="height: 40px;">
        <img onclick="updSticker('gator')" src="/img/stickers/gator.png" alt="" style="height: 40px;">
        <img onclick="updSticker('gba')" src="/img/stickers/gba.png" alt="" style="height: 40px;">
        <img onclick="updSticker('ghosty')" src="/img/stickers/ghosty.png" alt="" style="height: 40px;">
        <img onclick="updSticker('globe')" src="/img/stickers/globe.png" alt="" style="height: 40px;">
        <img onclick="updSticker('greenbulb')" src="/img/stickers/greenbulb.png" alt="" style="height: 40px;">
        <img onclick="updSticker('grumpy')" src="/img/stickers/grumpy.png" alt="" style="height: 40px;">
        <img onclick="updSticker('highkitty')" src="/img/stickers/highkitty.png" alt="" style="height: 40px;">
        <img onclick="updSticker('icecream')" src="/img/stickers/icecream.png" alt="" style="height: 40px;">
        <img onclick="updSticker('illuminati')" src="/img/stickers/illuminati.png" alt="" style="height: 40px;">
        <img onclick="updSticker('jelly')" src="/img/stickers/jelly.png" alt="" style="height: 40px;">
        <img onclick="updSticker('knife')" src="/img/stickers/knife.png" alt="" style="height: 40px;">
        <img onclick="updSticker('leafy')" src="/img/stickers/leafy.png" alt="" style="height: 40px;">
        <img onclick="updSticker('loveballs')" src="/img/stickers/loveballs.png" alt="" style="height: 40px;">
        <img onclick="updSticker('mariostar')" src="/img/stickers/mariostar.png" alt="" style="height: 40px;">
        <img onclick="updSticker('monkee')" src="/img/stickers/monkee.png" alt="" style="height: 40px;">
        <img onclick="updSticker('motherboard')" src="/img/stickers/motherboard.png" alt="" style="height: 40px;">
        <img onclick="updSticker('nutella')" src="/img/stickers/nutella.png" alt="" style="height: 40px;">
        <img onclick="updSticker('owl')" src="/img/stickers/owl.png" alt="" style="height: 40px;">
        <img onclick="updSticker('pacifier')" src="/img/stickers/pacifier.png" alt="" style="height: 40px;">
        <img onclick="updSticker('pengiun')" src="/img/stickers/pengiun.png" alt="" style="height: 40px;">
        <img onclick="updSticker('picklerick')" src="/img/stickers/picklerick.png" alt="" style="height: 40px;">
        <img onclick="updSticker('pikachu')" src="/img/stickers/pikachu.png" alt="" style="height: 40px;">
        <img onclick="updSticker('pocketwatch')" src="/img/stickers/pocketwatch.png" alt="" style="height: 40px;">
        <img onclick="updSticker('poison')" src="/img/stickers/poison.png" alt="" style="height: 40px;">
        <img onclick="updSticker('poo')" src="/img/stickers/poo.png" alt="" style="height: 40px;">
        <img onclick="updSticker('popsicle')" src="/img/stickers/popsicle.png" alt="" style="height: 40px;">
        <img onclick="updSticker('pug')" src="/img/stickers/pug.png" alt="" style="height: 40px;">
        <img onclick="updSticker('puppy')" src="/img/stickers/puppy.png" alt="" style="height: 40px;">
        <img onclick="updSticker('rickandmorty')" src="/img/stickers/rickandmorty.png" alt="" style="height: 40px;">
        <img onclick="updSticker('rocket')" src="/img/stickers/rocket.png" alt="" style="height: 40px;">
        <img onclick="updSticker('ryuk')" src="/img/stickers/ryuk.png" alt="" style="height: 40px;">
        <img onclick="updSticker('scooter')" src="/img/stickers/scooter.png" alt="" style="height: 40px;">
        <img onclick="updSticker('shootingstar')" src="/img/stickers/shootingstar.png" alt="" style="height: 40px;">
        <img onclick="updSticker('siamese')" src="/img/stickers/siamese.png" alt="" style="height: 40px;">
        <img onclick="updSticker('skellington')" src="/img/stickers/skellington.png" alt="" style="height: 40px;">
        <img onclick="updSticker('squirrel')" src="/img/stickers/squirrel.png" alt="" style="height: 40px;">
        <img onclick="updSticker('totoro')" src="/img/stickers/totoro.png" alt="" style="height: 40px;">
        <img onclick="updSticker('wolf')" src="/img/stickers/wolf.png" alt="" style="height: 40px;">
        <img onclick="updSticker('foxoroomba')" src="/img/stickers/foxoroomba.png" alt="" style="height: 40px;">
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_title">
          Floating Header
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          Enabling this will cause the Misdew header to stay at the top of the page as you scroll. Action bars do not float- they will go away as you scroll. Refresh or visit another page for the change to reflect.
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="headerFloat('on');" name="headerfloat" value="headerfloat" type="radio"<?php if($u_header_float == 'on') { echo " checked"; } ?>>
        enabled
      </td>
    </tr>
    <tr>
      <td>
        <input onchange="headerFloat('no');" name="headerfloat" value="headerfloat" type="radio"<?php if($u_header_float == 'no') { echo " checked"; } ?>>
        disabled<br>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_title">
          Canvas Design
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
          Tap <span onclick="eraseCSS()" style="text-decoration: underline;">here</span> to erase all of your Canvas CSS. <br>
          Tap <span onclick="eraseDesign()" style="text-decoration: underline;">here</span> to erase everything from your Canvas Design Editor. <br>
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_title">
          Apps
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
            You can re-arrange, hide, and toggle alerts for your owned apps here.
        </span>
      </td>
    </tr>
    <tr>
      <td id="custom_apps">
        <?php require_once("customize_apps.php"); ?>
      </td>
    </tr>
  <!--  <tr>
      <td>
        <span class="settings_title">
          Themes
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <span class="settings_desc">
            Change your theme by selecting one below. This will also redirect you to the Hub. <br><br> themes are currently NOT undergoing upgrades
        </span>
      </td>
    </tr>-->
  </table>
  <center>
    <!--<table style="width: 95%; max-width: 500px;">
      <tr>
        <td onclick="changeTheme('1');" style="width: 25%;">
          <img src="/img/themes/consistent.png" alt="" style="width: 100%; height: auto; display: block;"> <br>
        </td>
        <td onclick="changeTheme('2');" style="width: 25%;">
          <img src="/img/themes/colorful.png" alt="" style="width: 100%; height: auto; display: block;"> <br>
        </td>
        <td onclick="changeTheme('3');" style="width: 25%;">
          <img src="/img/themes/dark.png" alt="" style="width: 100%; height: auto; display: block;"> <br>
        </td>
      </tr>
    </table>-->
  </center>
</div>
<script>
function headerFloat(headerfloat) {
  var token = "<?php echo $u_token; ?>";
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'header-float.php',
  type: 'POST',
  data: { headerfloat: headerfloat, token: token },
  success: function(data){
    if(data == '') {
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function updChatTheme(chattheme) {
  var token = "<?php echo $u_token; ?>";
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'chat-dark.php',
  type: 'POST',
  data: { chattheme: chattheme, token: token },
  success: function(data){
    if(data == '') {
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function changeTheme(i) {
  var token = "<?php echo $u_token; ?>";
  $.ajax({
  url: 'change_theme.php',
  type: 'POST',
  data: { token: token, theme: i },
  success: function(data){
    if(data == '') {
      window.location.replace("/hub");
    }
  },
  error: function(data) {
    alert('error');
  }
});
}
function eraseCSS() {
  if(confirm('!!! WARNING !!!\nThis will completely erase all CSS on your Canvas.\nThis cannot be undone.\nAre you sure?')) {
    if(confirm('Are you truly sure you want to erase it all?')) {
      if(confirm('Last check. Are you sure?')) {
        document.getElementById('settings_upd').innerHTML = 'saving changes...';
        var type = "css";
        var token = "<?php echo $u_token; ?>";
        $.ajax({
        url: 'canvas_design.php',
        type: 'POST',
        data: { type: type, token: token },
        success: function(data){
          if(data == '') {
            updApps();
            document.getElementById('settings_upd').innerHTML = 'changes saved';
          }
        },
        error: function(data) {
          document.getElementById('settings_upd').innerHTML = 'save failed';
        }
        });
      }
    }
  }
}
function eraseDesign() {
  if(confirm('!!! WARNING !!!\nThis will completely erase everything from your Canvas Design Editor.\nThis cannot be undone.\nAre you sure?')) {
    if(confirm('Are you truly sure you want to erase it all?')) {
      if(confirm('Last check. Are you sure?')) {
        document.getElementById('settings_upd').innerHTML = 'saving changes...';
        var type = "design";
        var token = "<?php echo $u_token; ?>";
        $.ajax({
        url: 'canvas_design.php',
        type: 'POST',
        data: { type: type, token: token },
        success: function(data){
          if(data == '') {
            updApps();
            document.getElementById('settings_upd').innerHTML = 'changes saved';
          }
        },
        error: function(data) {
          document.getElementById('settings_upd').innerHTML = 'save failed';
        }
        });
      }
    }
  }
}
function togHide(i) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'toggle_hide.php',
  type: 'POST',
  data: { i: i },
  success: function(data){
    if(data == '') {
      updApps();
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function togAlerts(i) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'toggle_alerts.php',
  type: 'POST',
  data: { i: i },
  success: function(data){
    if(data == '') {
      updApps();
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function updSticker(i) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'cust_update.php',
  type: 'POST',
  data: { sticker: i },
  success: function(data){
    if(data == '') {
      updApps();
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function updApps() {
  $.get("customize_apps.php", function(d) {
    $("#custom_apps").html(d);
  });
}
function appUp(i) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  var move = "up";
  $.ajax({
  url: 'cust_arrange.php',
  type: 'POST',
  data: { app_id: i, move: move },
  success: function(data){
    if(data == '') {
      updApps();
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function appDown(i) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  var move = "down";
  $.ajax({
  url: 'cust_arrange.php',
  type: 'POST',
  data: { app_id: i, move: move },
  success: function(data){
    if(data == '') {
      updApps();
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
function updEmoji(style) {
  document.getElementById('settings_upd').innerHTML = 'saving changes...';
  $.ajax({
  url: 'cust_update.php',
  type: 'POST',
  data: { emoji: style },
  success: function(data){
    if(data == '') {
      $.get("custom_emoji.php", function(d) {
        $("#custom_emoji").html(d);
      });
      document.getElementById('settings_upd').innerHTML = 'changes saved';
    }
  },
  error: function(data) {
    document.getElementById('settings_upd').innerHTML = 'save failed';
  }
  });
}
</script>
