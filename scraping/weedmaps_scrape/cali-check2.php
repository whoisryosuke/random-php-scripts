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
$brands = array();
echo '"id","name","image","location","parent_cat","sub_cat","description"<br />';

    $sql_select = "SELECT * from brands WHERE location IS NOT NULL";
    $check = $conn->query($sql_select);
        	while($got = $check->fetch_assoc()) {

          //check if contains CA
              if(strstr($got['location'], 'CA')) {

$sql = "SELECT * from products WHERE brand = '".$got['slug']."'";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

    $brand_slug = $row['brand'];



    $id = $row['id'];
    $name = $row['name'];
    $image = $row['image'];
    $location = $got['location'];
    $parent_cat = $row['parent_cat'];
    $sub_cat = $row['sub_cat'];
    $description = htmlspecialchars(str_replace('"', '&#34;', $row['description']));

      $brands[$brand_slug] = "\"" . $id."\", \"". $name."\", \"". $image."\", \"". $location."\", \"". $parent_cat."\", \"". $sub_cat."\", \"". $description."\"";


          } // end location loop

    } // end cali check
}
  } // end brand loop
  foreach($brands as $brand){
    print $brand . "<br />";
  }


// close mySQL connection
$conn->close();

?>
