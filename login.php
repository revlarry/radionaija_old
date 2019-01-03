<?php session_start(); ?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php include_once("analyticstracking.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<link rel="icon" 
      type="image/jpeg" 
      href="http://radiovoiceofnaija.org/images/microphone.jpg">

    <title>Radio Naija - A Pan-African Media</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

  <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	 <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width:40%;
      margin: auto;
  }
  </style>
   <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" class="äctive" href="index.php">Radio Naija</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="about.php">About</a></li>                  
					
				<!---Drop-down menu 1--->
					 <li class="dropdown">
					  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Extra
					  <span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<li><a href="#">Newsletter Archives</a></li>
						<li><a href="#">Special Events</a></li>
						<li><a href="#">YouTube Videos</a></li>
						 <li><a href="#">Services</a> </li>
					  </ul>
					</li>
					
					<!-----end drop-down-menu--->
					
					
				<!---Drop-down menu 2----->
				<li class="dropdown">
				  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Segments
				  <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="#">Health</a></li>
					<li><a href="#">Social Issues</a></li>
					<li><a href="#">Politics</a></li> 
					<li><a href="#">Education</a></li> 
					<li><a href="#">Pastoral Forum</a></li> 
					<li><a href="#">Business</a></li> 
					<li><a href="#">Legal Issues</a></li> 
					<li><a href="#">Youth & Society</a></li> 
					<li><a href="#">More...</a></li> 
				  </ul>
				</li>
					
					<!-----end drop-down-menu--->
					
                    <li><a href="search-start.php"><span class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" ></span> Search</a></li>
					<li><a href="photogallery.php">Photo Gallery</a></li>
					<li><a href="../radio/contact.php">Contact</a></li>	
					<li><a href="sign-up.php">Sign Up</a></li>		
					
				<?php
				$_SESSION["loggedin"] =false;  // test
				//$_SESSION["loggedin"] =true;  // test
				$_SESSION["userid"] = "Tester";
				
				if (!isset($_SESSION["loggedin"])) {
					echo "Will set session variable here!";
					$_SESSION["loggedin"]= '';
					}
					if ($_SESSION["loggedin"]){   // Display option ONLY when user logged in
						echo "<li><a href='dashboard.php'>Dashboard </a></li>";
					}
				?>					
										

		
       <?php
    	   if (!$_SESSION["loggedin"]){
		   		echo "<li><form action='logincheck.php' method='POST'>";
				echo "<input type='email' class='form-control' name='email' placeholder='Enter email' style='width: 180px;'>";
				echo "<input type='password' class='form-control' name='pwd' placeholder='Enter password' style='width: 180px;'>";
				echo    "<button type='submit' class='btn btn-default'>GO!</button>";
				echo  "</form></li>";
		   
				////  ---login form starts here
			/*
				echo "<li>";
				 echo "<form class='form-inline' role='form' action='logincheck.php' method='POST'>";
				 //echo  " <div class='form-group'>";
				 //echo   "  <label f/or='email'>Email:</label>";
				 echo     "<font color='white'>Email:<input type='email' class='form-control' name='email' placeholder='Enter email'>";
				// echo   "</div>";
				 //echo   "<div class='form-group'>";
				 echo     "<label for='pwd'>Password:</label>";
				 echo     "<input type='password' class='form-control' name='pwd' placeholder='Enter password'>";
				// echo   "</div>";
				echo    "<button type='submit' class='btn btn-default'>GO!</button>";
				echo  "</form>";
				echo "</li>";
				////  /// End login form section			   			
    		    }
				*/
				}
    		else {
    	    	echo "<li><a href='logout.php'>". "Logged in as:". $_SESSION["userid"]. " <span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
	    	}
		?>
	</ul>

	
    </div>
  </div>
</nav>
  