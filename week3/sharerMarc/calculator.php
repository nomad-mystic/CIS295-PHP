<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/7/2016
 * Time: 10:02 PM
 */

require_once('assets/includes/calculator_constants.php');

?>

<!doctype html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <title>Ohms Law Calculator</title>
     
     <!--jquery jquery-ui-->
     <script src="assets/jquery/jquery.min.js"></script>
     <script src="assets/jquery-ui/jquery-ui.min.js"></script>
     <link rel="stylesheet" href="assets/jquery-ui/overcast/jquery-ui.min.css">
     <link rel="stylesheet" href="assets/jquery-ui/overcast/theme.css">

     <!--my scripts and styles-->
     <script src="assets/includes/loadContent.js.php"></script>
     <script>
         $(function() {
             var show_button = $('#show_button').button();
             show_button.on('click', function() {
                 loadContent('assets/includes/calculator_content.php', function() {
                     calculate();
                 });
             }); // end show_button dialog
         });<!--end jQuery-->
     </script>
</head>
<body>

<div id="show_button">Show Calculator</div>

</body>
</html>
