<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/16/2016
 * Time: 8:01 PM
 */

require_once('../includes/sharer_constants.php');
require_once('../includes/User.php');
require_once('../includes/SharerDatabase.php');
require_once('../includes/SharerEmail.php');

session_start();

$user = new User();
$user->sendVerification();

