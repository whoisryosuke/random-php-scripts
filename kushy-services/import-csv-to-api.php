<?php

// Turn off all error reporting
error_reporting(0);

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

// Sort through folder > find JSON files > add to mySQL DB

$csv = array_map('str_getcsv', file('biz.csv'));
//print_r($csv)
$csv_limit = count($csv);
for($i=0; $i <= $csv_limit; $i++) {
    if($i == 0) {
        $keys = $csv[$i];
    } else {
        $array = Array();
        $array = array_combine($keys, $csv[$i]);
        
        $title = $array['Title'];
        echo $array['Title'] . '<br />';
        
        $content = $array['Content'];
        echo $array['Content'] . '<br />';
        
        $slug = str_replace('/', '', (str_replace('http://kushy.net/business/', '', $array['Permalink'])));
        echo $slug;
        
        $hours = $array['_job_hours'];
        echo $array['_job_hours'] . '<br />';
        
        $avatar = $array['_company_avatar'];
        echo $array['_company_avatar'] . '<br />';
        
        $facebook = $array['_company_facebook'];
        echo $array['_company_facebook'] . '<br />';
        
        $twitter = $array['_company_twitter'];
        echo $array['_company_twitter'] . '<br />';
        
        $googleplus = $array['_company_googleplus'];
        echo $array['_company_googleplus'] . '<br />';
        
        $linkedin = $array['_company_linkedin'];
        echo $array['_company_linkedin'] . '<br />';
        
        $instagram = $array['_company_instagram'];
        echo $array['_company_instagram'] . '<br />';
        
        $github = $array['_company_github'];
        echo $array['_company_github'] . '<br />';
        
        $lat = $array['geolocation_lat'];
        echo $array['geolocation_lat'] . '<br />';
        
        $lng = $array['geolocation_long'];
        echo $array['geolocation_long'] . '<br />';
        
        if($array['geolocation_street_number']) {
            
            $street_number = $array['geolocation_street_number'];
            echo $array['geolocation_street_number'] . '<br />';
            
            $street_address = $array['geolocation_street'];
            echo $array['geolocation_street'] . '<br />';

            $street = $street_number + $street_address;

        } else {
            $street = $array['_job_location'];
            echo $array['_job_location'] . '<br />';
        }

        
        $city = $array['geolocation_city'];
        echo $array['geolocation_city'] . '<br />';
        
        if($array['geolocation_state_short']) {
            $state = $array['geolocation_state_short'];
        } else {
            $state = $array['geolocation_state_long'];
        }
        echo $state . '<br />';
        
        $zip = $array['geolocation_postcode'];
        echo $array['geolocation_postcode'] . '<br />';
        
        $country = $array['geolocation_country_short'];
        echo $array['geolocation_country_short'] . '<br />';
        
        $website = $array['_company_website'];
        echo $array['_company_website'] . '<br />';
        
        $phone = $array['_phone'];
        echo $array['_phone'] . '<br />';
        
        $featured_img = $array['Image URL'];
        echo $array['Image URL'] . '<br />';
        
        $type = $array['Business Categories'];
        echo $array['Business Categories'] . '<br />';

        // Insert into DB
        $sql = "INSERT INTO shops_fixed4 ( name, slug, featured_image, avatar, description, lat, lng, address, city, state, postcode, country, hours, twitter, facebook, instagram, tumblr, googleplus, type)
        VALUES ('$title', '$slug', '$featured_img', '$avatar', '$content', '$lat', '$lng', '$street', '$city', '$state', '$zip', '$country', '$hours', '$twitter', '$facebook', '$instagram', '$tumblr', '$googleplus', '$type')";

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
}
/*
// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      $full = $dir . $file;
      $json = json_decode(file_get_contents($full), true);
      // print_r($json);
      foreach($json['data'] as $products) {
         //print_r($products);

         $name = mysqli_real_escape_string($conn, $products['name']);
         echo $name .', ';

         $link = mysqli_real_escape_string($conn, $products['link']);
         echo $link .', ';

         $image = mysqli_real_escape_string($conn, $products['image']);
         echo $image .', ';

         $brand_name = mysqli_real_escape_string($conn, $products['producer']['name']);
         echo $brand_name .', ';

         $brand_link = mysqli_real_escape_string($conn, $products['producer']['link']);
         echo $brand_link .', ';

         $type = mysqli_real_escape_string($conn, $products['type']);
         echo $type .', ';
         if($products['strain']) {
           unset($strainArray);
           foreach($products['strain'] as $strains) {
             $strainArray[] = $strains;
           }
         }
         $strain = str_replace("'", json_encode($strainArray));
         echo 'Strains: (' . $strain .'), ';

         $lab_test = $products['labTest'];
         echo $lab_test .', ';

         $thc = $products['thc'];
         echo $thc .', ';

         $cbd = $products['cbd'];
         echo $cbd .', ';

         $cannabis = $products['cannabis'];
         echo $cannabis .', ';

         $hash_oil = $products['hash_oil'];
         echo $hash_oil .', ';

         $created = $products['createdAt']['datetime'];
         echo $created .', ';

         $updated = $products['updatedAt']['datetime'];
         echo $updated .', ';

         $date_created = date('Y-m-d g:ia');
         echo $date_created .'<br /><br /><br />';

           // Insert into DB
           $sql = "INSERT INTO shops_fixed (name, link, image, producer, producer_link, type, strain, labtest, thc, cbd, cannabis, hashoil, created, updated, date_acquired)
           VALUES ('$name', '$link', '$image', '$brand_name', '$brand_link', '$type', '$strain', '$lab_test', '$thc', '$cbd', '$cannabis', '$hash_oil', '$created', '$updated', '$date_created')";

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
               echo "MYSQL ERROR" . mysqli_error($conn);
           }
       }

    }
    closedir($dh);

    // close mySQL connection
    $conn->close();
  }
}
