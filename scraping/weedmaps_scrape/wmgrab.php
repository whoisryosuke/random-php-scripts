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


// pull API
$json = file_get_contents('https://api-v2.weedmaps.com/api/v2/brands?page=12&page_size=150&sort_by=name&sort_order=asc');
$obj = json_decode($json);


// print CSV friendly format
// CSV Headers
// echo "Name, Slug, Avatar, Premium <br />";

// loop every entry
foreach($obj->data->brands as $brand) {


$name = $brand->name;
echo $name . ',';

$slug = $brand->slug;
echo $slug . ',';
if($brand->avatar_image->large_url) {
	$avatar = $brand->avatar_image->large_url;
	echo $avatar . ',';
} elseif($brand->avatar_image->small_url) {
	$avatar = $brand->avatar_image->small_url;
	echo $avatar . ',';
}

$premium = $brand->is_premium;
echo $premium . '<br />';


// Insert into DB
$sql = "INSERT INTO brands (name, slug, avatar, premium)
VALUES ('$name', '$slug', '$avatar', '$premium')";

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
		console.log('Error');
	</script>
    <?php
}

	// CSV Content

} // end loop for entries


// close mySQL connection
$conn->close();

?>