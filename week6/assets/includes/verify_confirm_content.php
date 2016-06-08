<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:56 PM
 */

require_once('LoadableContent.php');
require_once('User.php');

session_start();

// User Class constants
$email = User::getEmail();


$js = <<<JS
function verifyConfirm() {
    // activate login dialog modal 
    $('#verify_confirm_dialog').dialog({
        width: 600,
        model: true,
        buttons: {
            'Ok': function() 
            {
               $.get('assets/actions/send_verification_email.php', function() {
                    $('#verify_confirm_dialog').dialog('close');
                    verifyConfirmNotice()
               });
            },
            'Cancel': function() 
            {
                $('#verify_confirm_dialog').dialog('close');
            }
        }
    }); // end jQuery dialog
} // end verifyConfirm
function verifyConfirmNotice() {
    $('#verify_confirm_notice').dialog({
        modal: true,
        width: 500,
        buttons: {
            'Ok': function() {
                $('#verify_confirm_notice').dialog('close');
            }
        }
    }); 
} // 
JS;

$html = <<<HTML
<div title="Please Verify Your Account." id="verify_confirm_dialog">
    <p id="login_header">Click ok to to begin the verification process and an email 
    will be sent to $email with a link to our verification page. Be sure to check your
    spam folder.</p>
</div>
<div id="verify_confirm_notice" title="You password verification link has been sent.">
  <p>Verification code has been sent to registered email address for this account please check your email.
        If you havn&apos;t gotten your email after a few moments check you span and social folders.</p>
</div>
HTML;

$css = <<<CSS
#verify_confirm_dialog { 
    display: none;
}
#verify_confirm_notice { 
    display: none;
}
.ui-dialog-titlebar-close {
     display: none;
}
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
