<?php
require_once("../inc/conx.php");
if($logged_in == false) {
  header("location: /");
  exit();
}
$feed_id = safe($_GET['i']);
?>
<script>
var likeBtns = document.querySelectorAll("td[id^=cmt_id_]");
[].forEach.call(likeBtns, function(btn) {
  btn.onclick = function(e){
    var xhr = new XMLHttpRequest();
    var likes = btn.id.match(/([0-9]*)$/)[0];
    xhr.open("GET", "likecmt.php?id=" + likes + "&_t=" + Math.random() + "&token=<?php echo "$u_token&&i=$feed_id"; ?>", true);
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4)
      if(xhr.status == 200) {
        btn.innerHTML = xhr.responseText;
      }
      else{
        alert("error");
        btn.innerHTML = "<i class='fa fa-thumbs-up'></i> error";
      }
    };
    xhr.send();
    btn.innerHTML = "<i class='fa fa-thumbs-up'></i> ...";
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
var cDel = document.querySelectorAll("i[id^=cdel_]");
[].forEach.call(cDel, function(dtt){
  dtt.onclick = function(e){
    if (confirm("Delete?")) {
      var dto = new XMLHttpRequest();
      dtto.open("GET", "delcmnt.php?id=" + dtt.id.match(/([0-9]*)$/)[0], true);
      dtto.onreadystatechange = function(){
        if (dtto.readyState == 4)
          if(dtto.status == 200) {
            upComments();
            UpMPcmts();
            refreshP();
          }
          else {
            alert("error");
          }
      };
      dtto.send();
      return false;
    }
  };
});
</script>
