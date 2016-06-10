<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/6/2016
 * Time: 4:22 PM
 */


require_once('../includes/User.php');

session_start();

$user = new User();
$user->clearUser('');


$session_info = session_get_cookie_params();
$_SESSION = [];
setcookie(
    session_name(),
    '',
    0,
    $session_info['path'],
    $session_info['domain'],
    $session_info['secure'],
    $session_info['httponly']
);

session_destroy();