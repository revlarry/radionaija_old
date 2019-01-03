<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>

<?php

include("dbconnect.php");   // include settings for database connection

  
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 

// Start composing SQL statement ...
$sql = "SELECT * FROM broadcasts WHERE id="."'". $_POST['id']."'" ;

$id = $_POST['id']; //save record id

$result = $conn->query($sql);

if ($result->num_rows > 0) {
//echo "<h4>Results : ".$result->num_rows." records</h4> <br>";

///$row = $result->fetch_assoc();

}

if ($result->num_rows > 0) {

		// Save data here ....
		//echo "save data lines";
		$sql = "UPDATE broadcasts SET "; 

		$sql = $sql . "title ='". $_POST["title"]."',  "; 
		
		$sql = $sql . 'descrip = "' . $_POST['descrip'] .'",  '; 
		
		$sql = $sql . 'segment = "' . $_POST['optradio'] .'",  '; 
				
		$sql = $sql . "guests ='". $_POST["guests"]."',  ";
		
	
		$sql = $sql . "hosts ='". $_POST["hosts"]."',  "; 
		$sql = $sql . "datetime ='". $_POST["datetime"]."',  "; 
	
		$sql = $sql . "url ='". $_POST['url']."',  "; 
		$sql = $sql . "youtubeurl ='". addslashes($_POST["youtubeurl"])."',  ";  
		
		$sql = $sql . "slideurl ='". $_POST["slideurl"]. "',"; 	

		$sql = $sql . "photourl ='". $_POST["photourl"]. "'"; 	

		$sql = $sql	. "      WHERE id= " . $_POST['id']. ";";	


		//echo $sql. "<br>";	
 
		//echo "By passed modifications";

		if ($conn->query($sql) === TRUE) {
            $redirectedurl=$_SESSION['prior_url'];
           // exit;
            
        $completeURL = $_SERVER['SERVER_NAME'] . $redirectedurl;    
        echo "<head>";
        echo '<META http-equiv="refresh" content="0;URL=http://'. $completeURL. '">';
        echo '</head>';
  
		} else {
			echo "Error updating record: " . $conn->error;
		}

	//	$conn->close();

//} else {
//		echo "0 results";
}

?>
  

