	<?php
	// Function to test when on mobile device
	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
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
				echo "";
		}

		return ($x);
		}	 // End of function
		
		
function table_exists($tablename, $database = false) {

    if(!$database) {
        $res = mysql_query("SELECT DATABASE()");
        $database = mysql_result($res, 0);
    }

    $res = mysql_query("
        SELECT COUNT(*) AS count 
        FROM information_schema.tables 
        WHERE table_schema = '$database' 
        AND table_name = '$tablename'
    ");

    return mysql_result($res, 0) == 1;

}

function imgResize($progphoto){
		// Obtain the dimensions of image
	list($width, $height, $type, $attr) = getimagesize($progphoto);
	//list($width, $height, $type, $attr) = getimagesize("http://larhel.com/von/Marijke.jpg");
	/*
	echo "Current width " .$width;
	echo "<BR>";
	echo "Current height " .$height;
	echo "<BR>";
	/*
	echo "Image type " .$type;
	echo "<BR>";
	echo "Attribute " .$attr;
	*/

	//------ Here resize image if detected as too large
	/*
	$stdHeight 	= 100;  // set standrd height for carousel photos
	$scaleBy	= $width/$stdHeight;
	$height		= $stdHeight;
	$width		= $stdHeight*$scaleBy; 
	//$width		= $width/$scaleBy; 
	*/
	//echo "<br>Rescaled width is: ". $width . " & Height is: ".$height." Scale-factor = ".$scaleBy	;
	/*
	if ($width == $height && $width > 300){
	//$radio_w = $height/350;
    $radio_w = $width/250;
 //echo "<br>Image width is ". $width/400 . " X wider than std";
	//echo "<br>Square image & too large";
	 $width = $width /$radio_w;  // reduce dimensions
	 $height = $height/$radio_w;
}
	
	if ($width > $height && $width > 300){
		//$radio_w = $height/350;
		$radio_w = $width/250;
	 //echo "<br>Image width ". $width/400 . " X wider than std";
		//echo "<br>Landscape image & too large";
		 $width = $width /$radio_w;  // reduce dimensions
		 $height = $height/$radio_w;
		 
		 
	}
	if ($width > $height && $width < 300){
		//echo "<br>Landscape image & OK";
		}

	if ($width < $height  && $height>250) {
	 //echo "<br>Image height ". $height/350 . " X higher than std";
	 $radio_h = $height/250;
		//echo "Portrait image large";
		$width = $width /$radio_h;  // reduce dimensions
		$height = $height/$radio_h;
	}

	if ($width < $height  && $height<250) {
		//echo "Portrait image Normal";
	}
	//echo "<br>New Image width = ". $width . "and height = ".$height."<br>";
	
	//exit;
	*/
	return array($width,$height);	
}	// end function imgResize


	//////////////////////////////////
	function fillUpFeature()
	{
	// "THis function fills us  Featured table";
	//////////////////////////////////

	include("dbconnect.php");
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
		
	//$sql = "DROP TABLE IF EXISTS featured";
	$sql = "TRUNCATE TABLE featured";
 
	if(!$conn->query($sql) === TRUE) {
	die("Could not drop Featured table: ". mysql_error());	//echo "<h4>Success: Featured table emptied</h4> <br>";
		//exit;
		//echo "Error DELETING Featured table: " . $conn->error;
	}
	
	
	//makeTable(); //Re-create Featured table
	
	// -- Extract most recent record into Featured table
	//$sql = "INSERT INTO featured SELECT title,descrip FROM broadcasts_select order by datetime desc limit 1";
	$sql = "INSERT INTO featured SELECT * FROM broadcasts_select order by datetime desc limit 1";
	if($conn->query($sql) === TRUE) {
		//echo "<h4>Success: 1st record added"; 
	} else 
	{ 
		echo "Error adding 1st record: " . $conn->error;
	}
	//exit;

	

	///- Starting filling up rest of Featured table using random function
	$sql = "SELECT * FROM broadcasts_select"; // Get count of records
	//$sql = "SELECT COUNT(*) as countx FROM broadcasts_select"; // Get count of records
	$result = $conn->query($sql);
	//echo $result['count']."<br>";
	
			while($row = $result->fetch_assoc()) { // Store record-count
				$count = $row["countx"]; 
			}
			
			//echo "<h4>Value of Count is : ".$count."</h4> <br>";
			$ctr = 1; //use ctr to count of 5 Feastured records
			for ($i=1;$i<50;$i++){  // random upper limit for loop
				$recno = (rand(6,$count));
				//echo "<br>Random # btw 6 and ". $count. " is : ".$recno."<br>";
				
				//check whether record exist ..
				$sql = "SELECT * FROM broadcasts_select WHERE id = ". $recno;
				$result = $conn->query($sql);
				
				//$conn->connect_error
				if ($conn->sql_error) {
					//echo "<h1>NOT FOUND</h1>";
					exit;
				} else
				{
					// -- Start filling up Featured table
					$sql2 = "INSERT INTO featured SELECT * FROM broadcasts_select WHERE id = ". $recno;
					$result = $conn->query($sql2);					
					if ($conn->sql_error) {
						//echo "Error: Record NOT added!" . $conn->error;
					} else 
					{ 
						//echo "<h4>Success: Record added";
						$recnr = chkRecCnt(); // check record count
						//echo "<br>".chkRecCnt()." <---- REC CNT <br>";
						$ctr +=1;
						//exit;
						if($recnr== 10){
						//if($recnr== 5){
							break;
						}	
					}	
					///--
					
				} //end for loop
			}	

			// Alter table with field `carouselPixUrl`
				// Test whether field 'carouselPixUrl' exists before attempting to add
				/*
				$result = mysql_query("SHOW COLUMNS FROM `featured` LIKE 'carouselPixUrl'");
				$exists = (mysql_num_rows($result))?TRUE:FALSE;

				if (!$exists){
					$sql = "ALTER TABLE featured ADD `carouselPixUrl` VARCHAR(1000) NOT NULL AFTER photourl";
					$result = $conn->query($sql);				
					//$conn->connect_error
					if (!$result) {
						echo "Couldn't alter Featured table: " . mysql_error();
					}	
				}
				*/
		} 
		
		//////////////////////////////////
		// end function fillUpFeature
		//////////////////////////////////
	
		
		////////////////////////////////////////////////////////////////////////////////
		// This function alters Feature table by adding an extra field `carouselPixUrl`
		function alterFeatureTable()
		/////////////////////////////////////////////////////////////////////////////////
		{
			include("dbconnect.php");
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			// Test whether field 'carouselPixUrl' exists before attempting to add
			
			$result = mysql_query("SHOW COLUMNS FROM `featured` LIKE 'carouselPixUrl'");
			$exists = (mysql_num_rows($result))?TRUE:FALSE;

			if (!$exists){
				$sql = "ALTER TABLE featured ADD `carouselPixUrl` VARCHAR(1000) NOT NULL AFTER photourl";
				$result = $conn->query($sql);				
				//$conn->connect_error
				if (!$result) {
					echo "Couldn't alter Featured table: " . mysql_error();
				}	
			}
			

		}  /// end function alterFeatureTable
		///////////////////////////////////////


	
		function chkRecCnt(){
			include("dbconnect.php");
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT COUNT(*) as countx FROM featured"; // Get count of records
			$result = $conn->query($sql);
			//echo $result['countx']."<br>";
	
			while($row = $result->fetch_assoc()) { // Store record-count
				$recCnt = $row["countx"]; 
				//echo "<br>".$recCnt." <---- REC CNT <br>";
			}
			return ($recCnt);
		}
	
		//////////////////////////////////////////////////////////////////
		// THis function checks for existence of any table in the database
		function tableExists($dbname,$table)
		//////////////////////////////////////////////////////////////////
		{
			include("dbconnect.php");
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "select * FROM  ".$table;	
			
			if($conn->query($sql))  {
			//if($conn->query($sql) === TRUE) {
				$result =true;
				//echo "<h4>Success: ".strtoupper($table)." table exists!</h4> <br>";
			} else 
			{ 
				$result =false;
				echo "<h3>Error ...".strtoupper($table)." Does not exist! ". $conn->errno."</h3>";
			}
			return $result;
		}


/////Test area
//////////////////////////////////////////////////////////////////////////////////////////////
		// THis function checks for existence of records in a given any table in the database
		function recsExist($dbname,$table)
		/////////////////////////////////////////////////////////////////////////////////////
		{
			include("dbconnect.php");
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "select * FROM  ".$table;	
			
			$query = $conn->query($sql);
			if($query->num_rows>0)  {
				$result =true;
			//	echo "<h4>Success: ".strtoupper($table)." table has ".$query->num_rows." records</h4> <br>";
			} else 
			{ 
				$result =false;
				echo "<h3>Failed! ...".strtoupper($table)." has 0 records</h3>";
			}
			return $result;
		}


///------


		//////////////////////////////////////////////////////
		// THis function creates the Feature table for carousel records
		function makeTable(){
		//////////////////////////////////////////////////////
		include("dbconnect.php");
			$conn= new mysqli($servername,$username,$password,$dbname);
			if (!$conn){
			die("Error connecting database - ".$conn->connect_error);	
			}			
			// Create Featured table ... in case it does not exist ...
				$sql = "CREATE TABLE featured LIKE broadcasts";
			$result = $conn->query($sql);
			//var_dump($result);
			
			if (!$result){
				echo "Error creating Featured table - ".$conn->query_error;
			}

		}  // end of makeTable function
	
		////////////////////////////////////////////////////////////////////////////////////////////
		// This function collects ONLY broadcast records for display with NON-BLANK picture field //
			function makeSource()
		////////////////////////////////////////////////////////////////////////////////////////////
			{
				include("dbconnect.php");
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

			// Test whether either of below tables exist or not ///
				$table_exists = tableExists("radionaija","broadcasts");
				if (!$table_exists){
					createTables($dbname,"broadcasts"); // Create and Fill up broadcasts table ...
					fillInitial($dbname); /// file up Broadcast table from backup file
				} else
				{
					recsExist("radionaija","broadcasts"); // check for records
				}

				$table_exists = tableExists("radionaija","broadcasts_select");
				if (!$table_exists){
					createTables($dbname,"broadcasts_select"); // Create and Fill up broadcasts table ...
					fillUpTables("radionaija","broadcasts_select");
				} else
				{
					recsExist("radionaija","broadcasts_select"); // check for records
				}

				$table_exists = tableExists("radionaija","featured");
				if (!$table_exists){
					createTables($dbname,"featured"); // Create and Fill up broadcasts table ...
					fillUpFeature();  /// fill up table with data
					alterFeatureTable(); // add extra column for carousel pix
				} else
				{
					$ok = recsExist("radionaija","featured"); // check for records
					if (!$ok){
						fillUpFeature();
					}
				}


				// die("<h1>HERE NOW</h1>");
				

				// // - Empty table for a fresh re-fill
				// $sql = "DELETE FROM  broadcasts_select";	
				
				// if($conn->query($sql) === TRUE) {
				// 	//echo "<h4>Success: broadcasts_select table emptied</h4> <br>";
				// 	//exit;
				// } else 
				// { 
				// 	echo "<h3>Error DELETING broadcasts_select table:BBBBBBBB " . $conn->error."</h3>";
				// }
				
				// // - Fill up broadcasts_select table .....
				
				// $sql= "CREATE TABLE featured (
				// 		id int(11) NOT NULL AUTO_INCREMENT,
				// 		segment varchar(3) NOT NULL,
				// 		title varchar(1000) NOT NULL,
				// 		descrip text NOT NULL,
				// 		guests varchar(200) NOT NULL DEFAULT 'Not available',
				// 		hosts varchar(200) NOT NULL DEFAULT 'not available',
				// 		datetime date NOT NULL,
				// 		url varchar(1000) NOT NULL,
				// 		youtubeurl varchar(200) NOT NULL DEFAULT '../radio/images/youtube-logo.png',
				// 		slideurl varchar(200) NOT NULL,
				// 		photourl varchar(1000) NOT NULL DEFAULT 'http://placehold.it/350x150',
				// 		PRIMARY KEY (`id`)
				// 		) ";
				
				// /*
				// if(!$conn->query($sql) === TRUE) {
				// 	echo "Error creating table:BBBBBBBB " . $conn->error;
				// }
				// */
				
				// $sql = "INSERT INTO broadcasts_select SELECT * FROM broadcasts WHERE photourl <>'http://placehold.it/350x150' and photourl <>''"; 
				// if($conn->query($sql) === TRUE) {
				// 	//echo "<h4>Success: record extraction"; //.$result->num_rows." records</h4> <br>";
				// } else 
				// { 
				// 	echo "Error record extraction: XXXXXX" . $conn->error;
				// }

			}// end of makeSOurce function
			
			
			
			
		///////////////////////////////
			function createDB(){
		///////////////////////////////		
				//echo "<br>Inside createDB";
				include("dbconnect.php");
			
				//$conn = new mysqli($servername, $username, $password, $dbname);
				$conn = new mysqli($servername, $username, $password);
				/*
				// Check connection
				if ($conn->connect_error) {
					die("<br>Connection failed: " . $conn->connect_error);
				} 
				
				*/
				// - USe query to create DB
				$sql = "CREATE DATABASE radionaija";

				$result = $conn->query($sql);
				
				if($conn->query($sql) === TRUE) {
					echo "<h4>Success: Database Radionaija created!</h4> <br>";
				}
/*				
				else 
				{ 
					die("Error creating database: ") . $conn->error;
					//exit;
				}
	*/
			}// end of createDB function
			
		///////////////////////////////
			function createTables($dbname,$table)
		///////////////////////////////
			{
				include("dbconnect.php");
		
			$conn = new mysqli($servername, $username, $password, $dbname);

			$sql =	"DROP TABLE IF EXISTS ".$table;    // DROP broadcast table
			//$sql =	"DROP TABLE IF EXISTS broadcasts";    // DROP broadcast table
			$result = $conn->query($sql); 
				if($result === TRUE) {
						echo "<h4>Success: table ".strtoupper($table)."!</h4>"; //.$result->num_rows." records</h4> <br>";
					} else 
					{	
					echo "<h4>Table ".strtoupper($table)." NOT DROPPED </h4>" . $conn->error;
				}

				/*----Create $table table ----***/
			$sql =	"CREATE TABLE IF NOT EXISTS `".$table."` (";
			//$sql =	"CREATE TABLE IF NOT EXISTS `".broadcasts."` 
			$sql .=	 "  `id` int(11) NOT NULL AUTO_INCREMENT,";
			$sql .=	 " `segment` varchar(3) NOT NULL DEFAULT 'SOC',";
			$sql .=	 " `title` varchar(1000) NOT NULL,";
			$sql .=	 " `descrip` text NOT NULL,";
			$sql .=	 " `guests` varchar(200) NOT NULL DEFAULT 'Not available',";
			$sql .=	 " `hosts` varchar(200) NOT NULL DEFAULT 'not available',";
			$sql .=	 "`datetime` date NULL,";
			$sql .=	 " `url` varchar(1000) NOT NULL,";
			$sql .=	 " `youtubeurl` varchar(200) NOT NULL DEFAULT '../radio/images/youtube-logo.png',";
			$sql .=	 "  `slideurl` varchar(200) NULL,";

			// Add extra field 'carouselPixUrl' if table = 'featured'
			// if ($table == 'featured'){
			// 	$sql .=	"	`carouselPixUrl` varchar(1000) NOT NULL DEFAULT 'http://placehold.it/350x150',";
			// }

			$sql .=	 " `photourl` varchar(1000) NOT NULL DEFAULT 'http://placehold.it/350x150',";
			$sql .=	 "  PRIMARY KEY (`id`)";
			$sql .=	 "	) ENGINE=InnoDB DEFAULT CHARSET=latin1";

			//die($sql);

			// $sql =	"CREATE TABLE IF NOT EXISTS `broadcasts` (
			// 	  `id` int(11) NOT NULL AUTO_INCREMENT,
			// 	  `segment` varchar(3) NOT NULL DEFAULT 'SOC',
			// 	  `title` varchar(1000) NOT NULL,
			// 	  `descrip` text NOT NULL,
			// 	  `guests` varchar(200) NOT NULL DEFAULT 'Not available',
			// 	  `hosts` varchar(200) NOT NULL DEFAULT 'not available',
			// 	  `datetime` date NULL,
			// 	  `url` varchar(1000) NOT NULL,
			// 	  `youtubeurl` varchar(200) NOT NULL DEFAULT '../radio/images/youtube-logo.png',
			// 	  `slideurl` varchar(200) NOT NULL,
			// 	  `photourl` varchar(1000) NOT NULL DEFAULT 'http://placehold.it/350x150',
			// 	  PRIMARY KEY (`id`)
			// 	) ENGINE=InnoDB DEFAULT CHARSET=latin1";

			
				if($conn->query($sql) === TRUE) {
						echo "<h4>Success: table " . strtoupper($table). " created!</h4>"; //.$result->num_rows." records</h4> <br>";
					} else 
					{	
						echo "<h4>Table ". strtoupper($table)." NOT CREATED Or Exists - #" . $conn->errno."</h4>";
						//echo "<h4>Table NOT CREATED Or Exists </h4>" . $conn->error;
				}

			} /// End of function: createTables


			/// Start of test area
			///////////////////////////////
			function fillUpTables($dbname,$table)
			///////////////////////////////		
			{
				include("dbconnect.php");
			
				//$conn = new mysqli($servername, $username, $password);
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				//  Fill up broadcasts_select table ......
				//--------------------------------------//
				if($table == 'broadcasts_select')
				{
					$sql = "INSERT INTO broadcasts_select SELECT * FROM broadcasts WHERE photourl <>'http://placehold.it/350x150' and photourl <>''"; 
					if($conn->query($sql) === TRUE) 
					{
						echo "<h4>Success: record extraction"; //.$result->num_rows." records</h4> <br>";
					} else 
					{ 
							echo "Error record extraction for table:". $table . $conn->error;
					}			
				}
				// Check if table has missing column
			//	findColumn('radionaija','broadcasts','featured',"BOOLEAN NOT NULL AFTER `photourl`"); // Check and add 'column 'featured' if absent
				
				// Clear existingcontents of table 
				
				// $sql = "DELETE FROM  broadcasts";	
				
				// if($conn->query($sql) === TRUE) {
				// 	//echo "<h4>Success: broadcasts table emptied</h4> <br>";
				// 	//exit;
				// } else 
				// { 
				// 	echo "Error DELETING broadcasts table: " . $conn->error;
				// }
				
				
			}// end of fillUpTables function




///--------------- End of test area


			///////////////////////////////
			function fillInitial($dbname)
			///////////////////////////////
			// Use loop to read data into file	
			{
				include("dbconnect.php");
			
				//$conn = new mysqli($servername, $username, $password);
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				$file = fopen("broadcasts_initial.txt","r");



				while(! feof($file))
				  {
					  //echo '"'.fgets($file).'"'. "<br />";
					  //echo fgets($file). "<br />";
					  
					 //$sql = fgets($file);
					 $sql = fgets($file);
					 //echo $sql."<hr>";
					 
					 // Amend for column 'Featured'
					 $len = strlen(trim($sql))-2;
					 $part1 = substr(trim($sql),0,$len);
					 $part2 = substr(trim($sql),-2,2);
					 //echo $part1."<hr>";
					 //echo $part2."<hr>";
					 $newsql =$part1.',0'.$part2;

					/// echo  $newsql."<hr>";

					 $replacedString = "INSERT INTO `broadcasts` 
					( 
					`segment`,
					 `title`,
					  `descrip`, 
					  `guests`, 
					  `hosts`,
					   `datetime`,
					    `url`, 
					    `youtubeurl`, 
					    `slideurl`, 
					    `photourl`)";

					    // echo substr($newsql,0,25);  // part of query to be replaced.
					    $tobeReplaced = substr($newsql,0,32);  // part of query to be replaced.
					    //echo $tobeReplaced."<br>";

					 $part1 = substr_replace($tobeReplaced,$replacedString,0);
					// echo "Part1 --> ".$part1."<br>";//substr_replace($tobeReplaced,$replacedString,0)."<br>";
					 $part2 = substr($newsql,25,strlen($newsql));
					 //echo "Part 2 --> ".$part2."<br>";

					 $chipOff1 = strpos($part2,",");
					 $chipOff2 = strrpos($part2,",");
					 // echo $chipOff1."<br>";//."<br>"
					 // echo $chipOff2."<br>";

	

					  $remainder1 = substr($part2,$chipOff1+2);
					  //$chipOff2 = strrpos($remainder1,",");
					 // echo $chipOff2."<br>";

					 // echo "<br> remainder1 -->". $remainder1; //" VALUES (".substr($remainder,$extraChip+1);
					 $chipOff2 = strrpos($remainder1,",");
					  //echo "<br>". $chipOff2."<br>";
					
					 //$remainder2 =" VALUES (".substr($remainder,$chipOff1+1);
					  $remainder1Trimmed = " VALUES ( ".substr($remainder1,0,$chipOff2).")";
					  //$remainder1Trimmed = " VALUES ( ".substr($remainder1,0,$chipOff2-9).")";
					 //echo "<h2> remainder 1Trimmed -->".$remainder1Trimmed."</h2>";//" ".substr($remainder2,0,$extraChip2-1).")";

					  //echo "<h2>".$part1.$remainder1Trimmed."</h2>";
					 $newsql = $part1.$remainder1Trimmed;  // Compose corrected query string
					
					  $datePos = strpos($newsql,'0000-00-00');  // replace 'zero' dates with default '1970-01-01'
					  //var_dump($datePos);
					  if($datePos){
					  	// echo "<h4>Replaced ...</h4>";
					  	$newsql = substr_replace($newsql,'1970-01-01',$datePos,10);
					  	//echo $newsql;
					  }
					 
					//echo $newsql; 

					 if($conn->query($newsql) === TRUE) {
						//echo "<h4>Success: record added</h4>"; //.$result->num_rows." records</h4> <br>";
					} else 
					{ 
						//echo "<h4>Error adding Broadcasts record: " . $conn->error." records</h4>";
						echo "<h4>Error adding Broadcasts record: " . $conn->error."</h4>";
						//echo "<h4>Error adding Broadcasts record: " . $conn->errno."</h4>";
						//exit;
					}	
				  }
				fclose($file);
			} // End of function fillInitial

			
		// ///////////////////////////////
		// 	function fillBroadcasts(){
		// ///////////////////////////////		
		// 		//echo "<br>Filling up Broadcasts table";
		// 		include("dbconnect.php");
			
		// 		//$conn = new mysqli($servername, $username, $password);
		// 		$conn = new mysqli($servername, $username, $password, $dbname);
				
		// 		//  Fill up broadcasts table .....
		// 		$sql = "CREATE TABLE IF NOT EXISTS broadcasts (
		// 		  `id` int(11) NOT NULL AUTO_INCREMENT,
		// 		  `segment` varchar(3) NOT NULL,
		// 		  `title` varchar(1000) NOT NULL,
		// 		  `descrip` text NOT NULL,
		// 		  `guests` varchar(200) NOT NULL DEFAULT 'Not available',
		// 		  `hosts` varchar(200) NOT NULL DEFAULT 'not available',
		// 		  `datetime` date NOT NULL,
		// 		  `url` varchar(1000) NOT NULL,
		// 		  `youtubeurl` varchar(200) NOT NULL DEFAULT '../radio/images/youtube-logo.png',
		// 		  `slideurl` varchar(200) NOT NULL,
		// 		  `photourl` varchar(1000) NOT NULL DEFAULT 'http://placehold.it/350x150',
		// 		  PRIMARY KEY (`id`)
		// 		) ENGINE=InnoDB  DEFAULT CHARSET=latin1";
				
		// 		if($conn->query($sql) === TRUE) {
		// 			echo "<h4>Success: table created!</h4>"; //.$result->num_rows." records</h4> <br>";
		// 		} else 
		// 		{	
		// 			echo "<h4>Table NOT CREATED Or Exists </h4>" . $conn->error;
		// 		}
		// 		//exit;

				
		// 		// Check if table has missing column
		// 	//	findColumn('radionaija','broadcasts','featured',"BOOLEAN NOT NULL AFTER `photourl`"); // Check and add 'column 'featured' if absent
				
		// 		// Clear existingcontents of table 
				
		// 		$sql = "DELETE FROM  broadcasts";	
				
		// 		if($conn->query($sql) === TRUE) {
		// 			//echo "<h4>Success: broadcasts table emptied</h4> <br>";
		// 			//exit;
		// 		} else 
		// 		{ 
		// 			echo "Error DELETING broadcasts table: " . $conn->error;
		// 		}
				
		// 			// Use loop to read data into file		
		// 			$file = fopen("broadcasts_initial.txt","r");

		// 			while(! feof($file))
		// 			  {
		// 				  //echo '"'.fgets($file).'"'. "<br />";
		// 				  //echo fgets($file). "<br />";
						  
		// 				 //$sql = fgets($file);
		// 				 $sql = fgets($file);
		// 				 //echo $sql."<hr>";
						 
		// 				 // Amend for column 'Featured'
		// 				 $len = strlen(trim($sql))-2;
		// 				 $part1 = substr(trim($sql),0,$len);
		// 				 $part2 = substr(trim($sql),-2,2);
		// 				 //echo $part1."<hr>";
		// 				 //echo $part2."<hr>";
		// 				 $newsql =$part1.',0'.$part2;
		// 				 //echo  $newsql."<hr>";
		// 				 // end amend section
						 
		// 				 if($conn->query($newsql) === TRUE) {
		// 				 //if($conn->query($sql) === TRUE) {
		// 					//echo "<h4>Success: record added"; //.$result->num_rows." records</h4> <br>";
		// 				} else 
		// 				{ 
		// 					//echo "<h4>Error adding Broadcasts record: " . $conn->error." records</h4>";
		// 					echo "<h4>Error adding Broadcasts record: " . $conn->error."</h4>";
		// 					//exit;
		// 				}			  
		// 			  }
		// 			fclose($file);
		// 	}// end of fillBroadcasts function
			
			///////////////////////////////
			function refresh($redirectedurl){  // This function refresh a given URL
			///////////////////////////////
				// Section to refreshen page ....
				$completeURL = $_SERVER['SERVER_NAME'] . $redirectedurl;

				//echo 'Server name: '.$_SERVER['SERVER_NAME'].'<br>';
				//echo '<br> Full URL : '.$completeURL;
				//exit;

				echo "<head>";
				echo '<META http-equiv="refresh" content="0;URL=http://'. $completeURL. '">';
				echo '</head>';
			}
			
			/////////////////////////////////////////
			function imgRescale ($pixUrl) {
			$filename = $pixUrl; // Pick up pix file -  e.g. "C:\Users\Radio\Pictures\panel-self-test.jpg";
			$new_height = 600;  // this will be targeted image height (carousel)
			$new_width = 800;
			$savePath =  'images/carousel/';

			// Check if path exists.else create one

			if (!file_exists($savePath)){
				if (!mkdir($savePath, 0777, true)) {
					exit;
					die('Failed to create path/folders...');
				} 
			}

			// Content type
			header('Content-Type: image/jpeg');

			// Get image dimensions
			list($width, $height) = getimagesize($filename);

			//Get aspect ratio 
			// $aspectRatio = $width/$height;
			// $new_width	 = $new_height *$aspectRatio;

			// Resample
			$image_p = imagecreatetruecolor($new_width, $new_height);
			$image = imagecreatefromjpeg($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

			// Output			
			//$saveFile = 'images/carousel/'.basename($filename); // compoae filename
			$saveFile = $savePath."crl_".basename($filename); // compose filename

			//imagejpeg($image_p, null, 100);  // output to browser
			imagejpeg($image_p,$saveFile , 100); // output to file
			//echo "File URL = ".$saveFile;
			//echo "<img src= '".$saveFile."' >";
			return $saveFile;
			}
			// End functiom imgRescale //////////////////////////////////
			
			
		//////////////////////////////////
		function fixFeaturePix(){
		//////////////////////////////////
			include("dbconnect.php");
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT * FROM featured"; // Get all records
			$result = $conn->query($sql);
			//echo $result['countx']."<br>";
	
			while($row = $result->fetch_assoc()) { // Store record
				$find = stristr($row["carouselPixUrl"], 'carousel'); 
				$recId = $row["id"]; // store this rec id
				if (!$find) {
					//echo "Not found!!";
					$newURL = imgRescale($row["photourl"]);  // Resolve image dimensions for carousel display
					//echo "$newURL = ".$newURL."<br>";
					//$sql = "update featured set photourl = '".$newURL."' where  id= ".$recId;
					$sql = "update featured set carouselPixUrl = '".$newURL."' where  id= ".$recId;
					
					//echo $sql."<br>"; 
					$status = $conn->query($sql);
					if(!$status){
						//die("Update failed!- ").$conn->connect_error;
						die("Update failed!- ").$conn->connect_errno;
					}
				}
				//echo $find."<br>"; 
				//echo "<br>".$recCnt." <---- REC CNT <br>";
			}
			//return ($recCnt);
		}
	// end function: fixFeaturePix
	////////////////////////////////
	
				
		?>