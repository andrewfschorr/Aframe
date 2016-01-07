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
    `title` text,
    `location` text,
    `image` longblob NOT NULL,
    `date` date NOT NULL,
    `time` time NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `date`, `time`) VALUES
(2, 'Build to-do list app', '2014-10-23', '04:02:31'),
(3, 'Add to-do items', '2014-10-28', '16:21:12');
