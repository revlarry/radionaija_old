<?php session_start(); ?>
<?php include_once("analyticstracking.php") ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<!--?php include("header.php") ?-->
<?php include("functions.php") ?>
<?php
// Pick up selected file and update input field

if ($_SERVER['SERVER_NAME']=='localhost'){
	$server ='localhost' ; //$_SERVER['SERVER_NAME'];
} else {
	$server ='radiovoiceofnaija.org' ;
}

if ($server == 'localhost') {   // fix url based on server running upload
	$targetURL = 'http://'.$server.'/projects/radio/'.$_POST['audiofile'];
	//echo "<br>".$targetURL." Target URL <br>";
	//exit;
} else {
	$targetURL = 'http://'.$server.'/'.$_POST['audiofile'];
	//echo $targetURL."<br>";	
}
?>
		<script>
			parent.document.getElementById("url").innerHTML ="<?php echo $targetURL ; ?>";
		</script>
		<?php	
?>