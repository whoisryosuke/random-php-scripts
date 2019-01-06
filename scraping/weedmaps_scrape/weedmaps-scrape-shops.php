<?php


function get_data($url) {
  // $proxy = 'socks4://47.52.24.117:80';
	$ch = curl_init();
	$timeout = 3;
	curl_setopt($ch, CURLOPT_URL, $url);
  // curl_setopt($ch, CURLOPT_PROXY, $proxy);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
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



$sql_select = "SELECT region from shops_ultra";
$check = $conn->query($sql_select);


$addto[] = 'south-bay-sd';
$addto[] = 'northridgechatsworth';
$addto[] = 'venice';
$addto[] = 'sherman-oaks';
$addto[] = 'woodland-hills-tarzana-canoga-park';
$addto[] = 'scappoose';
$addto[] = 'harbor-city-wilmington';
$addto[] = 'rosamond-mojave';
$addto[] = 'oakdale-riverbank';
$addto[] = 'alameda-county-haywardtri-valley';
$addto[] = 'olympiathurston-county';
$addto[] = 'everettsnohomish';
$addto[] = 'lake-havasu-parker';
$addto[] = 'east-phoenix';
$addto[] = 'laughlin-bullhead-city';
$addto[] = 'gilbert-chandler-mesa';
$addto[] = 'newberg-mcminnville';
$addto[] = 'eugene-springfield';
$addto[] = 'newport-lincoln-city';
$addto[] = 'glendale-peoria';
$addto[] = 'vail';
$addto[] = 'inglewood-hawthorne-crenshaw-leimert-park';
$addto[] = 'federal-way-puyallup';
$addto[] = 'san-fernando-santa-clarita';
$addto[] = 'south-gatebellflowerartesia';
$addto[] = 'ocean-shores-long-beach';
$addto[] = 'compton';
$addto[] = 'north-county';
$addto[] = 'coronanorco';
$addto[] = 'lafayette-louisville';
$addto[] = 'anaheim-hills-orange';
$addto[] = 'rosamond-mojave';
$addto[] = 'westminster';
$addto[] = 'the-foothils-sacramento';
$addto[] = 'sun-valley';
$addto[] = 'granite-bay-folsom';
$addto[] = 'south-east-san-diego';
$addto[] = 'lake-havasu-parker';
$addto[] = 'reddingmt-shasta';
$addto[] = 'henderson';
$addto[] = 'needles';
$addto[] = 'thousand-palmspalm-desert';
$addto[] = 'albany-corvallis';
$addto[] = 'hillsboro-forest-grove';
$addto[] = 'korea-town-echo-park';
$addto[] = 'summit-eagle-county';
$addto[] = 'longmont';
$addto[] = 'eastside-seattle';
$addto[] = 'albany-corvallis';
$addto[] = 'seal-beach';
$addto[] = 'clackamas-lake-oswego';
$addto[] = 'federal-way-puyallup';
$addto[] = 'north-inland';
$addto[] = 'greeley-loveland';
$addto[] = 'imperial-beach-otay-mesa';

echo "Regions with Slashes:";
if($check->num_rows > 0) {
  while($shop = $check->fetch_assoc()) {

      $region = strtolower($shop['region']);
			// no regions with slashes, weedmaps doesn't slug them correctly
      if(strpos($region, '/') == false) {
				$stripped_region = str_replace(' ', '-', $region);
				//echo $stripped_region;
				$addto[] = $stripped_region;
			} else {
				//echo $region . ',';
			}
  } // end loop for all slugs
} // end check for no records
echo "<br /><br /><br />";

$region_array = array_unique($addto);

foreach($region_array as $region_slug) {
	echo $region_slug . "<br />";
	// $url = 'http://localhost:80/miniProxy.php?https://api-v2.weedmaps.com/api/v2/listings?filter%5Bplural_types%5D%5B%5D=dispensaries&filter%5Bregion_slug%5Bdispensaries%5D%5D='.$region_slug.'&page_size=150&size=150'; // dispensaries
	// $url = 'https://api-v2.weedmaps.com/api/v2/listings?filter%5Bplural_types%5D%5B%5D=doctors&filter%5Bregion_slug%5Bdoctors%5D%5D='.$region_slug.'&page_size=150&size=150'; // doctors
	// $url = 'http://localhost:80/miniProxy.php?https://api-v2.weedmaps.com/api/v2/listings?filter%5Bplural_types%5D%5B%5D=deliveries&filter%5Bregion_slug%5Bdeliveries%5D%5D='.$region_slug.'&page_size=150&size=150';
	$json_new = get_data($url);
	$brand = json_decode($json_new);
	foreach($brand->data->listings as $listing) {
		//print_r($listing);
		$name = $listing->name;
		echo $name . ',';
		$slug = $listing->slug;
		echo $slug . ',';

		//$link = $listing->url;
		//echo $link . ',';
		/*if($listing->avatar_url) {
			$image = $listing->avatar_url;
			echo $image . ',';
		}*/

		$intro_body = $listing->intro_body;
		echo $intro_body . ',';

		$reviews_count = $listing->reviews_count;
		echo $reviews_count . ',';

		$rating = $listing->rating;
		echo $rating . ',';

		$package_level = $listing->package_level;
		echo $package_level . ',';

		$license_type = $listing->license_type;
		echo $license_type . ',';

		$address = $listing->address;
		echo $address . ',';

		$city = $listing->city;
		echo $city . ',';

		$region = $region_slug;
		echo $region . ',';

		$state = $listing->state;
		echo $state . ',';

		$zip_code = $listing->zip_code;
		echo $zip_code . ',';

		//$phone_number = $listing->phone_number;
		//echo $phone_number . ',';

		$latitude = $listing->latitude;
		echo $latitude . ',';

		$longitude = $listing->longitude;
		echo $longitude . ',';

		//$is_delivery = $listing->is_delivery;
		//echo $is_delivery . ',';

		//$has_testing = $listing->has_testing;
		//echo $has_testing . ',';

		//$is_recreational = $listing->is_recreational;
		//echo $is_recreational . ',';

		/*$hours_sunday = $listing->hours_of_operation->sunday;
		echo $hours_sunday . ',';

		$hours_monday = $listing->hours_of_operation->monday;
		echo $hours_monday . ',';

		$hours_tuesday = $listing->hours_of_operation->tuesday;
		echo $hours_tuesday . ',';

		$hours_wednesday = $listing->hours_of_operation->wednesday;
		echo $hours_wednesday . ',';

		$hours_thursday = $listing->hours_of_operation->thursday;
		echo $hours_thursday . ',';

		$hours_friday = $listing->hours_of_operation->friday;
		echo $hours_friday . ',';

		$hours_saturday = $listing->hours_of_operation->saturday;
		echo $hours_saturday . ',';
		*/

		//$description = $listing->description;
		//echo $description . ',';

		$type = $listing->type;
		echo $type . ',';

		$ranking = $listing->ranking;
		echo $ranking . ',';

		//$email = $listing->email;
		//echo $email . ',';

		//$todays_deal = $listing->todays_deal;
		//echo $todays_deal . ',';

		//$first_time_announcement = $listing->first_time_announcement;
		//echo $first_time_announcement . ',';

		//$verified_seller = $listing->verified_seller;
		//echo $verified_seller . ',';

		$is_published = $listing->is_published;
		echo $is_published . ',';

		$avatar = $listing->avatar_image->small_url;
		echo $avatar . ', <br />';

			// Insert into DB
			$sql = "INSERT INTO shops_2017_2 (name, slug, intro_body, reviews_count, rating, package_level, license_type, address, city, region, state, zip_code, latitude, longitude, type, ranking, is_published, avatar)
			 VALUES ('$name', '$slug', '$intro_body', '$reviews_count', '$rating', '$package_level', '$license_type', '$address', '$city', '$region', '$state', '$zip_code', '$latitude', '$longitude', '$type', '$ranking', '$is_published', '$avatar')";

			//check for errors - print in JS console
			if ($conn->query($sql) === TRUE) {
					?>
				<script>
					console.log('Success');
				</script>
					<?php

							sleep(1);
			} else {
					?>
				<script>
					console.log('Error');
				</script>
					<?php
							sleep(1);
			}


		} //end loop through current API listings
	}  // end loop through regions

// close mySQL connection
$conn->close();

?>
