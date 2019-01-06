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
      $image_data = array(
        'image_url' => $row["image_url"],
        'image_title' => $row["image_title"],
        'image_caption' => $row["image_caption"],
        'image_alt' => $row["image_alt"]
      );
      $images = json_encode(array('images' => $image_data), JSON_FORCE_OBJECT);

      $sql = "UPDATE biz_old SET images = '$images' WHERE id=$id";

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
