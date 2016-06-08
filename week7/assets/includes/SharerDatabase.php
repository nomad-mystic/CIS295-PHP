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
    const DB_PASSWORD = 'sharer';
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

    // Image sets database constants
    const IMAGESETS_TABLE = 'ImageSets';
    const IMAGE_SETS_ID_KEY = 'ImageSetID';
    const OWNER_KEY = 'Owner';
    const TIME_KEY = 'Time';
    const NAME_KEY = 'Name';
    const SHARING_KEY = 'Sharing';
    const ORIGINAL_IMAGE_ID_KEY = 'OriginalImageID';
    const PAGE_IMAGE_ID_KEY = 'PageImageID';
    const THUMBNAIL_IMAGE_ID_KEY = 'ThumbnailImageID';

    // Images table constants
    const IMAGES_TABLE = 'Images';
    const IMAGES_ID_KEY = 'ImagesID';
    const MIME_TYPE_KEY = 'MimeType';
    const SIZE_KEY = 'Size';
    const WIDTH_KEY = 'Width';
    const HEIGHT_KEY = 'Height';
    const DATA_KEY = 'Data';



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
        $query = 'CALL lookup_user(?);';
        $connection = SharerDatabase::connect();
        $statement = $connection->prepare($query);
        $statement->bind_param('s', $username);
        $statement->execute();

        $result = $statement->get_result();

        return $result->fetch_array(MYSQL_ASSOC);
    } // end lookupUser method

    public function addUser($username, $email, $hash, $role)
    {
        $query = 'CALL add_user(?, ?, ?, ?);';
        $connection = SharerDatabase::connect();
        $statement = $connection->prepare($query);
        $statement->bind_param('ssss', $username, $email, $hash, $role);
        $statement->execute();

    } // end addUser method

    public function lookupUsernames($email)
    {
        $connection = SharerDatabase::connect();
        $query = 'CALL lookup_usernames(?);';
        $statement = $connection->prepare($query);
        $statement->bind_param('s', $email);
        $statement->execute();

        $results = $statement->get_results();
        return $results->fetch_all(MYSQL_ASSOC);

    }
    // private helper function
    private function changeColumnValue($username, $value, $column)
    {
        $connection = SharerDatabase::connect();
        $query = 'CALL change_column_value(?, ?, ?);';
        $statement = $connection->prepare($query);
        $statement->bind_param('sss', $username, $value, $column);
        $statement->execute();

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
    } // end changePassword()

    public function changeRole($username, $role)
    {
        $connection = SharerDatabase::connect();
        $query = 'CALL change_role(?, ?);';
        $statement = $connection->prepare($query);
        $statement->bind_param('ss', $username, $role);
        $statement->execute();

    } // end changeRole()

    public function insertImage($type, $size, $width, $height, $data)
    {
        $connection = SharerDatabase::connect();
        $query = 'CALL insert_image(?, ?, ?, ?, ?);';
        $statement = $connection->prepare($query);
        $statement->bind_param('siiib', $type, $size, $width, $height, $data);
        $statement->send_long_data(4, $data);
        $statement->execute();

        $result = $statement->get_result();
        $results_array = $result->mysqli_fetch_array(MYSQL_NUM);
        return $results_array[0];
    }

    function insertImageSet($owner, $name, $sharing, $original_id, $page_id, $thumb_id)
    {
        $query = 'SELECT insert_imageset(?, ?, ?, ?, ?, ?);';

        $connection = SharerDatabase::connect();
        $statement = $connection->prepare($query);
        $statement->bind_param('sssiii',
            $owner,
            $name,
            $sharing,
            $original_id,
            $page_id,
            $thumb_id
        );
        $statement->execute();

        $result = $statement->get_result();
        $results_array = $result->fetch_array(MYSQL_NUM);
        return $results_array[0];
    }

    public function fetchImage($set_id, $size_type_key)
    {
        $query = 'CALL fetch_image(?, ?);';
        $connection = SharerDatabase::connect();
        $statement = $connection->prepare($query);
        $statement->bind_param('is', $set_id, $size_type_key);
        $statement->execute();

        $result = $statement->get_result();
        $results_array = $result->fetch_array(MYSQL_ASSOC);

        return $results_array;
    } // end fetchImage
} // end SharerDatabase