<?php session_start(); ?>
<?php include_once("analyticstracking.php") ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include("header.php") ?>

	<!-- Page Content -->
    <div class="container">
		<div class="well well-sm">Playback Selected Programme...</div>
		

<!--- facebook share -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=369010359837943";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--- twitter share -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<?php

//Get current URL
//echo $_SERVER['REQUEST_URI'];

//echo "Here is the link: <br>";
//echo $_GET['link'];
//echo $_POST['link'];

// Determine on which server you are working to proceed.
include("dbconnect.php");   // include settings for database connection

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 


// Start composing SQL statement ...
//$sql = "SELECT * FROM broadcasts WHERE trim(url) ="."'". $_GET['link']."'" ;
$sql = "SELECT * FROM broadcasts WHERE id ="."'". $_GET['id']."'" ;

//echo "SQL string contains-->".$sql."<br>";

//$sql = "SELECT * FROM broadcasts WHERE trim(url) ="."'". $_POST['link']."'" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
//echo "<h4>Results : ".$result->num_rows." records</h4> <br>";
}

if ($result->num_rows > 0) {


    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "<tr><td>" . $row["id"]. " " . $row["datetime"]. " " . stripslashes(substr($row["descrip"],0,50))."...  ". $row["url"]. "</td></tr><br>";
	//	echo "<tr><td>" . $row["title"]."</td><td>" . stripslashes(substr($row["descrip"],0,300))."...  "."</td><td>" . $row["url"]. "</td></tr><br>";
		$audiolink=$row['url'];   // Save audio link	
		$progdescrip =stripslashes($row["descrip"]);   // Save programme description
		$progtitle = stripslashes($row["title"]);   // Save programme title
		$proghosts = $row["hosts"];   // Save host name(s)
		$progguests = $row["guests"];   // Save guest name(s)
		$progphoto = $row["photourl"];   // Save programme photo
        $progdate = $row["datetime"];   // Save programme broadcast date
		
		$progyoutube = $row["youtubeurl"];   // Save YouTube link
		$progyoutube2 = $row["youtubeurl"];   // Save YouTube link #2
		$embedpart1= "https://www.youtube.com/embed/"; // Use this partial YouTube url to prepare embed string ..
		$embedpart2= strstr($progyoutube,"=");  // Extract the YouTube video's unique address to be add to the embed url
		$progyoutube = $embedpart1. substr($embedpart2,1); //$row["youtube-url"];   // Transform the YouTube link for embedding
        $progslideurl = $row["slideurl"];   // Save slideshow link
		$progsegment = $row["segment"];   // Save programme segment
		$_SESSION['id'] = $row["id"];   // save id
		
    }
} else {
    echo "0 results";
}
/// Diaplay audio player here

// Table tag here
  echo '<div class="table-responsive">';     
 echo "<table class='table'>";
 echo   "<thead>";
 echo     "<tr>";
 echo       "<th>Programme Title/Description</th>";

 if ($progsegment != 'EVE' && $progslideurl =='') {
//if ($progsegment != 'EVE') {  
	echo       "<th>Photo</th>";
} else {
		echo       "<th>Slide show / ". '<a href="'.$progslideurl . '" target="_blank">Visit link</a>'. "</th>";
		//echo       "<th>Slide show</th>";
		
}
 
echo      "</tr>";
echo    "</thead>";
echo    "<tbody>";
echo      "<tr class='danger'>";
//echo        "<td><h4>".$progtitle. "</h4>".$progdescrip . "</td>";
// Add editing option when logged in
if ($_SESSION["loggedin"]) {   // Activate this section only when user logged in
        //if ($loggedin) {   // Activate this section only when user logged in
		
			////  -- adding a pop over link
			//echo "<div class='container'>";
			echo      "<tr class='danger'>";	
			echo "<td></td><td></td>";
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
			echo      "</tr>";			
		}	// End: Section to check whether user logged in		
		

//end: add editing FB

//echo    "<td><h4>". stripslashes($progtitle). "</h4>". stripslashes($progdescrip);
echo    "<td><h4>". stripslashes($progtitle). "</h4>". "<p style='white-space:pre-wrap;'>". stripslashes($progdescrip). "</p>";
// Format date for display
$date = strtotime( $progdate);

echo "<h4 textcolor='red'> First broadcast: ". date("j F Y", $date) . "</h4>";
echo "</td>";

// Check the dimensions of image2wbmp
list($width, $height, $type, $attr) = getimagesize($progphoto);
//list($width, $height, $type, $attr) = getimagesize("http://radiovoiceofnaija.org/images/ruth-sinkelar.png");

/*
//Test line
echo "Image width " .$width;
echo "<BR>";
echo "Image height " .$height;
echo "<BR>";
echo "Image type " .$type;
echo "<BR>";
echo "Attribute " .$attr;
// end test lines

*/

//------ Here resize image if detected as too large
if ($width == $height && $width > 400){
	//$radio_w = $height/350;
    $radio_w = $width/350;
 //echo "<br>Image width is ". $width/400 . " X wider than std";
	//echo "<br>Square image & too large";
	 $width = $width /$radio_w;  // reduce dimensions
	 $height = $height/$radio_w;
}

