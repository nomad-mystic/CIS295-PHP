-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2016 at 11:39 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharer`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user` (IN `name` VARCHAR(64), IN `email` VARCHAR(256), IN `hash_val` VARCHAR(128), IN `urole` VARCHAR(16))  MODIFIES SQL DATA
    COMMENT 'Add a user to the user table.'
INSERT INTO users (Username, Email, Hash, Role)
VALUES (name, email, hash_val, urole)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `change_column_value` (IN `name` VARCHAR(64), IN `value` VARCHAR(256), IN `colname` VARCHAR(64))  MODIFIES SQL DATA
    COMMENT 'Change the value of a column for the current user in users table'
BEGIN
	SET @query = CONCAT('UPDATE users SET ', colname, ' = ? WHERE Username = ?;');
    PREPARE statement FROM @query;
    SET @value = value;
    SET @name = name;
    EXECUTE statement USING @value, @name;
  	DEALLOCATE PREPARE statement;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `change_role` (IN `name` VARCHAR(64), IN `urole` VARCHAR(16))  NO SQL
    COMMENT 'Update the role of user in Users table '
UPDATE users 
SET Role = urole 
WHERE Username = name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fetch_image` (IN `set_id` INT, IN `colname` VARCHAR(64))  READS SQL DATA
    COMMENT 'Fetch an image and image metadata for a set.'
BEGIN 
	SET @query = CONCAT('SELECT MimeType, Data, Size, Name, Width, Height FROM Images JOIN Imagesets ON ImageID = ', colname, ' WHERE ImageSetId = ?'); 
    PREPARE statement FROM @query; 
    SET @set_id = set_id; 
    EXECUTE statement USING @set_id; 
  	DEALLOCATE PREPARE statement; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lookup_user` (IN `name` VARCHAR(64))  READS SQL DATA
    COMMENT 'Lookup user data based on their username.'
SELECT Username, Email, Hash, Role, VerificationCode, ResetCode
FROM users
WHERE Username = name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lookup_usernames` (IN `emailaddr` VARCHAR(256))  NO SQL
    COMMENT 'This looks up usernames associated with email.'
SELECT Username 
FROM users
WHERE Email = emailaddr$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `insert_image` (`type` VARCHAR(256), `sz` INT, `w` INT, `h` INT, `d` LONGBLOB) RETURNS INT(11) MODIFIES SQL DATA
    COMMENT 'Insert image into the images and return image_id.'
BEGIN INSERT 
INTO
    images
    (MimeType, Size, Width, Height, Data) 
VALUES
    (type, sz, w, h, d); 
    RETURN LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insert_imageset` (`own` VARCHAR(64), `n` VARCHAR(256), `s` VARCHAR(16), `oid` INT, `pid` INT, `tid` INT) RETURNS INT(11) MODIFIES SQL DATA
    COMMENT 'Insert imageset into imageset table.'
BEGIN
	INSERT INTO imagessets (Owner, Name, Sharing, OriginalImageID, PageImageID, ThumbnailImageID)
	VALUES (own, n, s, oid, pid, tid);
	RETURN LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `test_hello` () RETURNS VARCHAR(256) CHARSET utf8 NO SQL
    DETERMINISTIC
    COMMENT 'My Test Function'
RETURN CONCAT('hello', ' ', 'world')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `MimeType` varchar(256) NOT NULL,
  `Size` int(11) NOT NULL,
  `Width` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `Data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `imagesets`
--

CREATE TABLE `imagesets` (
  `ImageSetID` int(11) NOT NULL,
  `Owner` varchar(64) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Name` varchar(256) NOT NULL,
  `Sharing` varchar(16) NOT NULL,
  `OriginalImageID` int(11) NOT NULL,
  `PageImageID` int(11) NOT NULL,
  `ThumbnailImageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(64) NOT NULL,
  `Hash` varchar(128) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Role` varchar(16) NOT NULL,
  `VerificationCode` text NOT NULL,
  `ResetCode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `imagesets`
--
ALTER TABLE `imagesets`
  ADD PRIMARY KEY (`ImageSetID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `imagesets`
--
ALTER TABLE `imagesets`
  MODIFY `ImageSetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
