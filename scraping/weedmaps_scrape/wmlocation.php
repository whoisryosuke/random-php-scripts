<?php

function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function add_biz($obj, $conn) {
	foreach($obj->data->listings as $shop) {

		$location = "";

		$name = $shop->name;
		echo $shop->name . ',';

		$shop_slug = $shop->slug;
		echo $shop->slug . ',';

		$state = $shop->state;
		echo $shop->state . ',';

		$city = $shop->city;
		echo $shop->city . ',';

		$address = $shop->address;
		echo $shop->address . ',';

		$zip = $shop->zip_code;
		echo $shop->zip_code . ',';

		$lat = $shop->latitude;
		echo $shop->latitude . ',';

		$lng = $shop->longitude;
		echo $shop->longitude . ',';

		$package = $shop->package_level;
		echo $shop->package_level . ',';

		$type = $shop->type;
		echo $shop->type . ',';

		$license = $shop->license_type;
		echo $shop->license_type . ',';

		$rating = $shop->rating;
		echo $shop->rating . ',';

		if($shop->avatar_image->small_url) {
			$avatar = $shop->avatar_image->small_url;
			echo $shop->avatar_image->small_url . ',';
		}

		if($shop->avatar_image->medium_url) {
			$avatar = $shop->avatar_image->medium_url;
			echo $shop->avatar_image->medium_url . ',';
		}

		if($shop->avatar_image->large_url) {
			$avatar = $shop->avatar_image->large_url;
			echo $shop->avatar_image->large_url . ',';
		}

		$location .= $address . ', ' . $city . ', ' . $state . ' ' . $zip . ' ++ ';

		// Insert into Products DB
		$sql = "INSERT INTO shops_2017_brands (name, slug, state, city, zip_code, address, latitude, longitude, package_level, type, license_type, rating, avatar)
		VALUES ('$name', '$shop_slug', '$state', '$city', '$zip', '$address', '$lat', '$lng', '$package', '$type', '$license', '$rating', '$avatar')";

		//check for errors - print in JS console
		if ($conn->query($sql) === TRUE) {
				?>
			<script>
				console.log('Shop Success');
			</script>
				<?php
		} else {
				?>
			<script>
				console.log('Shop Error');
			</script>
				<?php
		}


	}

	// Update Brands DB
	$sql = "UPDATE brands_2017
	SET location='$location'
	WHERE slug = '$slug';";

	//check for errors - print in JS console
	if ($conn->query($sql) === TRUE) {
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


$sql = "SELECT slug from brands_location WHERE location = ''";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {


  		$slug = $row['slug'];
    $url = 'http://localhost:80/miniProxy.php?https://api-v2.weedmaps.com/api/v2/brands/'. $slug .'/listings?limit=150';
    $json_new = get_data($url);
		$obj = json_decode($json_new);
    print_r($obj);

        if(!empty($obj->data->listings)) {

					add_biz($obj, $conn);

							//check meta total_listings, loop through in 150 offset segments
							if($obj->meta->total_listings > 150) {

								for($i=150; $i >= $obj->meta->total_listings; $i+150) {
							    $url_offset = $url.'&offset='.$i;
							    $json_offset = get_data($url_offset);
									$obj_offset = json_decode($json_offset);
							    print_r($obj_offset);
									add_biz($obj_offset, $conn);
								}

							}

					}


        } // end empty check

        		sleep(3);

        	} // end brand loop

// close mySQL connection
$conn->close();

?>
