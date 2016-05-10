<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/6/2016
 * Time: 12:19 AM
 */


function get_post_value($key)
{
    if (!isset($_POST) || !isset($_POST[$key])) {
        return '';
    } else {
        return $_POST[$key];
    }
}