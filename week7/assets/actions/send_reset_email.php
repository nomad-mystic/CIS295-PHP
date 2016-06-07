<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/17/2016
 * Time: 2:03 AM
 */

require_once('../includes/sharer_constants.php');
require_once('../includes/User.php');
require_once('../includes/SharerDatabase.php');
require_once('../includes/SharerEmail.php');
require_once('../includes/utilities.php');

session_start();

$user = new User();
$user->sendResetCode(get_get_value(User::PASSWORD_RESET_USERNAME_KEY));