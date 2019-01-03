<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "radionaija";

/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
*/

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


/*
// Create database
$sql = "CREATE DATABASE myDB";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/

/* Compose SQL search string ///// */

$searchstring="osei joe ngo poverty";    // Obtain search string via form textbox

//$searchstring  = "piece1 piece2 piece3 piece4 piece5 piece6";
$pieces = explode(" ", $searchstring);   // break up search items into array elements for further use

// Start composing SQL statement ...
echo "Count of array elements ". count($pieces). "<br>";
$sql = "SELECT * FROM broadcasts  WHERE ";

//$sql = 'SELECT * FROM broadcasts WHERE descrip LIKE %'.$pieces[0]."%";

for ($x = 0; $x< count($pieces); $x++) {
 	
 $sql .= "descrip LIKE '%".$pieces[$x]."%'";	
	echo "The array key $x: contains $sql <br><br>";

	if (($x+1) != count($pieces)) {
			$sql .= ' or ';
	}
	
}  // End of FOR loop


echo $sql.'<br>';

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["id"]. " " . $row["datetime"]. " " . substr($row["descrip"],0,50)."...  ". $row["url"]. "<br><br>";
	//	echo "id: " . $row["id"]. " DateTime: " . $row["datetime"]. " Description" . $row["desc"]. "photo:" . $row["photo"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>