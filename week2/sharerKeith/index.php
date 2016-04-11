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
     <section>
          <fieldset id="<?php echo CHART_INPUTS; ?>">
               <legend>Create Your Chart:</legend>
               <label for="<?php echo NUMBER_OF_SLICES; ?>">Number of Slices?</label>
               <input type="number" name="<?php echo NUMBER_OF_SLICES; ?>" min="1" max="4" id="<?php echo NUMBER_OF_SLICES; ?>">
               <!--Input Fields Added by Javascript-->
               <article class="input_fields"></article>
          </fieldset>
     </section>
     <section id="canvas_parent">
         <canvas id="<?php echo CHART_OUTPUT; ?>" width="350px" height="350px"></canvas>
     </section>
</section><!--end pie_chart_dialog-->
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto autem, commodi dolor doloremque doloribus ducimus
     harum nesciunt perferendis perspiciatis praesentium veniam voluptates! Aut
     doloribus dolorum eius nemo quasi, quos?
</div>
</body>
</html>