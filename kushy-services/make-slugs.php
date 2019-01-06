<?php

// Turn off all error reporting
//error_reporting(0);

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


//Source: https://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


$sql = "SELECT * from strains";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        $error = false;
        $id = $row['id'];
        $name = $row['name'];// pull API
        $slug = slugify($row['name']);// pull API

        $sql = "UPDATE `strains`
                SET `slug` = '$slug'
                WHERE `id` = '$id'";

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
