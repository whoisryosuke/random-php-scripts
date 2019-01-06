<?php
/**
 * Template Name: Scrape - California 1
 *
 * @package Listify
 */

get_header();
$biz[] = array('name' => 'Presidential Collective', 
'desc' => 'COME CHECK US OUT AT 2790 14TH ST RIVERSIDE CA 92507 ! THE BEST CLINIC IN RIVERSIDE FOR ALL YOUR MEDICAL NEEDS. ALL TOP SHELF FLOWER @ $10 A GRAM, $30 EIGHTS, & 5 GRAMS FOR $40 ALL DAY EVERYDAY !!!! 8-)', 
'addy' => '2790 14th St.', 
'type' => 'MMJ Dispensary', 
'state' => 'CA', 
'city' => 'Riverside', 
'zip' => '92507', 
'phone' => '(951)808-7091', 
'lng' => '-117.367177', 
'lat' => '33.970732', 
'avatar' => 'https://d2kxqxnk1i5o9a.cloudfront.net/uploads/avatars/dispensaries/47687/square_smoke_girl.jpg');

// INSERT INTO DATBASE

global $user_ID;

foreach ($biz as $newpost) {
$new_post = array(
'post_title' => $newpost['name'],
'post_content' => $newpost['desc'],
'post_status' => 'publish',
'post_date' => date('Y-m-d H:i:s'),
'post_author' => 1,
'post_type' => 'job_listing',
'tags_input'   => array('dispensary, mmj, mmj dispensary, medical marijuana, medical marijuana dispensary, dispensary finder, weed finder, cannabis finder, weed map, weedmaps, leafly,'),
'post_category' => $newpost['city']
);
$post_id = wp_insert_post($new_post);

if (strpos($newpost['addy'], ',') !== false) {
		list($number, $street) = explode(',', $address, 2);
	} else {
		preg_match('~^(.*?)((?:unit )?(?:[0-9]+\s?-\s?[0-9]+|[0-9]+))(.*)$~is', $address, $parts);
		$number = $parts[2];
		if (trim($parts[3]) == '') {
			$street = $parts[1];
		} else {
			$street = $parts[3];
		}
	}

$meta_key="geolocation_street_number";
$new_meta_value=$number;

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_street";
$new_meta_value=$street;

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocated";
$new_meta_value=1;

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$full_address = $newpost['addy'] . ", " . $newpost['city'] . ", " . $newpost['state'] . " " . $newpost['zip'];

$meta_key="_job_location";
$new_meta_value=$full_address;

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_formatted_address";
$new_meta_value=$full_address.", USA";

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

wp_set_post_terms( $post_id, 59, 'job_listing_category' );

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_state_short";
$new_meta_value="CA";

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_state_long";
$new_meta_value="California";

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_city";
$new_meta_value=$newpost['city'];

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_postcode";
$new_meta_value=$newpost['zip'];

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="_phone";
$new_meta_value=$newpost['phone'];

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_long";
$new_meta_value=$newpost['lng'];

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_lat";
$new_meta_value=$newpost['lat'];

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_country_short";
$new_meta_value="US";

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_country_long";
$new_meta_value="United States";

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

$meta_key="geolocation_lat";
$new_meta_value=$newpost['lat'];

add_post_meta( $post_id, $meta_key, $new_meta_value, true );

if(!empty($newpost['avatar'])) {
// Add Featured Image to Post
$image_url  = $newpost['avatar']; // Define the image URL here
$upload_dir = wp_upload_dir(); // Set upload folder
$image_data = file_get_contents($image_url); // Get image data
$filename   = basename($image_url); // Create image file name

// Check folder permission and define file location
if( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
} else {
    $file = $upload_dir['basedir'] . '/' . $filename;
}

// Create the image  file on the server
file_put_contents( $file, $image_data );

// Check image file type
$wp_filetype = wp_check_filetype( $filename, null );

// Set attachment data
$attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title'     => sanitize_file_name( $filename ),
    'post_content'   => '',
    'post_status'    => 'inherit'
);

// Create the attachment
$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

// Include image.php
require_once(ABSPATH . 'wp-admin/includes/image.php');

// Define attachment metadata
$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

// Assign metadata to attachment
wp_update_attachment_metadata( $attach_id, $attach_data );

$attach_url = wp_get_attachment_url ( $attach_id )

add_post_meta( $post_id, "_company_avatar", $attach_url, true );

} //end add avatar

}

?>

        </main>

        <?php get_sidebar(); ?>

    </div><!-- .row -->

</div><!-- .container -->
<?php

get_footer();