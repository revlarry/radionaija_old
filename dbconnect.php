<?php
// Settings for a database connection on an online server or localhost
// Determine on which server you are working to proceed.

// Determine on which server you are working to proceed.
if ($_SERVER['SERVER_NAME'] == 'localhost') {
 //@ $db = new mysqli('localhost', 'root', 'root', 'blog');
 //@ $db = new mysqli('localhost', '', '', 'blog');
 //@ $db = new mysqli('localhost', 'blog');
 
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

    ?>