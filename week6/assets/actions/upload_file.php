<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/26/2016
 * Time: 12:25 AM
 */

require_once('../includes/User.php');
require_once('../includes/Image.php');
require_once('../includes/ImageSet.php');
require_once('../includes/SharerDatabase.php');

session_start();
header('Content-Type: application/json');

$object = new stdClass();

$object->status = 'OK';

$img = new ImageSet($_FILES[ImageSet::FILE_KEY]);
$object->id = $img->getID();

echo json_encode($object);
