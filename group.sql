CREATE TABLE `groups` (
    `group` varchar(30) NOT NULL,
    `count` int(11) DEFAULT 0,
    PRIMARY KEY (`group`),
    UNIQUE KEY `group` (`group`)
);
