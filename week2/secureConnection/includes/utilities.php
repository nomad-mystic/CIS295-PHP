<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/4/2016
 * Time: 11:18 PM
 */

function redirectHTTPS()
{
     if($_SERVER['HTTPS'] !== 'on') {
          header('Location: https://localhost' . $_SERVER['REQUEST_URI']);
          exit();
     }
}
