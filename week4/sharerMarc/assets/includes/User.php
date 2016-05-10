<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/5/2016
 * Time: 11:29 PM
 */




//class User
//{
//    // Class Constants
//    // register constants
//    const REGISTER_USERNAME_KEY = 'username';
//    const REGISTER_EMAIL_KEY = 'email';
//    const REGISTER_PASSWORD_KEY = 'password';
//    const REGISTER_PASSWORD_CONFIRMATION_KEY = 'password_confirmation';
//
//    const USERNAME_KEY = 'username';
//    const STATUS_ERROR = 'error';
//    const STATUS_OK = 'ok';
//
//    // login constants
//    const LOGIN_USERNAME_KEY = 'Username';
//    const LOGIN_PASSWORD_KEY = 'Hash';
//
//    // User object constants
//    const USER_USERNAME = 'Username';
//    const USER_HASH = 'Hash';
//    const USER_EMAIL = 'Email';
//    const USER_ROLE = 'Role';
//
//    // error messages
//    const E_NO_USERNAME = '<b><span style="color: red">Error: No Username was Supplied.</span></b>';
//    const E_NO_EMAIL = '<b><span style="color: red">Error: No Email was Supplied.</span></b>';
//    const E_NO_PASSWORD = '<b><span style="color: red">Error: No Password was Supplied.</span></b>';
//    const E_NO_PASSWORD_CONFIRMATION = '<b><span style="color: red">Error: Passwords do not Match.</span></b>';
//    const E_INVALID_EMAIL = '<b><span style="color: red">Error: Invalid Email.</span></b>';
//    const E_PASSWORD_MATCH = '<b><span style="color: red">Error: Password do not match.</span></b>';
//    const E_USERNAME_EXISTS = '<b><span style="color: red">Error: User already exists.</span></b>';
//    const E_PASSWORD_INCORRECT = '<b><span style="color: red">Error: Password Do Not Match our Records.</span></b>';
//    const E_NO_SUCH_USER = '<b><span style="color: red">Error: Username Do Not Match our Records.</span></b>';
//
//
//    // Member variables
//    private $status;
//    private $message;
//    private $username = '';
//    private $email = '';
//    private $hash = '';
//
//    public static function getUser()
//    {
//        if (!isset($_SESSION) || !isset($_SESSION[User::USERNAME_KEY])) {
//            return '';
//        }
//        return $_SESSION[User::USERNAME_KEY];
//    }
//
//    public function setUser($username)
//    {
//        // storing the SESSION name in global
//        $_SESSION[User::USERNAME_KEY] = $username;
//    }
//
//    private static function getStatusObject($status, $message)
//    {
//        $message_object = new stdClass();
//
//        $message_object->status = $status;
//        $message_object->message = $message;
//
//        return $message_object;
//    }
//
//    public function register($username, $email, $password, $password_confirmation)
//    {
//        // Checking to make user user entered all information in sign up form
//        if (empty($username)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_USERNAME);
//        }
//        if (empty($email)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_EMAIL);
//        }
//        if (empty($password)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_PASSWORD);
//        }
//        if (empty($password_confirmation)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_PASSWORD_CONFIRMATION);
//        }
//
//        // checking to see if password match
//        if ($password !== $password_confirmation) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_PASSWORD_MATCH);
//        }
//        // PHP function to validate different types of values
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_INVALID_EMAIL);
//        }
//
//        // contenting to the database object
//        $database = new SharerDatabase();
//        $user = $database->lookupUser($username);
//        // making sure user is not defined
//        if ($user) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_USERNAME_EXISTS);
//        }
//
//        $hash = password_hash($password, PASSWORD_DEFAULT);
//
//        // properties
//        $this->username = $username;
//        $this->email = $email;
//        $this->hash = $hash;
//
//        // adding user to database
//        $database->addUser($username, $email, $hash);
//        $this->setUser($username);
//
//        return User::getStatusObject(User::STATUS_OK, '');
//    } // end register
//
//    // Login Method
//    public function login($username, $password)
//    {
//        // Checking to make user user entered all information in sign up form
//        if (empty($username)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_USERNAME);
//        }
//        if (empty($password)) {
//            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_PASSWORD);
//        }
//
//        // contenting to the database object
//        $database = new SharerDatabase();
//        // $user is an object with user information response from SharerDatabase class
//        $user = $database->lookupUser($username);
//        // making sure user is not defined
//        if ($user) {
//            if (!password_verify($password, $user[User::USER_HASH])) {
//                return User::getStatusObject(User::STATUS_ERROR, User::E_PASSWORD_INCORRECT);
//            }
//
//            // properties
//            $this->username = $user[User::USER_USERNAME];
//            $this->email = $user[User::USER_EMAIL];
//            $this->hash = $user[User::USER_HASH];
//
//            // adding user to database
//            $this->setUser($username);
//
//            return User::getStatusObject(User::STATUS_OK, '');
//        }
//
//        return User::getStatusObject(User::STATUS_ERROR, User::E_NO_SUCH_USER);
//    } // end login method
//
//    public function clearUser()
//    {
//        $this->setUSer('');
//    }
//} // end User class