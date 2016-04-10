<?php
/**
 * Created by PhpStorm.
 * User: endof
 * Date: 4/8/2016
 * Time: 3:46 PM
 */

require_once('../includes/constants.php');

// POST values
$number_of_slices = $_POST['number_of_slices'];
$slice_val = $_POST['slice_number_val'];
$slice_color = $_POST['slice_color'];
$slice_highlight = 'rgba(0, 0, 0, .1)';

// Create generic object
$slice_object = new stdClass();

// Simple validation
$error_message = 'Please start over';
if ($slice_val == 0) {
     echo json_encode($error_message);
     exit;
}

for ($i = 0; $i < $number_of_slices; $i++) {
     $slice_object->slice_highlight_[$i] = $slice_highlight;
}

// Objects
$slice_object->slice_val = $slice_val;
$slice_object->slice_color = $slice_color;
$slice_object->number_of_slices = $number_of_slices;


echo json_encode($slice_object);