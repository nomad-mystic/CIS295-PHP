<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:56 PM
 */

require_once('LoadableContent.php');
require_once('User.php');

$register_username_key = User::REGISTER_USERNAME_KEY;
$register_email_key = User::REGISTER_EMAIL_KEY;
$register_password_key = User::REGISTER_PASSWORD_KEY;
$register_password_confirmation_key = User::REGISTER_PASSWORD_CONFIRMATION_KEY;
$status_error = User::STATUS_ERROR;

$js = <<<JS
function register() {
    // clear inputs 
    $('#register_dialog input').val('');
    // clear errors 
    $('.register_error_message').html('');
    
    // activate register dialog modal 
    $('#register_dialog').dialog({
        width: 600,
        model: true,
        buttons: {
            'Register': function() 
            {
                var cookies = document.cookie.split('; ');
                console.log(cookies);
                var sess_id = '';
                for (var i=0; i < cookies.length; i++) { 
                    if( cookies[i].indexOf('PHPSESSID=') == 0) { 
                        sess_id = cookies[i].substr(cookies[i].indexOf('=') + 1); 
                        console.log(sess_id);
                    } 
                } // end cookies 
                
                $.post(
                // inside location window object 
                'https://' 
                // + location.host 
                + 'localhost'
                + location.pathname.substr(0, location.pathname.lastIndexOf('/')) 
                + '/assets/actions/do_register.php',
                $('#register_dialog input').serialize() + '&sess_id=' + sess_id,
                function(data) {
                console.log(data);
                    if (data.status === "{$status_error}") {
                        $('.register_error_message').html(data.message);
                    } else {
                        $('#register_dialog').dialog('close');
                        updateNavbar();
                    }
                });
            },
            'Cancel': function() 
            {
                $('#register_dialog').dialog('close');
            }
        }
    }); // end jQuery dialog
}
JS;

$html = <<<HTML
<div title="Please Create Your Account." id="register_dialog">
    <div class="register_error_message"></div>
    <p id="register_header">Please Enter Your Name, Email, and Password</p>
    <fieldset>
            <!--name-->
        <label for="{$register_username_key}">Name:</label>
        <input type="text" name="{$register_username_key}" 
            id="{$register_username_key}" value="">
            
            <!--email-->
            <label for="{$register_email_key}">Email</label>
        <input type="email" name="{$register_email_key}" 
            id="{$register_email_key}" value="">
            
            <!--password confirmation-->
            <label for="{$register_password_key}">Password</label>
        <input type="password" name="{$register_password_key}" 
            id="{$register_password_key}" value="">
            
            <!--password confirmation-->
            <label for="{$register_password_confirmation_key}">Password Confirmation</label>
        <input type="password" name="{$register_password_confirmation_key}" 
            id="{$register_password_confirmation_key}" value="">
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
     width: 30em;
}
fieldset label {
     display: block;
}
.ui-dialog-titlebar-close {
     display: none;
}
CSS;
$object = new LoadableContent($js, $html, $css);
$object->load();
