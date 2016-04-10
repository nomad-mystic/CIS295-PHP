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

     var show_button = $('#show_dialog_button').button();
     show_button.on('click', function() {
          $('#pie_chart_dialog').dialog({
               width: 700,
               model: true,
               buttons: {
                    'Build Chart': function() {
                         console.log('clicked');
                         $.post('assets/actions/pie_chart_builder.php',
                              $("#<?php echo CHART_INPUTS; ?>").serialize(),
                              function(data) {
                                   console.log(data);
//                                        build_chart(data);
//                            $('#<?php //echo OUT_VOLTS_KEY; ?>//').val(data.volts);
//                            $('#<?php //echo OUT_OHMS_KEY; ?>//').val(data.ohms);
//                            $('#<?php //echo OUT_AMPS_KEY; ?>//').val(data.amps);
//                            $('#<?php //echo OUT_WATTS_KEY; ?>//').val(data.watts);
                              });
                    },
                    'Close': function() {
                         $('#pie_chart_dialog').dialog('close');
                    }
               }
          });
          build_chart();
     });

     function build_chart() {
          var data = [
               {
                    value: 300,
                    color:"#F7464A",
                    highlight: "#FF5A5E",
                    label: "Red"
               },
               {
                    value: 50,
                    color: "#46BFBD",
                    highlight: "#5AD3D1",
                    label: "Green"
               },
               {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#FFC870",
                    label: "Yellow"
               }
          ];
          var ctx = $('#chart_output').get(0).getContext("2d");
          if (ctx) {
               console.log('this');
               var chart = new Chart(ctx).Doughnut(data);
               console.log(chart);
          }
     } // build_chart()

     // Dynamically create create slices inputs
     var number_of_slices = $("#<?php echo NUMBER_OF_SLICES; ?>");
     number_of_slices.on('change', function(evnt) {
          var user_input_val = number_of_slices.val();
          var i;

          for (i = 0; i < user_input_val; i++) {
               console.log(number_of_slices.val());
          }
     }); // number_of_slices

}); // end Jquery
