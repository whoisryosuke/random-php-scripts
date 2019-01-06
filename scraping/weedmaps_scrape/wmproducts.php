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


$sql = "SELECT slug from brands";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$json = file_get_contents('https://api-v2.weedmaps.com/api/v2/brands/'.$row['slug'].'?include%5B%5D=brand.categories&include%5B%5D=brand.social');
		$obj = json_decode($json);

		$slug = $row['slug'];

		//description
		$description = $obj->data->brand->description;
		echo $description . ',';
		
		// categories + products
		$category = "";
		foreach($obj->data->brand->categories as $categories) {
			$category .= $categories->name . '+ ';
			echo $categories->name . ' + ';


			foreach($categories->products as $product){

				//product name
				$product_name = $product->name;
				echo $product_name . ',';

				//product desc
				$product_desc = $product->description;
				echo $product_desc . ',';

				//product parent cat
				$parent_category = $product->parent_category->name;
				echo $parent_category . ',';

				//product parent cat
				if($product->sub_category->name) {
					$sub_category = $product->sub_category->name;
					echo $sub_category . ',';
				} else {
					$sub_category = null;
				}
				
				//product images
				$images = "";
				foreach($product->gallery_images as $image) {
					$images .= $image->large_url . ' + ';
					echo $image->large_url . ', ';
				}

				// check for duplicates
				$sql_dupe_check = mysqli_query($conn, "SELECT description from products WHERE name='".$product_name."' AND brand='".$slug."'");
				$num_rows = mysqli_num_rows($sql_dupe_check);

				if($num_rows) {
					//skip product, already in DB
				} else {

					// Insert into Products DB
					$sql = "INSERT INTO products (name, description, image, parent_cat, sub_cat, brand)
					VALUES ('$product_name', '$product_desc', '$images', '$parent_category', '$sub_category', '$slug')";

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
							console.log('Insert Error');
						</script>
					    <?php
					}
				}
			}
			

		}
		echo ',';

		sleep(5);

	} // end brand loop
}

// close mySQL connection
$conn->close();

?>