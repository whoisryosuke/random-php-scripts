<?php
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

$sql = "SELECT * FROM biz_old";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $name = $row["name"];
      $permalink = $row["permalink"];
      $featured_image = $row["featured_image"];
      $avatar = $row["avatar"];
      $images = $row["images"];
      $gallery = $row["gallery"];
      $description = $row["description"];
      $location_lat = $row["location_lat"];
      $location_lng = $row["location_lng"];
      $location_address = $row["location_address"];
      $location_state = $row["location_state"];
      $location_postcode = $row["location_postcode"];
      $location_country = $row["location_country"];
      $hours = $row["hours"];
      $coupons = $row["coupons"];
      $deals = $row["deals"];
      $rating = $row["rating"];
      $tags = $row["tags"];
      $twitter = $row["twitter"];
      $facebook = $row["facebook"];
      $instagram = $row["instagram"];
      $tumblr = $row["tumblr"];
      $googleplus = $row["googleplus"];
      $type = $row["type"];

      $sql = "INSERT INTO shops (status, name, permalink, featured_image, avatar, images, gallery, description, location_lat, location_lng, location_address, location_state, location_postcode, location_country, hours, coupons, deals, rating, tags, twitter, facebook, instagram, tumblr, googleplus, type) VALUES
      (1, '$name', '$permalink', '$featured_image', '$avatar', '$images', '$gallery', '$description', '$location_lat', '$location_lng', '$location_address', '$location_state', '$location_postcode', '$location_country', '$hours', '$coupons', '$deals', '$rating', '$tags', '$twitter', '$facebook', '$instagram', '$tumblr', '$googleplus', '$type');";      


      if ($conn->query($sql) === TRUE) {
          echo "Updated " . $row['name'];
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }

    }
} else {
    echo "0 results";
}



$conn->close();
?>
