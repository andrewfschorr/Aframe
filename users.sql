CREATE TABLE users (
    user_id int(11) NOT NULL auto_increment,
    email varchar(30) NOT NULL,
    password char(60) NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE KEY email (email)
);