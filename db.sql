DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `mp3` MEDIUMBLOB NOT NULL,
    `title` VARCHAR(100) NOT NULL DEFAULT '',
    `artist` VARCHAR(100) NOT NULL DEFAULT '',
    `album` VARCHAR(100) NOT NULL DEFAULT '',
    `genre` VARCHAR(100) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
);
DROP TABLE IF EXISTS `users`;
CREATE TABLE users (
	userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	loginID varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	firstName varchar(128) NOT NULL,
	lastName varchar(128) NOT NULL
);
