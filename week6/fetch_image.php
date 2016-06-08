<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 11:22 PM
 */

require_once('assets/includes/utilities.php');
require_once('assets/includes/SharerDatabase.php');
require_once('assets/includes/ImageSet.php');

$set_id = get_get_value(ImageSet::IMAGE_SET_ID_KEY);
$size_type_key = get_get_value(ImageSet::IMAGE_SET_SIZE_KEY);

// this method is not called
// Fatal error: Call to a member function bind_param()
// on boolean in
// C:\xampp\htdocs\CIS295P\week6\assets\includes\SharerDatabase.php
// on line 286
$image_array = ImageSet::fetchImage($set_id, $size_type_key);

header('Content-Type: ' . $image_array[SharerDatabase::MIME_TYPE_KEY]);
header('Content-Length: ' . $image_array[SharerDatabase::SIZE_KEY]);

echo $image_array[SharerDatabase::DATA_KEY];