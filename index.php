<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<?php include("header.php") ?>
<?php include("functions.php") ?>

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
  echo '<!-- Page Content -->';
   echo '   <center><h2 class="text-primary">The Pan-African Media for Informing, Educating and Empowering Migrants in Diaspora!</h2></center>';
 

 //include("dbconnect.php");
 $_SESSION['url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 $_SESSION['prior_url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
 //echo "'prior_url' contains -->".$_SESSION['prior_url']."<br>";
 
 
 //fixFeaturePix();
// exit;
 
 //-- Load records for carousel ------//
include("dbconnect.php");   // include settings for database connection

// $conn = new mysqli($servername, $username, $password, $dbname);


// $servername = "localhost";
// $username = "root";
// $password = "";

// echo "<h1>Here now!</h1?";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$dbInitialized = false; // flag to direct database & tables creation
// Create database
$sql = "CREATE DATABASE $dbname";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
   // echo "Error creating database: " . $conn->error;
}


	makeSource(); // Function createa data for tables
	

	//echo "Need to CREATE Featured table!<br>";
	//makeTable();  // Create structure of Featured table
	
	//echo "Need to fill up Featured table!<br>";
	//(); //Use this function to check or fill up Featured table
	fixFeaturePix();  // USe this function to resolve carousel pix dimensions
////}
	
include("dbconnect.php");   // include settings for database connection
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = " select * from featured ORDER BY datetime desc";

$result = $conn->query($sql);
// var_dump($result);

// die("<h1>AFTER makeSOurce function</h1>");

	$featuredx = array();
	$ctr=0;
  while($row = $result->fetch_assoc()) {
	  $featuredx[$ctr] = $row;
	
		$ctr +=1;
    } // End of Fetching recordset rows


/*	





echo '<!----Start carousel --->';
echo	'<div class="container">';
			  
		echo	'<div id="myCarousel" class="carousel slide" data-ride="carousel">';
		echo		'<!-- Indicators -->';
		echo		'<ol class="carousel-indicators">';
		echo		  '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
		echo		  '<li data-target="#myCarousel" data-slide-to="1"></li>';
		echo		  '<li data-target="#myCarousel" data-slide-to="2"></li>';
		echo		  '<li data-target="#myCarousel" data-slide-to="3"></li>';
		echo		'</ol>';
		
		echo		'<!-- Wrapper for slides -->';
		echo		'<div class="carousel-inner" role="listbox">';
				
			echo		'<div class="item active">';
		//--	
			//echo $featuredx[0]["photourl"]."<br>"; // test line 
			//$pix = imgResize($featuredx[0]["photourl"]); // Obtain dimension of image for rescaling
			//echo $pix[0];
		//	exit;	
		//--	
		//carouselPixUrl
			//echo			'<img src="'. $featuredx[0]["photourl"].'" alt="'. $featuredx[0]["title"]. '" width="'.$pix[0].'" height="'.$pix[1].'">';
			//echo			'<img src="'. $featuredx[0]["photourl"].'" alt="'. $featuredx[0]["title"]. ' class="img-responsive">';
			echo			'<img src="'. $featuredx[0]["carouselPixUrl"].'" alt="'. $featuredx[0]["title"]. ' class="img-responsive">';
			echo			'<div class="carousel-caption">';
			echo				'<h4>'. $featuredx[0]["title"].'</h4>';
			echo				'<h5>'.fulltext($featuredx[0]["segment"]). 'Segment</h5>';
	
			echo				'<!-- Audio part -->';
			echo				'<!--audio controls>';
			echo				  '<source src="../radio/audio/family-law-changes-2015-alimony-payments.mp3" type="audio/mpeg">';
			echo				  'Your browser does not support the audio tag.';
			echo				'</audio-->';
			echo			'</div>';
			echo		  '</div>'; // closing tag for 1st ítem (active)
		
		for($i=1;$i<5;$i++) {
		echo		  '<div class="item">';	
		$pix = imgResize($featuredx[$i]["photourl"]); // Obtain dimension of image for rescaling
		//echo  "<br>Adjusted width= ".$pix[0]." Adjusted height= ".$pix[1];
	
		//echo			'<img src="'. $featuredx[$i]["photourl"].'" alt="'. $featuredx[$i]["title"]. '" class="img-responsive" width="25"'. ' height="25" >';
		//echo			'<img src="'. $featuredx[$i]["photourl"].'" alt="'. $featuredx[$i]["title"]. '" class="img-responsive" width="'.$pix[0].'" height="'.$pix[1].'">';
		//echo			'<img src="'. $featuredx[$i]["photourl"].'" alt="'. $featuredx[$i]["title"]. 'class="img-responsive" >';

		echo			'<img src="'. $featuredx[$i]["carouselPixUrl"].'" alt="'. $featuredx[$i]["title"]. 'class="img-responsive" >';
		echo			 $featuredx[$i]["carouselPixUrl"]." <-->";
		//test
		$pix = imgResize($featuredx[$i]["carouselPixUrl"]); // Obtain dimension of image for rescaling
		$width= $pix[0];
		$height= $pix[1];
		echo "Width --> ".$width."<br> ";
		echo "Height --> ".$height."<br> ";		
		// end test
		
		echo			'<div class="carousel-caption">';
		
		echo				'<h4>'. $featuredx[$i]["title"].'</h4>';
		echo				'<h5>'.fulltext($featuredx[$i]["segment"]). 'Segment</h5>';		
		
		echo			'</div>';
		echo		 '</div>';

		} // end of FOR loop
		
		echo		'</div>'; // end tag for carousel 
		
		echo		'<!-- Left and right controls -->';
		echo		'		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">';
		echo		'		  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
		echo		'		  <span class="sr-only">Previous</span>';
		echo		'		</a>';
		echo		'		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">';
		echo		'		  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
		echo		'		  <span class="sr-only">Next</span>';
		echo		'		</a>';
		
		echo		 '</div>'; // end tag carousel

		echo '<!----End carousel container--->';	
		
*/		
//--------start pasted text

