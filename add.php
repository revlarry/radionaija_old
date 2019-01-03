<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>


<?php
include("dbconnect.php");   // include settings for database connection
$_SESSION['prior_url']= $_SERVER['REQUEST_URI'];


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 

			
addrecord();   // Add new record


function addrecord() {

echo '<div class="container">';
echo '<h2>Enter New Programme Data</h2>';
echo '<div class="well">Adding New Programme';
  

	
	echo "<form action='addsave.php' name= 'addform' method='POST'>"; 
			echo "       Programme date: <input type='date' name= 'datetime' ><br>";
			//echo "       Programme date: <input type='text' name= 'datetime'  size='10' value='".$param["datetime"]."'><br>";			
			echo	"Title:<br>";// <input type='text' name= 'title'  size='100' value='".$param["title"]."'><br>";
			echo 	  		"<textarea rows='1' cols='100' name='title'>".$param["title"]. "</textarea><br>";		
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
					
				
			//echo "   Description: <input type='text' name= 'descrip'  size='1000' value='".$param["descrip"]."'><br>";
			echo	"Description:<br>"; ///<input type='text' name= 'descrip'  size='1000' value='".$param["descrip"]."'><br>";			
			echo		"<textarea rows='10' cols='100' name='descrip'>".$param["descrip"]. "</textarea><br>";					
			echo	"Guests:<br>"; //<input type='text' name= 'guests'  size='100' value='".$param["guests"]."'><br>";
			echo 	 	 "<textarea rows='1' cols='100' name='guests'>".$param["guests"]. "</textarea><br>";		
			echo	"Hosts:<br>"; //<input type='text' name= 'hosts'  size='100' value='".$param["hosts"]."'><br>";
			echo 	  		"<textarea rows='1' cols='100' name='hosts'>".$param["hosts"]. "</textarea><br>";	
/*			
			echo	"Programme link:<br>"; //<input type='text' name= 'url'  size='100' value='".$param["url"]."'><br>";

			echo	"<table><tr style='vertical-align:middle'>";
			//echo 	  		"<td><textarea rows='1' cols='87' id='url' name='url'>".$_SESSION['targetAudioURL']. "</textarea></td>  <td></td>";	
			echo 	  		"<td><textarea rows='1' cols='87' id='url' name='url'>".$param["url"]. "</textarea></td>  <td></td>";	
			echo				 "<td name='progLinkName'>&nbsp&nbsp<a href='audioFileUpload.html'  class='btn btn-primary btn-xs' role='button' target='progLinkName'>Upload MP3 file</a></td";
			echo	"</tr></table>";
*/			
//test

			//$dom = new 
			
			?>
			<script>
				function myFunctionURL(){
					var val = '';
					var val = "<?php echo $_SESSION['targetAudioURL']; ?>";
					document.getElementById("url").innerHTML = val;
				}
				
				function myFunctionURL2(){
					var val2 = '';
					var val2 = "<?php echo $_SESSION['targetPhotoURL']; ?>";
					document.getElementById("photourl").innerHTML = val2;
				}				
			</script>

			<?php			
			
			echo	"<div>Programme link:<br>";
			//echo 	 "<textarea rows='1' cols='87' id='url' name='url'>". "</textarea>";
			//echo 		"<a href='audioFileUpload.html' target='audiobox' class='btn btn-primary btn-xs' role='button'>Upload file!</a>";
			//echo 	"<iframe  name='audiobox' style='border:none;scroll:no;'>";
			//echo		 "<p>Your browser does not support iframes.</p>";
			//echo	 "</iframe></div>";
			
			echo "<table>";
			echo    "<tr style='vertical-align:middle' >";
			echo 	    "<td><textarea rows='1' cols='87' id='url' name='url'>". "</textarea></td>";
			echo        "<td><a href='audioFileUpload.htm' target='audiobox' class='btn btn-primary btn-xs' role='button'>Upload file!</a>";
			echo        "</td>";
			// Section to browse audio files on server
			echo        "<td>";	
			echo 	          "<a href='browseprocess.php'  class='btn btn-warning btn-xs' target='browsefiles'>Browse files</a>";
			echo		 "</td>";
			echo        "<td>";
			echo 	       "<iframe  name='audiobox' style='border:none;scroll:no;'>";
			echo		     "<p>Your browser does not support iframes.</p>";
			echo	      "</iframe>";
			echo		 "</td>";
			echo    "</tr>";
			// Here display browsed audio files....
			echo     "<tr><td><iframe name='browsefiles' style='border:none;scroll:no;' width='700'></iframe></td></tr>";
			//echo     "<tr><td><iframe name='browsefiles' border='none' scroll='no' width='700'></iframe></td></tr>";
			//echo     "<tr><td><p id='browsefiles' ></p></td></tr>";
			echo "</table>";
// end test

			echo	"<br>YouTube link:<br>"; 
			echo 	  		"<textarea rows='1' cols='87' name='youtubeurl'>".$param["youtubeurl"]. "</textarea><br>";		
			echo	"Photo link:<br>"; 
			echo	"<table>"; 
			echo 	  	"<tr><td><textarea rows='1' cols='87' id='photourl' name='photourl'>".$param["photourl"]. "</textarea></td>";		
			echo 			"<td><a href='photoUpload.htm' target='photobox' class='btn btn-primary btn-xs' role='button'>Upload photo</a>";	
			echo            "<td>";
			echo 	          "<iframe  name='photobox' style='border:none;scroll:no;'>";
			echo		         "<p>Your browser does not support iframes.</p>";
			echo	           "</iframe></td>";
			echo        "</tr>";
			echo    "</table>";
			
			echo	"Slide URL<br>:"; //<input type='text' name= 'slideurl'  size='100' placeholder ='http://radiovoiceofnaija.org/images/oldorlu2014'><br>";
			echo 	  		"<textarea rows='1' cols='100' name='slideurl'>".$param["slideurl"]. "</textarea><br>";					
			
			echo "<input type='hidden' name= 'id'   value='".$param["id"]."'><br>";
			
		
			
		//echo  "<input type='submit' value='Save Changes'>";
		// Compose SAVE and CANCEL option buttons		
	echo '<div class="container">';
    echo '<input type="submit" name= "save-btn" class="btn btn-success" value="Confirm SAVE">';
	echo '<button type="button" class="btn btn-link"></button>'; 
	echo '<input type="submit" name= "cancel-save"class="btn btn-danger" value="Cancel">';
	echo '</div>';		
	
	echo  "</form>";	

	
//test


//echo '<p id="demo" name="demo"></p>';

$doc = new DOMDocument;
$html = $doc->loadHTML('<p id="url" name="url"></p>');
//$html = $doc->getElementsByTagName('url');
//echo $doc->getElementsByTagName('url');
//$doc->saveHTMLFile('test.html');

//end test
	
//echo '</div>';  // end Well container
//echo '</div>';
	
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