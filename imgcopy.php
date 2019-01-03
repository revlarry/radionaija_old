<?php
// Create image instances
$src = imagecreatefromjpeg('images/adam.jpg');
//$src = imagecreatefromgif('php.gif');
$dest = imagecreatetruecolor(750, 350);

// Copy
imagecopy($dest, $src, 0, 0, 0, 0, 800, 400);

// Output and free from memory
header('Content-Type: image/jpeg');
imagejpeg($dest);
imagejpeg($dest, 'images/simpletext.jpg');

imagedestroy($dest);
imagedestroy($src);
//bool imagecopy ( resource $dst_im , resource $src_im , int $dst_x , 
//int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h )
?>

