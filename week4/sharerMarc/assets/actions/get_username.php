<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 5:20 PM
 */

require_once('../includes/User.php');

session_start();

echo User::getUser();