<input id="erd" type="file"/>
<script>
var input = document.querySelector('#erd');
input.addEventListener('change', load);
function load(){
    var fr = new FileReader();
    fr.onload = process;
    fr.readAsArrayBuffer(this.files[0]);
}
function process(){
    var dv = new DataView(this.result);
    var offset = 0, recess = 0;
    var pieces = [];
    var i = 0;
    if (dv.getUint16(offset) == 0xffd8){
        offset += 2;
        var app1 = dv.getUint16(offset);
        offset += 2;
        while (offset < dv.byteLength){

if (app1 == 0xffe1){

    pieces[i] = {recess:recess,offset:offset-2};
    recess = offset + dv.getUint16(offset);
    i++;
}
else if (app1 == 0xffda){
    break;
}
offset += dv.getUint16(offset);
var app1 = dv.getUint16(offset);
offset += 2;
}
if (pieces.length > 0){
var newPieces = [];
pieces.forEach(function(v){
    newPieces.push(this.result.slice(v.recess, v.offset));
}, this);
newPieces.push(this.result.slice(recess));
var br = new Blob(newPieces, {type: 'image/jpeg'});

var reader = new FileReader();
reader.readAsDataURL(br);
reader.onloadend = function() {
    var base64data = reader.result;
}
//window.open(URL.createObjectURL(br), "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
var upload_normal = false;
}
}
console.log(upload_normal);
}
</script>
