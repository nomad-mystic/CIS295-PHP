<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/6/2016
 * Time: 1:04 AM
 */


class SharerDatabase 
{
    // Class constants
    const DB_SERVER = '127.0.0.1';
    const DB_USER = 'sharer';
    const DB_PASSWORD = 'test';
    const DB_DATABASE = 'sharer';
    
    // properties 
    private static $database = null;

    // private functions
    private static function connect()
    {
        // this is the first connection to the database 
        if (empty(SharerDatabase::$database)) {
            // init connection 
            SharerDatabase::$database = new mysqli(SharerDatabase::DB_SERVER, 
                SharerDatabase::DB_USER, 
                SharerDatabase::DB_PASSWORD, 
                SharerDatabase::DB_DATABASE
            );
        }
        return SharerDatabase::$database;
    }

    // public functions
    public function __destruct()
    {
        if (!empty(SharerDatabase::$database)) {
            // use close() method of $database mysqli object
            SharerDatabase::$database->close();
            SharerDatabase::$database = null;
        }
    }

    public function lookupUser($username)
    {
        $connection = SharerDatabase::connect();
        $safe_username = $connection->real_escape_string($username);
        $query = <<<QUERY
SELECT Username, Email, Hash, Role
FROM users
WHERE Username = '$safe_username';
QUERY;

        $result = $connection->query($query);

        return $result->fetch_array(MYSQL_ASSOC);
    } // end lookupUser method

    public function addUser($username, $email, $hash)
    {
        $connection = SharerDatabase::connect();
        $safe_username = $connection->real_escape_string($username);
        $safe_email = $connection->real_escape_string($email);

        $query = <<<QUERY
INSERT INTO users (Username, Email, Hash, Role)
VALUES ('$safe_username', '$safe_email', '$hash', 'User');
QUERY;

        $connection->query($query);
    } // end addUser method

    public function storeVerification($username, $code)
    {
        $connection = SharerDatabase::connect();
        $safe_username = $connection->real_escape_string($username);
        $query = <<<QUERY
UPDATE users 
SET VerificationCode = '$code' 
WHERE Username = '$safe_username';
QUERY;
        $connection->query($query);
    } // end storeVerification
}