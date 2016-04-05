<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/5/2016
 * Time: 2:03 AM
 */


?>


<!doctype html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <title>AJAX</title>
     <script src="assets/jquery/jquery.min.js"></script>
     <script src="assets/jquery-ui/jquery-ui.min.js"></script>
     <link rel="stylesheet" href="assets/jquery-ui/overcast/jquery-ui.min.css">
     <link rel="stylesheet" href="assets/jquery-ui/overcast/theme.css">

     <script>
          $(function() {
               $.get('assets/actions/get_content.php', function(data) {
                    $('#content').html(data.html);
                    $('#count').html(data.count + Math.PI + Math.random());
               });

               /*--Get
               $('input[type="submit"]').on('click', function() {
                    $.get('assets/actions/calc_ohms.php?' + $('fieldset').serialize(), function(data) {
                         $('.results').html(data.volts + ' volts <br> ' +
                              data.ohms + ' Ohms <br>' +
                              data.amps + ' amps </br>' +
                              data.watts + ' Watts ');
                         console.log(data);
                    });
               });
               */
               $('input[type="submit"]').on('click', function() {
                    $.post('assets/actions/calc_ohms.php', $('fieldset').serialize(), function(data) {
                         $('.results').html(data.volts + ' volts <br> ' +
                              data.ohms + ' Ohms <br>' +
                              data.amps + ' amps </br>' +
                              data.watts + ' Watts ');
                         console.log(data);
                    });
               });
          });
     </script>
</head>
<body>
<p>Here is the fetched content:<span id="content"></span></p>
<p>Here is the fetched count:<span id="count"></span></p>
<fieldset>
     <table>
          <tr>
               <td>Volts</td>
               <td><input type="text" name="volts"></td>
          </tr>
          <tr>
               <td>Ohms</td>
               <td><input type="text" name="ohms"></td>
          </tr>
          <tr>
               <td>Actions</td>
               <td><input type="text" name="actions"></td>
          </tr>
          <tr>
               <td>
                    <input type="submit" value="Calculate">
               </td>
          </tr>
     </table>
</fieldset>
<div class="results"></div>
</body>
</html>
