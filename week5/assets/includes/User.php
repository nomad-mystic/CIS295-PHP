<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/5/2016
 * Time: 11:29 PM
 */

class User
{
    // Class Constants
    // register constants
    const REGISTER_USERNAME_KEY = 'username';
    const REGISTER_EMAIL_KEY = 'email';
    const REGISTER_PASSWORD_KEY = 'password';
    const REGISTER_PASSWORD_CONFIRMATION_KEY = 'password_confirmation';

    // keys
    const USERNAME_KEY = 'username';
    const ROLE_KEY = 'role';
    const CODE_KEY = 'code';
    const EMAIL_KEY = 'email';
    const HASH_KEY = 'hash';
    const RESET_CODE_KEY = 'reset';
    
    const STATUS_ERROR = 'error';
    const STATUS_OK = 'ok';

    // login constants
    const LOGIN_USERNAME_KEY = 'Username';
    const LOGIN_PASSWORD_KEY = 'Hash';

    // User object constants
    const USER_USERNAME = 'Username';
    const USER_HASH = 'Hash';
    const USER_EMAIL = 'Email';
    const USER_ROLE = 'Role';

    const PASSWORD_RESET_USERNAME_KEY = 'username';

    // error messages
    const E_NO_USERNAME = '<b><span style="color: red">Error: No Username was Supplied.</span></b>';
    const E_NO_EMAIL = '<b><span style="color: red">Error: No Email was Supplied.</span></b>';
    const E_NO_PASSWORD = '<b><span style="color: red">Error: No Password was Supplied.</span></b>';
    const E_NO_PASSWORD_CONFIRMATION = '<b><span style="color: red">Error: Passwords do not Match.</span></b>';
    const E_INVALID_EMAIL = '<b><span style="color: red">Error: Invalid Email.</span></b>';
    const E_PASSWORD_MATCH = '<b><span style="color: red">Error: Password do not match.</span></b>';
    const E_USERNAME_EXISTS = '<b><span style="color: red">Error: User already exists.</span></b>';
    const E_PASSWORD_INCORRECT = '<b><span style="color: red">Error: Password Do Not Match our Records.</span></b>';
    const E_NO_SUCH_USER = '<b><span style="color: red">Error: Username Do Not Match our Records.</span></b>';

    const ROOT_DIRECTORY = 'http://localhost:8080/CIS295P/week5';

    // Member variables
    private $status;
    private $message;


    // user roles
    const USER_ROLE_VALUE = 'User';
    const VERIFIED_ROLE_VALUE = 'Verified';
    const ADMIN_ROLE_VALUE = 'Admin';

    const CODE_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    const CODE_CHAR_LENGTH = 62;
    const VERIFICATION_CODE_LENGTH = 10;
    const RESET_CODE_LENGTH = 10;

    // get functions
    public static function getUser()
    {
        if (!isset($_SESSION) || !isset($_SESSION[User::USERNAME_KEY])) {
            return '';
        }
        return $_SESSION[User::USERNAME_KEY];
    }

    // get the user email
    public static function getEmail()
    {
        if (!isset($_SESSION) || !isset($_SESSION[User::EMAIL_KEY])) {
            return '';
        }
        return $_SESSION[User::EMAIL_KEY];
    }

    // get the user role
    public static function getRole()
    {
        if (!isset($_SESSION) || !isset($_SESSION[User::ROLE_KEY])) {
            return '';
        }
        return $_SESSION[User::ROLE_KEY];
    }

    // get the users password hash
    public static function getHash()
    {
        if (!isset($_SESSION) || !isset($_SESSION[User::HASH_KEY])) {
            return '';
        }
        return $_SESSION[User::HASH_KEY];
    }

    ////////     setFunctions
    // sets user in local login() register() verify() and clearUser()
    public function setUser($username)
    {
        // storing the SESSION name in global
        $_SESSION[User::USERNAME_KEY] = $username;
    }

