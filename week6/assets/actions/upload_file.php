<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 12:25 AM
 */

require_once('../includes/Image.php');
require_once('../includes/SharerDatabase.php');

header('Content-Type: application/json');



$object = new stdClass();

$object->status = 'OK';


$img = new Image($_FILES[Image::FILE_KEY]);
$object->id = $img->getId();

echo json_encode($object);
