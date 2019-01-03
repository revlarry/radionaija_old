<?php session_start(); ?>
<?php include_once("analyticstracking.php") ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<!--?php include("header.php") ?-->
<?php include("functions.php") ?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<?php

/// Scan directory for files
$dir = "audio/";

// Sort in ascending order - this is default
$audios = scandir($dir);
echo array_shift($audios); // remove 1st directory entry
echo array_shift($audios); // remove 2nd directory entry

//print_r($audios);


//exit;

echo '<div class="container">';
//echo  '<h2>Dropdowns</h2>';
echo  '<div class="dropdown">';
echo    '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Audio files';
echo    '<span class="caret"></span></button>';
echo    '<ul class="dropdown-menu">';
// Itemize directory entries
foreach($audios as $audio){
	echo '<li>
			<form method="POST" action="browseprocess2.php" target="browsefiles">
			   <input type="hidden" name="audiofile" value ="'.$audio.'">
			   <button type="submit">'.$audio.'</button>
			   
			</form>
		 </li>';
}
echo    '</ul>';
echo  '</div>';
echo '</div>';

?>

