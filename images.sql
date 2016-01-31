SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `images` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `group` text,
    `title` text,
    `location` text,
    `file_location` text,
    `file_name` text,
    `date` date NOT NULL,
    `time` time NOT NULL,
    `featured` tinyint(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;


ALTER TABLE `images` ADD `featured` tinyint(1) DEFAULT 0
