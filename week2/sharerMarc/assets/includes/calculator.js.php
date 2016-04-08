<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/7/2016
 * Time: 10:00 PM
 */

require_once('calculator_constants.php');
header('Content-Type: text/javascript');

?>


$(function() {

     var show_button = $('#show_button').button();
     show_button.on('click', function() {
               $('#calculator').dialog({
                    width: 600,
                    model: true,
                    buttons: {
                         'Calculate': function() {
                              console.log('clicked');
                              $.post('assets/actions/do_calculate.php',
                              $('#input_fields').serialize(),
                              function(data) {

                                   $('#<?php echo OUT_VOLTS_KEY; ?>').val(data.volts);
                                   $('#<?php echo OUT_OHMS_KEY; ?>').val(data.ohms);
                                   $('#<?php echo OUT_AMPS_KEY; ?>').val(data.amps);
                                   $('#<?php echo OUT_WATTS_KEY; ?>').val(data.watts);
                              })
                         },
                         'Done': function() {
                              $('#calculator').dialog('close');
                         }
                    }
               });
     }); // end show_button dialog
});// end jQuery
