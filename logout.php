<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
	// echo "Currently visiting this link:". $_SERVER['REQUEST_URI'];
	// echo "<br>Prior link visited was :". $_SESSION['prior_url']."<br>";
	 $_SESSION["loggedin"]=false;
	// unset( $_SESSION['loggedin']);
    
    $tmpfile=basename($_SESSION['prior_url']);
   // echo  $tmpfile;
    
     header("Location:  $tmpfile");
	 //header("Location:  display-a-segment.php?segment=SOC");

	 //exit;
	 
/*	 
	if ($_SERVER['REQUEST_URI']== $_SESSION['url']) {
		echo "<br>Been On the same page";
		}
	else 
	{
	 		echo "<br>Been to different pages";
	}
*/	
/*
	 if (basename($_SESSION['prior_url'])== 'login.php') {
	 	// exit;
		header("Location: index.php");
	 }
	 else {
//		echo " WIll be going to a different link: ". $_SESSION['url']."<br>";
   
      $tmpfile=basename($_SESSION['prior_url']);
		echo  $tmpfile;
		//exit;
	 header("Location:  $tmpfile");
    $_SESSION['loggedin']= false;
	//unset($_SESSION['loggedin']);
	 
//	 }
	 //$_SESSION['url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
*/	

?>
