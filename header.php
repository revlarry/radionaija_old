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
      width:30%;
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
					<li><a href="../radio/display-a-segment.php?segment=HEA">Health</a></li>
					<!--li><a href="#">Health</a></li-->
					<li><a href="../radio/display-a-segment.php?segment=SOC">Social Issues</a></li>
					<li><a href="../radio/display-a-segment.php?segment=POL">Politics</a></li> 
					<li><a href="../radio/display-a-segment.php?segment=EDU">Education</a></li> 
					<li><a href="../radio/display-a-segment.php?segment=PAS">Pastoral Forum</a></li> 
					<li><a href="../radio/display-a-segment.php?segment=BUS">Business</a></li> 
					<li><a href="../radio/display-a-segment.php?segment=LEG">Legal Issues</a></li> 
					<li><a href="../radio/display-a-segment.php?segment=YOU">Youth & Society</a></li> 
					<li><a href="../radio/display-a-segment.php?segment=EVE">Social & Community Events</a></li> 
				  </ul>
				</li>
					
					<!-----end drop-down-menu--->
					
                    <li><a href="search-start.php"><span class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" ></span> Search</a></li>
					<li><a href="photogallery.php">Photo Gallery</a></li>
					<li><a href="../radio/contact.php">Contact</a></li>	
					<!--li><a href="sign-up.php">Sign Up</a></li--->		
					
				<?php
				
				//if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"]) {   // when NOT logged in ...
				if (!$_SESSION["loggedin"]) {   // when NOT logged in ...				
					echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";					
				}
				else   // Display option ONLY when user logged in
				{
					echo "<li><a href='dashboard.php'>Dashboard </a></li>";
					echo "<li><a href='logout.php'>". "Logged in as:". $_SESSION["userid"]. " <span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
					//echo "<li><a href='logout.php'>". "Logged in as:"." <span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
					}
				?>					
					</ul>
					
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

  
              </div>

   

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
