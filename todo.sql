SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `images` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `category` text,
    `title` text,
    `location` text,
    `file_location` text,
    `file_name` text,
    `date` date NOT NULL,
    `time` time NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `tasks`
--

INSERT INTO `images` (`id`, `title`, `location`, `file_name`, `image`, `date`, `time`) VALUES
(2, 'title', 'location', '', '' ,'2014-10-23', '04:02:31');
