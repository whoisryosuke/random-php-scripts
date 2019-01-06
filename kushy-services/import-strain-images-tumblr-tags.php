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


function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


$sql = "SELECT * from strains";
$result = $conn->query($sql);


$my_file = 'error-strains.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        $error = false;
        $strain_id = $row['id'];
        $name = $row['name'];// pull API

        $url = "http://weedporndaily.tumblr.com/tagged/$name/xml";
        echo $url;
        $json_new = get_data($url);
        try {
            $object = new SimpleXmlElement($json_new);
        } catch (Exception $e) {
        // Do something with the exception, or ignore it.
            $error = true;
            // log strains that don't have images
            $data = "\n".$name;
            fwrite($handle, $data);
        }
        if($error == false) {
        if(isset($object->posts->post)) {
            foreach($object->posts->post as $entry) {
                if(isset($entry->{'photo-url'})) {
                    $photo = $entry->{'photo-url'};
                    $caption =  $entry->{'photo-caption'};

                    echo "<li><a href='$photo'><img src='$photo' width='100' /></a></li>";

                        // Insert into DB
                    $sql = "INSERT INTO images ( item_id, item_type, image_url, caption )
                    VALUES ('$strain_id', 'strains', '$photo', '$caption')";

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
        }
        }
        
    }
}


fclose($handle);