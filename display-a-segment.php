<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>

<?php
//echo  $_POST['segment'];
$_SESSION['segment']= $_POST['segment'];   // save category variable for later re-use
//exit;

 $_SESSION['url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 $_SESSION['prior_url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 //echo "'prior_url' contains -->".$_SESSION['prior_url']."<br>";
 
/*
 if (isset($_POST['segment'])) {
	$_SESSION['segment']= $_POST['segment'];   // save category variable for later re-use
 }
*/
 //echo "'segment' contains -->".$_SESSION['segment']."<br>";
 
    if (!$_SESSION["loggedin"]) {
	//echo "Not logged in yet!!!";
	$loggedin=false;     // Temporary indicator for 'logged in' status
} else 
{
	//echo "Logged in as:". $_SESSION["userid"];
	$loggedin=true;     // Indicator for 'logged in' status
}

$path_now = $_SERVER['REQUEST_URI'];  // Use this setting help determine how to process the categories
//echo "Current URI is ---->". $_SERVER['REQUEST_URI']."<br>";
//echo "Current value of segment is ---->". $_SESSION['segment']."<br>";
$domain = strstr($path_now, '?');
//echo $domain."<br>";
//echo substr($domain,-3)."<br>";
//$_SESSION['segment'] = substr($domain,-3);
//echo substr($domain,0,8);

// Preset category when coming through drop-down menu options
if (substr($domain,0,8) == '?segment') {
	$_SESSION['segment'] = substr($domain,-3); // Set the category to display
}




//******************************************************//
// Use Switch statement to determine what to display //

$msg ="";    // message postfix
switch ($_SESSION['segment']) {
    case 'ALL':
        $msg = " ALL broadcasts";
        break;
    case 'HEA':
         $msg = " HEALTH broadcasts";
        break;
    case 'SOC':
         $msg = " SOCIAL broadcasts";
        break;
    case 'POL':
         $msg = " POLITICAL Segment broadcasts";
        break;
    case 'BUS':
         $msg = " BUSINESS Segment broadcasts";
        break;
    case 'YOU':
         $msg = " YOUTH Segment broadcasts";
        break;
    case 'LEG':
         $msg = " LEGAL Segment broadcasts";
        break;
    case 'EDU':
         $msg = " EDUCATIONAL Segment broadcasts";
        break;
    case 'PAS':
         $msg = " PASTORAL FORUM broadcasts";
        break;			
	case 'EVE':
         $msg = " SOCIAL & COMMUNITY EVENTS / broadcasts";
        break;
	case 'BLA';  /// for 'blank'titled entries
         $msg = " Untitled broadcasts";
        break;					
    default:
        //echo "No specific segment was chosen";
}

//set URL for chosen category
//echo $_SESSION['prior_url'].'?segment='.$_SESSION['segment'];
$_SESSION['prior_url'] .= '?segment='. $_SESSION['segment'];
//exit;

echo '<!-- Page Content -->';
echo  '<div class="container">';
echo	'<div class="well well-sm">Search Results - '. $msg. '</div>';

echo     '   <!-- Intro Content -->';
echo       ' <div class="row">';
echo            '<div class="col-md-6">';
echo				'<h3>Search Results</h3> ';
echo				'<img class="img-responsive" src="http://radiovoiceofnaija.org/radio/images/search3.png" width="150" height="100" alt="Search icon">			';
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

if ($_SESSION['segment'] =='BLA') {   // For blank titled entries
	//echo "We have trapped you here!";
	$sql = "SELECT * FROM broadcasts WHERE title =''";
}

else
{ 
	if ($_SESSION['segment'] == 'ALL') {

		$sql = "SELECT * FROM broadcasts order by datetime desc";
	} else {											// Select the indicated segment
		$sql = "SELECT * FROM broadcasts WHERE segment = '";
		$sql  .= $_SESSION['segment']. "'";
        $sql = $sql . "order by datetime desc";
	}
}


//echo $sql;


$result = $conn->query($sql);
echo "<h3>You are listing ". $msg. "</h3><br>"; // Display provided search terms

if ($result->num_rows > 0) {
	echo "<h4>Results : ".$result->num_rows." records</h4>";
} else {
    echo "0 results";
}

//if ($result->num_rows > 0) {

// Tabled results
echo '<div class="table-responsive">'; // make table listing responsive to display medium
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
  echo '</div>';

  //$_SESSION['segment']; // release this variabel for now

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