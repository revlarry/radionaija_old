<?php
$myfile = fopen("data.php", "w") or die("Unable to open file!");
$title = "Happy Holiday";
$prog_url =  "http://radiovoiceofnaija.org/audio/pf-once-saved-forever-saved-Part-2-sun-13-dec-2015.mp3";
$pix_url =  "http://radiovoiceofnaija.org/images/pf-once-saved-4ever-saved-part2.jpg";
$line = $title.','.$prog_url .','.$pix_url;
//echo $line;
fwrite($myfile, $line);

fclose($myfile);

print_r (explode(",",$line));

?>