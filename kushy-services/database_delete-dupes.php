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


$sql = "SELECT * from shops_2017_merged";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
  		$id = $row['id'];


			$name = $row['name'];
			$address = $row['address'];

			// check for duplicates (if name is same)
			$sql_dupe_check = mysqli_query($conn, "SELECT id from shops_2017_merged WHERE name='".$name."' AND address='".$address."'");

			if(mysqli_num_rows($sql_dupe_check) > 1) {


					// Delete the dupe
					$update = "DELETE FROM shops_2017_merged
					WHERE id = '$id';";
					//check for errors - print in JS console
					if ($conn->query($update) === TRUE) {
							?>
						<script>
							console.log('Delete Success');
						</script>
							<?php
					} else {
							?>
						<script>
							console.log('Delete Error');
						</script>
							<?php
					}
			}
		}


	}

	// close mySQL connection
	$conn->close();

	?>
