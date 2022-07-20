<?php
$this_page = "draw";
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
?>
<div class="draw_toolbar">
  <table style="width: 100%; text-align: center;">
    <tr>
      <td style="width: 20%;">
        <i onclick="expand('colors');" class="fa fa-tint" aria-hidden="true"></i>
      </td>
      <td style="width: 20%;">
        <i onclick="expand('tools');" class="fa fa-paint-brush" aria-hidden="true"></i>
      </td>
      <td style="width: 20%;">
        <i onclick="erase();" class="fa fa-eraser" aria-hidden="true"></i>
      </td>
      <td style="width: 20%;">
        <i onclick="expand('restore');" class="fa fa-refresh" aria-hidden="true"></i>
      </td>
      <td id="save_td" style="width: 20%;">
        <i onclick="save();" class="fa fa-save" aria-hidden="true"></i>
      </td>
    </tr>
  </table>
</div>
<div id="restore" class="tools_hidden" style="display: none;">
  <span class="toolbar_info">restore previous drawing</span> <br>
  <table style="width: 95%; text-align: center;">
    <tr>
      <td style="width: 100%;">
        <select id="restore_selc" style="width: 100%;" onchange="restore();">
          <option>Select a Drawing</option>
          <?php
          $draw_q = mysqli_query($conx, "SELECT name,tstamp,location FROM draw WHERE uid='$u_uid' ORDER BY id DESC");
          while($draw_r = mysqli_fetch_assoc($draw_q)) {
            $draw_name = $draw_r['name'];
            $draw_tstamp = $draw_r['tstamp'];
            $draw_location = $draw_r['location'];
            echo "<option value=\"$draw_location\">$draw_name (";
            echo timeago($draw_tstamp);
            echo " ago)</option>";
          }
          ?>
        </select>
      </td>
      <td>
        <button class="draw_buttons" onclick="restoreIMG();">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button></td>
      </td>
    </tr>
  </table>
</div>
<div id="tools" class="tools_hidden" style="display: none;">
  <span class="toolbar_info"><span id="tool">round</span>; size set to <span id="color_size">5</span></span>
  <table style="width: 100%; text-align: center;">
    <tr>
      <td>
        <input id="size_input" placeholder="Enter Size [px]" class="toolbar_input">
      </td>
      <td>
        <button onclick="sizeInp();" id="size_input_button" class="toolbar_button">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button>
      </td>
    </tr>
  </table>
  <table style="width: 100%; text-align: center;">
    <tr>
      <td id="tool_colors">
        <i onclick="changeSize('1');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 5px;"></i>
        <i onclick="changeSize('5');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 9px;"></i>
        <i onclick="changeSize('10');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 12px;"></i>
        <i onclick="changeSize('15');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 19px;"></i>
        <i onclick="changeSize('20');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 24px;"></i>
        <i onclick="changeSize('25');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 29px;"></i>
        <i onclick="changeSize('30');changeTool('square');" class="fa fa-square" aria-hidden="true" style="font-size: 33px;"></i>
        <i onclick="changeSize('30');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 33px;"></i>
        <i onclick="changeSize('25');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 29px;"></i>
        <i onclick="changeSize('20');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 24px;"></i>
        <i onclick="changeSize('15');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 19px;"></i>
        <i onclick="changeSize('10');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 12px;"></i>
        <i onclick="changeSize('5');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 9px;"></i>
        <i onclick="changeSize('1');changeTool('round');" class="fa fa-circle" aria-hidden="true" style="font-size: 5px;"></i>
      </td>
    </tr>
  </table>
</div>
<div id="colors" class="tools_hidden" style="display: none;">
  <table style="width: 100%; text-align: center; padding-top: 3px;">
    <tr>
      <td class="toolbar_info">
        color set to <span id="color_set" style="font-weight: bold;">#000</span>
      </td>
    </tr>
  </table>
  <table style="width: 100%; text-align: center;">
    <tr>
      <td>
        <input id="color_input" placeholder="Enter Color [color/hex]" class="toolbar_input">
      </td>
      <td>
        <button onclick="colorInp();" id="color_input_button" class="toolbar_button">
          <i class="fa fa-check" aria-hidden="true"></i>
        </button>
      </td>
    </tr>
  </table>
  <div class="palette_select">
    <table style="width: 100%; text-align: center; font-size: 13px; font-weight: bold;">
      <tr>
        <td id="p_default" style="padding: 4px;" onclick="navPalette('default')">
          default
        </td>
        <td id="p_sky" style="padding: 4px;" onclick="navPalette('sky')">
          sky
        </td>
        <td id="p_water" style="padding: 4px;" onclick="navPalette('water')">
          water
        </td>
        <td id="p_flora" style="padding: 4px;" onclick="navPalette('flora')">
          flora
        </td>
        <td id="p_skin" style="padding: 4px;" onclick="navPalette('skin')">
          skin
        </td>
      </tr>
    </table>
  </div>
  <div id="color_adv">
    <?php require_once("colors.php"); ?>
  </div>
</div>
<canvas id="sig-canvas" width="310" height="450" style="display: block; border: none;">
  Your browser does not support the canvas element.
