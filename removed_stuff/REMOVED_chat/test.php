
<script>
$(function() {
    var $elie = $("img"), degree = 0, timer;
    rotate();
    function rotate() {

        $elie.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
        $elie.css({ '-moz-transform': 'rotate(' + degree + 'deg)'});
        $elie.css('transform','rotate('+degree+'deg)');
        timer = setTimeout(function() {
            ++degree; rotate();
        },5);
    }

    $("input").toggle(function() {
        clearTimeout(timer);
    }, function() {
        rotate();
    });
});
</script>

<input type="button" value=" Toggle Spin " />
<br/><br/><br/><br/>
<img src="https://i.imgur.com/ABktns.jpg" />
