<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/5/2016
 * Time: 2:07 AM
 */



header('Content-Type: application/json');

// Generic class in PHP
$object = new StdClass();
$object->html = "<span style=\"color: #222\">Content from Ajax</span>";
$object->count = 1;

echo json_encode($object);