    // sets role
    public function setRole($role)
    {
        // storing the SESSION name in global
        $_SESSION[User::ROLE_KEY] = $role;
    }

    // sets email
    public function setEmail($email)
    {
        // storing the SESSION name in global
        $_SESSION[User::EMAIL_KEY] = $email;
    }

    // sets hash
    public function setHash($hash)
    {
        // storing the SESSION name in global
        $_SESSION[User::HASH_KEY] = $hash;
    }

    private static function getStatusObject($status, $message)
    {
        $message_object = new stdClass();

        $message_object->status = $status;
        $message_object->message = $message;

        return $message_object;
    }

    public function register($username, $email, $password, $password_confirmation)
    {
        // Checking to make user user entered all information in sign up form
        if (empty($username)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_USERNAME);
        }
        if (empty($email)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_EMAIL);
        }
        if (empty($password)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_PASSWORD);
        }
        if (empty($password_confirmation)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_PASSWORD_CONFIRMATION);
        }

        // checking to see if password match
        if ($password !== $password_confirmation) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_PASSWORD_MATCH);
        }
        // PHP function to validate different types of values
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_INVALID_EMAIL);
        }

        // connecting to the database object
        $database = new SharerDatabase();
        $user = $database->lookupUser($username);
        // making sure user is not defined
        if ($user) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_USERNAME_EXISTS);
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        // properties
        $this->username = $username;
        $this->email = $email;
        $this->hash = $hash;

        // adding user to database
        $database->addUser($username, $email, $hash, User::USER_ROLE_VALUE);
        $this->setUser($username);
        $this->setRole(User::USER_ROLE_VALUE);
        $this->setEmail($email);
        $this->sendVerification();
        $this->setHash($hash);
        
        return User::getStatusObject(User::STATUS_OK, '');
    } // end register

    // Login Method
    public function login($username, $password)
    {
        // Checking to make user user entered all information in sign up form
        if (empty($username)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_USERNAME);
        }
        if (empty($password)) {
            return User::getStatusObject(User::STATUS_ERROR, User::E_NO_PASSWORD);
        }

        // contenting to the database object
        $database = new SharerDatabase();
        // $user is an object with user information response from SharerDatabase class
        $user = $database->lookupUser($username);
        // making sure user is not defined
        if ($user) {
            if (!password_verify($password, $user[User::USER_HASH])) {
                return User::getStatusObject(User::STATUS_ERROR, User::E_PASSWORD_INCORRECT);
            }

            // adding user to session
            $this->setUser($user[User::USER_USERNAME]);
            // setting the role of the user
            $this->setRole($user[User::USER_ROLE]);
            // setting email 
            $this->setEmail($user[User::USER_EMAIL]);
            //setting hash
            $this->setHash($user[User::USER_HASH]);

            // calling local function to send email verification
            $this->sendVerification();
            return User::getStatusObject(User::STATUS_OK, '');
        }

        return User::getStatusObject(User::STATUS_ERROR, User::E_NO_SUCH_USER);
    } // end login method

    //
    public function clearUser() 
    {
        $this->setUser('');
    } // end clearUser

    private function generateCode($length)
    {
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= User::CODE_CHARS[rand(0, User::CODE_CHAR_LENGTH - 1)];
        }
        return $code;
    } // end generateCode

