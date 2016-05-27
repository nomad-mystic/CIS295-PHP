<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/25/2016
 * Time: 12:21 AM
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testing Upload form</title>
</head>
<body>
<form action="test_upload.php" method="post" id="test_upload_form"
    enctype="multipart/form-data">
    File Upload: <input type="file" class="upload_file_input" name="upload_files[]" multiple>
    <input type="submit" value="Submit">
</form>
</body>
</html>
