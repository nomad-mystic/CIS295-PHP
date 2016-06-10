<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:34 PM
 */

require_once('LoadableContent.php');

$js = <<<JS
$(function() {
    $('#login_button').on('click', function() {
        loadContent('assets/includes/login_content.php', function() {
            login();
            updateNavbar();
        });
    }); // end login_button
    
    $('#register_button').on('click', function() {
        loadContent('assets/includes/register_content.php', function() {
            register();
            updateNavbar();
        });
    }); // end login_button
    
    $('#verify_button').on('click', function() {
    console.log('Clicked');
        loadContent('assets/includes/verify_confirm_content.php', function() {
            verifyConfirm();
        });
    }); // end verify function 
    
    $('#logout_button').on('click', function() {
        $.get('assets/actions/do_logout.php', function() {
            updateNavbar();
        });
    }); // end logout function 
    
    $(window).on('focus', function() {
        updateNavbar();
    });
    
    // Init the navbar 
    updateNavbar();
    
}); // end Ready 
function updateNavbar() {
    $.get('assets/actions/get_username.php', function(user) {
        if (user.username == '') {
            $('#login_button span').removeClass('hidden');
            $('#register_button span').removeClass('hidden');
            $('#username span').text('').addClass('hidden');
            $('#verify_button span').addClass('hidden');
            $('#logout_button span').addClass('hidden');
        } else {
            $('#login_button span').addClass('hidden');
            $('#register_button span').addClass('hidden');
            $('#username span').text(user.username).removeClass('hidden');
            
            // check to see if the user has a default role 
            if (user.role === 'User') {
                $('#verify_button span').removeClass('hidden');
            } else { 
                $('#verify_button span').addClass('hidden');
            }
            $('#logout_button span').removeClass('hidden');
        }
        
    });  
};
JS;

$html = <<<HTML
<nav>
    <ul class="toolbar">
        <li class="tool_item_left">
            <span class="tool_item_label ">Generic Sharer</span>
        </li>
        <li class="tool_item_right clickable" id="login_button">
            <span class="tool_item_label hidden">Sign In</span>
        </li>
        <li class="tool_item_right clickable" id="register_button">
            <span class="tool_item_label hidden">Sign Up</span>
        </li>
        <li class="tool_item_right clickable" id="logout_button">
            <span class="tool_item_label hidden">Log Out</span>
        </li>
        <li class="tool_item_right clickable" id="verify_button">
            <span class="tool_item_label hidden">Verify your account</span>
        </li>
        <li class="tool_item_right" id="username">
            <span class="tool_item_label hidden"></span>
        </li>
    </ul>
</nav>
HTML;

$css = <<<CSS
.toolbar {
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333; 
    -webkit-box-shadow:  0 0 11px 1px lightgrey;
    -moz-box-shadow:  0 0 11px 1px lightgrey;
    box-shadow:  0 0 11px 1px lightgrey;
    list-style-type: none;
}
.tool_item_label {
    display: block;
    color: #fff;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
.tool_item_left {
    float: left;
}
.tool_item_right {
    float: right;
}
.clickable:hover {
    background: #000;
    cursor: pointer;
}       
.hidden {
    display: none;
}
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
