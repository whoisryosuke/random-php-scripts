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

$dir = "./leafly_data/strains/sativa/";
$i = 0;

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      $full = $dir . $file;
      $products = json_decode(file_get_contents($full), true);
       print_r($json);
         //print_r($products);

         $name = mysqli_real_escape_string($conn, $products['name']);
         echo $name .', ';

         $type = 'Sativa';

         $description = mysqli_real_escape_string($conn, $products['description']);
         echo $description .', ';

         $lineage = mysqli_real_escape_string($conn, $products['lineage']);
         echo $lineage .', ';

         $flavors = mysqli_real_escape_string($conn, $products['flavors']);
         echo $flavors .', ';

         $grow_metrics = mysqli_real_escape_string($conn, $products['grow_metrics']);
         echo $grow_metrics .', ';

         $attributes_title = mysqli_real_escape_string($conn, $products['attributes_title']);
         echo $attributes_title .', ';

         $attributes_num = mysqli_real_escape_string($conn, $products['attributes_num']);
         echo $attributes_num .', ';

         $date_created = date('Y-m-d g:ia');
         echo $date_created .'<br /><br /><br />';

           // Insert into DB
           $sql = "INSERT INTO strains_leafly (name, type, description, lineage, flavors, grow_metrics, attributes_title, attributes_num, date_acquired)
           VALUES ('$name', '$type', '$description', '$lineage', '$flavors', '$grow_metrics', '$attributes_title', '$attributes_num', '$date_created')";

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
    closedir($dh);

    // close mySQL connection
    $conn->close();
  }
}
