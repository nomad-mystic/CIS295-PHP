<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:56 PM
 */

require_once('LoadableContent.php');

$js = <<<JS
function login() {
    $('#login_dialog').dialog();
}
JS;

$html = <<<HTML
<div title="Please Sign in to Your Account." id="login_dialog">[Stub]</div>
HTML;

$css = <<<CSS

CSS;
$object = new LoadableContent($js, $html, $css);
$object->load();
