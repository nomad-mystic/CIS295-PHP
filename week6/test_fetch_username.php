<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/20/2016
 * Time: 12:55 AM
 */

require_once('assets/includes/SharerDatabase.php');

$database = new SharerDatabase();
$results = $database->lookupUsernames('keith.murphy1@pcc.edu');
echo '<pre>';
print_r($results);
echo '</pre>';