//    public function testGenerateCode()
//    {
//        for ($j =0; $j < 100; $j++) {
//            echo $this->generateCode(User::VERIFICATION_CODE_LENGTH) . '<hr>';
//        }
//    }

    // Send reset
    public function sendResetCode($username)
    {
        // general variables
        $sharer_url = User::ROOT_DIRECTORY;
        $code = $this->generateCode(User::RESET_CODE_LENGTH);

        // connecting to the database object
        $database = new SharerDatabase();
        $database->storeResetCode($username, $code);
        $user = $database->lookupUser($username);

        // making sure user is defined
        if ($user) {

            // adding user to session
            $this->setUser($username);
            // setting the role of the user
            $this->setRole($user[User::USER_ROLE]);
            // setting email
            $this->setEmail($user[User::USER_EMAIL]);
            //setting hash
            $this->setHash($user[User::USER_HASH]);

            $encoded_username = urlencode($username);
            $username_key = User::USERNAME_KEY;
            $code_key = User::RESET_CODE_KEY;
            $subject = 'Please reset your Generic Sharer account';
            $body = <<<BODY
<h1>Generic password reset</h1>
<p>The email address {$this->getEmail()} was used to resend Sharer password associated with
<a href="$sharer_url">Generic Sharer</a> website.. In Order to reset this
account, please click on the link below. Only verified users are allowed to 
post content and comments, through unregistered users can browse th content
posted by others.</p>
<p><a href="$sharer_url/reset.php?$code_key=$code&$username_key={$encoded_username}">Reset Your account</a></p>
BODY;

            $sharer_email = new SharerEmail(User::getEmail(), $subject, $body);
            $sharer_email->send();
        } else {
            // adding user to session
            $this->setUser('');
            // setting the role of the user
            $this->setRole('');
            // setting email
            $this->setEmail('');
            //setting hash
            $this->setHash('');
        }
    } // end sendResetCode()

    // Send verification
    public function sendVerification()
    {
        // general variables
        $sharer_url = User::ROOT_DIRECTORY;
        $code = $this->generateCode(User::VERIFICATION_CODE_LENGTH);

        // database variables
        $database = new SharerDatabase();
        $database->storeVerification(User::getUser(), $code);

        $encoded_username = urlencode(User::getUser());
        $username_key = User::USERNAME_KEY;
        $code_key = User::CODE_KEY;

        $subject = 'Please verify your Generic Sharer account';
        $body = <<<BODY
<h1>Welcome to the Generic Sharer!</h1>
<p>The email address {$this->getEmail()} was used to create an account on the 
<a href="$sharer_url">Generic Sharer</a> website.. In Order to verify this
account, please click on the link below. Only verified users are allowed to 
post content and comments, through unregistered users can browse th content
posted by others.</p>
<p><a href="$sharer_url/verify.php?{$code_key}=$code&email={$this->getEmail()}&{$username_key}={$encoded_username}">Verify my account</a></p>
BODY;
        
        $sharer_email = new SharerEmail(User::getEmail(), $subject, $body);
        $sharer_email->send();
    } // end sendVerification()

    // verifying the account
    public function verify($username, $code)
    {
        // contenting to the database object
        $database = new SharerDatabase();
        // $user is an object with user information response from SharerDatabase class
        $user = $database->lookupUser($username);
        
        if ($user[SharerDatabase::VERIFICATION_CODE_KEY] === $code) {
            // adding user to database
            $this->setUser(User::USER_USERNAME);
            $database->changeRole($username, User::VERIFIED_ROLE_VALUE);

            // store the users role and email in SESSION
            $this->setEmail($user[User::USER_EMAIL]);
            $this->setRole(User::VERIFIED_ROLE_VALUE);
            $this->setHash($user[User::USER_HASH]);

            echo <<<BODY
<header>
    <div id="navbar_area"></div>
</header>
<section>
    <main>
        <article>
            <h1>Thank you for verifying your account!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim
                minima numquam quos! Accusamus aperiam aspernatur cumque deserunt minima
                neque officia quod quos soluta totam! Corporis cumque dolorem error officiis!</p>
        </article>
    </main>
</section>
BODY;
        } else {
            echo <<<BODY
<header>
    <div id="navbar_area"></div>
</header>
<section>
    <main>
        <article>
            <h1>There was an issue with verifying your account!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim
                minima numquam quos! Accusamus aperiam aspernatur cumque deserunt minima
                neque officia quod quos soluta totam! Corporis cumque dolorem error officiis!</p>
        </article>
    </main>
</section>
BODY;
        }
    } // end verify
} // end User class