<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 5:20 PM
 */

require_once('../includes/User.php');
header('Content-Type: application/json');

session_start();

// Creating new class an assigning username property to the object 
$object = new stdClass();
$object->username = User::getUser();
$object->role = User::getRole();

echo json_encode($object);
