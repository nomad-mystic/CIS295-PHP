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
    <title>The Pie Chart Maker</title>
    <!--jquery jquery-ui and other libraries-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/chart_js/Chart.js"></script>
    <link rel="stylesheet" href="assets/jquery-ui/overcast/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/jquery-ui/overcast/theme.css">
	<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/flatUI/dist/css/flat-ui.min.css">
    <!--my scripts and styles-->
    <script src="assets/includes/pie_builder.js.php"></script>
    <link rel="stylesheet" href="assets/includes/pie_builder.css.php">

</head>
<body>
<div id="show_dialog_button">Create Chart</div>
<section id="pie_chart_dialog" title="Pie Chart Builder">
	<div class="container-fluid">
		<div class="row">
			<section class="user-form">
				<div class="col-sm-4">
					<fieldset id="<?php echo CHART_INPUTS; ?>">
						<legend>Create Your Chart:</legend>
						<div class="form-group">
							<label for="<?php echo NUMBER_OF_SLICES; ?>" class="label">Number of Slices?</label>
							<input type="number" name="<?php echo NUMBER_OF_SLICES; ?>" min="1" max="4"
							       id="<?php echo NUMBER_OF_SLICES; ?>" class="form-control">
						</div>
						<!--Input Fields Added by Javascript-->
						<article class="input_fields"></article>
					</fieldset>
				</div>
			</section>
			<section id="canvas_parent">
				<div class="col-sm-6 col-sm-offset-2">
					<canvas id="<?php echo CHART_OUTPUT; ?>" width="350px" height="350px"></canvas>
					<h2 class="<?php echo CHART_TITLE; ?>"></h2>
				</div>
			</section>
		</div><!--end .row-->
	</div><!--end Container-->
</section><!--end pie_chart_dialog-->
</body>
</html>