if ($width > $height && $width > 400){
	//$radio_w = $height/350;
    $radio_w = $width/350;
 echo "<br>Image width ". $width/400 . " X wider than std";
	echo "<br>Landscape image & too large";
	 $width = $width /$radio_w;  // reduce dimensions
	 $height = $height/$radio_w;
	 
}
if ($width > $height && $width < 400){
	//echo "<br>Landscape image & OK";
	}

if ($width < $height  && $height>350) {
 //echo "<br>Image height ". $height/350 . " X higher than std";
 $radio_h = $height/350;
	//echo "Portrait image large";
	$width = $width /$radio_h;  // reduce dimensions
	$height = $height/$radio_h;
}

if ($width < $height  && $height<450) {
	//echo "Portrait image Normal";
}
//------- end resizing images

// Display PHOTO or SLIDE SHOW
if ($progsegment == 'EVE' || $progslideurl !='') {  // Section to display photo or slide show
	echo "<td>".'<iframe src="'. $progslideurl.'" width="500" height="350"></iframe></td>';
	//echo '<a href="'.$progslideurl . '">Visit slide link</a>';
	///echo "<td>".'<iframe src="'. $progslideurl.'" width="500" height="350"></iframe></td>';
} else {
	echo        "<td>". "<img src='". $progphoto. "' width=".$width. "'height=".$height. "><p><center><b><small>".$progguests."</small></b></p><center></td>";
}
echo      "</tr>";

echo      "<tr class='success'>";

if ($audiolink == "") {   // Where there's NO audio link available

 echo "<td>". "<center><img src='http://radiovoiceofnaija.org/images/no-audio-link.jpg'> <h3>No audio link found! </h3></center>". "</td>";

} 


	 
 if ($audiolink != "") {  // Where there's audio link available
// Start row for embedding audio player 
echo "<td>";
echo  "<h3>Click to listen:</h3>";
echo  "<div class='well well-sm'><h3>". $progtitle."</h3>";
//echo  "<br><audio controls autoplay>";  /// Option with autoplay
echo  "<br><audio controls>";
echo  		"<source src='" .  $audiolink ."' type='audio/ogg'>";
echo  		"<source src='" .  $audiolink ."' type='audio/mpeg'>";
echo  		"Your browser does not support the audio tag.";
echo  "</audio>";
 }
 
echo "</div>";
echo "</td>";



if (substr($progyoutube2,-3)!='png') {   // Display embedded YouTube if available
   
	echo        "<td><center><h3>YouTube version</h3>" . "<iframe width='350' height='215' src='" .$progyoutube."'". " frameborder='0' allowfullscreen></iframe>". "</center></td>"; // YouTube embed code
} else {
	echo        "<td><center><h3> No Video</h3>". "<img src='". $progyoutube2. "' width=250 height=100>"."'</center></td>";
}


/*
if (substr($progyoutube,1,6)=='iframe') {   // Display embedded YouTube if available
	echo        "<td><center><h3>YouTube version</h3>" . $progyoutube. "</center></td>"; // YouTube embed code
} else {
	echo        "<td><center><h3> No Video</h3>". "<img src='". $progyoutube. "' width=250 height=100>"."'</center></td>";
}
*/
// End Row for embedding audio player 


echo "<tr><td><center>";
// Insert social share buttons here ..
 echo "<ul class='list-inline'>";
 echo "<h3>Share this on:</h3>";

$server =  $_SERVER['SERVER_NAME'];
$currentURL= 'http://'.$server . $_SERVER['REQUEST_URI'];
//echo $currentURL;
//exit;

//echo '<li><div class="fb-like" data-href="'. $currentURL. '" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div></li>';
 echo '<li><div class="fb-share-button" data-href="'. $currentURL. '" data-layout="button_count"></div></li>';
 
echo '<a href="https://twitter.com/share" class="twitter-share-button" data-via="RadioNaijaPanAfricanMedia" data-hashtags="RadioNaija">Tweet</a>';
//echo     	"<li><a href='#'><i class='fa fa-2x fa-linkedin-square'></i></a>";

echo '<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>';
echo '<li><script type="IN/Share" data-url="'. $currentURL. '" data-counter="right"></script></li>';

 //echo        "<li><a href='http://plus.google.com/share?url=http%3A%2F%2Fbuiltbyboon.com%2Fposed%2FSimple-Social-Sharing-Buttons' target='_blank'><i class='fa fa-2x fa-google+-square'></i></a>";
 echo 		"</ul>";
 
 // FB comment segment
 ?>
     <script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=369010359837943";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
<?php
 
 echo '<div class="fb-comments" data-href="'. $currentURL. '" data-numposts="5"></div>';
// end of social  share buttons

echo "</center></td>";
//echo "<td>";
echo        "<td><h3>More info:</h3> Hosted by:". $proghosts."</td>";

echo "</tr>";
echo    "</tbody>";
echo "</table>";

// End table tag
 


// Close up table after last entry
	echo "</tbody>";
  echo "</table>";
  echo "</div>";


$conn->close();
?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php include("footer.php") ?>