</canvas>
<img id="restore_img" src="#" style="display: none;">
<script>
function restore() {
  var selectedValue = $("#restore_selc").val();
  document.getElementById("restore_img").src = selectedValue;
}
function restoreIMG() {
  if(confirm('This will erase anything already on the Canvas.\nAre you sure?')) {
    var img = document.getElementById("restore_img");
    ctx.drawImage(img, 0, 0);
  }
}
function save() {
  if (confirm("Are you sure you want to save?\nYou can edit your drawing later this way.\nJust select it from \"restore drawing.\"\nThis will save to My Art.\nSelect the globe icon to publicly share to collections.\nAlso, be sure to give your artwork a name and description within My Art!")) {
    document.getElementById('save_td').innerHTML = '<i class="fa fa-spinner" aria-hidden="true"></i>';
    var data = canvas.toDataURL("image/png");
    $.ajax({
    url: 'save.php',
    type: 'POST',
    data: { data: data },
    success: function(data){
      if(data == '') {
        toGallery();
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, 310, 450);
      }
    },
    error: function(data) {
      alert('error');
    }
  });
  }
}
function navPalette(pname) {
document.getElementById('p_' + pname).innerHTML = pname + "..";
var xhr = new XMLHttpRequest();
xhr.open("GET", "colors.php?p=" + pname, true);
xhr.onreadystatechange = function(){
  if (xhr.readyState == 4)
  if(xhr.status == 200) {
    document.getElementById('color_adv').innerHTML = xhr.responseText;
    document.getElementById('p_' + pname).innerHTML = pname;
  }
  else{
    alert("error");
  }
};
xhr.send();
return false;
}
function erase() {
if (confirm("Erase everything?")) {
  ctx.fillStyle = '#fff';
  ctx.fillRect(0, 0, 310, 450);
}
}
function colorInp() {
var a = document.getElementById('color_input').value;
changeColor(a);
}
function sizeInp() {
var a = document.getElementById('size_input').value;
changeSize(a);
}
function changeSize(a) {
ctx.lineWidth = a;
document.getElementById('color_size').innerHTML = a;
}
function changeTool(a) {
ctx.lineCap = a;
document.getElementById('tool').innerHTML = a;
}
function changeColor(a) {
ctx.strokeStyle = a;
document.getElementById('color_set').innerHTML = a;
document.getElementById('color_set').style.color = a;
document.getElementById('tool_colors').style.color = a;
}
function bg(a) {
ctx.fillStyle = a;
ctx.fillRect(0, 0, 310, 450);
}
var canvas = document.getElementById("sig-canvas");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "#fff";
ctx.fillRect(0, 0, 310, 450);
ctx.strokeStyle = "#000";
ctx.lineWidth = 5;
ctx.lineCap = "round"
  // Set up mouse events for drawing
var drawing = false;
var mousePos = {
  x: 0,
  y: 0
};
var lastPos = mousePos;
canvas.addEventListener("mousedown", function(e) {
  drawing = true;
  lastPos = getMousePos(canvas, e);
}, false);
canvas.addEventListener("mouseup", function(e) {
  drawing = false;
}, false);
canvas.addEventListener("mousemove", function(e) {
  mousePos = getMousePos(canvas, e);
}, false);

// Get the position of the mouse relative to the canvas
function getMousePos(canvasDom, mouseEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
          x: mouseEvent.clientX - rect.left,
          y: mouseEvent.clientY - rect.top
      };
  }
  // Get a regular interval for drawing to the screen
window.requestAnimFrame = (function(callback) {
  return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
          window.setTimeout(callback, 1000 / 60);
      };
})();
// Draw to the canvas
function renderCanvas() {
  if (drawing) {

ctx.beginPath();
ctx.moveTo(lastPos.x, lastPos.y);
ctx.lineTo(mousePos.x, mousePos.y);
ctx.stroke();
lastPos = mousePos;
ctx.closePath();
  }
}

// Allow for animation
(function drawLoop() {
  requestAnimFrame(drawLoop);
  renderCanvas();
})();
// Set up touch events for mobile, etc
canvas.addEventListener("touchstart", function(e) {
  mousePos = getTouchPos(canvas, e);
  var touch = e.touches[0];
  var mouseEvent = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
  });
  if (e.target == canvas) {
      e.preventDefault();
  }
  canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchend", function(e) {
  var mouseEvent = new MouseEvent("mouseup", {});
  if (e.target == canvas) {
      e.preventDefault();
  }
  canvas.dispatchEvent(mouseEvent);
}, false);
canvas.addEventListener("touchmove", function(e) {
  var touch = e.touches[0];
  var mouseEvent = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
  });
  if (e.target == canvas) {
      e.preventDefault();
  }
  canvas.dispatchEvent(mouseEvent);
}, false);

// Get the position of a touch relative to the canvas
function getTouchPos(canvasDom, touchEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
          x: touchEvent.touches[0].clientX - rect.left,
          y: touchEvent.touches[0].clientY - rect.top
      };
  }
  // Prevent scrolling when touching the canvas
document.body.addEventListener("touchstart", function(e) {
  if (e.target == canvas) {
      e.preventDefault();
  }
}, false);
document.body.addEventListener("touchend", function(e) {
  if (e.target == canvas) {
      e.preventDefault();
  }
}, false);
document.body.addEventListener("touchmove", function(e) {
  if (e.target == canvas) {
      e.preventDefault();
  }
}, false);
</script>
