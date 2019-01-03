<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>

<?php

//echo basename($_SESSION['url']);
//exit;
include("dbconnect.php");   // include settings for database connection

  
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DELETE FROM broadcasts WHERE id="."'". $_POST['id']."'" ;
//echo $sql;
	
if (isset($_POST['go-delete'])) {
	echo "Will delete this record --" . $_POST['title'];
	
		if ($conn->query($sql) === TRUE) {
				echo "Record deleted successfully";
			//$tmpfile=basename($_SESSION['prior_url']);
			//echo  $tmpfile;
			//header("Location:  $tmpfile");
				unset($_POST['go-delete']);
				unset($_SESSION['segment']);
                
                $completeURL = $_SERVER['SERVER_NAME'] . $_SESSION['prior_url'];
                echo "<head>";
                echo '<META http-equiv="refresh" content="0;URL=http://'. $completeURL. '">';
                echo '</head>';  
                
			} else {
				echo "Error updating record: " . $conn->error;
		}	
	
} else {
	//echo "Will NOT delete this record --" . $_POST['title'];
	 //$url= basename($_SESSION['url']);
	 //echo $url;
	 //exit;
	 //include($url);
	//header('Location: displayallbroadcasts.php'); // Redirect to re-display list	
      $completeURL = $_SERVER['SERVER_NAME'] . $_SESSION['prior_url'];
            
            echo "<head>";
            echo '<META http-equiv="refresh" content="0;URL=http://'. $completeURL. '">';
            echo '</head>';
}

	//$conn->close();
?>