// Test region ----
/*
$dir = "images/carousel/";
//$dir = "C:/wamp/www/projects/radio/images/carousel";
echo getcwd();

// Sort in ascending order - this is default
$a = scandir($dir);

// Sort in descending order
$b = scandir($dir,1);

//print_r($a);
//print_r($b);

echo '<img src="images/smiley.gif" alt="Smiley face" width="42" height="42">';

echo "<table><tr>";
$i=1;

foreach ($a as  $pix){
$pix = imgResize($featuredx[$i]["carouselPixUrl"]); // Obtain dimension of image for rescaling
$width= $pix[0];
$height= $pix[1];
echo "Width --> ".$width."<br> ";
echo "Height --> ".$height."<br> ";
echo "width = $width and height =$height <br> ";

	//echo $dir.$pix."<br>";
	echo $featuredx[$i]["carouselPixUrl"]."<br>";
	//echo "<td><img src='".$dir.$pix."' alt='Smiley face' ></td>";	
	echo "<td><img src='".$featuredx[$i]["carouselPixUrl"]."' alt='Smiley face' ></td>";	
	$i++;
}
echo "</tr></table>";
*/



?>
<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
  <!--   <div class="carousel-inner" role="listbox">
      <div class="item active">
	 	<img src="images/carousel/poverty-debate.jpg" width="640" height="400" alt="Chania" >	    
      </div>

      <div class="item">
        <img src="images/carousel/smart-against-poverty.jpg" width="640" height="400" alt="Chania" >
      </div>
    
      <div class="item">
        <img src="images/carousel/gerard_wouters.jpg" width="640" height="400" alt="Flower" >
      </div>

      <div class="item">
        <img src="images/carousel/drsuuard.jpg" width="640" height="400" alt="Flower" >
      </div>
    </div> -->

   	<?php
   	// <!-- Wrapper for slides -->

 	echo '<div class="carousel-inner" role="listbox">';
    echo  '<div class="item active">';
	echo 	'<img src="images/carousel/poverty-debate.jpg" width="640" height="400" alt="Chania" >';	    
    echo  '</div>';

    foreach($featuredx as $pix)
    {
    echo  '<div class="item">';
    //echo    '<img src="images/carousel/smart-against-poverty.jpg" width="640" height="400" alt="Chania" >';
    echo '  <img src="'. $pix['carouselPixUrl'].'" width="640" height="400" alt="Chania" >';
    //echo '  <img src="'. $pix['carouselPixUrl'].'" width="640" height="400" alt="Chania" >';
    echo  '</div>';
    
	}
    echo '</div>';







    // echo '<div class="carousel-inner" role="listbox">';

    //   	foreach($featuredx as $pix)
    //   	{
    //   		echo '<div class="item">';
	   //      echo '  <img src="'. $pix['carouselPixUrl'].'" width="640" height="400" alt="Chania" >';
	   //      //<!-- <img src="images/carousel/poverty-debate.jpg" width="640" height="400" alt="Chania" > -->
	   //      echo '</div>';
    //     }
    // echo '</div>';
      ?>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<?php
