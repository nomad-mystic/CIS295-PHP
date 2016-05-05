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
        });
    }); // end login_button
    
    $('#register_button').on('click', function() {
        loadContent('assets/includes/register_content.php', function() {
            register();
        });
    }); // end login_button
}); // end Ready 
function updateNavbar() {
    $.get('assets/actions/get_username.php', function(user) {
        if (user === '') {
            $('#login_button').show();
            $('#register_button').show();
            $('#username').text('').hide();
            $('#logout_button').hide();
        } else {
            $('#login_button').hide();
            $('#register_button').hide();
            $('#username').text(user).show();
            $('#logout_button').show();
        }
    });  
};
JS;

$html = <<<HTML
<nav>
    <ul class="toolbar">
        <li class="tool_item_left">
            <span class="tool_item_label">Generic Sharer</span>
        </li>
        <li class="tool_item_right clickable" id="login_button">
            <span class="tool_item_label">Sign In</span>
        </li>
        <li class="tool_item_right clickable" id="register_button">
            <span class="tool_item_label">Sign Up</span>
        </li>
        <li class="tool_item_right clickable">
            <span class="tool_item_label" id="logout_button">Log Out</span>
        </li>
        <li class="tool_item_right">
            <span class="tool_item_label" id="username"></span>
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
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
