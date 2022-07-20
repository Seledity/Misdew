<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
?>
<script>
// THE FOLLOWING SCRIPT WAS
// MADE BY MARIOERMANDO
// GIVEN BY ANGEL
// PERFECTED BY JUSTIN
var likeBtns = document.querySelectorAll("td[id^=post_id_]");
[].forEach.call(likeBtns, function(btn) {
  btn.onclick = function(e){
    var xhr = new XMLHttpRequest();
    var a = new XMLHttpRequest();
    var likes = btn.id.match(/([0-9]*)$/)[0];
    var count = document.getElementById("likecnt_" + likes);
    xhr.open("GET", "like.php?id=" + btn.id.match(/([0-9]*)$/)[0] + "&_t=" + Math.random() + "&token=<?php echo $u_token; ?>", true);
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4)
      if(xhr.status == 200) {
        btn.innerHTML = xhr.responseText;
      }
      a.open("GET", "count.php?id=" + btn.id.match(/([0-9]*)$/)[0], true);
      a.onreadystatechange = function(){
        if (a.readyState == 4)
        if(a.status == 200) {
          count.innerHTML = a.responseText;
          updInfosies(btn.id.match(/([0-9]*)$/)[0]);
        }
        else{
          alert("error");
          count.innerHTML = "error";
        }
      };
      a.send();
    };
    xhr.send();
    count.innerHTML = "...";
    return false;
  };
});
var dlikeBtns = document.querySelectorAll("td[id^=dpost_id_]");
[].forEach.call(dlikeBtns, function(btn) {
  btn.onclick = function(e){
    var xhr = new XMLHttpRequest();
    var a = new XMLHttpRequest();
    var likes = btn.id.match(/([0-9]*)$/)[0];
    var count = document.getElementById("dlikecnt_" + likes);
    xhr.open("GET", "dislike.php?id=" + btn.id.match(/([0-9]*)$/)[0] + "&_t=" + Math.random() + "&token=<?php echo $u_token; ?>", true);
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4)
      if(xhr.status == 200) {
        btn.innerHTML = xhr.responseText;
      }
      a.open("GET", "dcount.php?id=" + btn.id.match(/([0-9]*)$/)[0], true);
      a.onreadystatechange = function(){
        if (a.readyState == 4)
        if(a.status == 200) {
          count.innerHTML = a.responseText;
          updInfosies(btn.id.match(/([0-9]*)$/)[0]);
        }
        else{
          alert("error");
          count.innerHTML = "error";
        }
      };
      a.send();
    };
    xhr.send();
    count.innerHTML = "...";
    return false;
  };
});
var Del = document.querySelectorAll("i[id^=pdel_]");
[].forEach.call(Del, function(dt){
  dt.onclick = function(e){
    if (confirm("Delete?")) {
      var dto = new XMLHttpRequest();
      dto.open("GET", "delete.php?id=" + dt.id.match(/([0-9]*)$/)[0], true);
      dto.onreadystatechange = function(){
        if (dto.readyState == 4)
          if(dto.status == 200) {
            upPosts();
            refreshP();
          }
          else {
            alert("error");
          }
      };
      dto.send();
      return false;
    }
  };
});
</script>
