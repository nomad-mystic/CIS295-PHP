<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/25/2016
 * Time: 1:02 AM
 */

$id = $_GET['id'];
$database = new mysqli('127.0.0.1', 'sharer', 'sharer', 'sharer');

$query = <<<QUERY
SELECT MimeType, Data, Size 
FROM images 
WHERE imageID = ?;
QUERY;


$statement = $database->prepare($query);
$statement->bind_param('i', $id);
$statement->bind_result($type, $data, $size);
$statement->execute();
$statement->fetch();

header('Content-Type: ' . $type);
header('Content-Length: ' . $size);
echo $data;