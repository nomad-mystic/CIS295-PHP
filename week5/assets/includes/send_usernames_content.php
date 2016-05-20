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
$send_usernames_email_key = User::SEND_USERNAME_EMAIL_KEY;
$status_error = User::STATUS_ERROR;

$js = <<<JS
function sendUsernames() {
    // clear inputs on cancel 
    $('#send_usernames_dialog input').val('');
 
    // activate login dialog modal 
    $('#send_usernames_dialog').dialog({
        width: 600,
        model: true,
        buttons: {
            'Reset': function() {
                $.get('assets/actions/send_usernames_email.php?' + 
                $('#send_usernames_dialog input').serialize() , function() {
                    $('#send_usernames_dialog').dialog('close');
                    sendUsernamesNotice();
                });
            },
            'Cancel': function() {
                $('#send_usernames_dialog').dialog('close');
            }
        }
    }); // end jQuery dialog
}
function sendUsernamesNotice() {
    $('#send_usernames_notice').dialog({
        modal: true,
        width: 500,
        buttons: {
            'Ok': function() {
                $('#send_usernames_notice').dialog('close');
            }
        }
    }); 
}
JS;

$html = <<<HTML
<div title="Lookup your username" id="send_usernames_dialog">
    <p id="send_usernames_header">Please Enter Your email and click ok, your username will be send to your email address.</p>
    <fieldset>
            <!--name-->
        <label for="{$send_usernames_email_key}">Email:</label>
        <input type="text" name="{$send_usernames_email_key}" 
            id="{$send_usernames_email_key}" value="">
    </fieldset>
    <div id="send_usernames_notice" title="Your username(s) has been sent.">
        <p>Your username(s) have been sent to registered email address for this account please check your email.
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
#send_usernames_dialog { 
    display: none;
}
#send_usernames_notice { 
    display: none;
}
.ui-dialog-titlebar-close {
     display: none;
}
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
