<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/25/2016
 * Time: 11:14 PM
 */

require_once('LoadableContent.php');
require_once('calculator_constants.php');

$in_volts_key = VOLTS_KEY;
$in_ohms_key = OHMS_KEY;
$out_volts_key = OUT_VOLTS_KEY;
$out_amps_key = OUT_AMPS_KEY;
$out_watts_key = OUT_WATTS_KEY;
$out_ohms_key = OUT_OHMS_KEY;

$js = <<<JS
function calculate() {
    $('#calculator').dialog({
        width: 600,
        model: true,
        buttons: {
            'Calculate': function() 
            {
                $.post(
                'https://localhost/CIS295P/week3/sharerMarc/assets/actions/do_calculate.php',
                $('#input_fields').serialize(),
                function(data) {
                    $('#{$out_volts_key}').val(data.volts);
                    $('#{$out_ohms_key}').val(data.ohms);
                    $('#{$out_amps_key}').val(data.amps);
                    $('#{$out_watts_key}').val(data.watts);
                })
            },
            'Done': function() 
            {
                $('#calculator').dialog('close');
            }
        }
    });
}
JS;

$html = <<<HTML
<div id="calculator" title="Ohms's Law Calculator">
     <fieldset id="input_fields">
          <legend>Enter you volts here:</legend>
          <label for="{$in_volts_key}">Volts:</label>
          <input type="text" name="{$in_volts_key}">

          <label for="{$in_ohms_key}">Ohms:</label>
          <input type="text" name="{$in_ohms_key}">
     </fieldset>
     <fieldset id="out_fields">
          <legend>Results</legend>
          <label for="{$out_volts_key}">Volts:</label>
          <input type="text" id="{$out_volts_key}" disabled>

          <label for="{$out_ohms_key}">Ohms:</label>
          <input type="text" id="{$out_ohms_key}" disabled>

          <label for="{$out_amps_key}">Volts:</label>
          <input type="text" id="{$out_amps_key}" disabled>

          <label for="{$out_watts_key}">Ohms:</label>
          <input type="text" id="{$out_watts_key}" disabled>
     </fieldset>
</div>
HTML;

$css = <<<CSS
fieldset {
     padding: 20px;
}
fieldset input {
     display: block;
     margin-bottom: 12px;
}
fieldset label {
     display: block;
}
.ui-dialog-titlebar-close {
     display: none;
}
#calculator {
     display: none;
}
#input_fields {
     float: left;
     width: 40%;
}
#out_fields {
     float: right;
     width: 40%;
}
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
