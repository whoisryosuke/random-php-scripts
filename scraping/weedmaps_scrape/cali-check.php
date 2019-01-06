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

echo '"id","name","slug","avatar","featured","description","location","category","instagram","premium" <br />';

$sql = "SELECT * from brands_cali_all WHERE location IS NOT NULL";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $name = $row['name'];
    $slug = $row['slug'];
    $location = $row['location'];
    $avatar = $row['avatar'];
    $featured = $row['featured'];
    $description = htmlspecialchars(str_replace('"', '&#34;', $row['description']));
    $category = $row['category'];
    $instagram = $row['instagram'];
    $premium = $row['premium'];

    //check if contains CA
    if(strstr($row['location'], 'CA')) {
          // explode by comma (,) to separate values
          $locations = explode(",", $row['location']);
          // loop through each location piece to find zip codes
          foreach($locations as $place) {
            // explode by ++ to get only zip_code
            $zip_check = explode('++', $place);
            // check if 90-93 are in zip code array (SoCal = zips with 93001 and below) (Norcal = up to 96162)
            if($zip_check[0] < 96162) {
              $brands[$slug] = "\"" . $id."\", \"". $name."\", \"". $slug."\", \"". $avatar."\", \"". $featured."\", \"". $description."\", \"". $location."\", \"". $category."\", \"". $instagram."\", \"". $premium."\",";
            } // end zip check

          } // end location loop

    } // end cali check

  } // end brand loop
  foreach($brands as $brand){
    print $brand . "<br />";
  }
}

// close mySQL connection
$conn->close();

?>
