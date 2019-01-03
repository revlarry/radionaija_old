<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>



<?php

echo '<!-- Page Content -->';
echo  '<div class="container">';
echo	'<div class="well well-sm">Search Results - All Broadcasts</div>';

echo     '   <!-- Intro Content -->';
echo       ' <div class="row">';
echo            '<div class="col-md-6">';
echo				'<h3>Search Results</h3> ';
echo				'<img class="img-responsive" src="../radio/images/delete-icon.png" width="150" height="100" alt="Search icon">			';
echo            '</div>';
                   
echo         '</div>';
echo        '<!-- /.row -->';





 include("dbconnect.php");   // include settings for database connection


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 

// $_SESSION['url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 
 // $url= basename($_SESSION['url']);
//echo "Current URL = ". $url;
	//	header("Location: $url");

// Start composing SQL statement ...
$sql = "SELECT * FROM broadcasts WHERE id="."'". $_POST['link']."'" ;

$id = $_POST['link']; //save record id

$result = $conn->query($sql);

/*
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
}
*/

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	deleterecord($row);

} else {
    echo "0 results";
}



$conn->close();



function deleterecord($param) {

echo '<div class="container">';
echo "<h4>Found record : ".$param["title"]."<img src='".$param["photourl"]."' width='100' height='70'>". "</h4>";
echo '<h2>DELETE  Data: '. $param["title"] . "</h2>";
//echo '<div class="well">About DELETING Member data';

		echo "<form action='deletedata.php' method='POST'>"; 
			echo "       Programme date: <input type='text' name= 'datetime'  size='10' value='".$param["datetime"]."'><br>";
			echo "            Title: <input type='text' name= 'title'  size='100' value='".$param["title"]."'><br>";
			//echo "   Description: <input type='text' name= 'descrip'  size='1000' value='".$param["descrip"]."'><br>";
			echo "   Description:<br>"; ///<input type='text' name= 'descrip'  size='1000' value='".$param["descrip"]."'><br>";			
			
			echo "<textarea rows='10' cols='100' name='descrip'>".$param["descrip"]. "</textarea><br>";		
			
			echo "     Guests: <input type='text' name= 'guests'  size='100' value='".$param["guests"]."'><br>";
			echo "       Hosts: <input type='text' name= 'hosts'  size='100' value='".$param["hosts"]."'><br>";
			echo "              Programme link: <input type='text' name= 'url'  size='100' value='".$param["url"]."'><br>";
			echo "           YouTube link: <input type='text' name= 'youtubeurl'  size='100' value='".$param["youtubeurl"]."'><br>";
			echo "            Photo link: <input type='text' name= 'photourl'  size='100' value='".$param["photourl"]."'><br>";
			echo "<input type='hidden' name= 'id'   value='".$param["id"]."'><br>";
			
	// Compose DELETE and CANCEL option buttons		
	echo '<div class="container">';
    echo '<input type="submit" name= "go-delete" class="btn btn-danger" value="Confirm DELETE">';
	echo '<button type="button" class="btn btn-link"></button>'; 
	echo '<input type="submit" name= "no-delete"class="btn btn-success" value="Cancel DELETE">';
	echo '</div>';		
	//echo  "<input type='submit' value='CLICK To Confirm DELETE'><br>";
	//echo  "<input type='submit' value='Cancel DELETE'>";
	echo  "</form>";


}

?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


<?php include("footer.php") ?>

	</div>
	</div>
</body>

</html>