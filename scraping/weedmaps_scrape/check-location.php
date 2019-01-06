<?php


// connect to mysql
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weedmaps_brands";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo 'name, slug, location <br />';

$sql = "SELECT * from brands_location2 WHERE location = ''";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

		$sql2 = "SELECT * from brands_location WHERE slug = '". $row['slug']."'";
		$result2 = $conn->query($sql2);

		if($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()) {
					if(!empty($row2['location'])) {
						echo $row2['name'] . ',' . $row2['slug'] . ',' . $row2['location'] . ',<br />';
					}
				}
			}

    } // end brand loop
}

// close mySQL connection
$conn->close();

?>
