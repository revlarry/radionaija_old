<?php session_start(); ?>
<?php include_once("analyticstracking.php") ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<!--?php include("header.php") ?-->
<?php include("functions.php") ?>

<?php
//echo "Contents of session priorURL : ". $_SESSION['prior_url'];
//echo "COnten of S_FILES array <br>";

//$_SESSION['targetAudioURL']=''; // Clear out variable

//echo "COnten of session 'targetAudioURL' ".$_SESSION['targetAudioURL']."<br>";

//if (isset($_GET["submit"])) {


$target_dir = "audio/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo "File name = ".$target_file."<br>";
$uploadOk = 1;
$audioFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// test
//print_r(pathinfo($target_file));
if ($_SERVER['SERVER_NAME']=='localhost'){
	$server ='localhost' ; //$_SERVER['SERVER_NAME'];
} else {
	$server ='radiovoiceofnaija.org' ;
}

if ($server == 'localhost') {   // fix url based on server running upload
	$targetURL = 'http://'.$server.'/projects/radio/'.$target_file;
	//echo "<br>".$targetURL." Target URL <br>";
	//exit;
} else {
	$targetURL = 'http://'.$server.'/radio/'.$target_file;
	//echo $targetURL."<br>";	
}
//$_session['targetAudioURL'] = $targetURL;
//echo "Target URL: ".$targetURL."<br>";	
/// end -test

// Check if audio file is real or fake 
if(isset($_POST["submit"])) {
 /* 
  $check = id3_get_tag( $_FILES["fileToUpload"]["tmp_name"]);  //getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an audio - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not audio.";
        $uploadOk = 0;
    }
*/	
}
// Check if file already exists
//echo "<br><h1>".$target_file. " <--- Target File <h1>";
if (file_exists($target_file)) {
	$_SESSION ['fileexists']= file_exists($target_file);  //Set variabe for latter use
    echo "<b style='color:red;'>Sorry, this file already exists: </b>". $target_file;
	echo "<br>Try again.";
	// Display browse button for file

	?>
		<script>
			parent.document.getElementById("url").innerHTML ="<?php echo $targetURL; ?>";
			//parent.document.getElementById("url").innerHTML ="<?php echo $_SESSION['targetAudioURL']; ?>";
		</script>
		<?php	
	
    $uploadOk = 0;
	//exit;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
	
if($audioFileType != "mp3") {	
    echo "<strong style='color:red;'>Sorry, only mp3 files are allowed.</strong>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	exit;
	
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<b style='color:green;'>Success!</b> File '". basename( $_FILES["fileToUpload"]["name"]). "' uploaded.";
		//$_SESSION['targetAudioURL'] = $targetURL;
		
		?>
		<script>
			parent.document.getElementById("url").innerHTML ="<?php echo $targetURL; ?>";
			//parent.document.getElementById("url").innerHTML ="<?php echo $_SESSION['targetAudioURL']; ?>";
		</script>
		<?php
		/*
		var_dump($_SESSION['targetAudioURL']);
		var_dump($targetURL);
		
		die();
		
		echo $_session['targetAudioURL'].": <-- Uploaded file";
		echo $targetURL." :<== targetURL";
		*/
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}




?>
