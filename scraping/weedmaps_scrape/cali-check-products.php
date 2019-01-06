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

echo '"id","name","image","location","parent_cat","sub_cat","description"<br />';

$sql = "SELECT * from products WHERE brand IS NOT NULL";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

    $brand_slug = $row['brand'];

    $sql_select = "SELECT location from brands_2017 WHERE slug = '$brand_slug'";
    $check = $conn->query($sql_select);

    if($check->num_rows > 0) {
    	while($got = $check->fetch_assoc()) {

    $id = $row['id'];
    $name = $row['name'];
    $image = $row['image'];
    $location = $got['location'];
    $parent_cat = $row['parent_cat'];
    $sub_cat = $row['sub_cat'];
    $description = htmlspecialchars(str_replace('"', '&#34;', $row['description']));

    //check if contains CA
    if(strstr($got['location'], 'CA')) {
          // explode by comma (,) to separate values
          $locations = explode(",", $got['location']);
          // loop through each location piece to find zip codes
          foreach($locations as $place) {
            // explode by ++ to get only zip_code
            $zip_check = explode('++', $place);
            // check if 90-93 are in zip code array (SoCal = zips with 93001 and below) (Norcal = up to 96162)
            if($zip_check[0] < 96162) {
              $brands[$brand_slug] = "\"" . $id."\", \"". $name."\", \"". $image."\", \"". $location."\", \"". $parent_cat."\", \"". $sub_cat."\", \"". $description."\"";
            } // end zip check

          } // end location loop

    } // end cali check
  }
}
  } // end brand loop
  foreach($brands as $brand){
    print $brand . "<br />";
  }
}

// close mySQL connection
$conn->close();

?>
