<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

/*
echo "INside login-check.php";
echo $_POST['email']."<br>";
echo $_POST['pwd'];
*/

if (trim($_POST['email'])=='voiceofnaija@live.com' && trim($_POST['pwd'])== "daviD%ruth1" ){

$_SESSION["userid"] = trim($_POST['email']);    // Store entered email   
$_SESSION["password"] = trim($_POST['pwd']);   // Store entered password   
$_SESSION['loggedin']= true;

//echo $_SERVER['REQUEST_URI'];

//include("header.php");
//echo "Correct email address & password";

$redirectedurl = $_SESSION['prior_url'];
if (trim($_SESSION['prior_url'])=='/radio/') {   //Adjust URL depending on whether appl.was started bby addinh index.php or not
    $redirectedurl .= 'index.php';
}

// Section to refreshen page ....
$completeURL = $_SERVER['SERVER_NAME'] . $redirectedurl;

// echo 'Server name: '.$_SERVER['SERVER_NAME'].'<br>';
//echo $completeURL;
//exit;

echo "<head>";
echo '<META http-equiv="refresh" content="0;URL=http://'. $completeURL. '">';
echo '</head>';

}
else 
{
echo "Invalid user credentials!";
}


?>