<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/24/2016
 * Time: 11:52 PM
 */

$a = 1;
echo $a;


$uploaded_file = $_FILES['upload_files'];
$query = <<<QUERY
INSERT INTO images(Name, MimeType, Size, Data)
VALUES (?, ?, ?, ?);
QUERY;

$database = new mysqli('127.0.0.1', 'sharer', 'sharer', 'sharer');
$statement = $database->prepare($query);
$statement->bind_param('ssib', $name, $type, $size, $data);



for ($i = 0; $i < count($uploaded_file['tmp_name']); $i++) {
    $name = $uploaded_file['name'][$i];
    $type = $uploaded_file['type'][$i];
    $tmp_name = $uploaded_file['tmp_name'][$i];
//    $error = $uploaded_file['error'][$i];
    $size = $uploaded_file['size'][$i];

    $data = file_get_contents($tmp_name);
    // send a group of packets
    $statement->send_long_data(3, $data);
    $statement->execute();
}

$database->close();