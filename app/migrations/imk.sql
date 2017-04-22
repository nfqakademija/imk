CREATE DATABASE IF NOT EXISTS imk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE imk;

CREATE TABLE IF NOT EXISTS `Users` ( 
`userId`            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`userName`          CHAR(32) CHARACTER SET ascii NOT NULL,
`password`          CHAR(64) CHARACTER SET ascii NOT NULL,
`email`             CHAR(64) CHARACTER SET ascii NOT NULL DEFAULT '',
`language`          CHAR(2) CHARACTER SET ascii NOT NULL DEFAULT 'en',
`country`           CHAR(2) CHARACTER SET ascii NOT NULL DEFAULT '',
`city`              CHAR(32) NOT NULL DEFAULT '',
`birthDate`         DATE NOT NULL DEFAULT '2000-01-01',
`createDate`        INT UNSIGNED NOT NULL DEFAULT '0', # unix timestamp
`updateDate`        INT UNSIGNED NOT NULL DEFAULT '0', # unix timestamp
`lastLoginDate`     INT UNSIGNED NOT NULL DEFAULT '0', # unix timestamp
`level`             TINYINT UNSIGNED NOT NULL DEFAULT '0',
`gender`            TINYINT UNSIGNED NOT NULL DEFAULT '0' # array(1 =>'Man', 'Woman');
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4;

CREATE TABLE IF NOT EXISTS `Polls` ( 
`pollId`            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`authorId`          INT UNSIGNED NOT NULL,
`createDate`        INT UNSIGNED NOT NULL DEFAULT '0', # unix timestamp
`updateDate`        INT UNSIGNED NOT NULL DEFAULT '0', # unix timestamp
`language`          CHAR(2) CHARACTER SET ascii NOT NULL DEFAULT 'en',
`title`             VARCHAR(250) NOT NULL DEFAULT '',
`option1`           VARCHAR(250) NOT NULL DEFAULT '', # text, link or file
`option2`           VARCHAR(250) NOT NULL DEFAULT '', # text, link or file
`option3`           VARCHAR(250) NOT NULL DEFAULT '', # text, link or file
`option4`           VARCHAR(250) NOT NULL DEFAULT '', # text, link or file
`option1VotesCount` INT UNSIGNED NOT NULL DEFAULT '0',
`option2VotesCount` INT UNSIGNED NOT NULL DEFAULT '0',
`option3VotesCount` INT UNSIGNED NOT NULL DEFAULT '0',
`option4VotesCount` INT UNSIGNED NOT NULL DEFAULT '0',
INDEX (authorId,createDate,language),
FOREIGN KEY (authorId) REFERENCES Users (userId) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4;

CREATE TABLE IF NOT EXISTS `Categories` ( 
`categoryId`        INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`title`             VARCHAR(100) NOT NULL DEFAULT '',
INDEX (title)
) ENGINE=MyISAM DEFAULT CHARACTER SET utf8mb4;

CREATE TABLE IF NOT EXISTS `PollsCategories` ( 
`id`                INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`pollId`            INT UNSIGNED NOT NULL,
`categoryId`        INT UNSIGNED NOT NULL,
INDEX (pollId,categoryId),
FOREIGN KEY (pollId) REFERENCES Polls (pollId) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4;

CREATE TABLE IF NOT EXISTS `PollsVoters` ( 
`id`                INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`pollId`            INT UNSIGNED NOT NULL,
`voterId`           INT UNSIGNED NOT NULL DEFAULT '0', # anonymous userId = 0,
`voterIp`           CHAR(45) CHARACTER SET ascii NOT NULL DEFAULT '', # IPv4/IPv6 address
`voteOption`        TINYINT UNSIGNED NOT NULL DEFAULT '0', # 1, 2, 3 or 4
INDEX (pollId,voterId),
FOREIGN KEY (pollId) REFERENCES Polls (pollId) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4;
