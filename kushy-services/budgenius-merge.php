<?php

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


$sql = "SELECT * from strains_new";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
  		$new_name = $row['strain_name'];


			$name = $row['strain_name'];
			$breeder = $row['breeder'];
			$location = $row['breeder_address'];

			$type_find = explode(' ', $row['type']);
			$type = $type_find[0];

			$thc_find = explode(' ', $row['thc']);
			$thc = (int) $thc_find[1];
			$thc = $thc * 100;

			$cbd_find = explode(' ', $row['cbd']);
			$cbd = (int) $cbd_find[1];
			$cbd = $cbd * 100;

			$cbn_find = explode(' ', $row['cbn']);
			$cbn = (int) $cbn_find[1];
			$cbn = $cbd * 100;

			//$image_array[] = $row['image1'];
			//$image_array[] = $row['image2'];
			//$image = serialize($image_array);

			// check for duplicates (if name is same)
			$sql_dupe_check = mysqli_query($conn, "SELECT breeder from strains WHERE name='".$new_name."'");

			if(mysqli_num_rows($sql_dupe_check) > 0) {

				$dupe = mysqli_fetch_row($sql_dupe_check);
				if (!$dupe)
				{
					// sql error
				}

				// if breeder is blank, update old strain
				if($dupe[0] == '') {
					// Update Brands DB
					$update = "UPDATE strains
					SET type='$type', breeder='$breeder', thc='$thc', cbd='$cbd', cbn='$cbn', location='$location'
					WHERE name = '$name';";
					//check for errors - print in JS console
					if ($conn->query($update) === TRUE) {
							?>
						<script>
							console.log('Update Success');
						</script>
							<?php
					} else {
							?>
						<script>
							console.log('Update Error');
						</script>
							<?php
					}
				}
			} else {
				// Insert into Products DB
				$sql = "INSERT INTO strains (name, type, breeder, thc, cbd, cbn, location)
				VALUES ('$name', '$type', '$breeder', '$thc', '$cbd', '$cbn', '$location')";

				//check for errors - print in JS console
				if ($conn->query($sql) === TRUE) {
						?>
					<script>
						console.log('Insert Success');
					</script>
						<?php
				} else {
						?>
					<script>
						console.log('Insert Error <?php echo $name ?>');
					</script>
						<?php
				}

			}
		}


	}

	// close mySQL connection
	$conn->close();

	?>
