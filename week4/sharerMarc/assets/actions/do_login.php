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

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:8080');

session_id($_POST['sess_id']);
session_start();

$user = new User();
$status = $user->login(
    get_post_value(User::LOGIN_USERNAME_KEY),
    get_post_value(User::LOGIN_PASSWORD_KEY)
);

echo json_encode($status);