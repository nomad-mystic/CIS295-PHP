<?php
/**
 * Created by PhpStorm.
 * User: endof
 * Date: 4/8/2016
 * Time: 3:46 PM
 */

require_once('constants.php');
header('Content-Type: text/javascript');
?>

$(function() {

     // Click event to show dialog widget and 
     // uses AJAX to call pie_chart_builder.php which echos a JSON object for Chart.js
     var show_button = $('#show_dialog_button').button();
     show_button.on('click', function() {
          $('#pie_chart_dialog').dialog({
               width: 900,
               model: true,
               buttons: {
                    'Build Chart': function() {
                         if ($("#number_of_slices").val() == 0) {
                              console.log('This');
                         } else {
                              $.get('assets/actions/pie_chart_builder.php?' + $("#<?php echo CHART_INPUTS; ?>").serialize(),
                                   function(data) {
                                        console.log(data);
                                        var parsed_chart = jQuery.parseJSON(data);
                                        build_chart(parsed_chart);
                                   });
                         }
                    },
                    'Close': function() {
                         $('#pie_chart_dialog').dialog('close');
                    }
               }
          });
     }); // end show_button

     function build_chart(chart_data)
     {
          var i;
          var data = [];
          for (i = 0; i < chart_data.number_of_slices; i++) {
               var object = {
                    value: Number(chart_data.slice_val[i]),
                    color: chart_data.slice_color[i],
                    highlight: chart_data.slice_highlight[i],
                    label: chart_data.slice_label[i]
               };
               data.push(object);
          }
          var canvas = $('#chart_output');
          var ctx = canvas.get(0).getContext("2d");
          if (ctx) {

               new Chart(ctx).Doughnut(data);
//               Chart.defaults.global = {
//                    responsive: true
//               };

          }
     } // build_chart()

     // Dynamically create create slices inputs
     var number_of_slices = $("#<?php echo NUMBER_OF_SLICES; ?>");
     number_of_slices.on('change', function(evnt) {
          var user_input_val = number_of_slices.val();
          var i;
          var input_fields_HTML = '';
          for (i = 0; i < user_input_val; i++) {
               var label_number = i + 1;
               input_fields_HTML += '<label for="<?php echo SLICE_NUMBER_VAL; ?>">Enter the Value of the Slice:' + label_number + '</label>';
               input_fields_HTML += '<input type="number" name="<?php echo SLICE_NUMBER_VAL; ?>[]" min="0" max="1000">';

               input_fields_HTML += '<label for="<?php echo SLICE_COLOR; ?>">Slice Color: ' + label_number + '</label>';
               input_fields_HTML += '<input type="color" name="<?PHP echo SLICE_COLOR; ?>[]">';

               input_fields_HTML += '<label for="<?php echo SLICE_LABEL; ?>">Give Your Chart a Label: ' + label_number + '</label>';
               input_fields_HTML += '<input type="text" name="<?php echo SLICE_LABEL; ?>[]">';

          }
          $('.input_fields').html(input_fields_HTML);
     }); // number_of_slices

}); // end Jquery
