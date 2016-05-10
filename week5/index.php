<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/7/2016
 * Time: 10:02 PM
 */
require_once('assets/includes/sharer_constants.php');
require_once('assets/includes/User.php');
require_once('assets/includes/SharerDatabase.php');
require_once('assets/includes/SharerEmail.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login and Register</title>

    <!--jquery jquery-ui-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="assets/jquery-ui/overcast/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/jquery-ui/overcast/theme.css">

    <!--my scripts and styles-->
    <script src="assets/includes/loadContent.js.php"></script>
    <script>
        $(function() {
            loadContent('assets/includes/navbar_content.php', function() {

            });
        });<!--end ready-->
    </script>
</head>
<body>

    <!--<div id="show_button">Show Calculator</div>-->
    <div>
<!--    --><?php
//        $user = new User();
//        $user->login('Testing Login', 'test');
//        $user->sendVerification();
//    ?>
    </div>


</body>
</html>
