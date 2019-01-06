<?php

// Turn off all error reporting
//error_reporting(0);

//mySQL
// connect to mysql
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kushy_api";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * from images";
$result = $conn->query($sql);

$strains = [];

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

        $id = $row['item_id'];
        $strains[$id] = $row['image_url'];

        }
    }

foreach($strains as $strain_id => $photo) {
    
    // Insert into DB
    $sql = "UPDATE strains 
    SET `image` = '$photo'
    WHERE `id` = '$strain_id'";

    //check for errors - print in JS console
    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
        console.log('Success');
        </script>
        <?php
    } else {
        ?>
        <script>
        console.log(`Error <?php echo mysqli_error($conn); ?>`);
        </script>
        <?php
    }    
}