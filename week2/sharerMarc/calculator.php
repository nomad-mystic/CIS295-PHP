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
     <script src="assets/includes/calculator.js.php"></script>
     <link rel="stylesheet" href="assets/includes/calculator.css.php">

</head>
<body>
<div id="show_button">Show Calculator</div>
<div id="calculator" title="Ohms's Law Calculator">
     <fieldset id="input_fields">
          <legend>Enter you volts here:</legend>
          <label for="<?php echo VOLTS_KEY; ?>">Volts:</label>
          <input type="text" name="<?php echo VOLTS_KEY; ?>">

          <label for="<?php echo OHMS_KEY; ?>">Ohms:</label>
          <input type="text" name="<?php echo OHMS_KEY; ?>">
     </fieldset>
     <fieldset id="out_fields">
          <legend>Results</legend>
          <label for="<?php echo OUT_VOLTS_KEY; ?>">Volts:</label>
          <input type="text" id="<?php echo OUT_VOLTS_KEY; ?>" disabled>

          <label for="<?php echo OUT_OHMS_KEY; ?>">Ohms:</label>
          <input type="text" id="<?php echo OUT_OHMS_KEY; ?>" disabled>

          <label for="<?php echo OUT_AMPS_KEY; ?>">Volts:</label>
          <input type="text" id="<?php echo OUT_AMPS_KEY; ?>" disabled>

          <label for="<?php echo OUT_WATTS_KEY; ?>">Ohms:</label>
          <input type="text" id="<?php echo OUT_WATTS_KEY; ?>" disabled>
     </fieldset>
</div>
</body>
</html>
