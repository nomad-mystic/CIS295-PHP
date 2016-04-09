<?php
/**
 * Created by PhpStorm.
 * User: endof
 * Date: 4/8/2016
 * Time: 3:46 PM
 */

header('Content-Type: text/javascript');
?>

$(function() {

    $('').on('click', function() {

    }); // end show dialog

    var show_button = $('#show_button').button();
    show_button.on('click', function() {
        $('#pie_chart_dialog').dialog({
            width: 600,
            model: true,
            buttons: {
                'Build Chart': function() {
                    console.log('clicked');
                    $.post('assets/actions/do_calculate.php',
                        $('#input_fields').serialize(),
                        function(data) {
                            build_chart(data);
//                            $('#<?php //echo OUT_VOLTS_KEY; ?>//').val(data.volts);
//                            $('#<?php //echo OUT_OHMS_KEY; ?>//').val(data.ohms);
//                            $('#<?php //echo OUT_AMPS_KEY; ?>//').val(data.amps);
//                            $('#<?php //echo OUT_WATTS_KEY; ?>//').val(data.watts);
                        })
                },
                'Close': function() {
                    $('#pie_chart_dialog').dialog('close');
                }
            }
        });
    }); // end show_button dialog
    function build_chart() {

    }
}); // end Jquery 
