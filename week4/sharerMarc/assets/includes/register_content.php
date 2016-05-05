<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:56 PM
 */

require_once('LoadableContent.php');

$js = <<<JS
function register() {
    $('#register_dialog').dialog();
    console.log('register');
}
JS;

$html = <<<HTML
<div title="Please Create Your Account." id="register_dialog">[Stub]</div>
HTML;

$css = <<<CSS

CSS;
$object = new LoadableContent($js, $html, $css);
$object->load();
