<?php
$db    = "radionaija";
$table = " broadcasts_select";

//echo "Table search result for $table = ".table_exists($db,$table);

$conn = new mysqli("localhost","root","");
	if ($conn->error){
		die("Connection error ".$conn->error);
	}

echo "SHOW TABLES LIKE '".$table."'";


if ($result = $mysqli->query("SHOW TABLES LIKE 'broadcasts_select'")) {
//if ($result = $mysqli->query("SHOW TABLES LIKE '".$table."'")) {
    if($result->num_rows == 1) {
        echo "Table exists";
    }
}
else {
    echo "Table does not exist";
}

// function table_exists(&$db, $table)
// {

// 	$conn = new mysqli("localhost","root","");
// 	if ($conn->error){
// 		die("Connection error ".$conn->error);
// 	}

// 	$result = $db->query("SHOW TABLES LIKE '{$table}'");
// 	if( $result->num_rows == 1 )
// 	{
// 	        return TRUE;
// 	}
// 	else
// 	{
// 	        return FALSE;
// 	}
// 	$result->free();
// }




// $servername = "localhost";
// $username = "root";
// $password = "";

// // Create connection
// $conn = new mysqli($servername, $username, $password);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// // Create database
// $sql = "CREATE DATABASE myDB";
// //$sql="CREATE DATABASE IF NOT EXISTS mydb";
// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }

// $conn->close();
?>