<!DOCTYPE html>
<html>
<body>

<p><a id="myAnchor" href="http://radiovoiceofnaija.org/audio/how-to-empower-people-in-poverty-the-SMART-way.mp3/">How to Empower Those in Poverty the SMART Way</a></p>

<p>Click the button to display the value of the href attribute of the link above.</p>

<button onclick="myFunction()">Try it</button>

<p id="demo"></p>

<script>
function myFunction() {
    var x = document.getElementById("myAnchor").href;
    document.getElementById("demo").innerHTML = x;
}
</script>

</body>
</html>
