<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/5/2016
 * Time: 2:45 AM
 */

require_once('../includes/calculator_constants.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$object = new StdClass();

$volts = $_POST['volts'];
$ohms = $_POST['ohms'];

$amps = $volts / $ohms;
$watts = $amps * $volts;


$object->volts = $volts;
$object->ohms = $ohms;

$object->amps = $amps;
$object->watts = $watts;


echo json_encode($object);