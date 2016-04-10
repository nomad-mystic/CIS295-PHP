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
    <!--jquery jquery-ui and other libraries-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/chart_js/Chart.js"></script>
    <link rel="stylesheet" href="assets/jquery-ui/overcast/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/jquery-ui/overcast/theme.css">


    <!--my scripts and styles-->
    <script src="assets/includes/pie_builder.js.php"></script>
    <link rel="stylesheet" href="assets/includes/pie_builder.css.php">

</head>
<body>
<div id="show_dialog_button">Create Chart</div>
<section id="pie_chart_dialog" title="Pie Chart Builder">
    <fieldset id="<?php echo CHART_INPUTS; ?>">
         <legend>Create Your Chart:</legend>
         <label for="<?php echo NUMBER_OF_SLICES; ?>">Number of Slices?</label>
         <input type="number" name="<?php echo NUMBER_OF_SLICES; ?>" min="1" max="4" id="<?php echo NUMBER_OF_SLICES; ?>">

         <!--get values for slices-->
         <!--Slice One-->
         <label for="<?php echo SLICE_NUMBER_VAL; ?>_1">Enter the Value of the Slice:</label>
         <input type="number" name="<?php echo SLICE_NUMBER_VAL; ?>[]">

         <label for="<?php echo SLICE_COLOR; ?>">Slice Color</label>
         <input type="color" name="<?PHP echo SLICE_COLOR; ?>">


         <!--Slice Two-->
         <label for="<?php echo SLICE_NUMBER_VAL; ?>_2">Enter the Value of the Slice:</label>
         <input type="number" name="<?php echo SLICE_NUMBER_VAL; ?>[]">
    </fieldset>
    <section>
        <canvas id="<?php echo CHART_OUTPUT; ?>" width="300px" height="300px"></canvas>
    </section>
</section>
</body>
</html>