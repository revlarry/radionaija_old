<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>

<?php
 $_SESSION['url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 $_SESSION['prior_url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes

if (!isset($_SESSION["userid"])) {
    if (!$_SESSION["loggedin"]) {
	$loggedin=false;     // 	//Not logged in yet!
} else 
{
	//echo "Logged in as:". $_SESSION["userid"];
	$loggedin=true;     // Temporary indicator for 'logged in' status
}


    echo '<!-- Page Content -->';
  echo  '<div class="container">';
echo	'<div class="well well-sm">Search Results - All Broadcasts</div>';

echo     '   <!-- Intro Content -->';
echo       ' <div class="row">';
echo            '<div class="col-md-6">';
echo				'<h3>Search Results</h3> ';
echo				'<img class="img-responsive" src="../radio/images/search3.png" width="150" height="100" alt="Search icon">			';
echo            '</div>';
                   
echo         '</div>';
echo        '<!-- /.row -->';


include("dbconnect.php");   // include settings for database connection


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/* Compose SQL search string ///// */
$sql = "SELECT * FROM broadcasts";


$result = $conn->query($sql);
echo "<h3>You are listing ALL broadcasts: </h3><br>"; // Display provided search terms
//echo "</h3><br>";

if ($result->num_rows > 0) {
	echo "<h4>Results : ".$result->num_rows." records</h4>";
} else {
    echo "0 results";
}

//if ($result->num_rows > 0) {

// Tabled results

echo '<table class="table table-striped">';

    echo "<thead>";
    echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Description</th>";
		echo "<th>Thumbnail</th>";
        echo "<th>Guest(s)</th>";
		echo "<th>Action</th>";
		
        if ($_SESSION["loggedin"]) {   // Activate only when user logged in
			echo "<th>". '&#43'. "</th>";
			echo "<th>". '&#9998'. "</th>";
			echo "<th>". '&#10008'. "</th>";			
		}	// end section Activate only when user logged in		
		
		
      echo "</tr>";
    echo "</thead>";

	echo "<tbody>";

    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . stripslashes($row["title"])."</td><td>" . stripslashes(substr($row["descrip"],0,300))."...  </td><td><img src='".$row["photourl"] ."' width='50' height='40'></td><td>" . $row["guests"]. "</td>";
		// Add clickable part of selection from here ..

		echo "<td>";
			echo "<form action='response.php' method='GET'>";
			echo "<input type='hidden' name='link' value=" ."'" . $row["url"]. "'>"; 
			echo "<input type='hidden' name='id' value=" ."'" . $row["id"]. "'>"; 
			echo "<input type='submit' value='Select & Play'>";
			echo "</form>";
		echo "</td>";
//		echo "Editing Buttons here";

		$_SESSION["loggedin"] = true;   /// Temporarily set loggedin as 'true'
		
		if ($_SESSION["loggedin"]) {   // Activate this section only when user logged in
        //if ($loggedin) {   // Activate this section only when user logged in
		
			////  -- adding a pop over link
			//echo "<div class='container'>";
		
			echo "<td>";
					echo '<form action="add.php" method="POST">';
					echo "<input type='hidden' name='link' value=" ."'" . $row["id"]. "'>"; 
					echo "<input type='submit' value='&#43'>";  // Add (Plus) button 
					echo "</form>";  // Each buttons as a form element
			echo "</td>";
			echo "<td>";		
					//echo "<form action='response.php' method='POST'>";
					echo "<form action='modify.php' method='POST'>";
					echo "<input type='hidden' name='link' value=" ."'" . $row["id"]. "'>"; 
					echo "<input type='submit' value='&#9998'>";  // Edit (pencil) button 
					echo "</form>";  // Each button as a form element			
			echo "</td>";	
			echo "<td>";				
					echo '<form action="delete.php" method="POST">';
					echo "<input type='hidden' name='link' value=" ."'" . $row["id"]. "'>"; 
					echo "<input type='submit' value='&#10008'>";  // Delete (X) button 
					echo "</form>";  // Each button as a form element						
			echo "</td>";	
		}	// End: Section to check whether user logged in		
		
		
		echo "</td>";		
		echo  "</tr>";
    }


// Close up table after last entry
	echo "</tbody>";
  echo "</table>";


$conn->close();
?>


        <!-- Footer -->
		<?php include("footer.php") ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>