//------ End test region
	
// Test area
?>

<?php
// //- End test area	

echo '<!----End carousel container--->';

	
echo '	<!----Start Container #2--->';
echo '    <div class="container">';
echo	  '<div class="table-responsive">';   
echo ' 	<table class="table">';
echo ' 			<tr>';
echo ' 				<!----Table cell 1--->';
echo ' 				<td>'; 
echo ' 			<!-- Featured Post -->';
 echo '                <!-- Title -->';
echo '                 <h2>Featured Item</h2>';
 echo '                <!-- Author -->';
 echo '                <p class="lead">';
 
/*
 echo  $featuredx[0]["url"]."<br>";
 echo  $featuredx[0]["title"]."<br>";
 echo  $featuredx[0]["id"]."xxx<br>";
 echo  $featuredx[0]["url"]. '&id="'.$featuredx[0]["id"];
 */
 
 echo '                   <h4>'. fulltext($featuredx[0]["segment"]). ' Segment: <a href="http://radiovoiceofnaija.org/radio/response.php?link='. $featuredx[0]["url"]. '&id='.$featuredx[0]["id"] .'" target="_blank">"'. $featuredx[0]["title"]. '"</a></h4>';
 //echo '                   <h4>Legal Segment: <a href="'. 'http://radiovoiceofnaija.org/radio/response.php?link=http%3A%2F%2Fradiovoiceofnaija.org%2Faudio%2Fanti-incasso-are-debt-collectors-milking-us-dry-7-mar-2016.mp3&id=322' .'" target="_blank">Anti-Incasso: Are Debt Collectors Milking Us Dry? </a/</h4>';
echo '                 </p>';			
echo '                 <hr>';
echo '                 <!-- Date/Time -->';
 echo '                <p><span class="glyphicon glyphicon-time"></span> Posted on March 27, 2016 at 12:40 PM</p>';
 echo '                <hr>';

 echo "<center>";
 echo '                <!-- Preview Image -->';
  echo '               <!--img class="img-responsive" src="http://radiovoiceofnaija.org/images/africa-descent.jpg" width="300" height="100" alt=""--->';
echo ' 				<!--iframe src="http://radiovoiceofnaija.org/images/2cultures2015/" width="500" height="350"></iframe-->';
				
           		$youtubeLink=$featuredx[0]["youtubeurl"]; // obtain Youtube link
				if($youtubeLink!=='') {
					$YouTubeOK=true; 
				} else {
				  $YouTubeOK=false;  // flag for whether YouTube video present or not
				}
				$YouTubeOK =false;
				///Resolve YouTube link ...
				$videoLink=explode("v=",$youtubeLink);
				
				if (ismobile()) {
					// Use this iframe setting if on mobile device
                        //
                      if ($YouTubeOK) {  // if video present
                		// Use this iframe setting if on NON-mobile device
				
    					    echo '<iframe src="https://www.youtube.com/embed/'.$videoLink[1].'" frameborder="0" allowfullscreen></iframe>';      
                        } else  // display image
                        {
                        //echo    '<img class="img-responsive" src="http://radiovoiceofnaija.org/images/anti-incasso.jpg" alt="" >';
						//echo    '<img src="'. $featuredx[0]["photourl"].'" alt="" width="460" height="345">';
						echo    '<img src="'. $featuredx[0]["photourl"].'" alt="" width="360" height="245">';
                        }        
                        //
					} else {
                        if ($YouTubeOK) {  // if video present
                        
    					// Use this iframe setting if on NON-mobile device
    						echo '<iframe  width="560" height="315" src="https://www.youtube.com/embed/'.$videoLink[1].'" frameborder="0" allowfullscreen></iframe>';      
                        } else  // display image
                        {

                        echo    '<img src="'. $featuredx[0]["photourl"].'" alt="" width="460" height="345">';
                        }
				}
		
				 if (!$YouTubeOK) {  // Show ONLY when no YouTube video
				 	echo "<center>";
					echo '<!-- Audio part -->';			
					echo '<h3>'. $featuredx[0]["title"].'</h3>';
						// Description of programme
						$tmp = explode('.',$featuredx[0]["descrip"]);  // extract part of description
						$myText = stripslashes($tmp[0].'.'.$tmp[1]); //$featuredx[0]["descrip"];
						//echo $myText;
						//exit;
					//echo '<h5 style="text-align:left;">'.$myText.'... Read more ... </h5>';
					echo '<h5 style="text-align:left;">'.$myText.'...'. '<a href="http://radiovoiceofnaija.org/radio/response.php?link='. $featuredx[0]["url"]. '&id='.$featuredx[0]["id"] .'" target="_blank">...Read more '. '</a></h5>';
					
					echo '<audio controls>';
						echo '<source src="'. $featuredx[0]["url"].'" type="audio/mpeg">';
					echo 'Your browser does not support the audio tag.';
					echo '</audio></p>';
					echo "</center>";
				 }
			//--test
			
