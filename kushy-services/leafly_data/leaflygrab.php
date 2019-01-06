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
$json = file_get_contents('https://www.leafly.com/api2/brands');
$obj = json_decode($json);


// print CSV friendly format
// CSV Headers
// echo "Name, Slug, Avatar, Premium <br />";

// loop every entry
foreach($obj as $brand) {


$name = $brand->brandName;
echo $name . ',';

$slug = $brand->slug;
echo $slug . ',';

if($brand->logoImageUrl) {
	$avatar = $brand->logoImageUrl;
	echo $avatar . ',';
} 

if($brand->heroImageUrl) {
	$featured = $brand->heroImageUrl;
	echo $featured . '<br />';
}


foreach($brand->products as $product) {
	$product_name = $product->productName;
	echo $product_name . ',';

	$product_slug = $product->slug;

	if($product->productThumbnailUrl) { $product_image = $product->productThumbnailUrl; echo $product_image . ','; }
	
	// check for duplicates
	$sql = "SELECT slug from products WHERE slug = '$product_slug'";
	$result = $conn->query($sql);

	if($result->num_rows == 0) {

		// Insert Product into DB
		$sql = "INSERT INTO products (name, image)
		VALUES ('$product_name', '$product_image')";

		//check for errors - print in JS console
		if ($conn->query($sql) === TRUE) {
		    ?>    
			<script>
				console.log('Product Success');
			</script>
		    <?php
		} else {
		    ?>    
			<script>
				console.log('Product Error');
			</script>
		    <?php
		}
	}
}



	// Insert Product into DB
	$sql = "INSERT INTO brands (name, slug, avatar, featured, description)
	VALUES ('$name', '$slug', '$avatar', '$featured', '$description')";

	//check for errors - print in JS console
	if ($conn->query($sql) === TRUE) {
	    ?>    
		<script>
			console.log('Brand Success');
		</script>
	    <?php
	} else {
	    ?>    
		<script>
			console.log('Brand Error');
		</script>
	    <?php
	}




	// CSV Content

} // end loop for entries


// close mySQL connection
$conn->close();

?>