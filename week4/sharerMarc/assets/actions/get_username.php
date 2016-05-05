<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 5:20 PM
 */

require_once('../includes/sharer_globals.php');

session_start();
if (isset($_SESSION[USERNAME_KEY])) {
    echo $_SESSION[USERNAME_KEY];
}