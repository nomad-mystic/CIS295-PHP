<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/4/2016
 * Time: 11:02 PM
 */


require_once('includes/utilities.php');

redirectHTTPS();



?>
<!doctype html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <title>Document</title>
</head>
<body>
     <p><?php echo $_SERVER['HTTP_HOST']; ?></p>
     <p><?php echo $_SERVER['REQUEST_URI']; ?></p>
     <p><?php echo 'Hello World'; ?></p>

</body>
</html>
