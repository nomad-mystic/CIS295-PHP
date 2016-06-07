<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/21/2016
 * Time: 2:08 AM
 */
// PEAR Mail extension
require_once('Mail.php');

class SharerEmail
{
    // Class Constants
    const HOST = 'ssl://smtp.gmail.com';
    const PORT = '465';
    const USERNAME = 'keith.murphy1@pcc.edu';
    const PASSWORD = '2Changeme031987';
    const FROM = 'Generic Sharer <sharer@sharer.com>';

    // Local Variables
    private $mTo;
    private $mSubject;
    private $mBody;
    private $mResults;

    public function __construct($to, $subject, $body)
    {
        $this->mTo = $to;
        $this->mBody = $body;
        $this->mSubject = $subject;
    } // End __construct

    public function send()
    {
        $headers = [
            'To'=> $this->mTo,
            // double colon because it is a class const
            'From' => SharerEmail::FROM,
            'Subject' => $this->mSubject,
            'MIME-Version' => 1.0,
            'Content-Type' => 'text/html; charset=utf8'
        ];

        $transport = [
            'host' => SharerEmail::HOST,
            'port' => SharerEmail::PORT,
            'username' => SharerEmail::USERNAME,
            'password' => SharerEmail::PASSWORD,
            'auth' => TRUE
        ];

        // Mail::factory() – creates a mailer instance
        // Returns: object - a specific Mail instance or a PEAR_Error object on failure.
        $smtp = Mail::factory('smtp', $transport);

        // Sends a mail. The send() method is provided by the object returned from factory()
        $this->mResults = $smtp->send($this->mTo, $headers, $this->mBody);

    } // end send() method
    
    public function getStatus()
    {
        return $this->mResults;
    }
}; // End SharerEmail
