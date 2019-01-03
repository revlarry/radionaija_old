<?php
/*
// The file
//$filename = 'test.jpg';
$filename = "C:\Users\Radio\Pictures\Marijke.jpg";
$newHeight = 400;  // this will be targeted height
$savePath =  '/images/carousel';

// Desired folder structure
//$structure = 'images/carousel';
$structure = 'images/carousel/';
echo "<br>Path ..: ".$structure;

// Check if path exists.else create one

if (!file_exists($savePath)){
	if (!mkdir($savePath, 0777, true)) {
		die('Failed to create path/folders...');
	} 
}else 
{
	echo "<br>Path exists: ".$savePath;
}
/*
if (file_exists($savePath)){
	echo "Dir exists!";
} else 	{
	echo "NO dir!!!!";
	mkdir($savePath);
}
*/
/*
$saveFile = $savePath.'/'.basename($filename);
echo "<br>File to be saved is: ". $saveFile;
//exit;

//$savePath =  'C:\wamp\www\projects\test\resize-image-while-uploading\uploads\test.jpg';
//$percent = 0.25;

// Content type
header('Content-Type: image/jpeg');

// Get new dimensions
list($width, $height) = getimagesize($filename);
//$new_width = $width * $percent;
//$new_height = $height * $percent;

/*
echo "<br>Width -- ".$width;
echo "<br>Height -- ".$height;

$new_height = 250;
$new_width = $width * ($width/250);
*/
/*
$aspectRatio = $width/$height;
$new_width	 = $newHeight *$aspectRatio;

// Resample
$image_p = imagecreatetruecolor($new_width, $newHeight);
//$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $newHeight, $width, $height);
//imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
imagejpeg($image_p, null, 100); // to browser

//Save image to file
//$savePath = $savePath .'/test.jpg';
//imagejpeg($image_p, $saveFile, 100);
imagejpeg($image_p, '/images/carousel/Marijke.jpg', 100);

*/
////////////////////////////////////////////////////////////////////
// Test //////////////////////////////////////////////////////////////
// The file
$filename = "C:\Users\Radio\Pictures\panel-self-test.jpg";
$new_height = 400;  // this will be targeted height
$savePath =  'images/carousel';

// Check if path exists.else create one

if (!file_exists($savePath)){
	if (!mkdir($savePath, 0777, true)) {
		die('Failed to create path/folders...');
	} 
}

// Content type
header('Content-Type: image/jpeg');

// Get new dimensions
list($width, $height) = getimagesize($filename);

//Get aspect ratio 
$aspectRatio = $width/$height;
$new_width	 = $new_height *$aspectRatio;

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
$saveFile = 'images/carousel/'.basename($filename); // compoae filename

imagejpeg($image_p, null, 100);  // output to browser
imagejpeg($image_p,$saveFile , 100); // output to file
// End test //////////////////////////////////

?>