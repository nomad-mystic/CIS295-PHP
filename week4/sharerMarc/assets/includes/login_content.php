<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:56 PM
 */

require_once('LoadableContent.php');
require_once('User.php');

// User Class constants
$login_username_key = User::LOGIN_USERNAME_KEY;
$login_password_key = User::LOGIN_PASSWORD_KEY;
$status_error = User::STATUS_ERROR;

$js = <<<JS
function login() {
    // clear inputs 
    $('#login_dialog input').val('');
    // clear errors 
    $('.login_error_message').html('');
    
    // activate login dialog modal 
    $('#login_dialog').dialog({
        width: 600,
        model: true,
        buttons: {
            'Login': function() 
            {
                var cookies = document.cookie.split('; ');
                var sess_id = '';
                for (var i=0; i < cookies.length; i++) { 
                    if( cookies[i].indexOf('PHPSESSID=') == 0) { 
                        sess_id = cookies[i].substr(cookies[i].indexOf('=') + 1); 
                    } 
                } // end cookies 
                
                $.post(
                // inside location window object 
                'https://' 
                // + location.host 
                + 'localhost'
                + location.pathname.substr(0, location.pathname.lastIndexOf('/')) 
                + '/assets/actions/do_login.php',
                $('#login_dialog input').serialize() + '&sess_id=' + sess_id,
                function(data) {
                console.log(data);
                    if (data.status === "{$status_error}") {
                        $('.login_error_message').html(data.message);
                    } else {
                        $('#login_dialog').dialog('close');
                        updateNavbar();
                    }
                });
            },
            'Cancel': function() 
            {
                $('#login_dialog').dialog('close');
            }
        }
    }); // end jQuery dialog
}
JS;

$html = <<<HTML
<div title="Please Log In into Your Account." id="login_dialog">
    <div class="login_error_message"></div>
    <p id="login_header">Please Enter Your Name, and Password</p>
    <fieldset>
            <!--name-->
        <label for="{$login_username_key}">Name:</label>
        <input type="text" name="{$login_username_key}" 
            id="{$login_username_key}" value="">
            
            <!--password confirmation-->
            <label for="{$login_password_key}">Password</label>
        <input type="password" name="{$login_password_key}" 
            id="{$login_password_key}" value="">
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
