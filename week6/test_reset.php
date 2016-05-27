<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/16/2016
 * Time: 10:26 PM
 */

require_once('assets/includes/common_requires.php');

$user = new User();
$user->sendResetCode('Nomad 10');