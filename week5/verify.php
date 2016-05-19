<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/7/2016
 * Time: 10:02 PM
 */

require_once('assets/includes/common_requires.php');
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('assets/includes/common_head_contents.php'); ?>
</head>
<body>

<?php 
$user = new User();
$user->verify(
    get_get_value(User::USERNAME_KEY),
    get_get_value(User::CODE_KEY)
);
?>

</body>
</html>