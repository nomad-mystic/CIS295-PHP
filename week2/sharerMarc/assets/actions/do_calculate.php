<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/5/2016
 * Time: 2:45 AM
 */

require_once('../includes/calculator_constants.php');
header('Content-Type: application/json');


$object = new StdClass();

//$volts = $_GET['volts'];
//$ohms = $_GET['ohms'];
$volts = $_POST['volts'];
$ohms = $_POST['ohms'];

$amps = $volts / $ohms;
$watts = $amps * $volts;


$object->volts = $volts;
$object->ohms = $ohms;

$object->amps = $amps;
$object->watts = $watts;


echo json_encode($object);