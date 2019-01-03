<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>


    <!-- Page Content -->
    <div class="container">
		<div class="well well-sm">Search Results</div>

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
				<h3>Search Results</h3> 
				<img class="img-responsive" src="../radio/images/search3.png" width="150" height="100" alt="Search icon">
				
            </div>
                   
         </div>
        <!-- /.row -->



<?php
$_GET["searchterms"] = "poverty smart fatherhood";  // TEST LINE ........

if (($_GET["searchterms"])=="") {
	echo "No search term provided!";
	exit;
}

// Collect form input

$searchstring=$_GET["searchterms"]; // Obtain search string via form textbox

// Determine on which server you are working to proceed.
if ($_SERVER['SERVER_NAME'] == 'localhost') {
 @ $db = new mysqli('localhost', 'blog');
 
  // Create connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radionaija";
 
}
else {
 @ $db = new mysqli('blogpodcast.db.8687452.hostedresource.com', 'radionaija', 'ifYlkd1966@', 'radionaija');
  // Create connection
$servername = "radionaija.db.8687452.hostedresource.com";
$username = "radionaija";
$password = "ifYlkd1966@";
$dbname = "radionaija";
 
  }


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/* Compose SQL search string ///// */
$pieces = explode(" ", $searchstring);   // break up search items into array elements for further use

// Start composing SQL statement ...
$sql1 = "SELECT * FROM broadcasts  WHERE ";
$sql2="";
for ($x = 0; $x< count($pieces); $x++) {
 	
 $sql2 .= "descrip LIKE '%".$pieces[$x]."%'";	
//	echo "The array key $x: contains $sql <br><br>";

	if (($x+1) != count($pieces)) {
			$sql2 .= ' or ';
	}	
}  // End of FOR loop

//***********************
// Adding  an OR option
//************************
 $sql3="";
for ($x = 0; $x< count($pieces); $x++) {
 	
 $sql3 .= "title LIKE '%".$pieces[$x]."%'";	
//	echo "The array key $x: contains $sql <br><br>";

	if (($x+1) != count($pieces)) {
			$sql3 .= ' or ';
			//$sql .= ' or ';			
	}
	
}  // End of FOR loop

//echo "Second part of query-->". $sql3. "<br>";
$sql = $sql1 . $sql2 ." OR ". $sql3;
//echo "Full query-->". $sql;

$result = $conn->query($sql);
echo "<h3>You have searched with terms: '".$searchstring ."'". "</h3><br>"; // Display provided search terms
//echo "</h3><br>";

if ($result->num_rows > 0) {
echo "<h4>Results : ".$result->num_rows." records</h4> <br>";
}

if ($result->num_rows > 0) {
	
	// Table results
	echo '<table class="table table-striped">';	
    echo "<thead>";
    echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Description</th>";
        echo "<th>Guest(s)</th>";
		echo "<th>Action</th>";
      echo "</tr>";
    echo "</thead>";

	echo "<tbody>";
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<tr><td>" . $row["title"]."</td><td>" . stripslashes(substr($row["descrip"],0,300))."...  "."</td><td>" . $row["guests"]. "</td>";
		// Add clickable part of selection from here ..
		
	// echo '<img src="'.$row["photo"].'" alt="HTML5 Icon" style="width:128px;height:128px">'; //--- Display photo

	echo "<td>";
	echo "<form action='response.php' method='GET'>";
	//echo "<form action='response.php' method='POST'>";
	//echo $row["title"];
	echo "<input type='hidden' name='link' value=" ."'" . $row["url"]. "'>"; 
	echo "<input type='hidden' name='id' value=" ."'" . $row["id"]. "'>"; 

	echo "<input type='submit' value='Select & Play'>";
	echo "</form>";
		echo "</td></tr><br>";
    }
} else {
    echo "0 results";
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