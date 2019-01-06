<?php

// connect to mysql
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kushy_api";



/* Kushy Effect List */
$kushy_effects = array(
    'Anxious',
    'Creative',
    'Dry Mouth',
    'Energetic',
    'Euphoric',
    'Focused',
    'Happy',
    'Horny',
    'Hungry',
    'Paranoid',
    'Psychedelic',
    'Relaxed',
    'Sleepy',
    'Talkative',
    'Tingly',
    'Uplifted'
  );

$kushy_medical = array(
  'ADD/ADHD',
  'Alzheimers',
  'Anorexia',
  'Anxiety',
  'Asthma',
  'Arthritis',
  'Bipolar Disorder',
  'Cancer',
  'Chrons Disease',
  'Depression',
  'Epilepsy',
  'Fibromyalgia',
  'Headache/Migraines',
  'IBS/GERD',
  'Inflammation',
  'Insomnia',
  'Glaucoma',
  'HIV/AIDS',
  'Lack of Appetite',
  'Multiple Sclerosis',
  'Muscle Spasms',
  'Nausea',
  'Pain',
  'PMS',
  'PTSD',
  'Rheumatoid Arthritis',
  'Seizures',
  'Stress'
);

$kushy_flavors = array(
  'Ammonia',
  'Apple',
  'Berry',
  'Blackberry',
  'Bleach',
  'Blueberry',
  'Bubblegum',
  'Candy',
  'Cherry',
  'Chocolate',
  'Citrus',
  'Coffee',
  'Earthy',
  'Fruity',
  'Grape',
  'Hash',
  'Honey',
  'Lavender',
  'Lemon',
  'Licorice',
  'Lime',
  'Mango',
  'Mint',
  'Musky',
  'Orange',
  'Perfume',
  'Pepper',
  'Pine',
  'Pineapple',
  'Raspberry',
  'Rose',
  'Skunk',
  'Spice',
  'Strawberry',
  'Sugar Cookies',
  'Sweet',
  'Vanilla'
);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * from strains_leafly";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {

			$name = $row['name'];
			$lineage = $row['lineage'];
			$type = $row['type'];
			$description = $row['description'];
			$flavors = explode('.', $row['flavors']);
			$grow_metrics = $row['grow_metrics'];
			$attributes_title_array = explode(', ', $row['attributes_title']);
      $attrib_count = 0;

      $effects = array();
      $medical_benefits = array();
      $negatives = array();

      foreach($attributes_title_array as $key => $attributes_title) {
        if($attrib_count <= 4) {
          //effects
          if($attributes_title == 'Aroused') {
            $effects[] = 'Horny';
          } elseif(in_array($attributes_title, $kushy_effects)) {
            $effects[] = $attributes_title;
          }
          //$effects[] = $attributes_title;
          //echo 'Effects: ' . $attributes_title .' - ' . $attributes_num_array[$key] . '<br />';
        }elseif($attrib_count <= 9) {
          //medical
          if(in_array($attributes_title, $kushy_medical)) {
            $medical_benefits[] = $attributes_title;
          }
          //echo 'Medical Benefits: ' . $attributes_title .' - ' . $attributes_num_array[$key] . '<br />';
        } else {
          // negatives
          if(in_array($attributes_title, $kushy_effects)) {
            $negatives[] = $attributes_title;
          }
          // echo 'Negatives: ' . $attributes_title .' - ' . $attributes_num_array[$key] . '<br />';
        }
        $attrib_count++;
      }

      $flavor_array = array();
      $flavor_count = count($flavors);

      for($i=1; $i < $flavor_count; $i++) {
        if(strpos($flavors[$i], ',')) {
          $flavor_name = explode(',',$flavors[$i]);
            if(in_array(ltrim($flavor_name[0]), $kushy_flavors)) {
              $flavor_array[] = ltrim($flavor_name[0]);
            }
        } else {
          if(in_array(ltrim($flavors[$i]), $kushy_flavors)) {
            $flavor_array[] = ltrim($flavors[$i]);
          }
        }
      }

      $attrib_effects = implode(', ', $effects);
      $attrib_medical = implode(', ', $medical_benefits);
      $attrib_negatives = implode(', ', $negatives);
      $all_effects = implode(', ', array_merge($effects, $negatives));
      $flavors_final = implode(', ', $flavor_array);

      echo 'Effects: ' . $attrib_effects . '<br />';
      echo 'Medical: ' . $attrib_medical . '<br />';
      echo 'Negatives: ' . $attrib_negatives . '<br />';
      echo 'Flavors: ' . $flavors_final . '<br />';

      //print_r($flavors);


      			// check for duplicates (if name is same)
      			$sql_dupe_check = mysqli_query($conn, "SELECT name from strains WHERE name='".$name."'");

      			if(mysqli_num_rows($sql_dupe_check) == 0) {
      				// Insert into Products DB
      				$sql = "INSERT INTO strains (name, type, effects, ailment, flavor)
      				VALUES ('$name', '$type', '$all_effects', '$attrib_medical', '$flavors_final')";

      				//check for errors - print in JS console
      				if ($conn->query($sql) === TRUE) {
      						?>
      					<script>
      						console.log('Insert Success');
      					</script>
      						<?php
      				} else {
      						?>
      					<script>
      						console.log('Insert Error <?php echo $name ?>');
      					</script>
      						<?php
      				}

      			}

		}


	}

	// close mySQL connection
	$conn->close();

	?>
