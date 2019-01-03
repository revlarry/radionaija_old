<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>

<?php
	//echo "Currently visiting this link:". $_SERVER['REQUEST_URI'];
	//echo "<br>Prior link visited was :".  $_SESSION['prior_url'];

//if (!isset($_SESSION["userid"])) {
    if (!$_SESSION["loggedin"]) {
	//echo "Not logged in yet!!!";
	$loggedin=false;     // Temporary indicator for 'logged in' status
} else 
{
	//echo "Logged in as:". $_SESSION["userid"];
	$loggedin=true;     // Temporary indicator for 'logged in' status
}


    echo '<!-- Page Content -->';
  echo  '<div class="container">';
echo	'<div class="well well-sm">Edit Record</div>';

echo     '   <!-- Intro Content -->';
echo       ' <div class="row">';
echo            '<div class="col-md-6">';
echo				'<h3>Edit Record</h3> ';
echo				'<img class="img-responsive" src="../radio/images/editbutton.jpg" width="100" height="80" alt="Search icon">			';
echo            '</div>';
                   
echo         '</div>';
echo        '<!-- /.row -->';


include("dbconnect.php");   // include settings for database connection


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


// Start composing SQL statement ...
$sql = "SELECT * FROM broadcasts WHERE id="."'". $_POST['link']."'" ;
//$sql = "SELECT * FROM broadcasts WHERE id="."'". $_SESSION['id']."'" ;


$id = $_POST['link']; //save record id
//$id = $_SESSION['id']; //save record id

$result = $conn->query($sql);



if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	editrecord($row);

} else {
    echo "0 results";
}


$conn->close();



function editrecord($param) {

echo '<div class="container">';
echo "<br>";
//echo "<h4>Found programme : ".$param["title"]."</h4> <br>";
echo "<h4>Found record : ".$param["title"]."<br><img src='".$param["photourl"]."' width='100' height='70'>". "</h4>";
echo '<h2>Change Programme Data</h2>';
echo '<div class="well">Editing record';


	echo "<form action='savemodifydata.php' method='POST'>"; 
	//echo "<form action='savemodifydata.php' method='GET'>"; 
			echo "       Programme date: <input type='date' name= 'datetime'  size='10' value='".$param["datetime"]."'><br>";
			echo "            Title: <input type='text' name= 'title'  size='100' value='".$param["title"]."'><br>";
		//	echo "            Title: <input type='text' name= 'title'  size='100' value='".$param["title"]."'><br>";

			//************************************************//
			// add option buttons here for Programme Segments
			//************************************************//
			//echo "   <br>Segment:". $param["segment"]."<br>";
			echo "   <br>Segment:<b>". fulltext($param["segment"]) ."</b><br>"; 	 			
			echo '<div>';   // 1st row
			echo '<label class="radio-inline">';
			if ($param["segment"]== "HEA") {       // ...then indicate it as 'checked'
				echo '<input type="radio" name="optradio" value="HEA" checked>HEALTH';
			} else {	echo '<input type="radio" name="optradio" value="HEA">HEALTH';
			}
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "SOC") {
				echo '<input type="radio" name="optradio" value="SOC" checked>SOCIAL';
			}else { echo '<input type="radio" name="optradio" value="SOC" >SOCIAL';
			}
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "POL") {
				echo '<input type="radio" name="optradio" value="POL" checked> POLITICAL';
			} else {				echo '<input type="radio" name="optradio" value="POL"> POLITICAL';
			}			
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "BUS") {
				echo '<input type="radio" name="optradio" value="BUS" checked>BUSINESS';
			} else { echo '<input type="radio" name="optradio" value="BUS">BUSINESS';
			}			
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "YOU") {
				echo '<input type="radio" name="optradio" value="YOU" checked>YOUTH';
			} else { echo '<input type="radio" name="optradio" value="YOU">YOUTH';
			}			
			echo '</label>';
			echo '</div>';
			
			echo '<div>';  // 2nd row
			echo '<label class="radio-inline">';
			if ($param["segment"]== "LEG") {
				echo '<input type="radio" name="optradio" value="LEG" checked>LEGAL';
			} else { echo '<input type="radio" name="optradio" value="LEG">LEGAL';
			}
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "EDU") {
				echo '<input type="radio" name="optradio" value="EDU" checked>EDUCATIONAL';
			} else { echo '<input type="radio" name="optradio" value="EDU">EDUCATIONAL';
			}
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "PAS") {
				echo '<input type="radio" name="optradio" value="PAS" checked>PASTORAL';
			} else { echo '<input type="radio" name="optradio" value="PAS">PASTORAL';
			}			
			echo '</label>';
			echo '<label class="radio-inline">';
			if ($param["segment"]== "EVE") {
				echo '<input type="radio" name="optradio" value="EVE" checked>EVENTS';
			} else { echo '<input type="radio" name="optradio" value="EVE">EVENTS';
			}
			echo '</label>';
			echo '</div><br>';		
		
			echo "   Description:<br>"; ///<input type='text' name= 'descrip'  size='1000' value='".$param["descrip"]."'><br>";			
			
			echo "<textarea rows='10' cols='100' name='descrip'>".$param["descrip"]. "</textarea><br>";		
			
			echo "     Guests: <input type='text' name= 'guests'  size='100' value='".$param["guests"]."'><br>";
			echo "       Hosts: <input type='text' name= 'hosts'  size='100' value='".$param["hosts"]."'><br>";
			echo "              Programme link: <input type='text' name= 'url'  size='100' value='".$param["url"]."'><br>";
			echo "           YouTube link: <input type='text' name= 'youtubeurl'  size='100' value='".$param["youtubeurl"]."'><br>";
			//echo "            Photo link: <input type='text' name= 'photourl'  size='100' value='".$param["photourl"]."'><br>";
			echo "            Slide URL: <input type='text' name= 'slideurl'  size='100'  value='".$param["slideurl"]."'><br>";			
			echo "            Photo link: <input type='text' name= 'photourl'  size='100' value='".$param["photourl"]."'><br>";			
			echo "<input type='hidden' name= 'id'   value='".$param["id"]."'><br>";
			
	echo  "<input type='submit' value='Save Changes'>";
	echo  "</form>";

	

	
}
	//*******************************************************//
	//  Function to compose broadcast segment code full text 
	//*******************************************************//
		function fulltext($arg) {
		$x = $arg;
		switch ($arg) {
			case 'HEA':
				 $x = " HEALTH";
				break;
			case 'SOC':
				 $x = " SOCIAL";
				break;
			case 'POL':
				 $x = " POLITICAL";
				break;
			case 'BUS':
				 $x = " BUSINESS";
				break;
			case 'YOU':
				 $x = " YOUTH";
				break;
			case 'LEG':
				 $x = " LEGAL";
				break;
			case 'EDU':
				 $x = " EDUCATIONAL";
				break;
			case 'PAS':
				 $x = " PASTORAL";
				break;			
			case 'EVE':
				 $x = " SOCIAL & COMMUNITY EVENTS";
				break;			
			default:
				echo "No specific segment was chosen";
		}

		return ($x);
		}	 // End of function
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