//			echo "<center>";
				// Insert social share buttons here ..
				 echo '<ul class="list-inline">';
				 echo "<h3>Share this on:</h3>";

				$server =  $_SERVER['SERVER_NAME'];
				$currentURL= 'http://'.$server . $_SERVER['REQUEST_URI'];
				//echo $currentURL. $featuredx[0]["url"]. '&id='.$featuredx[0]["id"]."<br>";
				//echo 'http://radiovoiceofnaija.org/radio/response.php?link='. $featuredx[0]["url"]. '&id='.$featuredx[0]["id"];
				//exit;
				//echo '<li><div class="fb-like" data-href="'. $currentURL. '" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div></li>';
				
				$currentURL="http://radiovoiceofnaija.org/radio/response.php?link=http%3A%2F%2Fradiovoiceofnaija.org%2Faudio%2Fpreventing_youth_radicalisation_social_persp_28-mar_2016.mp3&id=325";
				//echo 'http://'.$server.'/radio/response.php?link='. $featuredx[0]["url"]. '&id='.$featuredx[0]["id"];
				$currentURL='http://'.$server.'/radio/response.php?link='. $featuredx[0]["url"]. '&id='.$featuredx[0]["id"];
				//exit;
				 echo '<li><div class="fb-share-button" data-href="'. $currentURL. '" data-layout="button_count"></div></li>';
				 
				echo '<a href="https://twitter.com/share" class="twitter-share-button" data-via="RadioNaijaPanAfricanMedia" data-hashtags="RadioNaija">Tweet</a>';
				//echo     	"<li><a href='#"><i class='fa fa-2x fa-linkedin-square"></i></a>";

				echo '<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>';
				echo '<li><script type="IN/Share" data-url="'. $currentURL. '" data-counter="right"></script></li>';

				 //echo        "<li><a href='http://plus.google.com/share?url=http%3A%2F%2Fbuiltbyboon.com%2Fposed%2FSimple-Social-Sharing-Buttons' target='_blank"><i class='fa fa-2x fa-google+-square"></i></a>";
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

				echo "</center>";
			
			//---end test
			
			/*
			// Function to test when on mobile device
				function isMobile() {
					return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
				}
			*/

      echo '   <!-- Post Content -->';
	  
               echo ' <hr>';

         echo '  <hr>';
		echo '	</td>';
				
		echo '	<!----Table cell 2--->';
		echo '	<td>';
        echo '  <!-- Blog Search Well -->';
        echo '      <div class="well">';
  			
        echo '      <div class="input-group">';
		echo '		<form role="form" action="display-selection.php" method="GET">';
		echo '		<!--form role="form" action="display-selection.php" method="POST"-->';
		echo '			<div class="form-group">';
		echo '			  <label for="searchbox">Browse more topics:</label><br>';
						   				  
		echo '			  <input type="text"  name="searchterms" placeholder="Enter search terms" size="35">';
		echo '				<button type="submit" class="btn btn-primary">';
		echo '				  <span class="glyphicon glyphicon-search"></span> Search';
		echo '				</button>';
		echo '			</div>';
					   
		echo '		  </form>';
		echo '		<!--/form-->';
        echo '      </div>';
        echo '      <!-- /.input-group -->';
        echo '    </div>';
        echo '    <!-- Broadcast Segments Well -->';
        echo '    <div class="well">';
        echo '     <center><h3 class="bg-primary">Check Out These Segments</h3></center>';
        echo '        <div class="row">';
        echo '             <div class="col-lg-6">';
        echo '                  <ul class="list-unstyled">';
		echo '					<!----- Test line: Category options ----->';
		echo '					<form role="form" action="display-a-segment.php" method="POST">';
		echo '						<li><input type="hidden" name="segment" value="ALL">';
		echo '							<input type="submit" class="btn btn-link" value="All Broadcasts"></li>';
		echo '					</form>';								
								
		echo '					<form role="form" action="display-a-segment.php" method="POST">';
		echo '						<li><input type="hidden" name="segment" value="HEA">';
		echo '							<input type="submit" class="btn btn-link" value="Health Topics"></li>';
		echo '						</form>';
								
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '						<li><input type="hidden" name="segment" value="SOC">';
		echo '								<input type="submit" class="btn btn-link" value="Social Topics"></li>';
		echo '							</form>';
								
		echo '							<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="POL">';
		echo '								<input type="submit" class="btn btn-link" value="Political Issues"></li>';
		echo '						</form>';
										
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="BUS">';
		echo '								<input type="submit" class="btn btn-link" value="Business Issues"></li>';
		echo '						</form>';

			 // Activate this option only when logged in ..
			 if ($_SESSION['loggedin']) {
				echo '<form role="form" action="display-a-segment.php" method="POST">';
				echo	'<li><input type="hidden" name="segment" value="BLA">';
				echo '<input type="submit" class="btn btn-link" style="color:red" value="Untitled Programmes"></li>';
				echo '</form>';
				}

       	echo '	                     </ul>';
        echo '                </div>';
        echo '                <div class="col-lg-6">';
        echo '                    <ul class="list-unstyled">';
 
		echo '							<!----- Test line: Category options ----->';
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="YOU">';
		echo '								<input type="submit" class="btn btn-link" value="Youth & Society"></li>';
		echo '						</form>';								
								
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="LEG">';
		echo '								<input type="submit" class="btn btn-link" value="Legal Segment"></li>';
		echo '						</form>';
								
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="EDU">';
		echo '								<input type="submit" class="btn btn-link" value="Educational Issues"></li>';
		echo '						</form>';
								
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="PAS">
										<input type="submit" class="btn btn-link" value="Pastoral Forum"></li>';
		echo '						</form>';
								
		echo '						<form role="form" action="display-a-segment.php" method="POST">';
		echo '							<li><input type="hidden" name="segment" value="EVE">';
		echo '								<input type="submit" class="btn btn-link" value="Events"></li>';
		echo '						</form>';
								
        echo '                    </ul>';
        echo '                </div>';
        echo '            </div>';
        echo '            <!-- /.row -->';
        echo '        </div>';				
		echo '		<!----Component 3 of data cell 2-Tune in section-->';
		echo '		<div class="well">';            
		echo '			<div class="panel panel-primary">';
		echo '				<div class="panel-heading"><center><strong><h3>Tune in Every Monday</h3></strong></center>';
		echo '				<center><h4>from 06.00hrs to 10.00hrs CET</h4></center>';
		echo '				</div>';
		echo '			<div class="panel-body">';
		echo '			  <p> on <strong>105.2MHz ether</strong> and <strong>103.8Mhz on cable</strong> (Amsterdam)</p>';
		echo '			  <p> Via internet on  <a href="http://salto.nl/streamplayer/radio/razo_live.asp" target="_blank">Radio Naija Live Streaming</a></p>';
		echo '			</div>';
		echo '			<div class="panel-footer">The Empowerment Station of Now!</div>';
		echo '			</div>';
		echo '		</div>';		
		echo '		</td>';
		echo '	</tr>';
		echo '</table>';
	echo '	<!----End table partitioning --->';	
	echo '	</div>';

	
 echo '   </div>';
echo '	<!----End Container #2--->';

echo '    <!-- jQuery -->';
echo '    <script src="js/jquery.js"></script>';

echo '    <!-- Bootstrap Core JavaScript -->';
echo '    <script src="js/bootstrap.min.js"></script>';

echo '</body>';

echo '</html>';
		

 //---------------- end pasted text
		$_SESSION['prior_url'] = $_SERVER['REQUEST_URI'];  // Save current URL for redirecting purposes
		 //echo $_SESSION['prior_url'];
		 //exit;
		 
		$conn->close();
	    echo '    <!-- Footer -->';
		include("footer.php")
	
?>		


	
 