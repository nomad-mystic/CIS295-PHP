<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/21/2016
 * Time: 1:36 AM
 */

require_once('assets/includes/SharerEmail_week4.php');

$email = new SharerEmail(
            'keith.murphy1@pcc.edu',
            'Testing Mail Class',
            '<div style="color: red">Testing the delivery of email from PHP script with error catch.</div>'
        );

// Using SharerEmail class method send()
$email->send();

// returning status of email return
$results = $email->getStatus();

if (PEAR::isError($results)) {
    echo $results->getMessage() . '<br>';
} else {
    echo 'Mail Sent';
}

