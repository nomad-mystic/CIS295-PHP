<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/5/2016
 * Time: 11:49 PM
 */


require_once('../includes/User.php');
require_once('../includes/SharerDatabase.php');
require_once('../includes/utilities.php');
require_once ('../includes/SharerEmail.php');
require_once('../includes/sharer_constants.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:8080');

session_id($_POST['sess_id']);
session_start();

$user = new User();
$status = $user->register(
    get_post_value(User::REGISTER_USERNAME_KEY),
    get_post_value(User::REGISTER_EMAIL_KEY),
    get_post_value(User::REGISTER_PASSWORD_KEY),
    get_post_value(User::REGISTER_PASSWORD_CONFIRMATION_KEY)
);

echo json_encode($status);