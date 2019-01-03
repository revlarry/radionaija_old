<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php


if ($_POST['cancel-save']=='Cancel'){
	//echo "Going back here ...". $_SESSION['prior_url'];
	$tmpfile=basename($_SESSION['prior_url']);
	header("Location:  $tmpfile");
	exit;
}


 include("dbconnect.php");   // include settings for database connection

  
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 

// Start composing SQL statement ...

$sql = "INSERT INTO `radionaija`.`broadcasts` (`id`, `title`, `descrip`, `guests`,`segment`, `hosts`, `datetime`, `url`, `youtubeurl`, `slideurl`, `photourl`) 
VALUES 
(NULL,
 '". addslashes($_POST['title'])."',"; 

$sql .= "'". addslashes($_POST['descrip'])."',"; 
//$sql .= "'". $_POST['descrip']."',"; 
$sql .= "'". $_POST['guests']."',"; 
$sql .= "'". $_POST['optradio']."',"; 
$sql .= "'". $_POST['hosts']."',"; 
$sql .= "'". $_POST['datetime']."',"; 
$sql .= "'". $_POST['url']."',"; 
$sql .= "'". $_POST['youtubeurl']."' , "; 
$sql .= "'". $_POST['slideurl']."',"; 
$sql .= "'". $_POST['photourl']."'";
$sql .= ")"; 

// echo $sql;
//exit;

 
		if ($conn->query($sql) === TRUE) {
		
            $completeURL = $_SERVER['SERVER_NAME'] . $_SESSION['prior_url'];
            
            echo "<head>";
            echo '<META http-equiv="refresh" content="0;URL=http://'. $completeURL. '">';
            echo '</head>';
		
			//header('Location: displayallbroadcasts.php'); // Redirect to re-display list
		} else {
			echo "Error updating record: " . $conn->error;
		}

?>

