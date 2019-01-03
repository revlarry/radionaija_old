<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("audios-from-radionvoiceofaija.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file

$ctr=0;
while(!feof($myfile)) {

	//for ($i=1;$i<=5;$i++) {
	   $x= fgets($myfile);
	   $y= trim(substr($x,-4));
	   //echo $y;
	   //echo trim(substr($x,-5))  . "<br>";
		   if ($y == 'mp3') {
			$ctr = $ctr+1;
			
			// Compose picture ...	
			//echo "<img src='http://larhel.com/von/" . $x. "' width='100' height='100'>";
			//echo "http://radiovoiceofnaija.org/audio/" . $x. "<br>";
			$z = "http://radiovoiceofnaija.org/audio/" . $x;
			
			$zz = "INSERT INTO `radionaija`.`broadcasts` (`id`, `title`, `descrip`, `guests`, `hosts`, `datetime`, `url`, `youtube-url`, `photo-url`) 
				VALUES (NULL, '', '', 'Not available', 'not available', '',".' "' . trim($z) .'"'.", '../radio/images/youtube-logo.png', 'http://placehold.it/350x150');<br>";
			echo $zz;
			//echo addslashes($zz);
		//echo	"INSERT INTO `radionaija`.`broadcasts` (`id`, `title`, `descrip`, `guests`, `hosts`, `datetime`, `url`, `youtube-url`, `photo-url`) 
		//		VALUES (NULL, '', '', 'Not available', 'not available', '', '" . trim($z) ."', '../radio/images/youtube-logo.png', 'http://placehold.it/350x150');<br>";
			//echo "<p>".$x.  "</p>";

		   }
	//}
}
fclose($myfile);
echo "Count of MP3 files : ".$ctr;
?>

</body>
</html>