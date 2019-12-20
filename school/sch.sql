-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(1024) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com',  '48bb6e862e54f2a795ffc4e541caed4d');

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text NOT NULL,
  `stat` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `messages` (`id`, `from`, `to`, `message`, `stat`, `created_at`) VALUES
(1, 1,  2,  '[wof[ef qppnf2 i', 1,  '2018-03-17 14:50:56'),
(2, 1,  2,  'agbani reeeee ooo',  0,  '2018-03-17 13:01:49'),
(4, 2,  1,  'Pkay we got the message',  0,  '2018-03-17 14:28:30');

DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `xpect` text NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `report` (`id`, `from`, `to`, `xpect`, `comment`, `date`) VALUES
(1, 1,  2,  'basic db skills',  'good good',  '2018-03-18 05:45:59');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `type` char(1) NOT NULL,
  `status` enum('Verified','Not Verified') NOT NULL DEFAULT 'Not Verified',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `type`, `status`) VALUES
(1, 'WebStorm', 'webstorm@gmail.com', 'bb318ce306ee6cf11e3fbc4b775294bf', '07069494803',  'C',  'Verified'),
(2, 'St Patricks Uni',  'stpat@gmail.com',  '48bb6e862e54f2a795ffc4e541caed4d', '00000000000',  'S',  'Verified');

-- 2018-03-18 06:21:21