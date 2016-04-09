<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/7/2016
 * Time: 10:02 PM
 */

require_once('assets/includes/constants.php');

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
    <script src="assets/includes/pie_builder.js.php"></script>
    <link rel="stylesheet" href="assets/includes/pie_builder.css.php">

</head>
<body>
<div id="show_dialog_button">Show Calculator</div>
<section id="pie_chart_dialog" title="Pic Chart Builder">
    <fieldset id="input_fields">
        <legend>Enter you volts here:</legend>
        <label for="<?php echo VOLTS_KEY; ?>">Volts:</label>
        <input type="text" name="<?php echo VOLTS_KEY; ?>">

        <label for="<?php echo OHMS_KEY; ?>">Ohms:</label>
        <input type="text" name="<?php echo OHMS_KEY; ?>">
    </fieldset>
    <fieldset id="out_fields">
        
    </fieldset>
</section>
</body>
</html>