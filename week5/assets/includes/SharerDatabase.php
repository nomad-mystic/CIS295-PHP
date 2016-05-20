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

    // database table
    const USERS_TABLE = 'users';
    // Class columns keys for database
    const VERIFICATION_CODE_KEY = 'VerificationCode';
    const ROLE_KEY = 'Role';
    const USERNAME_KEY = 'Username';
    const HASH_KEY = 'Hash';
    const EMAIL_KEY = 'Email';
    const RESET_KEY = 'ResetCode';

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
    
    // looking up user by username
    public function lookupUser($username)
    {
        // SQL Keys
        $verification_code = SharerDatabase::VERIFICATION_CODE_KEY;
        $reset_code = SharerDatabase::RESET_KEY;
        $users_table = SharerDatabase::USERS_TABLE;
        $connection = SharerDatabase::connect();
        $username_key = SharerDatabase::USERNAME_KEY;
        $email_key = SharerDatabase::EMAIL_KEY;
        $hash_key = SharerDatabase::HASH_KEY;
        $role_key = SharerDatabase::ROLE_KEY;

        $safe_username = $connection->real_escape_string($username);
        $query = <<<QUERY
SELECT $username_key, $email_key, $hash_key, $role_key, $verification_code, $reset_code
FROM $users_table
WHERE $username_key = '$safe_username';
QUERY;

        $result = $connection->query($query);

        return $result->fetch_array(MYSQL_ASSOC);
    } // end lookupUser method

    public function addUser($username, $email, $hash, $role)
    {
        // SQL Keys
        $users_table = SharerDatabase::USERS_TABLE;
        $username_key = SharerDatabase::USERNAME_KEY;
        $email_key = SharerDatabase::EMAIL_KEY;
        $hash_key = SharerDatabase::HASH_KEY;
        $role_key = SharerDatabase::ROLE_KEY;

        $connection = SharerDatabase::connect();
        $safe_username = $connection->real_escape_string($username);
        $safe_email = $connection->real_escape_string($email);

        $query = <<<QUERY
INSERT INTO $users_table ($username_key, $email_key, $hash_key, $role_key)
VALUES ('$safe_username', '$safe_email', '$hash', '$role');
QUERY;

        $connection->query($query);
    } // end addUser method

    public function lookupUsernames($email)
    {

        // SQL Keys
        $users_table = SharerDatabase::USERS_TABLE;
        $username_key = SharerDatabase::USERNAME_KEY;
        $email_key = SharerDatabase::EMAIL_KEY;

        $connection = SharerDatabase::connect();
        $safe_email = $connection->real_escape_string($email);

        $query = <<<QUERY
SELECT $username_key 
FROM $users_table
WHERE $email_key = '$safe_email';
QUERY;

        $results = $connection->query($query);
        return $results->fetch_all(MYSQL_ASSOC);

    }
    // private helper function
    private function changeColumnValue($username, $value, $column)
    {
        // SQL Keys
        $username_key = SharerDatabase::USERNAME_KEY;
        $users_table = SharerDatabase::USERS_TABLE;

        $connection = SharerDatabase::connect();
        $safe_username = $connection->real_escape_string($username);
        $query = <<<QUERY
UPDATE $users_table 
SET $column = '$value' 
WHERE $username_key = '$safe_username';
QUERY;
        $connection->query($query);
    } // end storeVerification

    public function storeVerification($username, $code)
    {
        $this->changeColumnValue($username, $code, SharerDatabase::VERIFICATION_CODE_KEY);
        // SQL Keys

    } // end storeVerification

    public function storeResetCode($username, $code)
    {
        $this->changeColumnValue($username, $code, SharerDatabase::RESET_KEY);
    } // end storeResetCode()

    // for changing the users password after reset
    public function changePassword($username, $hash)
    {
        $this->changeColumnValue($username, $hash, SharerDatabase::HASH_KEY);
        $this->changeColumnValue($username, '', SharerDatabase::RESET_KEY);
    }

    public function changeRole($username, $role)
    {
        // SQL Keys
        $role_key = SharerDatabase::ROLE_KEY;
        $username_key = SharerDatabase::USERNAME_KEY;
        $users_table = SharerDatabase::USERS_TABLE;

        $connection = SharerDatabase::connect();
        $safe_username = $connection->real_escape_string($username);
        $query = <<<QUERY
UPDATE $users_table 
SET $role_key = '$role' 
WHERE $username_key = '$safe_username';
QUERY;
        $connection->query($query);
    }
} // end SharerDatabase