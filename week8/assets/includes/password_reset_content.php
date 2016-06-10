<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/17/2016
 * Time: 1:38 AM
 */


require_once('LoadableContent.php');
require_once('User.php');

// User Class constants
$password_reset_username_key = User::PASSWORD_RESET_USERNAME_KEY;
$status_error = User::STATUS_ERROR;

$js = <<<JS
function passwordReset() {
    // clear inputs on cancel 
    $('#password_reset_dialog input').val('');
 
    // activate login dialog modal 
    $('#password_reset_dialog').dialog({
        width: 600,
        model: true,
        buttons: {
            'Reset': function() {
                $.get('assets/actions/send_reset_email.php?' + 
                $('#password_reset_dialog input').serialize() , function() {
                    $('#password_reset_dialog').dialog('close');
                    passwordResetNotice();
                });
            },
            'Cancel': function() {
                $('#password_reset_dialog').dialog('close');
            }
        }
    }); // end jQuery dialog
}
function passwordResetNotice() {
    $('#password_reset_notice').dialog({
        modal: true,
        width: 500,
        buttons: {
            'Ok': function() {
                $('#password_reset_notice').dialog('close');
            }
        }
    }); 
}
JS;

$html = <<<HTML
<div title="Do you want to reset your password?" id="password_reset_dialog">
    <p id="password_reset_header">Please Enter Your Username and click ok, A password
    reset link will be sent to the registered email address for this account.</p>
    <fieldset>
            <!--name-->
        <label for="{$password_reset_username_key}">Name:</label>
        <input type="text" name="{$password_reset_username_key}" 
            id="{$password_reset_username_key}" value="">
    </fieldset>
    <div id="password_reset_notice" title="You password reset link has been sent.">
        <p>Password has been sent to registered email address for this account please check your email.
        If you havn&apos;t gotten your email after a few moments check you span and social folders.</p>
    </div>
</div>
HTML;

$css = <<<CSS
fieldset {
     padding: 20px;
}
fieldset input {
     display: block;
     margin-bottom: 12px;
     width: 30em;
}
fieldset label {
     display: block;
}
#password_reset_dialog { 
    display: none;
}
#password_reset_notice { 
    display: none;
}
.ui-dialog-titlebar-close {
     display: none;
}
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
