<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("photolist.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file

$ctr=0;
while(!feof($myfile)) {

	//for ($i=1;$i<=5;$i++) {
	   $x= fgets($myfile);
	   $y= trim(substr($x,-5));
	   //echo trim(substr($x,-5))  . "<br>";
		   if ($y == 'jpg') {
			$ctr = $ctr+1;
			
			// Compose picture ...	
			echo "<img src='http://larhel.com/von/" . $x. "' width='200' height='250'>";
			echo "<p>".$x.  "</p>";

		   }
	//}
}
fclose($myfile);
echo "Count of JPG files : ".$ctr;
?>

</body>
</html>