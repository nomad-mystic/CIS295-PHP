<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/5/2016
 * Time: 2:45 AM
 */

header('Content-Type: application/json');


$object = new StdClass();

//$volts = $_GET['volts'];
//$ohms = $_GET['ohms'];
$volts = $_POST['volts'];
$ohms = $_POST['ohms'];
$actions = $_POST['actions'];

$dir = './';
if (is_dir($dir))
{
     $filenames = scandir($dir, 0);
     $object->files = $filenames;
     // do something
} else {
     echo "No such directory";
}



$object->volts = $volts;
$object->ohms = $ohms;

$object->amps = $volts / $ohms;
$object->watts = $volts * $object->amps;

echo json_encode($object);