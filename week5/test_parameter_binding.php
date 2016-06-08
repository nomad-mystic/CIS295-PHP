<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/24/2016
 * Time: 11:53 PM
 */

$email = $_GET['email'];
$role = 'verified';

$database = new mysqli('127.0.0.1', 'sharer', 'sharer', 'sharer');
//$safe_email = $database->real_escape_string($email);


$query = <<<QUERY
SELECT Username
FROM users 
WHERE Email = ?
AND Role = ?;
QUERY;

$statement = $database->prepare($query);
$statement->bind_param('ss', $email, $role);
$results = $statement->execute();
$statement->bind_result($username);


$result_array = [];
while ($statement->fetch()) {
    $result_array[] = ['Role' => $role, 'Username' => $username];
//    echo 'Role: ' . $role . ' ' . 'Username: ' . $username . '<br>';
}
var_dump($result_array);
//$results = $rs->fetch_all(MYSQL_ASSOC);


// close database
$database->close();

//echo '<pre>';
//print_r($results);
//echo '</pre>';


