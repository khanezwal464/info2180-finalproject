-- SQL File 

-- To install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME dolphin_crm < schema.sql
--
-- Host: localhost    Database: dolphin_crm
-- ------------------------------------------------------

-- Database Creation
DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;


-- Creation of Tables

-- User Table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL auto_increment,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` varchar(15) NOT NULL,
  `date_time` datetime NOT NULL default current_timestamp,
  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES ('Lynne', 'Taylor', 'taylyn73265', 'lynnetaylor@gmail.com', 'user'),
('Alex', 'Robin', '74fredrick!', 'alrobin@gmail.com', 'user'),
('Kenzie', 'McDonald', 'ruby4867!', 'kenzie.mcdonald3@gmail.com', 'user');

