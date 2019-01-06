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



$sql_select = "SELECT slug from shops_2017_2 WHERE id > 2930";
$check = $conn->query($sql_select);

if($check->num_rows > 0) {
  while($shop = $check->fetch_assoc()) {
    print_r($shop);
      $slug = $shop['slug'];
      echo $slug;
        $url = 'http://localhost:80/miniProxy.php?https://weedmaps.com/api/web/v1/listings/'. $slug;
      $json_new = get_data($url);
      $brand = json_decode($json_new, true);

      $name = $brand[name];
      echo $name . ',';

      $link = $brand[url];
      echo $link . ',';
      if($brand[avatar_url]) {
        $image = $brand[avatar_url];
        echo $image . ',';
      }

      $intro_body = $brand[intro_body];
      echo $intro_body . ',';

      $reviews_count = $brand[reviews_count];
      echo $reviews_count . ',';

      $rating = $brand[rating];
      echo $rating . ',';

      $package_level = $brand[package_level];
      echo $package_level . ',';

      $license_type = $brand[license_type];
      echo $license_type . ',';

      $address = $brand[address];
      echo $address . ',';

      $city = $brand[city];
      echo $city . ',';

      $region = $brand[region];
      echo $region . ',';

      $state = $brand[state];
      echo $state . ',';

      $zip_code = $brand[zip_code];
      echo $zip_code . ',';

      $phone_number = $brand[phone_number];
      echo $phone_number . ',';

      $latitude = $brand[latitude];
      echo $latitude . ',';

      $longitude = $brand[longitude];
      echo $longitude . ',';

      $is_delivery = $brand[is_delivery];
      echo $is_delivery . ',';

      $has_testing = $brand[has_testing];
      echo $has_testing . ',';

      $is_recreational = $brand[is_recreational];
      echo $is_recreational . ',';

      $hours_sunday = $brand[hours_of_operation][sunday];
      echo $hours_sunday . ',';

      $hours_monday = $brand[hours_of_operation][monday];
      echo $hours_monday . ',';

      $hours_tuesday = $brand[hours_of_operation][tuesday];
      echo $hours_tuesday . ',';

      $hours_wednesday = $brand[hours_of_operation][wednesday];
      echo $hours_wednesday . ',';

      $hours_thursday = $brand[hours_of_operation][thursday];
      echo $hours_thursday . ',';

      $hours_friday = $brand[hours_of_operation][friday];
      echo $hours_friday . ',';

      $hours_saturday = $brand[hours_of_operation][saturday];
      echo $hours_saturday . ',';

      $description = $brand[description];
      echo $description . ',';

      $type = $brand[_type];
      echo $type . ',';

      $ranking = $brand[ranking];
      echo $ranking . ',';

      $email = $brand[email];
      echo $email . ',';

      $todays_deal = $brand[todays_deal];
      echo $todays_deal . ',';

      $first_time_announcement = $brand[first_time_announcement];
      echo $first_time_announcement . ',';

      $verified_seller = $brand[verified_seller];
      echo $verified_seller . ',';


        // Insert into DB
        $sql = "INSERT INTO shops_2017_email (name, slug, link, image, intro_body, reviews_count, rating, package_level, license_type, address, city, region, state, zip_code, phone_number, latitude, longitude, is_delivery, has_testing, is_recreational, hours_sunday, hours_monday, hours_tuesday, hours_wednesday, hours_thursday, hours_friday, hours_saturday, description, type, ranking, email, todays_deal, first_time_announcement, verified_seller)
         VALUES ('$name', '$slug', '$link', '$image', '$intro_body', '$reviews_count', '$rating', '$package_level', '$license_type', '$address', '$city', '$region', '$state', '$zip_code', '$phone_number', '$latitude', '$longitude', '$is_delivery', '$has_testing', '$is_recreational', '$hours_sunday', '$hours_monday', '$hours_tuesday', '$hours_wednesday', '$hours_thursday', '$hours_friday', '$hours_saturday', '$description', '$type', '$ranking', '$email', '$todays_deal', '$first_time_announcement', '$verified_seller')";

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

  } // end loop for all slugs
} // end check for no records
// close mySQL connection
$conn->close();

?>
