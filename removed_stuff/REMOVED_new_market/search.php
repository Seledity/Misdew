<div class="mrk_search">
  <input id="search_query" class="mrk_search_input" placeholder="Search Market" onkeypress="search()" onkeyup="search()">
</div>
<div id="s_results" style="display: none; width: 95%; max-width: 450px; font-family: 'Dosis', sans-serif;">
  <div id="search_results"></div>
</div>
<script>
function search() {
  var searchQ = document.getElementById("search_query");
  var q = searchQ.value;
  var q = q.trim();
  var sb = document.getElementById("s_results");
  if(q == '') {
    sb.style.display = 'none';
  }
  else {
    sb.style.display = '';
  }
  document.getElementById("search_results").innerHTML = '<div class="market_table"><div style="padding: 8px;"><span class="no_results">searching...</span></div></div>';
  $.get("search_results.php?q=" + q, function(d) {
    $("#search_results").html(d);
  });
}
</script>
