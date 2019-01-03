<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>



    <!-- Page Content -->
    <div class="container">
		<div class="well well-sm">Search Results</div>

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
				<h3>Search Results</h3> 
				<img class="img-responsive" src="http://radiovoiceofnaija.org/radio/images/search3.png" width="150" height="100" alt="Search icon">
				<!--img class="img-responsive" src="../radio/images/search3.png" width="150" height="100" alt="Search icon"--->
            </div>
                   
                   
         </div>
        <!-- /.row -->



<?php
 $_SESSION['url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 $_SESSION['prior_url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 //echo "'prior_url' contains -->".$_SESSION['prior_url']."<br>";
 
 
//if (($_SESSION['searchterms'])=="") {
if (($_GET["searchterms"])=="") {
	echo "No search term provided!";
	exit;
}


// Collect form input
//$searchstring=$_POST["searchterms"]; // Obtain search string via form textbox
$searchstring=$_GET["searchterms"]; // Obtain search string via form textbox
 
include("dbconnect.php");   // include settings for database connection



$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/* Compose SQL search string ///// */
$pieces = explode(" ", $searchstring);   // break up search items into array elements for further use

// Start composing SQL statement ...
//echo "Count of array elements ". count($pieces). "<br>";
$sql1 = "SELECT * FROM broadcasts  WHERE ";
$sql2="";
for ($x = 0; $x< count($pieces); $x++) {
 	
 $sql2 .= "descrip LIKE '%".$pieces[$x]."%'";	
//	echo "The array key $x: contains $sql <br><br>";

	if (($x+1) != count($pieces)) {
			//$sql2 .= ' or ';
			$sql2 .= ' AND ';
	}
	
}  // End of FOR loop
//$sql1	=	$sql;   // Save part1 of query

//***********************
// Adding  an OR option
//************************
 $sql3="";
for ($x = 0; $x< count($pieces); $x++) {
 	
 $sql3 .= "title LIKE '%".$pieces[$x]."%'";	
//	echo "The array key $x: contains $sql <br><br>";

	if (($x+1) != count($pieces)) {
			$sql3 .= ' AND ';
			//$sql .= ' or ';			
	}
	
}  // End of FOR loop

//echo "Second part of query-->". $sql3. "<br>";
$sql = $sql1 . $sql2 ." OR ". $sql3."ORDER BY datetime desc";
//$sql = $sql1 . $sql2 ." OR ". $sql3;
//echo "Full query-->". $sql;

$result = $conn->query($sql);
echo "<h3>You have searched with terms: '".$searchstring ."'"; // Display provided search terms
echo "</h3><br>";

if ($result->num_rows > 0) {
echo "<h4>Results : ".$result->num_rows." records</h4> <br>";
}

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

		//$_SESSION["loggedin"] = true;   /// Temporarily set loggedin as 'true'
		
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

 $_SESSION['prior_url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 //echo $_SESSION['prior_url'];
 //exit;
 
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