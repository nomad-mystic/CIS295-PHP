<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/20/2016
 * Time: 1:27 AM
 */

require_once('assets/includes/User.php');
require_once('assets/includes/SharerDatabase.php');
require_once('assets/includes/SharerEmail.php');
require_once('assets/includes/sharer_constants.php');

$user = new User();
$user->sendUsernamesEmail('nomadmystics@gmail.com');